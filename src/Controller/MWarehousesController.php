<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * MWarehouses Controller
 *
 * @property \App\Model\Table\MWarehousesTable $MWarehouses
 *
 * @method \App\Model\Entity\MWarehouse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MWarehousesController extends AppController
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
        $mWarehouses = $this->paginate($this->MWarehouses);

        $tableCenters = TableRegistry::getTableLocator()->get('Centers');
        $centers = $tableCenters->find('list')->toArray();
        
        $this->set(compact('mWarehouses', 'centers'));
    }

    /**
     * View method
     *
     * @param string|null $id M Warehouse id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mWarehouse = $this->MWarehouses->get($id, [
            'contain' => ['MUsers']
        ]);

        $this->set('mWarehouse', $mWarehouse);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mWarehouse = $this->MWarehouses->newEntity();
        if ($this->request->is('post')) {
            $mWarehouse = $this->MWarehouses->patchEntity($mWarehouse, $this->request->getData());
            if ($this->MWarehouses->save($mWarehouse)) {
                $this->Flash->success(__('The m warehouse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m warehouse could not be saved. Please, try again.'));
        }
        
        $tableCenters = TableRegistry::getTableLocator()->get('Centers');
        $centers = $tableCenters->find('list')->where(['delete_flag' => 0]);
        
        $this->set(compact('mWarehouse', 'centers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Warehouse id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mWarehouse = $this->MWarehouses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mWarehouse = $this->MWarehouses->patchEntity($mWarehouse, $this->request->getData());
            if ($this->MWarehouses->save($mWarehouse)) {
                $this->Flash->success(__('The m warehouse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m warehouse could not be saved. Please, try again.'));
        }
        
        $tableCenters = TableRegistry::getTableLocator()->get('Centers');
        $centers = $tableCenters->find('list')->where(['delete_flag' => 0]);
        
        $this->set(compact('mWarehouse', 'centers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Warehouse id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mWarehouse = $this->MWarehouses->get($id);
        if ($this->MWarehouses->delete($mWarehouse)) {
            $this->Flash->success(__('The m warehouse has been deleted.'));
        } else {
            $this->Flash->error(__('The m warehouse could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
