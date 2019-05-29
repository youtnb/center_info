<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 *
 * @method \App\Model\Entity\Center[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CentersController extends AppController
{
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

        $query = $this->Centers->find();
        $m_area_id = null;
        if (!empty($this->request->query))
        {
            // 一覧検索
            $query = $this->Centers->find('search', $this->request->query);
            if (isset($this->request->query['m_area_id'])) $m_area_id = $this->request->query['m_area_id'];
        }
        $centers = $this->paginate($query);
        
        $mCustomers = $this->Centers->MCustomers->find('list');
        
        $tableMAreas = TableRegistry::get('MAreas');
        $mAreas = $tableMAreas->find('list');
        $mPrefectures = $this->Centers->MPrefectures->find('list')->where(['delete_flag' => 0]);
        if($m_area_id)
        {   // 都道府県絞り込み
            $mPrefectures->where(['m_area_id' => $m_area_id]);
        }
        
        $this->set(compact('centers', 'mCustomers', 'mPrefectures', 'mAreas'));
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

        $tableMDeviceTypes = TableRegistry::get('MDeviceTypes');
        $mDeviceTypes = $tableMDeviceTypes->find('list')->toArray();
        
        $this->set(compact('center', 'mDeviceTypes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $center = $this->Centers->newEntity();
        if ($this->request->is('post')) {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center)) {
                $this->Flash->success(__('The center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $mCustomers = $this->Centers->MCustomers->find('list');
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center)) {
                $this->Flash->success(__('The center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $mCustomers = $this->Centers->MCustomers->find('list');
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
        if ($this->Centers->delete($center)) {
            $this->Flash->success(__('The center has been deleted.'));
        } else {
            $this->Flash->error(__('The center could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
