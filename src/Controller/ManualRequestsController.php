<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ManualRequests Controller
 *
 * @property \App\Model\Table\ManualRequestsTable $ManualRequests
 */
class ManualRequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $manualRequests = $this->paginate($this->ManualRequests);

        $this->set(compact('manualRequests'));
        $this->set('_serialize', ['manualRequests']);
    }

    /**
     * View method
     *
     * @param string|null $id Manual Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manualRequest = $this->ManualRequests->get($id, [
            'contain' => []
        ]);

        $this->set('manualRequest', $manualRequest);
        $this->set('_serialize', ['manualRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manualRequest = $this->ManualRequests->newEntity();
        if ($this->request->is('post')) {
            $manualRequest = $this->ManualRequests->patchEntity($manualRequest, $this->request->data);
            if ($this->ManualRequests->save($manualRequest)) {
                $this->Flash->success(__('The manual request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manual request could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('manualRequest'));
        $this->set('_serialize', ['manualRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Manual Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manualRequest = $this->ManualRequests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manualRequest = $this->ManualRequests->patchEntity($manualRequest, $this->request->data);
            if ($this->ManualRequests->save($manualRequest)) {
                $this->Flash->success(__('The manual request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manual request could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('manualRequest'));
        $this->set('_serialize', ['manualRequest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Manual Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manualRequest = $this->ManualRequests->get($id);
        if ($this->ManualRequests->delete($manualRequest)) {
            $this->Flash->success(__('The manual request has been deleted.'));
        } else {
            $this->Flash->error(__('The manual request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
