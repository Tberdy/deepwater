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
class EarningsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');
        
        $earnings = $this->Earnings->find('all')->matching('Members', function ($q) use ($idMember) {
            return $q->where(['Members.id' => $idMember]);
        });
        
        $this->set([
            'earnings' => $earnings,
            '_serialize' => ['earnings']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $earning = $this->Earnings->get($id);
        $this->set([
            'earning' => $earning,
            '_serialize' => ['earning']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $earning = $this->Earnings->newEntity($this->request->getData());
        $earning->member_id = $this->request->getParam('member_id');
        
        if ($this->Earnings->save($earning)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'earning' => $earning,
            '_serialize' => ['message', 'earning']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $earning = $this->Earnings->get($id);
        if ($this->request->is(['post', 'put'])) {
            $earning = $this->Earnings->patchEntity($earning, $this->request->getData());
            if ($this->Earnings->save($earning)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $earning = $this->Earnings->get($id);
        $message = 'Deleted';
        if (!$this->Earnings->delete($earning)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
