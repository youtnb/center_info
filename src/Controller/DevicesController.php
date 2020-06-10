<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use RuntimeException;
use Cake\Http\CallbackStream;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 *
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends AppController
{
    public $components = ['AttachedFile', 'Log'];
    
    const UPLOAD_DIR = UPLOAD_DIR_DEVICE;
    const UPLOAD_PATH = WWW_ROOT. DIR_SEP. self::UPLOAD_DIR. DIR_SEP;
    const PHOTO_DIR = PHOTO_DIR_DEVICE;
    const PHOTO_PATH = WWW_ROOT. DIR_SEP. self::PHOTO_DIR. DIR_SEP;
    const TEMPLATE_PATH = WWW_ROOT. DIR_SEP. 'template';

    private $sec_flag = ['未', '済', '予'];
    
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
        
        $tableMCustomers = TableRegistry::getTableLocator()->get('MCustomers');
        $mCustomers = $tableMCustomers->find('list');
        
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list');
        $mOperationSystems = $this->Devices->MOperationSystems->find('list');
        $mSqlservers = $this->Devices->MSqlservers->find('list');
        $mProducts = $this->Devices->MProducts->find('list');
        $mVersions = $this->Devices->MVersions->find('list');
        
        $tableMAreas = TableRegistry::getTableLocator()->get('MAreas');
        $mAreas = $tableMAreas->find('list');
        
        $tableMPrefectures = TableRegistry::getTableLocator()->get('MPrefectures');
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
        
        // セキュリティ
        $sec_flag = $this->sec_flag;
        
        $this->set(compact('devices', 'mCustomers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'centers', 'mAreas', 'mPrefectures', 'sec_flag'));
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
            'contain' => ['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers', 'Comments', 'Customs', 'Documents', 'Photos']
        ]);
        
        // ユーザー
        $tableMUsers = TableRegistry::getTableLocator()->get('MUsers');
        $mUsers = $tableMUsers->find('list')->toArray();
        
        // セキュリティ
        $sec_flag = $this->sec_flag;
        
        $this->set(compact('device', 'mUsers', 'sec_flag'));
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
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $device->id,
                    'center_id:'. $device->center_id,
                    'name:'. $device->name,
                    'ip_higher:'. $device->ip_higher,
                    'ip_lower:'. $device->ip_lower,
                ]));
                
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
        
        $tableMCustomers = TableRegistry::getTableLocator()->get('MCustomers');
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
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $device->id,
                    'center_id:'. $device->center_id,
                    'name:'. $device->name,
                    'ip_higher:'. $device->ip_higher,
                    'ip_lower:'. $device->ip_lower,
                ]));
                
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
        
        $tableMCustomers = TableRegistry::getTableLocator()->get('MCustomers');
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
        // check post data
        if (!$this->request->is(['patch', 'post', 'put']))
        {
            return $this->redirect(['action' => 'view', $id]);
        }
        
        // check file
        if (empty($this->request->data['import_file']['tmp_name']))
        {
            $this->Flash->error(__('Please input attached file.'));
            return $this->redirect(['action' => 'view', $id]);  
        }
        
        // upload
        $dir = self::UPLOAD_PATH. $id;
        try {
            $save_name = $this->AttachedFile->upload($this->request->data['import_file'], $dir);
        } catch (RuntimeException $e){
            $this->Flash->error(__('The file could not be uploaded. Please, try again.'));
            $this->Flash->error(__($e->getMessage()));
            return $this->redirect(['action' => 'index']);
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
                $this->Flash->error(__('DB was not saved. Please, try again.'));
            }
            else
            {
                $this->Flash->success(__('The file has been uploaded.'));
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $id,
                    'file:'. $this->request->data['import_file']['name'],
                ]));
            }
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * ファイル削除処理
     * @param type $device_id
     * @param type $id
     * @return type
     */
    public function deleteFile($device_id = null, $id = null)
    {
        if ($id != null)
        {
            $tableDocuments = TableRegistry::getTableLocator()->get('Documents');
            $document = $tableDocuments->get($id);
            $document->delete_flag = 1;
            if ($tableDocuments->save($document))
            {
                $path_info = pathinfo($document->file_path);
                $this->AttachedFile->delete(implode('', [self::UPLOAD_PATH, $device_id, DIR_SEP, $path_info['basename']]));
                
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'device_id:'. $device_id,
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
        
        return $this->redirect(['action' => 'view', $device_id]);
    }
    
    /**
     * 写真保存処理
     * @param type $id
     * @return type
     */
    public function addPhoto($id = null)
    {
        // check post data
        if (!$this->request->is(['patch', 'post', 'put']))
        {
            return $this->redirect(['action' => 'view', $id]);
        }
        
        // check file
        if (empty($this->request->data['import_file']['tmp_name']))
        {
            $this->Flash->error(__('Please input attached photo.'));
            return $this->redirect(['action' => 'view', $id]);                
        }

        // upload
        $dir = self::PHOTO_PATH. $id;
        try {
            $save_name = $this->AttachedFile->uploadPhoto($this->request->data['import_file'], $dir);
        } catch (RuntimeException $e){
            $this->Flash->error(__('The file could not be uploaded. Please, try again.'));
            $this->Flash->error(__($e->getMessage()));
            return $this->redirect(['action' => 'index']);
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
                $this->Flash->error(__('DB was not saved. Please, try again.'));
            }
            else
            {
                $this->Flash->success(__('The photo has been uploaded.'));
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $id,
                    'file:'. $this->request->data['import_file']['name'],
                ]));
            }
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }
    
    /**
     * 写真削除処理
     * @param type $device_id
     * @param type $id
     * @return type
     */
    public function deletePhoto($device_id = null, $id = null)
    {
        if ($id != null)
        {
            $tablePhotos = TableRegistry::getTableLocator()->get('Photos');
            $photo = $tablePhotos->get($id);
            $photo->delete_flag = 1;
            if ($tablePhotos->save($photo))
            {
                $path_info = pathinfo($photo->file_path);
                $this->AttachedFile->deletePhoto(implode('', [self::PHOTO_PATH, $device_id, DIR_SEP, $path_info['basename']]));
                
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'device_id:'. $device_id,
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
        
        return $this->redirect(['action' => 'view', $device_id]);
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
     * CSV出力
     */
    public function output()
    {
        $this->request->allowMethod(['post']);
        
        $query = $this->Devices->find();
        if (!empty($this->request->data))
        {
            // 一覧検索
            $query = $this->Devices->find('search', $this->request->data);
        }
        $query->contain(['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers']);
        $devices = $query->all();

        $tableMPrefectures = TableRegistry::getTableLocator()->get('MPrefectures');
        $mPrefectures = $tableMPrefectures->find('list')->where(['delete_flag' => 0])->toArray();
        
        $tableMCustomers = TableRegistry::getTableLocator()->get('MCustomers');
        $mCustomers = $tableMCustomers->find('list', ['valueField' => 'full_name'])->toArray();
        
        // セキュリティ
        $sec_flag = $this->sec_flag;
        
        $this->set(compact('devices', 'mPrefectures', 'mCustomers', 'sec_flag'));

        $this->viewBuilder()->setLayout(false);

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=ip_address_list.csv');
        header('Content-Transfer-Encoding: binary');
    }
    
    /**
     * Excel出力
     */
    public function outputExcel()
    {
        $this->request->allowMethod(['post']);
        
        // テンプレート読込
        $inputFileName = self::TEMPLATE_PATH . DS . 'template_device.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $sheet = $spreadsheet->getActiveSheet();

        // データ取得
        $query = $this->Devices->find();
        if (!empty($this->request->data))
        {
            // 一覧検索
            $query = $this->Devices->find('search', $this->request->data);
        }
        $query->contain(['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers']);
        $devices = $query->all();

        // マスターセット
        $tableMPrefectures = TableRegistry::getTableLocator()->get('MPrefectures');
        $mPrefectures = $tableMPrefectures->find('list')->where(['delete_flag' => 0])->toArray();
        $tableMDeviceTypes = TableRegistry::getTableLocator()->get('MDeviceTypes');
        $mDeviceTypes = $tableMDeviceTypes->find('list', ['valueField' => 'background_color'])->toArray();
        $tableMOperationSystems = TableRegistry::getTableLocator()->get('MOperationSystems');
        $mOperationSystems = $tableMOperationSystems->find('list', ['valueField' => 'background_color'])->toArray();
        $tableMSqlservers = TableRegistry::getTableLocator()->get('MSqlservers');
        $mSqlservers = $tableMSqlservers->find('list', ['valueField' => 'background_color'])->toArray();
        $tableMCustomers = TableRegistry::getTableLocator()->get('MCustomers');
        $mCustomers = $tableMCustomers->find('list', ['valueField' => 'full_name'])->toArray();
        
        // 作成日時
        $sheet->setCellValue('D1', date('Y/m/d h:i:s'));

        $line = 2;
        $preCenter = '';
        $color = 'FFFFFFFF';
        foreach ($devices as $device)
        {
            $line++;

            // データ書き込み
            $sheet->setCellValue('B'.$line, $device->has('center') ? substr('0'.$device->center->m_prefecture_id, -2).$mPrefectures[$device->center->m_prefecture_id] : '');
            $sheet->setCellValue('C'.$line, $mCustomers[$device->toArray()['center']['m_customer_id']]);
            $sheet->setCellValue('D'.$line, $device->has('center') ? $device->center->name : '');
            $sheet->setCellValue('E'.$line, $device->has('m_device_type') ? $device->m_device_type->name : '');
            if ($device->has('m_device_type'))
            {   $sheet->getStyle('E'.$line)->getFill()->setFillType('solid')->getStartColor()->setARGB('FF'. substr($mDeviceTypes[$device->m_device_type->id], 1));}
            $sheet->setCellValue('F'.$line, $device->security_flag ? $this->sec_flag[$device->security_flag] : '');
            $sheet->setCellValue('G'.$line, $device->ip_higher);
            $sheet->setCellValue('H'.$line, $device->ip_lower);
            $sheet->setCellValue('I'.$line, $device->name);
            $sheet->setCellValue('J'.$line, $device->reserve_flag ? 'v' : '');
            $sheet->setCellValue('K'.$line, $device->model);
            $sheet->setCellValue('L'.$line, strpos($device->remarks, 'R5') !== false ? 'R5' : '');
            $sheet->setCellValue('M'.$line, $device->seria_no);
            $sheet->setCellValue('N'.$line, '');
            $sheet->setCellValue('O'.$line, !empty($device->support_end_date) ? date('Y/m/d', strtotime($device->support_end_date)) : '');
            if (!empty($device->support_end_date) && strtotime($device->support_end_date) < strtotime(date('Y/m/d')))
            {
                $sheet->getStyle('O'.$line)->getFont()->getColor()->setARGB('FFFF0000');
            }
            $sheet->setCellValue('P'.$line, !empty($device->setup_date) ? date('Y/m/d', strtotime($device->setup_date)) : '');
            $sheet->setCellValue('Q'.$line, $device->has('m_operation_system') ? str_replace(['indowsServer ', 'indows '], ['', ''], $device->m_operation_system->name) : '');
            if ($device->has('m_operation_system'))
            {
                $sheet->getStyle('Q'.$line)->getFill()->setFillType('solid')->getStartColor()->setARGB('FF'. substr($mOperationSystems[$device->m_operation_system->id], 1));
                $borders = $sheet->getStyle('Q'.$line)->getBorders();
                $borders->getTop()->setBorderStyle('thin');
                $borders->getBottom()->setBorderStyle('thin');
                $borders->getRight()->setBorderStyle('thin');
                $borders->getLeft()->setBorderStyle('thin');
            }
            $sheet->setCellValue('R'.$line, $device->has('m_sqlserver') ? $device->m_sqlserver->name : '');
//            if ($device->has('m_sqlserver'))
//            {   $sheet->getStyle('R'.$line)->getFill()->setFillType('solid')->getStartColor()->setARGB('FF'. substr($mSqlservers[$device->m_sqlserver->id], 1));}
            $sheet->setCellValue('S'.$line, $device->admin_pass);
            $sheet->setCellValue('T'.$line, $device->has('m_product') ? $device->m_product->name : '');
            $sheet->setCellValue('U'.$line, $device->has('m_version') ? $device->m_version->name : '');
            $sheet->setCellValue('V'.$line, $device->connect);
            $sheet->setCellValue('W'.$line, $device->remote);
            $sheet->setCellValue('X'.$line, $device->remarks);
            $sheet->setCellValue('Y'.$line, '');

            // センター境界
            // 背景色変更
            if (!empty($preCenter) && $preCenter <> $device->center->name)
            {
                if ($color == 'FFFFFFFF'){$color = 'FFFFFFE0';}else{$color = 'FFFFFFFF';}
            }
//            $sheet->getStyle('D'.$line)->getFill()->setFillType('solid')->getStartColor()->setARGB($color);
            // 罫線
            if (!empty($preCenter) && $preCenter <> $device->center->name)
            {
                $col = 'D';
                for ($i=4; $i<=28; $i++)
                {
                    $borders = $sheet->getStyle($col.$line)->getBorders();
                    $borders->getTop()->setBorderStyle('thin');
                    $col++;
                }
            }
            $preCenter = $device->center->name;
        }

        // コールバックをストリーム化
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $stream = new CallbackStream(function () use ($writer) {
            $writer->save('php://output');
        });

        // ファイルを出力
        $response = $this->response
            ->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->withHeader('Content-Disposition', 'attachment;filename="IPアドレス一覧.xlsx"')
            ->withHeader('Cache-Control', 'max-age=0')
            ->withBody($stream);

        return $response;
    }
}
