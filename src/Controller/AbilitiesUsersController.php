<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AbilitiesUsers Controller
 *
 * @property \App\Model\Table\AbilitiesUsersTable $AbilitiesUsers
 */
class AbilitiesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Abilities', 'Users']
        ];
        $abilitiesUsers = $this->paginate($this->AbilitiesUsers);

        $this->set(compact('abilitiesUsers'));
        $this->set('_serialize', ['abilitiesUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Abilities User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abilitiesUser = $this->AbilitiesUsers->get($id, [
            'contain' => ['Abilities', 'Users']
        ]);

        $this->set('abilitiesUser', $abilitiesUser);
        $this->set('_serialize', ['abilitiesUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abilitiesUser = $this->AbilitiesUsers->newEntity();
        if ($this->request->is('post')) {
            $abilitiesUser = $this->AbilitiesUsers->patchEntity($abilitiesUser, $this->request->data);
            if ($this->AbilitiesUsers->save($abilitiesUser)) {
                $this->Flash->success(__('The abilities user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The abilities user could not be saved. Please, try again.'));
            }
        }
        $abilities = $this->AbilitiesUsers->Abilities->find('list', ['limit' => 200]);
        $users = $this->AbilitiesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('abilitiesUser', 'abilities', 'users'));
        $this->set('_serialize', ['abilitiesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Abilities User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abilitiesUser = $this->AbilitiesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abilitiesUser = $this->AbilitiesUsers->patchEntity($abilitiesUser, $this->request->data);
            if ($this->AbilitiesUsers->save($abilitiesUser)) {
                $this->Flash->success(__('The abilities user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The abilities user could not be saved. Please, try again.'));
            }
        }
        $abilities = $this->AbilitiesUsers->Abilities->find('list', ['limit' => 200]);
        $users = $this->AbilitiesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('abilitiesUser', 'abilities', 'users'));
        $this->set('_serialize', ['abilitiesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Abilities User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abilitiesUser = $this->AbilitiesUsers->get($id);
        if ($this->AbilitiesUsers->delete($abilitiesUser)) {
            $this->Flash->success(__('The abilities user has been deleted.'));
        } else {
            $this->Flash->error(__('The abilities user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
