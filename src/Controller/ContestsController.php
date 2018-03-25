<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Contests Controller
 *
 * @property \App\Model\Table\ContestsTable $Contests
 *
 * @method \App\Model\Entity\Contest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContestsController extends ApiController {

    protected $repoLogs;

    public function initialize() {
        parent::initialize();

        $this->Auth->allow(['index', 'view']);

        $this->repoLogs = TableRegistry::get('logs');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $contests = $this->Contests->find('all');
        return $this->response->withStringBody(json_encode($contests));
    }

    /**
     * View method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $contest = $this->Contests->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($contest));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $contest = $this->Contests->newEntity($this->request->getData());

        if ($this->Contests->save($contest)) {
            return $this->response->withStringBody(json_encode($contest));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $contest = $this->Contests->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $patchedContest = $this->Contests->patchEntity($contest, $this->request->getData());

        if ($this->Contests->save($patchedContest)) {
            return $this->response->withStringBody(json_encode($patchedContest));
        }

        return $this->response->withStatus(400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $contest = $this->Contests->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($this->Contests->delete($contest)) {
            return $this->response->withStatus(204);
        }

        return $this->response->withStatus(500);
    }

    public function getScoreByContest() {
        $idContest = $this->request->getParam('contest_id');

        try {
            $contest = $this->Contests->get($idContest);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $logs = $this->repoLogs->find('all')->matching('Workouts', function ($q) use ($contest) {
            return $q->where(['Workouts.contest_id' => $contest->id]);
        });
        
        $score = array();
        
        foreach ($logs as $log) {
            if (array_key_exists($log->member_id, $score)) {
                $score[$log->member_id] += $log->log_value;
            } else {
                $score[$log->member_id] = $log->log_value;
            }
        }
        
        return $this->response->withStatus(200);
    }

}
