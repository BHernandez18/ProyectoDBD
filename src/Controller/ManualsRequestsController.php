<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ManualsRequests Controller
 *
 * @property \App\Model\Table\ManualsRequestsTable $ManualsRequests
 */
class ManualsRequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests', 'Manuals']
        ];
        $manualsRequests = $this->paginate($this->ManualsRequests);

        $this->set(compact('manualsRequests'));
        $this->set('_serialize', ['manualsRequests']);
    }

    /**
     * View method
     *
     * @param string|null $id Manuals Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manualsRequest = $this->ManualsRequests->get($id, [
            'contain' => ['Requests', 'Manuals']
        ]);

        $this->set('manualsRequest', $manualsRequest);
        $this->set('_serialize', ['manualsRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manualsRequest = $this->ManualsRequests->newEntity();
        if ($this->request->is('post')) {
            $manualsRequest = $this->ManualsRequests->patchEntity($manualsRequest, $this->request->data);
            if ($this->ManualsRequests->save($manualsRequest)) {
                $this->Flash->success(__('The manuals request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manuals request could not be saved. Please, try again.'));
            }
        }
        $requests = $this->ManualsRequests->Requests->find('list', ['limit' => 200]);
       
        $manuals = $this->ManualsRequests->Manuals->find('list', ['limit' => 200]);
        $this->set(compact('manualsRequest', 'requests', 'manuals'));
        $this->set('_serialize', ['manualsRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Manuals Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manualsRequest = $this->ManualsRequests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manualsRequest = $this->ManualsRequests->patchEntity($manualsRequest, $this->request->data);
            if ($this->ManualsRequests->save($manualsRequest)) {
                $this->Flash->success(__('The manuals request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manuals request could not be saved. Please, try again.'));
            }
        }
        $requests = $this->ManualsRequests->Requests->find('list', ['limit' => 200]);
        
        $manuals = $this->ManualsRequests->Manuals->find('list', ['limit' => 200]);
        $this->set(compact('manualsRequest', 'requests', 'manuals'));
        $this->set('_serialize', ['manualsRequest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Manuals Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manualsRequest = $this->ManualsRequests->get($id);
        if ($this->ManualsRequests->delete($manualsRequest)) {
            $this->Flash->success(__('The manuals request has been deleted.'));
        } else {
            $this->Flash->error(__('The manuals request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
