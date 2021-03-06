<?php

namespace App\Controller;

use App\Controller\ApiController;
use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 *
 * @method \App\Model\Entity\Member[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembersController extends ApiController {

    protected $repoDevices;

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['add', 'token', 'facebook', 'getPerformance']);

        $this->repoDevices = TableRegistry::get('devices');
        $this->repoLogs = TableRegistry::get('logs');
    }

    public function isAuthorized($user = null) {
        $action = $this->request->getParam('action');

        switch ($action) {
            case 'index':
            case 'view':
                return true;
            case 'edit':
            case 'delete':
                return ($this->request->getParam('id') === $user['id']);
            default:
                return false;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        if (!$this->isAuthorized($this->Auth->user())) {
            return $this->fordibben();
        }

        $members = $this->Members->find('all');
        return $this->response->withStringBody(json_encode($members));
    }

    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        if (!$this->isAuthorized($this->Auth->user())) {
            return $this->fordibben();
        }

        try {
            $member = $this->Members->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($member));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $member = $this->Members->newEntity($this->request->getData());

        if ($this->Members->save($member)) {

            $device = $this->repoDevices->newEntity();
            $device->description = '@match';
            $device->serial = '@match';
            $device->trusted = true;
            $device->member_id = $member->id;

            return $this->response->withStringBody(json_encode(array(
                        'member' => $member,
                        'token' => JWT::encode([
                            'sub' => $member['id'],
                            'exp' => time() + 604800
                                ], Security::salt())
            )));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        if (!$this->isAuthorized($this->Auth->user())) {
            return $this->fordibben();
        }

        try {
            $member = $this->Members->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $patchedMember = $this->Members->patchEntity($member, $this->request->getData());

        if ($this->Members->save($patchedMember)) {
            return $this->response->withStringBody(json_encode($patchedMember));
        }

        return $this->response->withStatus(400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        if (!$this->isAuthorized($this->Auth->user())) {
            return $this->fordibben();
        }

        try {
            $member = $this->Members->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($this->Members->delete($member)) {
            return $this->response->withStatus(204);
        }

        return $this->response->withStatus(500);
    }

    public function token() {
        $member = $this->Auth->identify();

        if ($member) {
            return $this->response->withStringBody(json_encode(array(
                        'member' => $member,
                        'token' => JWT::encode(['sub' => $member['id'], 'exp' => time() + 604800], Security::salt())
            )));
        }

        return $this->response->withStatus(401);
    }

    public function facebook() {
        $member = $this->Auth->identify();

        if ($member) {
            return $this->response->withStringBody(json_encode(array(
                        'member' => $member,
                        'token' => JWT::encode(['sub' => $member['id'], 'exp' => time() + 604800], Security::salt())
            )));
        } else {
            $newMember = $this->Members->newEntity($this->request->getData());

            if ($this->Members->save($newMember)) {

                $device = $this->repoDevices->newEntity();
                $device->description = '@match';
                $device->serial = '@match';
                $device->trusted = true;
                $device->member_id = $newMember->id;

                return $this->response->withStringBody(json_encode(array(
                            'member' => $newMember,
                            'token' => JWT::encode([
                                'sub' => $newMember['id'],
                                'exp' => time() + 604800
                                    ], Security::salt())
                )));
            } else {
                return $this->response->withStatus(400);
            }
        }
    }

    public function getPerformance() {
        $logs = $this->repoLogs->find('all');

        $score = array();

        foreach ($logs as $log) {
            if (array_key_exists($log->member_id, $score)) {
                $score[$log->member_id] += $log->log_value;
            } else {
                $score[$log->member_id] = $log->log_value;
            }
        }

        return $this->response->withStringBody(json_encode($score));
    }

}
