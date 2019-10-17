<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * MUsers Controller
 *
 * @property \App\Model\Table\MUsersTable $MUsers
 *
 * @method \App\Model\Entity\MUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MDepartments', 'MRoles']
        ];
        $mUsers = $this->paginate($this->MUsers);

        $this->set(compact('mUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mUser = $this->MUsers->get($id, [
            'contain' => ['MDepartments', 'MRoles', 'Centers', 'Comments', 'Devices', 'MCustomers', 'MDeviceTypes', 'MOperationSystems', 'MProducts', 'MSqlservers', 'MVersions']
        ]);

        $this->set('mUser', $mUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mUser = $this->MUsers->newEntity();
        if ($this->request->is('post')) {
            $mUser = $this->MUsers->patchEntity($mUser, $this->request->getData());
            if ($this->MUsers->save($mUser)) {
                $this->Flash->success(__('The m user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m user could not be saved. Please, try again.'));
        }
        $mDepartments = $this->MUsers->MDepartments->find('list', ['limit' => 200]);
        $mRoles = $this->MUsers->MRoles->find('list', ['limit' => 200]);
        $this->set(compact('mUser', 'mDepartments', 'mRoles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mUser = $this->MUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mUser = $this->MUsers->patchEntity($mUser, $this->request->getData());
            if ($this->MUsers->save($mUser)) {
                $this->Flash->success(__('The m user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The m user could not be saved. Please, try again.'));
        }
        $mDepartments = $this->MUsers->MDepartments->find('list', ['limit' => 200]);
        $mRoles = $this->MUsers->MRoles->find('list', ['limit' => 200]);
        $this->set(compact('mUser', 'mDepartments', 'mRoles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mUser = $this->MUsers->get($id);
        if ($this->MUsers->delete($mUser)) {
            $this->Flash->success(__('The m user has been deleted.'));
        } else {
            $this->Flash->error(__('The m user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * 認証不要なアクションを定義
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

    /**
     * role別にアクセスを制御したい場合はここに記述。全ロールに許可する場合はreturn trueとだけ書く
     */
    public function isAuthorized($user)
    {
        return true;
    }

    /**
     * ログインアクション
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
    
    /**
     * ログアウトアクション
     */
    public function logout()
    {
        $session = $this->request->session();
        $session->destroy();
        
        return $this->redirect($this->Auth->logout());
    }
}
