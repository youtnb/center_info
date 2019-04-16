<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MDeviceTypes Controller
 *
 * @property \App\Model\Table\MDeviceTypesTable $MDeviceTypes
 *
 * @method \App\Model\Entity\MDeviceType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MDeviceTypesController extends AppController
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
        $mDeviceTypes = $this->paginate($this->MDeviceTypes);

        $this->set(compact('mDeviceTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id M Device Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mDeviceType = $this->MDeviceTypes->get($id, [
            'contain' => ['MUsers', 'Devices']
        ]);

        $this->set('mDeviceType', $mDeviceType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mDeviceType = $this->MDeviceTypes->newEntity();
        if ($this->request->is('post')) {
            $mDeviceType = $this->MDeviceTypes->patchEntity($mDeviceType, $this->request->getData());
            if ($this->MDeviceTypes->save($mDeviceType)) {
                $this->Flash->success(__('The m device type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m device type could not be saved. Please, try again.'));
        }
        $mUsers = $this->MDeviceTypes->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mDeviceType', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Device Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mDeviceType = $this->MDeviceTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mDeviceType = $this->MDeviceTypes->patchEntity($mDeviceType, $this->request->getData());
            if ($this->MDeviceTypes->save($mDeviceType)) {
                $this->Flash->success(__('The m device type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m device type could not be saved. Please, try again.'));
        }
        $mUsers = $this->MDeviceTypes->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mDeviceType', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Device Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mDeviceType = $this->MDeviceTypes->get($id);
        if ($this->MDeviceTypes->delete($mDeviceType)) {
            $this->Flash->success(__('The m device type has been deleted.'));
        } else {
            $this->Flash->error(__('The m device type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
