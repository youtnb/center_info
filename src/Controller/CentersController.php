<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use RuntimeException;
use Cake\Event\Event;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 *
 * @method \App\Model\Entity\Center[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CentersController extends AppController
{
    public $components = ['AttachedFile', 'Log'];
    
    const UPLOAD_DIR = UPLOAD_DIR_CENTER;
    const UPLOAD_PATH = WWW_ROOT. DIR_SEP. self::UPLOAD_DIR. DIR_SEP;
    const PHOTO_DIR = PHOTO_DIR_CENTER;
    const PHOTO_PATH = WWW_ROOT. DIR_SEP. self::PHOTO_DIR. DIR_SEP;
    
    // セッションに保存する検索条件
    const SESSION_CLASS = 'Center.';
    private $search_items = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'name', 'delete_flag'];
    const SESSION_CLASS_SUB = 'Device.';
    private $search_items_sub = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'center_id', 'm_device_type_id', 'm_operation_system_id']; // nameとdelete_flagは共有しない
    
    //api
    const AUTHORIZED_API_TOKEN = 'apikey';
    const BAD_REQUEST_CODE = 400;
    const NORMAL_REQUEST_CODE = 200;

    /**
     * 認証不要なアクションを追記
     * @param \App\Controller\Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['getCenterList']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MCustomers', 'MPrefectures', 'MUsers']
        ];

        // パラメータ無いときはセッションから検索条件取得
        $session = $this->request->session();
        if (empty($this->request->query))
        {
            foreach($this->search_items as $i)
            {
                if ($session->check(self::SESSION_CLASS.$i) && !empty($session->read(self::SESSION_CLASS.$i))) $this->request->query[$i] = $session->read(self::SESSION_CLASS.$i);
            }
        }

        $query = $this->Centers->find();
        $m_area_id = null;
        if (!empty($this->request->query))
        {
            // 一覧検索
            $query = $this->Centers->find('search', $this->request->query);
            if (isset($this->request->query['m_area_id'])) $m_area_id = $this->request->query['m_area_id'];
            
            // セッションに検索条件保存
            foreach($this->search_items as $i)
            {
                if (isset($this->request->query[$i])) $session->write([self::SESSION_CLASS.$i => $this->request->query[$i]]);
            }
            foreach($this->search_items_sub as $i)
            {
                if (isset($this->request->query[$i])) $session->write([self::SESSION_CLASS_SUB.$i => $this->request->query[$i]]);
            }
        }
        $centers = $this->paginate($query);
        
        $mCustomers = $this->Centers->MCustomers->find('list');
        
        $tableMAreas = TableRegistry::getTableLocator()->get('MAreas');
        $mAreas = $tableMAreas->find('list');
        $mPrefectures = $this->Centers->MPrefectures->find('list')->where(['delete_flag' => 0]);
        if($m_area_id)
        {   // 都道府県絞り込み
            $mPrefectures->where(['m_area_id' => $m_area_id]);
        }
        
        $this->set(compact('centers', 'mCustomers', 'mPrefectures', 'mAreas'));
    }

    /**
     * セッションクリア
     * @return type
     */
    public function clear()
    {
        // セッションから検索条件削除
        $session = $this->request->session();
        foreach($this->search_items as $i)
        {
            $session->delete(self::SESSION_CLASS.$i);
        }
        foreach($this->search_items_sub as $i)
        {
            $session->delete(self::SESSION_CLASS_SUB.$i);
        }

        // リダイレクト
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => ['MCustomers', 'MPrefectures', 'MUsers', 'Devices']
        ]);

        $tableMDeviceTypes = TableRegistry::getTableLocator()->get('MDeviceTypes');
        $mDeviceTypes = $tableMDeviceTypes->find('list')->toArray();
        
        // 添付ファイル
        $result = glob(self::UPLOAD_PATH. $id. DIR_SEP. '*');
        $file_list = array();
        foreach($result as $file)
        {
            $path_info = pathinfo($file);
            $file_list[$path_info['basename']] = DIR_SEP. implode(DIR_SEP, [self::UPLOAD_DIR, $id, $path_info['basename']]);
        }
        // 画像
        $result_photo = glob(self::PHOTO_PATH. $id. DIR_SEP. '*');
        $photo_list = array();
        foreach($result_photo as $file)
        {
            $path_info = pathinfo($file);
            // サムネイル画像を対象に処理
            if (substr($path_info['filename'], -1 * strlen(PHOTO_SAFIX)) == PHOTO_SAFIX)
            {
                $pre_name = $this->AttachedFile->removePhotSafix($path_info['basename']);
                $photo_list[$pre_name] = [
                    DIR_SEP. implode(DIR_SEP, [self::PHOTO_DIR, $id, $path_info['basename']]),
                    DIR_SEP. implode(DIR_SEP, [self::PHOTO_DIR, $id, $pre_name])];
            }
        }
        
        $this->set(compact('center', 'mDeviceTypes', 'file_list', 'photo_list'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $center = $this->Centers->newEntity();
        if ($this->request->is('post'))
        {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center))
            {
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $center->id,
                    'm_customer_id:'. $center->m_customer_id,
                    'name:'. $center->name,
                ]));
            
                $this->Flash->success(__('The center has been saved.'));
                return $this->redirect(['action' => 'view', $center['id']]);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $mCustomers = $this->Centers->MCustomers->find('list', ['order' => 'id']);
        $mPrefectures = $this->Centers->MPrefectures->find('list');
        $mUsers = $this->Centers->MUsers->find('list');
        $this->set(compact('center', 'mCustomers', 'mPrefectures', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center))
            {
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $center->id,
                    'm_customer_id:'. $center->m_customer_id,
                    'name:'. $center->name,
                ]));
                
                $this->Flash->success(__('The center has been saved.'));
                return $this->redirect(['action' => 'view', $center['id']]);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $mCustomers = $this->Centers->MCustomers->find('list', ['order' => 'id']);
        $mPrefectures = $this->Centers->MPrefectures->find('list');
        $mUsers = $this->Centers->MUsers->find('list');
        $this->set(compact('center', 'mCustomers', 'mPrefectures', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $center = $this->Centers->get($id);
        if ($this->Centers->delete($center))
        {
            // ログ
            $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                'id:'. $center->id,
                'm_customer_id:'. $center->m_customer_id,
                'name:'. $center->name,
            ]));

            $this->Flash->success(__('The center has been deleted.'));
        }
        else
        {
            $this->Flash->error(__('The center could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * ファイル保存処理
     * @param type $id
     * @return type
     */
    public function addFile($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            if (empty($this->request->data['import_file']['tmp_name']))
            {
                $this->Flash->error(__('Please input attached file.'));
                return $this->redirect(['action' => 'view', $center['id']]);                
            }
            
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            $dir = self::UPLOAD_PATH. $center['id'];
            
            try {
                $this->AttachedFile->upload($this->request->data['import_file'], $dir);
            } catch (RuntimeException $e){
                $this->Flash->error(__('The file could not be uploaded. Please, try again.'));
                $this->Flash->error(__($e->getMessage()));
                return $this->redirect(['action' => 'index']);
            }
            
            // ログ
            $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                'id:'. $center['id'],
                'file:'. $this->request->data['import_file']['name'],
            ]));

            $this->Flash->success(__('The file has been uploaded.'));
        }
        
        return $this->redirect(['action' => 'view', $center['id']]);
    }
    
    /**
     * ファイル削除処理
     * @param type $id
     * @param type $filename
     * @return type
     */
    public function deleteFile($id = null, $filename = null)
    {
        if ($filename)
        {
            $this->AttachedFile->delete(implode('', [self::UPLOAD_PATH, $id, DIR_SEP, urldecode($filename)]));
            // ログ
            $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                'id:'. $id,
                'file:'. urldecode($filename),
            ]));
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * 写真保存処理
     * @param type $id
     * @return type
     */
    public function addPhoto($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            if (empty($this->request->data['import_file']['tmp_name']))
            {
                $this->Flash->error(__('Please input attached photo.'));
                return $this->redirect(['action' => 'view', $center['id']]);                
            }
            
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            $dir = self::PHOTO_PATH. $center['id'];
            
            try {
                $center['import_file'] = $this->AttachedFile->uploadPhoto($this->request->data['import_file'], $dir);
            } catch (RuntimeException $e){
                $this->Flash->error(__('The file could not be uploaded. Please, try again.'));
                $this->Flash->error(__($e->getMessage()));
                return $this->redirect(['action' => 'index']);
            }
            
            // ログ
            $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                'id:'. $id,
                'file:'. $this->request->data['import_file']['name'],
            ]));

            $this->Flash->success(__('The file has been uploaded.'));
        }
        
        return $this->redirect(['action' => 'view', $center['id']]);
    }
    
    /**
     * 写真削除処理
     * @param type $id
     * @param type $filename
     * @return type
     */
    public function deletePhoto($id = null, $filename = null)
    {
        if ($filename)
        {
            $this->AttachedFile->deletePhoto(implode('', [self::PHOTO_PATH, $id, DIR_SEP, urldecode($filename)]));
            
            // ログ
            $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                'id:'. $id,
                'file:'. urldecode($filename),
            ]));
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * API実験
     */
    public function getCenterList()
    {
        // レンダリング不要
        $this->autoRender = false;
        // レスポンス形式指定
        $this->response->type('application/json');
        
        // 認証
        $auth = true;
        if (!empty($this->request->query))
        {
            $key = $this->request->query['key'];
            if ($key != self::AUTHORIZED_API_TOKEN)
            {
                $auth = false;
            }
        }
        else
        {
            $auth = false;
        }

        // 認証成功の場合
        if ($auth)
        {
            $records =  $this->Centers->find('all')->toArray();
            $data = $this->create_response_data($key, self::NORMAL_REQUEST_CODE, 'success' , $records);
            //$this->log(json_encode($data),LOG_DEBUG);
            $this->response->body(json_encode($data,JSON_UNESCAPED_UNICODE));
        }
        else
        {
            // レスポンス用JSONを生成するための連想配列を生成
            $data = $this->create_response_data($key, self::BAD_REQUEST_CODE, 'bad request', []);
            $this->response->body(json_encode($data));
        }
    }
    
    /**
     * API実験（レスポンス作成）
     * @param type $key
     * @param type $status
     * @param type $message
     * @param type $data
     * @return array
     */
    private function create_response_data($key, $status, $message , $data = null)
    {
        if ($status === self::NORMAL_REQUEST_CODE)
        {
            $data = ['parmas' => ['key' => '[MASK]'],
                'result' => ['status' => $status, 'message' => $message],
                'data' => $data];
        }
        else
        {
            $data = ['parmas' => ['key' => $key],
                'result' => ['status' => $status, 'message' => $message]];
        }
        return $data;
    }
}
