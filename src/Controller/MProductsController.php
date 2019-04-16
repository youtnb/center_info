<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MProducts Controller
 *
 * @property \App\Model\Table\MProductsTable $MProducts
 *
 * @method \App\Model\Entity\MProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MProductsController extends AppController
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
        $mProducts = $this->paginate($this->MProducts);

        $this->set(compact('mProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id M Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mProduct = $this->MProducts->get($id, [
            'contain' => ['MUsers', 'Devices']
        ]);

        $this->set('mProduct', $mProduct);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mProduct = $this->MProducts->newEntity();
        if ($this->request->is('post')) {
            $mProduct = $this->MProducts->patchEntity($mProduct, $this->request->getData());
            if ($this->MProducts->save($mProduct)) {
                $this->Flash->success(__('The m product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m product could not be saved. Please, try again.'));
        }
        $mUsers = $this->MProducts->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mProduct', 'mUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mProduct = $this->MProducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mProduct = $this->MProducts->patchEntity($mProduct, $this->request->getData());
            if ($this->MProducts->save($mProduct)) {
                $this->Flash->success(__('The m product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m product could not be saved. Please, try again.'));
        }
        $mUsers = $this->MProducts->MUsers->find('list', ['limit' => 200]);
        $this->set(compact('mProduct', 'mUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mProduct = $this->MProducts->get($id);
        if ($this->MProducts->delete($mProduct)) {
            $this->Flash->success(__('The m product has been deleted.'));
        } else {
            $this->Flash->error(__('The m product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
