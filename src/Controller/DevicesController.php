<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 *
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends ApiController {
    
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

        $devices = $this->Devices->find('all')->matching('Members', function ($q) use ($member) {
            return $q->where(['Members.id' => $member->id]);
        });

        return $this->response->withStringBody(json_encode($devices));
    }

    /**
     * View method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $device = $this->Devices->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($device));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $device = $this->Devices->newEntity($this->request->getData());

        try {
            $member = $this->repoMembers->get($this->request->getParam('member_id'));
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(400);
        }

        $device->member_id = $member->id;

        if ($this->Devices->save($device)) {
            return $this->response->withStringBody(json_encode($device));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $device = $this->Devices->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $device = $this->Devices->patchEntity($device, $this->request->getData());

        if ($this->Devices->save($device)) {
            return $this->response->withStringBody(json_encode($device));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $device = $this->Devices->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }
        
        if ($this->Devices->delete($device)) {
            return $this->response->withStatus(204);
        }
       
        return $this->response->withStatus(500);
    }

}
