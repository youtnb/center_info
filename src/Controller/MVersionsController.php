<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MVersions Controller
 *
 * @property \App\Model\Table\MVersionsTable $MVersions
 *
 * @method \App\Model\Entity\MVersion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MVersionsController extends AppController
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
        $mVersions = $this->paginate($this->MVersions);

        $this->set(compact('mVersions'));
    }

    /**
     * View method
     *
     * @param string|null $id M Version id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mVersion = $this->MVersions->get($id, [
            'contain' => ['MUsers', 'Devices']
        ]);

        $this->set('mVersion', $mVersion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mVersion = $this->MVersions->newEntity();
        if ($this->request->is('post')) {
            $mVersion = $this->MVersions->patchEntity($mVersion, $this->request->getData());
            if ($this->MVersions->save($mVersion)) {
                $this->Flash->success(__('The m version has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m version could not be saved. Please, try again.'));
        }
        $mUsers = $this->MVersions->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mVersion', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Version id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mVersion = $this->MVersions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mVersion = $this->MVersions->patchEntity($mVersion, $this->request->getData());
            if ($this->MVersions->save($mVersion)) {
                $this->Flash->success(__('The m version has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m version could not be saved. Please, try again.'));
        }
        $mUsers = $this->MVersions->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mVersion', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Version id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mVersion = $this->MVersions->get($id);
        if ($this->MVersions->delete($mVersion)) {
            $this->Flash->success(__('The m version has been deleted.'));
        } else {
            $this->Flash->error(__('The m version could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
