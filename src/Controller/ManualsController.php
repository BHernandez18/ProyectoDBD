<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Manuals Controller
 *
 * @property \App\Model\Table\ManualsTable $Manuals
 */
class ManualsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks']
        ];
        $manuals = $this->paginate($this->Manuals);

        $this->set(compact('manuals'));
        $this->set('_serialize', ['manuals']);
    }

    /**
     * View method
     *
     * @param string|null $id Manual id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manual = $this->Manuals->get($id, [
            'contain' => ['Tasks', 'ManualsRequests']
        ]);

        $this->set('manual', $manual);
        $this->set('_serialize', ['manual']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manual = $this->Manuals->newEntity();
        if ($this->request->is('post')) {
            $manual = $this->Manuals->patchEntity($manual, $this->request->data);
            if ($this->Manuals->save($manual)) {
                $this->Flash->success(__('The manual has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manual could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->Manuals->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('manual', 'tasks'));
        $this->set('_serialize', ['manual']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Manual id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manual = $this->Manuals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manual = $this->Manuals->patchEntity($manual, $this->request->data);
            if ($this->Manuals->save($manual)) {
                $this->Flash->success(__('The manual has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manual could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->Manuals->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('manual', 'tasks'));
        $this->set('_serialize', ['manual']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Manual id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manual = $this->Manuals->get($id);
        if ($this->Manuals->delete($manual)) {
            $this->Flash->success(__('The manual has been deleted.'));
        } else {
            $this->Flash->error(__('The manual could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
