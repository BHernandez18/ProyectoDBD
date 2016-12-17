<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->Auth->user['user_type'] == 'volunteer')
            {$this->redirect(['controller'=>'volunteer','action'=>'index']);
        }
        $this->paginate = [
            'contain' => ['Missions', 'Admins']
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function isAuthorized($user)
    {
    
   return true;
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Missions', 'Admins', 'Abilities', 'ManualsRequests', 'Reports']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            

            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->username=$this->request->data['run'];
            $user->user_type='Voluntario';
            $user->volunteer_state='DISPONIBLE';
            $user->score=0;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Users->Missions->find('list', ['limit' => 200]);
        $admins = $this->Users->Admins->find('list', ['limit' => 200]);
        $abilities = $this->Users->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('user', 'missions', 'admins', 'abilities'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Abilities']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Users->Missions->find('list', ['limit' => 200]);
        $users = $this->Users->Admins->find('list', ['limit' => 200]);
        $abilities = $this->Users->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('user', 'missions', 'users', 'abilities'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
        $this->Auth->allow('add');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->setLoginUserRedirectUrl($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }


    protected function setLoginUserRedirectUrl($user)
    {
        if(isset($user['user_type'])) {
            if($user['user_type'] === 'Voluntario') {
                $this->Auth->config('loginRedirect', [
                    'controller' => 'volunteers',
                    'action' => 'index'
                ]);
            } else if($user['user_type'] === 'Encargado') {
                $this->Auth->config('loginRedirect', [
                    'controller' => 'managers',
                    'action' => 'index'
                ]);

                if($user['mission_id']===null){
                    $this->Auth->config('loginRedirect', [
                    'controller' => 'volunteers',
                    'action' => 'index'
                ]);
                }

            } else if($user['user_type'] === 'Administrador') {
                $this->Auth->config('loginRedirect', [
                    'controller' => 'administrators',
                    'action' => 'index'
                ]);
            } 
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
