<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MPrefectures Controller
 *
 * @property \App\Model\Table\MPrefecturesTable $MPrefectures
 *
 * @method \App\Model\Entity\MPrefecture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MPrefecturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MAreas']
        ];
        $mPrefectures = $this->paginate($this->MPrefectures);

        $this->set(compact('mPrefectures'));
    }

    /**
     * View method
     *
     * @param string|null $id M Prefecture id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mPrefecture = $this->MPrefectures->get($id, [
            'contain' => ['MAreas', 'Centers']
        ]);

        $this->set('mPrefecture', $mPrefecture);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mPrefecture = $this->MPrefectures->newEntity();
        if ($this->request->is('post')) {
            $mPrefecture = $this->MPrefectures->patchEntity($mPrefecture, $this->request->getData());
            if ($this->MPrefectures->save($mPrefecture)) {
                $this->Flash->success(__('The m prefecture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m prefecture could not be saved. Please, try again.'));
        }
        $mAreas = $this->MPrefectures->MAreas->find('list', ['limit' => 200]);
        $this->set(compact('mPrefecture', 'mAreas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Prefecture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mPrefecture = $this->MPrefectures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mPrefecture = $this->MPrefectures->patchEntity($mPrefecture, $this->request->getData());
            if ($this->MPrefectures->save($mPrefecture)) {
                $this->Flash->success(__('The m prefecture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m prefecture could not be saved. Please, try again.'));
        }
        $mAreas = $this->MPrefectures->MAreas->find('list', ['limit' => 200]);
        $this->set(compact('mPrefecture', 'mAreas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Prefecture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mPrefecture = $this->MPrefectures->get($id);
        if ($this->MPrefectures->delete($mPrefecture)) {
            $this->Flash->success(__('The m prefecture has been deleted.'));
        } else {
            $this->Flash->error(__('The m prefecture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
