<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Usergraph Controller
 *
 * @method \App\Model\Entity\Usergraph[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsergraphController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $this->loadModel('co2datadetails');
        // $co2_result = $this->co2datadetails->find('all')->where(['co2_device_id' => 2]);
        // $co2_data = $co2_result->temperature;


        $this->loadModel('co2datadetails');
        $data = $this->co2datadetails->find()->where([
                ['co2datadetails.co2_device_id' => 2],
                ['co2datadetails.id' => 2]
            ])->first();
        $temperature = $data->temperature;
        $time = $data->time_measured;

        // $temperature = rand(100,200);
        // $time = rand(50,60);
        $this->set(compact('temperature','time'));
    }

    /**
     * View method
     *
     * @param string|null $id Usergraph id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usergraph = $this->Usergraph->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('usergraph'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usergraph = $this->Usergraph->newEmptyEntity();
        if ($this->request->is('post')) {
            $usergraph = $this->Usergraph->patchEntity($usergraph, $this->request->getData());
            if ($this->Usergraph->save($usergraph)) {
                $this->Flash->success(__('The usergraph has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usergraph could not be saved. Please, try again.'));
        }
        $this->set(compact('usergraph'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usergraph id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('co2datadetails');
        $this->request->allowMethod('get');
        $roleData = $this->request->getQuery('role');
        $data = $this->co2datadetails->find()->where([
                ['co2datadetails.co2_device_id' => 2],
                ['co2datadetails.id' => $roleData]
            ])->first();
        $temperature = $data->temperature;
        $time = $data->time_measured;
        // $temperature = rand(-2,2);
        // $temperature = $roleData;
        // $time = rand(50,60);
        $this->set(compact('temperature','time'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usergraph id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usergraph = $this->Usergraph->get($id);
        if ($this->Usergraph->delete($usergraph)) {
            $this->Flash->success(__('The usergraph has been deleted.'));
        } else {
            $this->Flash->error(__('The usergraph could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function one(){
        
    }
}
