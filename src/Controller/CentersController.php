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
        
        if ($this->request->is('post'))
        {
            $where = array();
            
            $m_customer_id = $this->request->data['m_customer_id'];
            if (!empty($m_customer_id))
            {
                $where[] = ['m_customer_id' => $m_customer_id];
            }
            $m_prefecture_id = $this->request->data['m_prefecture_id'];
            if (!empty($m_prefecture_id))
            {
                $where[] = ['m_prefecture_id' => $m_prefecture_id];
            }
            $name = $this->request->data['name'];
            if (!empty($name))
            {
                $where[] = ['Centers.name LIKE' => '%'.$name.'%'];
            }
            
            if (!empty($where))
            {
                $this->paginate['conditions'] = $where;
            }
        }
        
        $centers = $this->paginate($this->Centers);
        $mCustomers = $this->Centers->MCustomers->find('list');
        $mPrefectures = $this->Centers->MPrefectures->find('list');

        $this->set(compact('centers', 'mCustomers', 'mPrefectures'));
        
        //var_dump($this->Auth->user('name'));
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

        $this->set('center', $center);
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
        $mCustomers = $this->Centers->MCustomers->find('list', ['limit' => 200]);
        $mPrefectures = $this->Centers->MPrefectures->find('list', ['limit' => 200]);
        $mUsers = $this->Centers->MUsers->find('list', ['limit' => 200]);
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
        $mCustomers = $this->Centers->MCustomers->find('list', ['limit' => 200]);
        $mPrefectures = $this->Centers->MPrefectures->find('list', ['limit' => 200]);
        $mUsers = $this->Centers->MUsers->find('list', ['limit' => 200]);
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
