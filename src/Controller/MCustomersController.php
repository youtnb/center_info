<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MCustomers Controller
 *
 * @property \App\Model\Table\MCustomersTable $MCustomers
 *
 * @method \App\Model\Entity\MCustomer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MCustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MUsers']
        ];
        $mCustomers = $this->paginate($this->MCustomers);

        $this->set(compact('mCustomers'));
    }

    /**
     * View method
     *
     * @param string|null $id M Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mCustomer = $this->MCustomers->get($id, [
            'contain' => ['MUsers', 'Centers']
        ]);

        $this->set('mCustomer', $mCustomer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mCustomer = $this->MCustomers->newEntity();
        if ($this->request->is('post')) {
            $mCustomer = $this->MCustomers->patchEntity($mCustomer, $this->request->getData());
            if ($this->MCustomers->save($mCustomer)) {
                $this->Flash->success(__('The m customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m customer could not be saved. Please, try again.'));
        }
        $mUsers = $this->MCustomers->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mCustomer', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mCustomer = $this->MCustomers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mCustomer = $this->MCustomers->patchEntity($mCustomer, $this->request->getData());
            if ($this->MCustomers->save($mCustomer)) {
                $this->Flash->success(__('The m customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m customer could not be saved. Please, try again.'));
        }
        $mUsers = $this->MCustomers->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mCustomer', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mCustomer = $this->MCustomers->get($id);
        if ($this->MCustomers->delete($mCustomer)) {
            $this->Flash->success(__('The m customer has been deleted.'));
        } else {
            $this->Flash->error(__('The m customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
