<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customs Controller
 *
 * @property \App\Model\Table\CustomsTable $Customs
 *
 * @method \App\Model\Entity\Custom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomsController extends AppController
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
        $customs = $this->paginate($this->Customs);

        $this->set(compact('customs'));
    }

    /**
     * View method
     *
     * @param string|null $id Custom id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $custom = $this->Customs->get($id, [
            'contain' => ['Devices', 'MUsers']
        ]);

        $this->set('custom', $custom);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $custom = $this->Customs->newEntity();
        if ($this->request->is('post'))
        {
            $custom = $this->Customs->patchEntity($custom, $this->request->getData());
            if (empty($custom->content))
            {
                $this->Flash->error(__('Please input content.'));
            }
            else
            {
                if ($this->Customs->save($custom))
                {
                    // ログ
                    $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                        'id:'. $custom->id,
                        'device_id:'. $custom->device_id,
                        'accepted_no:'. $custom->accepted_no,
                        'content:'. $custom->content,
                    ]));
                    $this->Flash->success(__('The custom has been saved.'));
                }
                else
                {
                    $this->Flash->error(__('The custom could not be saved. Please, try again.'));                
                }
            }
        }
//        $devices = $this->Customs->Devices->find('list', ['limit' => 200]);
//        $mUsers = $this->Customs->MUsers->find('list', ['limit' => 200]);
//        $this->set(compact('custom', 'devices', 'mUsers'));

        return $this->redirect(['controller' => 'devices', 'action' => 'view', $custom['device_id']]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $custom = $this->Customs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $custom = $this->Customs->patchEntity($custom, $this->request->getData());
            if ($this->Customs->save($custom)) {
                $this->Flash->success(__('The custom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The custom could not be saved. Please, try again.'));
        }
//        $devices = $this->Customs->Devices->find('list', ['limit' => 200]);
//        $mUsers = $this->Customs->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('custom', 'devices', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $custom = $this->Customs->get($id);
        if ($this->Customs->delete($custom)) {
            $this->Flash->success(__('The custom has been deleted.'));
        } else {
            $this->Flash->error(__('The custom could not be deleted. Please, try again.'));
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
        $custom = $this->Customs->get($id);
        if ($id !== null && $device_id !== null)
        {
            $custom->delete_flag = 1;
            $custom = $this->Customs->patchEntity($custom, $this->request->getData());
            if ($this->Customs->save($custom))
            {
                // ログ
                $this->Log->write(__CLASS__, __FUNCTION__, implode(',', [
                    'id:'. $custom->id,
                    'device_id:'. $custom->device_id,
                ]));
                
                $this->Flash->success(__('The custom has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('The custom could not be saved. Please, try again.'));                
            }
        }
        return $this->redirect(['controller' => 'devices', 'action' => 'view', $device_id]);
    }
}
