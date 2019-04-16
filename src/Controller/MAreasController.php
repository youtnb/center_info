<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MAreas Controller
 *
 * @property \App\Model\Table\MAreasTable $MAreas
 *
 * @method \App\Model\Entity\MArea[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MAreasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mAreas = $this->paginate($this->MAreas);

        $this->set(compact('mAreas'));
    }

    /**
     * View method
     *
     * @param string|null $id M Area id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mArea = $this->MAreas->get($id, [
            'contain' => ['MPrefectures']
        ]);

        $this->set('mArea', $mArea);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mArea = $this->MAreas->newEntity();
        if ($this->request->is('post')) {
            $mArea = $this->MAreas->patchEntity($mArea, $this->request->getData());
            if ($this->MAreas->save($mArea)) {
                $this->Flash->success(__('The m area has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m area could not be saved. Please, try again.'));
        }
        $this->set(compact('mArea'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Area id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mArea = $this->MAreas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mArea = $this->MAreas->patchEntity($mArea, $this->request->getData());
            if ($this->MAreas->save($mArea)) {
                $this->Flash->success(__('The m area has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m area could not be saved. Please, try again.'));
        }
        $this->set(compact('mArea'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Area id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mArea = $this->MAreas->get($id);
        if ($this->MAreas->delete($mArea)) {
            $this->Flash->success(__('The m area has been deleted.'));
        } else {
            $this->Flash->error(__('The m area could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
