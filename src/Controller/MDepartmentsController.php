<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MDepartments Controller
 *
 * @property \App\Model\Table\MDepartmentsTable $MDepartments
 *
 * @method \App\Model\Entity\MDepartment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MDepartmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mDepartments = $this->paginate($this->MDepartments);

        $this->set(compact('mDepartments'));
    }

    /**
     * View method
     *
     * @param string|null $id M Department id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mDepartment = $this->MDepartments->get($id, [
            'contain' => ['MUsers']
        ]);

        $this->set('mDepartment', $mDepartment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mDepartment = $this->MDepartments->newEntity();
        if ($this->request->is('post')) {
            $mDepartment = $this->MDepartments->patchEntity($mDepartment, $this->request->getData());
            if ($this->MDepartments->save($mDepartment)) {
                $this->Flash->success(__('The m department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m department could not be saved. Please, try again.'));
        }
        $this->set(compact('mDepartment'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mDepartment = $this->MDepartments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mDepartment = $this->MDepartments->patchEntity($mDepartment, $this->request->getData());
            if ($this->MDepartments->save($mDepartment)) {
                $this->Flash->success(__('The m department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m department could not be saved. Please, try again.'));
        }
        $this->set(compact('mDepartment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mDepartment = $this->MDepartments->get($id);
        if ($this->MDepartments->delete($mDepartment)) {
            $this->Flash->success(__('The m department has been deleted.'));
        } else {
            $this->Flash->error(__('The m department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
