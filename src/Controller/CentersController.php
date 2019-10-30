<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use RuntimeException;

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
    const UPLOAD_PATH = WWW_ROOT. '/'. self::UPLOAD_DIR. '/';
    
    // セッションに保存する検索条件
    const SESSION_CLASS = 'Center.';
    private $search_items = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'name', 'delete_flag'];
    const SESSION_CLASS_SUB = 'Device.';
    private $search_items_sub = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'center_id', 'm_device_type_id', 'm_operation_system_id']; // nameとdelete_flagは共有しない

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
        $result = glob(self::UPLOAD_PATH. $center['id']. '/'. '*');
        $file_list = array();
        foreach($result as $file)
        {
            $file_list[basename($file)] = '/'. implode('/', [self::UPLOAD_DIR, $center['id'], basename($file)]);
        }
        
        $this->set(compact('center', 'mDeviceTypes', 'file_list'));
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
            if ($this->request->data['import_file'])
            {
                $this->Flash->error(__('Please input attached file.'));
                return $this->redirect(['action' => 'view', $center['id']]);                
            }
            
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            $dir = self::UPLOAD_PATH. $center['id'];
            try {
                $center['import_file'] = $this->AttachedFile->upload($this->request->data['import_file'], $dir);
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
            return $this->redirect(['action' => 'view', $center['id']]);
        }
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
            $this->AttachedFile->delete(implode('', [self::UPLOAD_PATH, $id, '/', urldecode($filename)]));
        }
        
        // ログ
        $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
            'id:'. $id,
            'file:'. urldecode($filename),
        ]));

        return $this->redirect(['action' => 'view', $id]);
    }
}
