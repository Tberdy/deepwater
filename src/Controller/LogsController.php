<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');
        $idWorkout = $this->request->getParam('workout_id');
        $idDevice = $this->request->getParam('device_id');

        $logs = $this->Logs->find('all')
                ->matching('Members', function ($q) use ($idMember) {
                    return $q->where(['Members.id' => $idMember]);
                })
                ->matching('Workouts', function ($q) use ($idWorkout) {
                    return $q->where(['Workouts.id' => $idWorkout]);
                })
                ->matching('Devices', function ($q) use ($idDevice) {
            return $q->where(['Devices.id' => $idDevice]);
        });

        $this->set([
            'logs' => $logs,
            '_serialize' => ['logs']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $log = $this->Logs->get($id);
        $this->set([
            'log' => $log,
            '_serialize' => ['log']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $log = $this->Logs->newEntity($this->request->getData());
        $log->member_id = $this->request->getParam('member_id');
        $log->workout_id = $this->request->getParam('workout_id');
        $log->device_id = $this->request->getParam('device_id');
        
        if ($this->Logs->save($log)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'log' => $log,
            '_serialize' => ['message', 'log']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $log = $this->Logs->get($id);
        if ($this->request->is(['post', 'put'])) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
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
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $log = $this->Logs->get($id);
        $message = 'Deleted';
        if (!$this->Logs->delete($log)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
