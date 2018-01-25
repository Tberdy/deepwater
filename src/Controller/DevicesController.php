<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 *
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends AppController {

    /**
     * Index method
     * 
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');
        
        $devices = $this->Devices->find('all')->matching('Members', function ($q) use ($idMember) {
            return $q->where(['Members.id' => $idMember]);
        });
        
        $this->set([
            'devices' => $devices,
            '_serialize' => ['devices']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $device = $this->Devices->get($id);
        $this->set([
            'device' => $device,
            '_serialize' => ['device']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $device = $this->Devices->newEntity($this->request->getData());
        $device->member_id = $this->request->getParam('member_id');
        
        if ($this->Devices->save($device)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'device' => $device,
            '_serialize' => ['message', 'device']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $device = $this->Devices->get($id);
        if ($this->request->is(['post', 'put'])) {
            $device = $this->Devices->patchEntity($device, $this->request->getData());
            if ($this->Devices->save($device)) {
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
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $device = $this->Devices->get($id);
        $message = 'Deleted';
        if (!$this->Devices->delete($device)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
