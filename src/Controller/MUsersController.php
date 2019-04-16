<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MUsers Controller
 *
 * @property \App\Model\Table\MUsersTable $MUsers
 *
 * @method \App\Model\Entity\MUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mUsers = $this->paginate($this->MUsers);

        $this->set(compact('mUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mUser = $this->MUsers->get($id, [
            'contain' => ['MUsers', 'Centers', 'Comments', 'Devices', 'MCustomers', 'MDeviceTypes', 'MOperationSystems', 'MProducts', 'MSqlservers', 'MVersions']
        ]);

        $this->set('mUser', $mUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mUser = $this->MUsers->newEntity();
        if ($this->request->is('post')) {
            $mUser = $this->MUsers->patchEntity($mUser, $this->request->getData());
            if ($this->MUsers->save($mUser)) {
                $this->Flash->success(__('The m user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m user could not be saved. Please, try again.'));
        }
        $this->set(compact('mUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mUser = $this->MUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mUser = $this->MUsers->patchEntity($mUser, $this->request->getData());
            if ($this->MUsers->save($mUser)) {
                $this->Flash->success(__('The m user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m user could not be saved. Please, try again.'));
        }
        $this->set(compact('mUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mUser = $this->MUsers->get($id);
        if ($this->MUsers->delete($mUser)) {
            $this->Flash->success(__('The m user has been deleted.'));
        } else {
            $this->Flash->error(__('The m user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
