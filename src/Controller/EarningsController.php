<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Earnings Controller
 *
 * @property \App\Model\Table\EarningsTable $Earnings
 *
 * @method \App\Model\Entity\Earning[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EarningsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Stickers']
        ];
        $earnings = $this->paginate($this->Earnings);

        $this->set(compact('earnings'));
    }

    /**
     * View method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $earning = $this->Earnings->get($id, [
            'contain' => ['Members', 'Stickers']
        ]);

        $this->set('earning', $earning);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $earning = $this->Earnings->newEntity();
        if ($this->request->is('post')) {
            $earning = $this->Earnings->patchEntity($earning, $this->request->getData());
            if ($this->Earnings->save($earning)) {
                $this->Flash->success(__('The earning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earning could not be saved. Please, try again.'));
        }
        $members = $this->Earnings->Members->find('list', ['limit' => 200]);
        $stickers = $this->Earnings->Stickers->find('list', ['limit' => 200]);
        $this->set(compact('earning', 'members', 'stickers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $earning = $this->Earnings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $earning = $this->Earnings->patchEntity($earning, $this->request->getData());
            if ($this->Earnings->save($earning)) {
                $this->Flash->success(__('The earning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earning could not be saved. Please, try again.'));
        }
        $members = $this->Earnings->Members->find('list', ['limit' => 200]);
        $stickers = $this->Earnings->Stickers->find('list', ['limit' => 200]);
        $this->set(compact('earning', 'members', 'stickers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $earning = $this->Earnings->get($id);
        if ($this->Earnings->delete($earning)) {
            $this->Flash->success(__('The earning has been deleted.'));
        } else {
            $this->Flash->error(__('The earning could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
