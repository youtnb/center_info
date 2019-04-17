<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MRoles Controller
 *
 * @property \App\Model\Table\MRolesTable $MRoles
 *
 * @method \App\Model\Entity\MRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MRolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mRoles = $this->paginate($this->MRoles);

        $this->set(compact('mRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id M Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mRole = $this->MRoles->get($id, [
            'contain' => ['MUsers']
        ]);

        $this->set('mRole', $mRole);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mRole = $this->MRoles->newEntity();
        if ($this->request->is('post')) {
            $mRole = $this->MRoles->patchEntity($mRole, $this->request->getData());
            if ($this->MRoles->save($mRole)) {
                $this->Flash->success(__('The m role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m role could not be saved. Please, try again.'));
        }
        $this->set(compact('mRole'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mRole = $this->MRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mRole = $this->MRoles->patchEntity($mRole, $this->request->getData());
            if ($this->MRoles->save($mRole)) {
                $this->Flash->success(__('The m role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m role could not be saved. Please, try again.'));
        }
        $this->set(compact('mRole'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mRole = $this->MRoles->get($id);
        if ($this->MRoles->delete($mRole)) {
            $this->Flash->success(__('The m role has been deleted.'));
        } else {
            $this->Flash->error(__('The m role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
