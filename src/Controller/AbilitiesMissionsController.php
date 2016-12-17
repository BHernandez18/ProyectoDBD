<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AbilitiesMissions Controller
 *
 * @property \App\Model\Table\AbilitiesMissionsTable $AbilitiesMissions
 */
class AbilitiesMissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Missions', 'Abilities']
        ];
        $abilitiesMissions = $this->paginate($this->AbilitiesMissions);

        $this->set(compact('abilitiesMissions'));
        $this->set('_serialize', ['abilitiesMissions']);
    }

    /**
     * View method
     *
     * @param string|null $id Abilities Mission id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abilitiesMission = $this->AbilitiesMissions->get($id, [
            'contain' => ['Missions', 'Abilities']
        ]);

        $this->set('abilitiesMission', $abilitiesMission);
        $this->set('_serialize', ['abilitiesMission']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abilitiesMission = $this->AbilitiesMissions->newEntity();
        if ($this->request->is('post')) {
            $abilitiesMission = $this->AbilitiesMissions->patchEntity($abilitiesMission, $this->request->data);
            if ($this->AbilitiesMissions->save($abilitiesMission)) {
                $this->Flash->success(__('The abilities mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The abilities mission could not be saved. Please, try again.'));
            }
        }
        $missions = $this->AbilitiesMissions->Missions->find('list', ['limit' => 200]);
        $abilities = $this->AbilitiesMissions->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('abilitiesMission', 'missions', 'abilities'));
        $this->set('_serialize', ['abilitiesMission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Abilities Mission id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abilitiesMission = $this->AbilitiesMissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abilitiesMission = $this->AbilitiesMissions->patchEntity($abilitiesMission, $this->request->data);
            if ($this->AbilitiesMissions->save($abilitiesMission)) {
                $this->Flash->success(__('The abilities mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The abilities mission could not be saved. Please, try again.'));
            }
        }
        $missions = $this->AbilitiesMissions->Missions->find('list', ['limit' => 200]);
        $abilities = $this->AbilitiesMissions->Abilities->find('list', ['limit' => 200]);
        $this->set(compact('abilitiesMission', 'missions', 'abilities'));
        $this->set('_serialize', ['abilitiesMission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Abilities Mission id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abilitiesMission = $this->AbilitiesMissions->get($id);
        if ($this->AbilitiesMissions->delete($abilitiesMission)) {
            $this->Flash->success(__('The abilities mission has been deleted.'));
        } else {
            $this->Flash->error(__('The abilities mission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
