<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Earnings Controller
 *
 * @property \App\Model\Table\EarningsTable $Earnings
 *
 * @method \App\Model\Entity\Earning[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EarningsController extends ApiController {
    
    protected $repoMembers;

    public function initialize() {
        parent::initialize();

        $this->repoMembers = TableRegistry::get('members');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');

        try {
            $member = $this->repoMembers->get($idMember);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $earnings = $this->Earnings->find('all')->matching('Members', function ($q) use ($idMember) {
            return $q->where(['Members.id' => $idMember]);
        });

        return $this->response->withStringBody(json_encode($earnings));
    }

    /**
     * View method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $earning = $this->Earnings->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($earning));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $earning = $this->Earnings->newEntity($this->request->getData());

        try {
            $member = $this->repoMembers->get($this->request->getParam('member_id'));
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(400);
        }

        if (!isset($this->request->getData()['date'])) {
            return $this->response->withStatus(400);
        }

        $earning->member_id = $member->id;
        $earning->date = Time::parse($this->request->getData()['date']);

        if ($this->Earnings->save($earning)) {
            return $this->response->withStringBody(json_encode($earning));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $earning = $this->Earnings->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $earning = $this->Earnings->patchEntity($earning, $this->request->getData());

        if (isset($this->request->getData()['date'])) {
            $earning->date = Time::parse($this->request->getData()['date']);
        }

        if ($this->Earnings->save($earning)) {
            return $this->response->withStringBody(json_encode($earning));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $earning = $this->Earnings->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }
        
        if ($this->Earnings->delete($earning)) {
            return $this->response->withStatus(204);
        }
       
        return $this->response->withStatus(500);
    }

}
