<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MOperationSystems Controller
 *
 * @property \App\Model\Table\MOperationSystemsTable $MOperationSystems
 *
 * @method \App\Model\Entity\MOperationSystem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MOperationSystemsController extends AppController
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
        $mOperationSystems = $this->paginate($this->MOperationSystems);

        $this->set(compact('mOperationSystems'));
    }

    /**
     * View method
     *
     * @param string|null $id M Operation System id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mOperationSystem = $this->MOperationSystems->get($id, [
            'contain' => ['MUsers', 'Devices']
        ]);

        $this->set('mOperationSystem', $mOperationSystem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mOperationSystem = $this->MOperationSystems->newEntity();
        if ($this->request->is('post')) {
            $mOperationSystem = $this->MOperationSystems->patchEntity($mOperationSystem, $this->request->getData());
            if ($this->MOperationSystems->save($mOperationSystem)) {
                $this->Flash->success(__('The m operation system has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m operation system could not be saved. Please, try again.'));
        }
        $mUsers = $this->MOperationSystems->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mOperationSystem', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Operation System id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mOperationSystem = $this->MOperationSystems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mOperationSystem = $this->MOperationSystems->patchEntity($mOperationSystem, $this->request->getData());
            if ($this->MOperationSystems->save($mOperationSystem)) {
                $this->Flash->success(__('The m operation system has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m operation system could not be saved. Please, try again.'));
        }
        $mUsers = $this->MOperationSystems->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mOperationSystem', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Operation System id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mOperationSystem = $this->MOperationSystems->get($id);
        if ($this->MOperationSystems->delete($mOperationSystem)) {
            $this->Flash->success(__('The m operation system has been deleted.'));
        } else {
            $this->Flash->error(__('The m operation system could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
