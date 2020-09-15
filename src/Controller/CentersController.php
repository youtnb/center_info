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
    private $search_items_sub = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'name', 'center_id', 'm_device_type_id', 'm_operation_system_id']; // delete_flagは共有しない
    
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
        
        $tableMWarehouses = TableRegistry::getTableLocator()->get('MWarehouses');
        $mWarehouses = $tableMWarehouses->find('all');
        $mWarehouse = [];
        $warehouse_names = [];
        foreach ($mWarehouses as $warehouse)
        {
            if ($warehouse->center_id_1) $warehouse_names[$warehouse->center_id_1] = $warehouse->name;
            if ($warehouse->center_id_2) $warehouse_names[$warehouse->center_id_2] = $warehouse->name;
            if ($warehouse->center_id_3) $warehouse_names[$warehouse->center_id_3] = $warehouse->name;
            if ($warehouse->center_id_4) $warehouse_names[$warehouse->center_id_4] = $warehouse->name;
            if ($warehouse->center_id_5) $warehouse_names[$warehouse->center_id_5] = $warehouse->name;
            $mWarehouse[$warehouse->id] = $warehouse->name;
        }
        
        $this->set(compact('centers', 'mCustomers', 'mPrefectures', 'mAreas', 'mWarehouse', 'warehouse_names'));
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
            'contain' => ['MCustomers', 'MPrefectures', 'MUsers', 'Devices', 'Documents', 'Photos']
        ]);

        $tableMDeviceTypes = TableRegistry::getTableLocator()->get('MDeviceTypes');
        $mDeviceTypes = $tableMDeviceTypes->find('list')->toArray();
        $device_color_list = $tableMDeviceTypes->find('list', ['valueField' => 'background_color'])->toArray();
        
        $tableDevices = TableRegistry::getTableLocator()->get('Devices');
        $delDevices = $tableDevices->find('search', ['center_id' => $id, 'delete_flag' => 1, 'delete_only' => 1])->order('id');
        
        $tableMWarehouses = TableRegistry::getTableLocator()->get('MWarehouses');
        $warehouses = $tableMWarehouses->find('all')->where(['OR' => [
            ['center_id_1' => $id], ['center_id_2' => $id], ['center_id_3' => $id], ['center_id_4' => $id], ['center_id_5' => $id]
        ]]);
        $warehouse_list = [];
        $same_list = [];
        foreach ($warehouses as $warehouse)
        {
            if ($warehouse->center_id_1) $warehouse_list[] = $warehouse->center_id_1;
            if ($warehouse->center_id_2) $warehouse_list[] = $warehouse->center_id_2;
            if ($warehouse->center_id_3) $warehouse_list[] = $warehouse->center_id_3;
            if ($warehouse->center_id_4) $warehouse_list[] = $warehouse->center_id_4;
            if ($warehouse->center_id_5) $warehouse_list[] = $warehouse->center_id_5;
        }
        if ($warehouse_list)
        {
            $same_list = $this->Centers->find('list')->where(['Centers.id IN' => $warehouse_list, 'Centers.id <>' => $id])->toArray();
        }
        
        $this->set(compact('center', 'mDeviceTypes', 'device_color_list', 'delDevices', 'same_list'));
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
        // check post data
        if ($this->request->is(['patch', 'post', 'put']))
        {
            // upload file
            $msg = $this->uploadFile($id, true);
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * ファイル保存処理（ajax）
     * @param type $id
     */
    public function addFileAjax($id = null)
    {
        $this->autoRender = false;
        $msg = '';
        
        // check ajax
        if ($this->request->is('ajax'))
        {
            // upload file
            $msg = $this->uploadFile($id, false);
        }
        
        echo $msg;
    }
    
    /**
     * ファイルアップロード
     * @return String error message
     */
    private function uploadFile($id = null, $isPost = true)
    {
        $result = '';
        $save_name = null;

        if (empty($this->request->data['import_file']['tmp_name']))
        {
            $result = 'Please input attached file.';
        }
        else
        {
            // upload
            $dir = self::UPLOAD_PATH. $id;
            try {
                $save_name = $this->AttachedFile->upload($this->request->data['import_file'], $dir);
            } catch (RuntimeException $e){
                $result = 'The file could not be uploaded. Please, try again.';
            }

            // save
            $tableDocuments = TableRegistry::getTableLocator()->get('Documents');
            $document = $tableDocuments->newEntity();
            if ($save_name)
            {
                // DB保存
                $document = $tableDocuments->patchEntity($document, $this->request->getData());
                $document->file_name = $this->request->data['import_file']['name'];
                $document->file_path = str_replace(WWW_ROOT, '', $dir. DIR_SEP. $save_name);
                if (!$tableDocuments->save($document)) {
                    $result = 'DB was not saved. Please, try again.';
                }
                else
                {
                    // ログ
                    $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                        'center_id:'. $id,
                        'file:'. $this->request->data['import_file']['name'],
                        'method:'. ($isPost?'POST':'AJAX')
                    ]));
                }
            }
        }
        
        // 結果表示
        if (empty($result))
        {
            $this->Flash->success(__('The file has been uploaded.'));
        }
        else
        {
            $this->Flash->error(__($result));
        }

        return $result;
    }
    
    /**
     * ファイル削除処理
     * @param type $center_id
     * @param type $id
     * @return type
     */
    public function deleteFile($center_id = null, $id = null)
    {
        if ($id != null)
        {
            $tableDocuments = TableRegistry::getTableLocator()->get('Documents');
            $document = $tableDocuments->get($id);
            $document->delete_flag = 1;
            if ($tableDocuments->save($document))
            {
                $path_info = pathinfo($document->file_path);
                $this->AttachedFile->delete(implode('', [self::UPLOAD_PATH, $center_id, DIR_SEP, $path_info['basename']]));
                
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'center_id:'. $center_id,
                    'name:'. $document->file_name,
                    'path:'. $document->file_path,
                ]));
                
                $this->Flash->success(__('The file has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('DB was not saved. Please, try again.'));
            }
        }
        else
        {
            $this->Flash->error(__('Not exist document id. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'view', $center_id]);
    }
    
    /**
     * 写真保存処理
     * @param type $id
     * @return type
     */
    public function addPhoto($id = null)
    {
        // check post data
        if ($this->request->is(['patch', 'post', 'put']))
        {
            // upload photo
            $msg = $this->uploadPhoto($id);
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * 写真保存処理（ajax）
     * @param type $id
     */
    public function addPhotoAjax($id = null)
    {
        $this->autoRender = false;
        $msg = '';
        
        // check ajax
        if ($this->request->is('ajax'))
        {
            // upload photo
            $msg = $this->uploadPhoto($id);
        }
        
        echo $msg;
    }
    
    /**
     * 写真アップロード
     * @return String error message
     */
    private function uploadPhoto($id = null)
    {
        $result = '';
        $save_name = null;

        if (empty($this->request->data['import_file']['tmp_name']))
        {
            $result = 'Please input attached photo.';
        }
        else
        {
            // upload
            $dir = self::PHOTO_PATH. $id;
            try {
                $save_name = $this->AttachedFile->uploadPhoto($this->request->data['import_file'], $dir);
            } catch (RuntimeException $e){
                $result = 'The file could not be uploaded. Please, try again.';
            }

            // save
            $tablePhotos = TableRegistry::getTableLocator()->get('Photos');
            $photo = $tablePhotos->newEntity();
            if ($save_name)
            {
                // DB保存
                $photo = $tablePhotos->patchEntity($photo, $this->request->getData());
                $photo->file_name = $this->request->data['import_file']['name'];
                $photo->file_path = str_replace(WWW_ROOT, '', $dir. DIR_SEP. $save_name);
                $photo->file_path_thmb = str_replace(WWW_ROOT, '', $dir. DIR_SEP. $this->AttachedFile->addPhotoSafix($save_name));
                if (!$tablePhotos->save($photo)) {
                    $result = 'DB was not saved. Please, try again.';
                }
                else
                {
                    // ログ
                    $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                        'id:'. $id,
                        'file:'. $this->request->data['import_file']['name'],
                    ]));
                }
            }
        }
        
        // 結果表示
        if (empty($result))
        {
            $this->Flash->success(__('The photo has been uploaded.'));
        }
        else
        {
            $this->Flash->error(__($result));
        }

        return $result;
    }
    
    /**
     * 写真削除処理
     * @param type $center_id
     * @param type $id
     * @return type
     */
    public function deletePhoto($center_id = null, $id = null)
    {
        if ($id != null)
        {
            $tablePhotos = TableRegistry::getTableLocator()->get('Photos');
            $photo = $tablePhotos->get($id);
            $photo->delete_flag = 1;
            if ($tablePhotos->save($photo))
            {
                $path_info = pathinfo($photo->file_path);
                $this->AttachedFile->deletePhoto(implode('', [self::PHOTO_PATH, $center_id, DIR_SEP, $path_info['basename']]));
                
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'center_id:'. $center_id,
                    'name:'. $photo->file_name,
                    'path:'. $photo->file_path,
                ]));
                
                $this->Flash->success(__('The photo has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('DB was not saved. Please, try again.'));
            }
        }
        else
        {
            $this->Flash->error(__('Not exist photo id. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'view', $center_id]);
    }
    
    /**
     * ファイルダウンロード
     * @param type $id
     */
    public function download($id = null)
    {
        $this->autoRender = false;
        $tableDocuments = TableRegistry::getTableLocator()->get('Documents');
        $document = $tableDocuments->get($id);
        if ($id !== null)
        {
            
            //ダウンロードをしたいファイル名のパス
            $file_path = $document->file_path;

            //ダウンロード時のファイル名
            $filename = $document->file_name;
            
            //タイプをダウンロードと指定
            header('Content-Type: application/force-download;');

            //ファイルのサイズを取得してダウンロード時間を表示する
            header('Content-Length: '.filesize(WWW_ROOT. DIR_SEP. $file_path));

            header('Content-Disposition: filename="'.$filename.'"');
            
            //ダウンロードの指示・ダウンロード時のファイル名を指定
            header('Content-Disposition: attachment; filename="'.$filename.'"');

            //header('Connection: close');
            
            while (ob_get_level()) { ob_end_clean(); }
            
            //ファイルを読み込んでダウンロード
            readfile(WWW_ROOT. DIR_SEP. $file_path);
            
            exit;
        }
    }
    
    /**
     * 
     * @param type $id
     */
    function getDevices($id = null)
    {
        if ($id)
        {
            $center = $this->Centers->get($id, [
                'contain' => ['MCustomers', 'MPrefectures', 'MUsers', 'Devices']
                ]);
            
            $tableMDeviceTypes = TableRegistry::getTableLocator()->get('MDeviceTypes');
            $mDeviceTypes = $tableMDeviceTypes->find('list')->toArray();

            $this->set(compact('center', 'mDeviceTypes'));

            $this->viewBuilder()->setLayout(false);

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=upload_devices.csv');
            header('Content-Transfer-Encoding: binary');
        }
    }
    
    function uploadDevices()
    {
        
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
