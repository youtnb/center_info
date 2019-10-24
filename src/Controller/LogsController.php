<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
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
        
        $query = $this->Logs->find();
        if (!empty($this->request->query))
        {   // 一覧検索
            $query = $this->Logs->find('search', $this->request->query);
        }
        $this->paginate['limit'] = 50;
        $logs = $this->paginate($query);

        $this->set(compact('logs'));
    }

    /**
     * 検索条件クリア
     * @return type
     */
    public function clear()
    {
        // リダイレクト
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => ['MUsers']
        ]);

        $this->set('log', $log);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $log = $this->Logs->newEntity();
        if ($this->request->is('post')) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $mUsers = $this->Logs->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('log', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $mUsers = $this->Logs->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('log', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $log = $this->Logs->get($id);
        if ($this->Logs->delete($log)) {
            $this->Flash->success(__('The log has been deleted.'));
        } else {
            $this->Flash->error(__('The log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * CSV出力
     */
    public function output()
    {
        $query = $this->Logs->find();
        if (!empty($this->request->query))
        {   // 一覧検索
            $query = $this->Logs->find('search', $this->request->query);
        }
        
        $query->contain(['MUsers']);
        
        $logs = $query->all();
        
        $this->set(compact('logs'));
        
        $this->viewBuilder()->setLayout(false);
        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=system_log.csv');
        header('Content-Transfer-Encoding: binary');
    }
}
