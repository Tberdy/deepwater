<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends ApiController {

    protected $repoMembers;
    protected $repoWorkouts;
    protected $repoDevices;

    public function initialize() {
        parent::initialize();

        $this->repoMembers = TableRegistry::get('members');
        $this->repoWorkouts = TableRegistry::get('workouts');
        $this->repoDevices = TableRegistry::get('devices');
        $this->Auth->allow(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');
        $idWorkout = $this->request->getParam('workout_id');

        try {
            $member = $this->repoMembers->get($idMember);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        try {
            $workout = $this->repoWorkouts->get($idWorkout);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $logs = $this->Logs->find('all')
                ->matching('Members', function ($q) use ($member) {
                    return $q->where(['Members.id' => $member->id]);
                })
                ->matching('Workouts', function ($q) use ($workout) {
            return $q->where(['Workouts.id' => $workout->id]);
        })
        ;

        return $this->response->withStringBody(json_encode($logs));
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $log = $this->Logs->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($log));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $log = $this->Logs->newEntity($this->request->getData());

        try {
            $member = $this->repoMembers->get($this->request->getParam('member_id'));
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(400)->withStringBody(json_encode($this->error_entity_not_found));
        }

        try {
            $workout = $this->repoWorkouts->get($this->request->getParam('workout_id'));
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $device_id = $this->request->getData('device_id', null);
        if (is_null($device_id)) {
            $device = $this->repoDevices->find('all', ['conditions' => ['Devices.serial' => '@match']])->matching('Members', function ($q) use ($member) {
                        return $q->where(['Members.id' => $member->id]);
                    })->first();
            $device_id = $device->id;
        } else {
            try {
                $device = $this->repoDevices->get($this->request->getData('device_id'));
            } catch (RecordNotFoundException $ex) {
                return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
            }
        }

        $log->member_id = $member->id;
        $log->workout_id = $workout->id;
        $log->device_id = $device->id;
        $log->date = Time::parse($this->request->getData('date'));

        if ($this->Logs->save($log)) {
            return $this->response->withStringBody(json_encode($log));
        } else {
            return $this->response->withStatus(400)->withStringBody(json_encode($log));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $log = $this->Logs->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $log = $this->Logs->patchEntity($log, $this->request->getData());

        if (isset($this->request->getData()['date'])) {
            $log->date = Time::parse($this->request->getData()['date']);
        }

        if ($this->Logs->save($log)) {
            return $this->response->withStringBody(json_encode($log));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $log = $this->Logs->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($this->Logs->delete($log)) {
            return $this->response->withStatus(204);
        }

        return $this->response->withStatus(500);
    }

}
