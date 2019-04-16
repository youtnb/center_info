<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 *
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers']
        ];
        $devices = $this->paginate($this->Devices);

        $this->set(compact('devices'));
    }

    /**
     * View method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => ['Centers', 'MDeviceTypes', 'MOperationSystems', 'MSqlservers', 'MProducts', 'MVersions', 'MUsers', 'Comments']
        ]);

        $this->set('device', $device);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $device = $this->Devices->newEntity();
        if ($this->request->is('post')) {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $centers = $this->Devices->Centers->find('list', ['limit' => 200]);
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list', ['limit' => 200]);
        $mOperationSystems = $this->Devices->MOperationSystems->find('list', ['limit' => 200]);
        $mSqlservers = $this->Devices->MSqlservers->find('list', ['limit' => 200]);
        $mProducts = $this->Devices->MProducts->find('list', ['limit' => 200]);
        $mVersions = $this->Devices->MVersions->find('list', ['limit' => 200]);
        $mUsers = $this->Devices->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('device', 'centers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $centers = $this->Devices->Centers->find('list', ['limit' => 200]);
        $mDeviceTypes = $this->Devices->MDeviceTypes->find('list', ['limit' => 200]);
        $mOperationSystems = $this->Devices->MOperationSystems->find('list', ['limit' => 200]);
        $mSqlservers = $this->Devices->MSqlservers->find('list', ['limit' => 200]);
        $mProducts = $this->Devices->MProducts->find('list', ['limit' => 200]);
        $mVersions = $this->Devices->MVersions->find('list', ['limit' => 200]);
        $mUsers = $this->Devices->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('device', 'centers', 'mDeviceTypes', 'mOperationSystems', 'mSqlservers', 'mProducts', 'mVersions', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $device = $this->Devices->get($id);
        if ($this->Devices->delete($device)) {
            $this->Flash->success(__('The device has been deleted.'));
        } else {
            $this->Flash->error(__('The device could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
