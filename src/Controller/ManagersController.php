<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ManagersController extends AppController
{
	
    public function initialize(){
            parent::initialize();
            $this->viewBuilder()->layout('encargado_bar');
            $this->loadModel('Emergencies');
            $this->loadModel('Abilities');
            $this->loadModel('Missions');
            $this->loadModel('Users');
            $this->loadModel('AbilitiesMissions');
            $this->loadModel('Tasks');
            $this->loadModel('Calls');
             
         

        }

    public function index(){
        $actually=$this->Auth->user('id');

       $user = $this->Users->get($actually, [
            'contain' => ['Missions', 'Admins', 'Abilities', 'ManualsRequests', 'Reports']
        ]);
        
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $id=$user->mission_id;
        $mission = $this->Missions->get($id, [
            'contain' => ['Abilities']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mission = $this->Missions->patchEntity($mission, $this->request->data);
            if ($this->Missions->save($mission)) {
                $this->Flash->success(__('The mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mission could not be saved. Please, try again.'));
            }
        }
        $emergencies = $this->Missions->Emergencies->find('list', ['limit' => 200]);
        $abilities = $this->Missions->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('mission', 'emergencies', 'abilities'));
        $this->set('_serialize', ['mission']);
    }

    public function assignHabilidades(){
        $abilitiesMission = $this->AbilitiesMissions->newEntity();
        $actually=$this->Auth->user('id');
       
        $user = $this->Users->get($actually, [
            'contain' => ['Missions', 'Admins', 'Abilities', 'ManualsRequests', 'Reports']
        ]);
 
        if ($this->request->is('post')) {

             $abilitiesMission->ability_id = $this->request->data['ability'];
             $abilitiesMission->mission_id = $user->mission_id; 
        
            if ($this->AbilitiesMissions->save($abilitiesMission)) {
                $this->Flash->success(__('The abilities mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The abilities mission could not be saved. Please, try again.'));
            }
        }


        $missions = $this->Missions->find('list', ['limit' => 200]);
        $abilities = $this->Abilities->find('list', ['limit' => 200]);
      
        $this->set(compact('abilitiesMission', 'missions', 'abilities'));
        $this->set('_serialize', ['abilitiesMission']);

    }

   public function isAuthorized($user)
    {
        if(isset($user['user_type']) && $user['user_type'] === 'Encargado') {
            return true;
        }
        
        return parent::isAuthorized($user);
    }


    public function indexTareas(){
        $actually=$this->Auth->user('id');

        $user = $this->Users->get($actually, [
            'contain' => ['Missions', 'Admins', 'Abilities', 'ManualsRequests', 'Reports']
        ]);

        $this->paginate = [
            'contain' => ['Missions']
        ];

        $tasks=$this->Tasks->find('all')
            ->where(['Tasks.mission_id'=>$user->mission_id]);
        $tasks = $this->paginate($tasks);

        $this->set(compact('tasks'));
        $this->set('_serialize', ['tasks']);
    }

    public function editTareas($id=null){
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Tasks->Missions->find('list', ['limit' => 200]);
        $this->set(compact('task', 'missions'));
        $this->set('_serialize', ['task']);
    }

    public function addTareas(){
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Tasks->Missions->find('list', ['limit' => 200]);
        $this->set(compact('task', 'missions'));
        $this->set('_serialize', ['task']);
    }


    public function indexVoluntarios(){
         $users= $this->Users->find('all',
            ['contain'=>['Missions','Admins']])
            ->where(['Users.user_type'=>'Voluntario'])
            ->andWhere(['Users.volunteer_state'=> 'DISPONIBLE']);

        
        $users = $this->paginate($users);
        $tasks=$this->Tasks->find('list');
        $taskId = $this->Tasks->find('all')->first()['id'];
        if(!empty($this->request->data)) {
            $taskId = $this->request->data['task_id'];
        } elseif (!is_null($this->request->session()->read('task_id'))) {
            $taskId = $this->request->session()->consume('task_id');
        }

        $this->set(compact('users', 'taskId','tasks'));
        $this->set('_serialize', ['users']);
    }

    public function assignVoluntarios($userId, $taskId){
        $call = $this->Calls->newEntity();
            $call->task_id = $taskId;
            $call->volunteer_id = $userId;
            $call->manager_id = $this->Auth->user('id');
            $call->date=time();
            if ($this->Calls->save($call)) {
                $this->Flash->success(__('The task has been saved.'));
                
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }

        $this->request->session()->write('task_id', $taskId);
        return $this->redirect(['action' => 'indexVoluntarios']);
    }





}
