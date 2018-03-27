<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * DirtyApis Controller
 */
class DirtyApisController extends ApiController {

    protected $repoMembers;
    protected $repoDevices;
    protected $repoWorkouts;
    protected $repoLogs;

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['registerdevice', 'workoutparameters', 'getsummary', 'addlog']);

        $this->repoMembers = TableRegistry::get('members');
        $this->repoDevices = TableRegistry::get('devices');
        $this->repoWorkouts = TableRegistry::get('workouts');
        $this->repoLogs = TableRegistry::get('logs');
    }

    public function registerdevice($member_id, $device_serial, $device_description) {
        try {
            $member = $this->repoMembers->get($member_id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $device = $this->repoDevices->newEntity();
        $device->member_id = $member->id;
        $device->serial = $device_serial;
        $device->description = $device_description;
        $device->trusted = true;

        if ($this->repoDevices->save($device)) {
            return $this->response->withStringBody(json_encode($device));
        } else {
            return $this->response->withStatus(400);
        }
    }

    public function workoutparameters($device_id, $workout_id) {
        try {
            $device = $this->repoDevices->get($device_id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if (!$device->trusted) {
            return $this->response->withStatus(403);
        }

        try {
            $workout = $this->repoWorkouts->get($workout_id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($workout->member_id == $device->member_id) {
            return $this->response->withStringBody(json_encode($workout));
        } else {
            return $this->response->withStatus(403);
        }
    }

    public function getsummary($device_id) {
        try {
            $device = $this->repoDevices->get($device_id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if (!$device->trusted) {
            return $this->response->withStatus(403);
        }

        $member = $this->repoMembers->get($device->member_id);

        $next_workout = $this->repoWorkouts->find('all')
                ->innerJoinWith('Members', function ($q) use ($member) {
                    return $q->where(['Members.id' => $member->id]);
                })
                ->where(['date >' => new \DateTime('now')])
                ->orderAsc('date')
                ->limit(1)
                ->contain('Logs')
        ;

        $past_workouts = $this->repoWorkouts->find('all')
                ->innerJoinWith('Members', function ($q) use ($member) {
                    return $q->where(['Members.id' => $member->id]);
                })
                ->where(['end_date <' => new \DateTime('now')])
                ->orderDesc('date')
                ->limit(3)
                ->contain('Logs')
        ;

        return $this->response->withStringBody(json_encode(array(
                    'next' => $next_workout,
                    'past' => $past_workouts
        )));
    }

    public function addlog($device_id, $match_id, $member_id, $points) {
        return $this->response->withStringBody('Incomplete subject, incomplete work...');
    }

}
