<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class VolunteersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function initialize()
    {
        
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Tasks');
        $this->loadModel('Calls');
        $this->loadModel('Reports');
        $this->viewBuilder()->layout('volunteer_bar');
        
    }
    public function index()
    {

        $calls = $this->Users->Calls->find('all')
            ->contain(['Tasks','Users'])
            ->where(['volunteer_id'=> $this->Auth->user('id')]);
        $calls = $this->paginate($calls);
        $tasks = $this->Tasks;
        $this->set(compact('calls'));
        $this->set('_serialize', ['calls']);
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
        if ($this->request->is(['post'])) {
            $user->username=$this->request->data['run'];
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->volunteer_state='DISPONIBLE';
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
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
   public function edit($id = null)
    {
        $id=$this->Auth->user('id');
        $user = $this->Users->get($id, [
            'contain' => ['Abilities','Admins']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user->username=$this->request->data['run'];
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

    public function accept($id = null){
        $call = $this->Calls->get($id, [
            'contain' => []
        ]);


            $call->state='CONFIRMADO';
            $call = $this->Calls->patchEntity($call, $this->request->data);
            if ($this->Calls->save($call)) {
                $this->Flash->success(__('The call has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The call could not be saved. Please, try again.'));
            }
        
        $users = $this->Calls->Users->find('list', ['limit' => 200]);
        $tasks = $this->Calls->Tasks->find('list', ['limit' => 200]);
       
    }

    public function report(){
         $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            $report->entry_date=time();
            $report->user_id=$this->Auth->user('id');
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The report could not be saved. Please, try again.'));
            }
        }
        $calls = $this->Calls->find('all')
            ->where(['volunteer_id'=>$this->Auth->user('id')])
            ->andwhere(['state'=>'CONFIRMADO'])
            ->limit (1);
        $idtask=$calls->toArray()[0]['task_id'];
        $tasks = $this->Reports->Tasks->find('list', ['limit' => 200])
            ->where(['id'=>$idtask]);
        
        
        $users = $this->Reports->Users->find('list', ['limit' => 200]);
        $this->set(compact('report', 'tasks', 'users'));
        $this->set('_serialize', ['report']);
    }
   

     public function isAuthorized($user)
    {

        $this->Auth->allow('add');
        if(isset($user['user_type']) && $user['user_type'] === 'Voluntario') {
            return true;
        }
        elseif($user['mission_id']===null){
                   return true;
                }
        
        return parent::isAuthorized($user);
    }

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

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}