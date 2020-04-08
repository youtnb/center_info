<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
    public $components = ['Log'];
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Devices', 'MUsers']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Devices', 'MUsers']
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post'))
        {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if (empty($comment->content))
            {
                $this->Flash->error(__('Please input content.'));
            }
            else
            {
                if ($this->Comments->save($comment))
                {
                    // ログ
                    $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                        'id:'. $comment->id,
                        'device_id:'. $comment->device_id,
                        'content:'. $comment->content,
                    ]));
                    $this->Flash->success(__('The comment has been saved.'));
                }
                else
                {
                    $this->Flash->error(__('The comment could not be saved. Please, try again.'));
                }
            }
        }
//        $devices = $this->Comments->Devices->find('list', ['limit' => 200]);
//        $mUsers = $this->Comments->MUsers->find('list', ['limit' => 200]);
//        $this->set(compact('comment', 'devices', 'mUsers'));
        
        return $this->redirect(['controller' => 'devices', 'action' => 'view', $comment['device_id']]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
//        $devices = $this->Comments->Devices->find('list', ['limit' => 200]);
//        $mUsers = $this->Comments->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'devices', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * 論理削除
     *
     * @param string|null $id Custom id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteLogical($id = null, $device_id = null)
    {
        $comment = $this->Comments->get($id);
        if ($id !== null && $device_id !== null)
        {
            $comment->delete_flag = 1;
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment))
            {
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $comment->id,
                    'device_id:'. $comment->device_id,
                ]));
                
                $this->Flash->success(__('The comment has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('The comment could not be deleted. Please, try again.'));    
            }
        }
        return $this->redirect(['controller' => 'devices', 'action' => 'view', $device_id]);
    }
}
