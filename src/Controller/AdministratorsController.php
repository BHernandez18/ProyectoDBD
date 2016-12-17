<?php
namespace App\Controller;

use App\Controller\AppController;


class AdministratorsController extends AppController
{
	public function initialize(){
		parent::initialize();
		$this->viewBuilder()->layout('administrator_bar');
		$this->loadModel('Emergencies');
		$this->loadModel('Abilities');
        $this->loadModel('Missions');
        $this->loadModel('Users');
	}

	//public function IsAuthorized($user)

     public function index()
    {	
    	$this->paginate = [
            'contain' => ['Users']
        ];
        $emergencies = $this->paginate($this->Emergencies);

        $this->set(compact('emergencies'));
        $this->set('_serialize', ['emergencies']);
    }

    public function definirEmergencias(){
    	$emergency = $this->Emergencies->newEntity();
        if ($this->request->is('post')) {
            $emergency = $this->Emergencies->patchEntity($emergency, $this->request->data);
            if ($this->Emergencies->save($emergency)) {
                $this->Flash->success(__('The emergency has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The emergency could not be saved. Please, try again.'));
            }
        }
        $users = $this->Emergencies->Users->find('list', ['limit' => 200]);
        $this->set(compact('emergency', 'users'));
        $this->set('_serialize', ['emergency']);
    }

    public function indexHabilidades(){
    	$abilities = $this->paginate($this->Abilities);

        $this->set(compact('abilities'));
        $this->set('_serialize', ['abilities']);
    }

    public function viewEmergencies($id=null){
    	$emergency = $this->Emergencies->get($id, [
            'contain' => ['Users', 'Missions']
        ]);

        $this->set('emergency', $emergency);
        $this->set('_serialize', ['emergency']);
    }

    public function editEmergencies($id=null){
		$emergency = $this->Emergencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emergency = $this->Emergencies->patchEntity($emergency, $this->request->data);
            if ($this->Emergencies->save($emergency)) {
                $this->Flash->success(__('The emergency has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The emergency could not be saved. Please, try again.'));
            }
        }
        $users = $this->Emergencies->Users->find('list', ['limit' => 200]);
        $this->set(compact('emergency', 'users'));
        $this->set('_serialize', ['emergency']);
    }

    public function viewHabilidades($id=null){
    	$ability = $this->Abilities->get($id, [
            'contain' => ['Missions', 'Users']
        ]);

        $this->set('ability', $ability);
        $this->set('_serialize', ['ability']);
    }

    public function editHabilidades($id=null){
    	$ability = $this->Abilities->get($id, [
            'contain' => ['Missions', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ability = $this->Abilities->patchEntity($ability, $this->request->data);
            if ($this->Abilities->save($ability)) {
                $this->Flash->success(__('The ability has been saved.'));

                return $this->redirect(['action' => 'indexHabilidades']);
            } else {
                $this->Flash->error(__('The ability could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Abilities->Missions->find('list', ['limit' => 200]);
        $users = $this->Abilities->Users->find('list', ['limit' => 200]);
        $this->set(compact('ability', 'missions', 'users'));
        $this->set('_serialize', ['ability']);
    }

    public function addHabilidades(){
    	 $ability = $this->Abilities->newEntity();
        if ($this->request->is('post')) {
            $ability = $this->Abilities->patchEntity($ability, $this->request->data);
            if ($this->Abilities->save($ability)) {
                $this->Flash->success(__('The ability has been saved.'));

                return $this->redirect(['action' => 'indexHabilidades']);
            } else {
                $this->Flash->error(__('The ability could not be saved. Please, try again.'));
            }
        }
        $missions = $this->Abilities->Missions->find('list', ['limit' => 200]);
        $users = $this->Abilities->Users->find('list', ['limit' => 200]);
        $this->set(compact('ability', 'missions', 'users'));
        $this->set('_serialize', ['ability']);
    }

    public function indexMisiones(){
         $this->paginate = [
            'contain' => ['Emergencies']
        ];
        $missions = $this->paginate($this->Missions);

        $this->set(compact('missions'));
        $this->set('_serialize', ['missions']);

    }

    public function addMisiones(){
        $mission = $this->Missions->newEntity();
        if ($this->request->is('post')) {
            $mission = $this->Missions->patchEntity($mission, $this->request->data);
            if ($this->Missions->save($mission)) {
                $this->Flash->success(__('The mission has been saved.'));

                return $this->redirect(['action' => 'indexMisiones']);
            } else {
                $this->Flash->error(__('The mission could not be saved. Please, try again.'));
            }
        }
        $emergencies = $this->Missions->Emergencies->find('list', ['limit' => 200]);
        $abilities = $this->Missions->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('mission', 'emergencies', 'abilities'));
        $this->set('_serialize', ['mission']);

    }

    public function editMisiones($id=null){
         $mission = $this->Missions->get($id, [
            'contain' => ['Abilities']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mission = $this->Missions->patchEntity($mission, $this->request->data);
            if ($this->Missions->save($mission)) {
                $this->Flash->success(__('The mission has been saved.'));

                return $this->redirect(['action' => 'indexMisiones']);
            } else {
                $this->Flash->error(__('The mission could not be saved. Please, try again.'));
            }
        }
        $emergencies = $this->Missions->Emergencies->find('list', ['limit' => 200]);
        $abilities = $this->Missions->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('mission', 'emergencies', 'abilities'));
        $this->set('_serialize', ['mission']);
    }

    public function indexEncargados(){
       
        $users= $this->Users->find('all',
            ['contain'=>['Missions','Admins']])
            ->where(['Users.user_type'=>'Encargado'])
            ->andWhere(['Users.mission_id IS'=> null]);

      
        $users = $this->paginate($users);
        $missions=$this->Missions->find('list');
        $missionId = $this->Missions->find('all')->first()['mission_id'];
        if(!empty($this->request->data)) {
            $missionId = $this->request->data['mission_id'];
        } elseif (!is_null($this->request->session()->read('mission_id'))) {
            $missionId = $this->request->session()->consume('mission_id');
        }
        $this->set(compact('users','missions', 'missionId'));
        $this->set('_serialize', ['users']);
    }

     public function isAuthorized($user)
    {
        if(isset($user['user_type']) && $user['user_type'] === 'Administrador') {
            return true;
        }
        
        return parent::isAuthorized($user);
    }

    public function assignEncargados($userId, $missionId){
        $user = $this->Users->get($userId, [
            'contain' => ['Abilities']
        ]);
        
        $user->mission_id=$missionId;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->request->session()->write('mission_id', $missionId);
        return $this->redirect(['action' => 'indexEncargados']);
    }
}
