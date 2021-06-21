<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Co2datadetails Controller
 *
 * @property \App\Model\Table\Co2datadetailsTable $Co2datadetails
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Co2datadetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RoomInfo'],
        ];
        $co2datadetails = $this->paginate($this->Co2datadetails);

        $this->set(compact('co2datadetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $co2datadetail = $this->Co2datadetails->get($id, [
            'contain' => ['RoomInfo'],
        ]);

        $this->set(compact('co2datadetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $co2datadetail = $this->Co2datadetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $co2datadetail = $this->Co2datadetails->patchEntity($co2datadetail, $this->request->getData());
            if ($this->Co2datadetails->save($co2datadetail)) {
                $this->Flash->success(__('The co2datadetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The co2datadetail could not be saved. Please, try again.'));
        }
        $roomInfo = $this->Co2datadetails->RoomInfo->find('list', ['limit' => 200]);
        $this->set(compact('co2datadetail', 'roomInfo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $co2datadetail = $this->Co2datadetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $co2datadetail = $this->Co2datadetails->patchEntity($co2datadetail, $this->request->getData());
            if ($this->Co2datadetails->save($co2datadetail)) {
                $this->Flash->success(__('The co2datadetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The co2datadetail could not be saved. Please, try again.'));
        }
        $roomInfo = $this->Co2datadetails->RoomInfo->find('list', ['limit' => 200]);
        $this->set(compact('co2datadetail', 'roomInfo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $co2datadetail = $this->Co2datadetails->get($id);
        if ($this->Co2datadetails->delete($co2datadetail)) {
            $this->Flash->success(__('The co2datadetail has been deleted.'));
        } else {
            $this->Flash->error(__('The co2datadetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
