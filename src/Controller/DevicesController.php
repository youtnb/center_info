<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use RuntimeException;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 *
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends AppController
{
    public $components = ['AttachedFile'];
    
    const UPLOAD_DIR = UPLOAD_DIR_DEVICE;
    const UPLOAD_PATH = WWW_ROOT. '/'. self::UPLOAD_DIR. '/';

    // セッションに保存する検索条件
    const SESSION_CLASS = 'Device.';
    private $search_items = ['m_customer_id', 'm_area_id', 'm_prefecture_id', 'center_id', 'm_device_type_id', 'm_operation_system_id', 'name', 'delete_flag'];
    const SESSION_CLASS_SUB = 'Center.';
    private $search_items_sub = ['m_customer_id', 'm_area_id', 'm_prefecture_id']; // nameとdelete_flagは共有しない
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers']
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

        $query = $this->Devices->find();
        $m_customer_id = null;
        $m_area_id = null;
        $m_prefecture_id = null;
        if (!empty($this->request->query))
        {
            // 一覧検索
            $query = $this->Devices->find('search', $this->request->query);
            if (isset($this->request->query['m_customer_id'])) $m_customer_id = $this->request->query['m_customer_id'];
            if (isset($this->request->query['m_area_id'])) $m_area_id = $this->request->query['m_area_id'];
            if (isset($this->request->query['m_prefecture_id'])) $m_prefecture_id = $this->request->query['m_prefecture_id'];
            
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
        $devices = $this->paginate($query);
        
        $tableMCustomers = TableRegistry::get('MCustomers');
        $mCustomers = $tableMCustomers->find('list');
        
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list');
        $mOperationSystems = $this->Devices->MOperationSystems->find('list');
        $mSqlservers = $this->Devices->MSqlservers->find('list');
        $mProducts = $this->Devices->MProducts->find('list');
        $mVersions = $this->Devices->MVersions->find('list');
        
        $tableMAreas = TableRegistry::get('MAreas');
        $mAreas = $tableMAreas->find('list');
        
        $tableMPrefectures = TableRegistry::get('MPrefectures');
        $mPrefectures = $tableMPrefectures->find('list')->where(['delete_flag' => 0]);
        
        $centers = $this->Devices->Centers->find('list')->where(['delete_flag' => 0]);
        
        // 顧客指定時
        if($m_customer_id)
        {   // 拠点リスト絞り込み
            $centers->where(['m_customer_id' => $m_customer_id]);
        }
        
        // 地域指定時
        if($m_area_id)
        {   // 都道府県リスト絞り込み
            $mPrefectures->where(['m_area_id' => $m_area_id]);
            // 拠点リスト絞り込み
            $sub = $tableMPrefectures->find()->where(['m_area_id' => $m_area_id])->select('id');
            $centers->where(['m_prefecture_id IN' => $sub]);
        }
        
        // 都道府県指定時
        if($m_prefecture_id)
        {   // 拠点リスト絞り込み
            $centers->where(['m_prefecture_id' => $m_prefecture_id]);
        }
        
        $this->set(compact('devices', 'mCustomers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'centers', 'mAreas', 'mPrefectures'));
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
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => ['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers', 'Comments', 'Customs']
        ]);
        
        // ユーザー
        $tableMUsers = TableRegistry::get('MUsers');
        $mUsers = $tableMUsers->find('list')->toArray();
        
        // 添付ファイル
        $result = glob(self::UPLOAD_PATH. $device['id']. '/'. '*');
        $file_list = array();
        foreach($result as $file)
        {
            $file_list[basename($file)] = '/'. implode('/', [self::UPLOAD_DIR, $device['id'], basename($file)]);
        }
        
        $this->set(compact('device', 'file_list', 'mUsers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($center_id = null)
    {
        $device = $this->Devices->newEntity();
        if ($this->request->is('post'))
        {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            if ($this->Devices->save($device))
            {
                $this->Flash->success(__('The device has been saved.'));
                return $this->redirect(['action' => 'view', $device['id']]);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list');
        $mOperationSystems = $this->Devices->MOperationSystems->find('list');
        $mSqlservers = $this->Devices->MSqlservers->find('list');
        $mProducts = $this->Devices->MProducts->find('list');
        $mVersions = $this->Devices->MVersions->find('list');
        $mUsers = $this->Devices->MUsers->find('list');
        
        $tableMCustomers = TableRegistry::get('MCustomers');
        $mCustomers = $tableMCustomers->find('list');
        
        $m_customer_id = null;
        if($center_id)
        {
            // 拠点指定あれば顧客ID逆引き
            $center = $this->Devices->Centers->get($center_id);
            $m_customer_id = $center['m_customer_id'];
        }
        else
        {
            // 無ければ初期値
            $m_customer_id = array_keys($mCustomers->toArray())[0];
        }
        $centers = $this->Devices->Centers->find('list')
            ->where(['m_customer_id' => $m_customer_id, 'delete_flag' => 0]);
        
        $this->set(compact('device', 'centers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'mUsers', 'mCustomers', 'center_id', 'm_customer_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => ['Centers']
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            if ($this->Devices->save($device))
            {
                $this->Flash->success(__('The device has been saved.'));
                return $this->redirect(['action' => 'view', $device['id']]);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $centers = $this->Devices->Centers->find('list');
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list');
        $mOperationSystems = $this->Devices->MOperationSystems->find('list');
        $mSqlservers = $this->Devices->MSqlservers->find('list');
        $mProducts = $this->Devices->MProducts->find('list');
        $mVersions = $this->Devices->MVersions->find('list');
        $mUsers = $this->Devices->MUsers->find('list');
        
        $tableMCustomers = TableRegistry::get('MCustomers');
        $mCustomers = $tableMCustomers->find('list');
        
        $this->set(compact('device', 'centers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'mUsers'. 'mCustomers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $device = $this->Devices->get($id, [
            'contain' => ['Centers']
        ]);
        if ($this->Devices->delete($device)) {
            $this->Flash->success(__('The device has been deleted.'));
        } else {
            $this->Flash->error(__('The device could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * 顧客IDから関連する拠点リストを取得（登録画面用）
     * @param type $m_customer_id
     * @return array $centers
     */
    public function addCenterList($m_customer_id = null)
    {
        if ($this->request->is('ajax') && $m_customer_id)
        {
            $this->viewBuilder()->setLayout(false);
            
            $centers = $this->Devices->Centers->find('list')
                ->where(['m_customer_id' => $m_customer_id, 'delete_flag' => 0]);
            $this->set(compact('centers'));
        }
    }
    
    /**
     * ファイル保存処理
     * @param type $id
     * @return type
     */
    public function addFile($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => ['Centers']
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            $dir = self::UPLOAD_PATH. $device['id'];
            try {
                $device['import_file'] = $this->AttachedFile->upload($this->request->data['import_file'], $dir);
            } catch (RuntimeException $e){
                $this->Flash->error(__('The file could not be uploaded. Please, try again.'));
                $this->Flash->error(__($e->getMessage()));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->success(__('The file has been uploaded.'));
            return $this->redirect(['action' => 'view', $device['id']]);
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
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
}
