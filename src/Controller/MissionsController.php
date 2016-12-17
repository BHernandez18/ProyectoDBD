<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Missions Controller
 *
 * @property \App\Model\Table\MissionsTable $Missions
 */
class MissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Emergencies']
        ];
        $missions = $this->paginate($this->Missions);

        $this->set(compact('missions'));
        $this->set('_serialize', ['missions']);
    }

    /**
     * View method
     *
     * @param string|null $id Mission id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mission = $this->Missions->get($id, [
            'contain' => ['Emergencies', 'Abilities', 'Tasks', 'Users']
        ]);

        $this->set('mission', $mission);
        $this->set('_serialize', ['mission']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mission = $this->Missions->newEntity();
        if ($this->request->is('post')) {
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

    /**
     * Edit method
     *
     * @param string|null $id Mission id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
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

    /**
     * Delete method
     *
     * @param string|null $id Mission id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mission = $this->Missions->get($id);
        if ($this->Missions->delete($mission)) {
            $this->Flash->success(__('The mission has been deleted.'));
        } else {
            $this->Flash->error(__('The mission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
