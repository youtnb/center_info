<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MSqlservers Controller
 *
 * @property \App\Model\Table\MSqlserversTable $MSqlservers
 *
 * @method \App\Model\Entity\MSqlserver[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MSqlserversController extends AppController
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
        $mSqlservers = $this->paginate($this->MSqlservers);

        $this->set(compact('mSqlservers'));
    }

    /**
     * View method
     *
     * @param string|null $id M Sqlserver id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mSqlserver = $this->MSqlservers->get($id, [
            'contain' => ['MUsers', 'Devices']
        ]);

        $this->set('mSqlserver', $mSqlserver);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mSqlserver = $this->MSqlservers->newEntity();
        if ($this->request->is('post')) {
            $mSqlserver = $this->MSqlservers->patchEntity($mSqlserver, $this->request->getData());
            if ($this->MSqlservers->save($mSqlserver)) {
                $this->Flash->success(__('The m sqlserver has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m sqlserver could not be saved. Please, try again.'));
        }
        $mUsers = $this->MSqlservers->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mSqlserver', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Sqlserver id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mSqlserver = $this->MSqlservers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mSqlserver = $this->MSqlservers->patchEntity($mSqlserver, $this->request->getData());
            if ($this->MSqlservers->save($mSqlserver)) {
                $this->Flash->success(__('The m sqlserver has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m sqlserver could not be saved. Please, try again.'));
        }
        $mUsers = $this->MSqlservers->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mSqlserver', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Sqlserver id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mSqlserver = $this->MSqlservers->get($id);
        if ($this->MSqlservers->delete($mSqlserver)) {
            $this->Flash->success(__('The m sqlserver has been deleted.'));
        } else {
            $this->Flash->error(__('The m sqlserver could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
