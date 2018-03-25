<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Workouts Controller
 *
 * @property \App\Model\Table\WorkoutsTable $Workouts
 *
 * @method \App\Model\Entity\Workout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorkoutsController extends ApiController {

    protected $repoMembers;
    protected $repoContests;

    public function initialize() {
        parent::initialize();

        $this->repoMembers = TableRegistry::get('members');
        $this->repoContests = TableRegistry::get('contests');

        $this->Auth->allow(['index', 'indexMatchByContest']);
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

        $workouts = $this->Workouts->find('all')->matching('Members', function ($q) use ($idMember) {
            return $q->where(['Members.id' => $idMember]);
        });

        return $this->response->withStringBody(json_encode($workouts));
    }

    /**
     * List match by member
     *
     * @return \Cake\Http\Response|void
     */
    public function indexMatchByMember() {
        $idMember = $this->request->getParam('member_id');

        try {
            $member = $this->repoMembers->get($idMember);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $workouts = $this->Workouts->find('all')->matching('Members', function ($q) use ($idMember) {
                    return $q->where(['Members.id' => $idMember]);
                })->matching('Contests');

        return $this->response->withStringBody(json_encode($workouts));
    }

    /**
     * List match by contest
     *
     * @return \Cake\Http\Response|void
     */
    public function indexMatchByContest() {
        $idContest = $this->request->getParam('contest_id');

        try {
            $contest = $this->repoContests->get($idContest);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $workouts = $this->Workouts->find('all')->matching('Contests', function ($q) use ($idContest) {
            return $q->where(['Contests.id' => $idContest]);
        });

        return $this->response->withStringBody(json_encode($workouts));
    }

    /**
     * View method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $workout = $this->Workouts->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($workout));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $workout = $this->Workouts->newEntity($this->request->getData());

        try {
            $member = $this->repoMembers->get($this->request->getParam('member_id'));
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(400);
        }

        $workout->member_id = $member->id;
        $workout->contest_id = $this->request->getData('contest_id', null);
        $workout->date = Time::parse($this->request->getData('date'));
        $workout->end_date = Time::parse($this->request->getData('end_date'));

        $opponent_id = $this->request->getData('opponent_id', null);
        if (!is_null($opponent_id)) {
            $opponent_workout = $this->Workouts->newEntity($this->request->getData());
            $opponent_workout->member_id = $opponent_id;
            $opponent_workout->contest_id = $this->request->getData('contest_id', null);
            $opponent_workout->date = Time::parse($this->request->getData('date'));
            $opponent_workout->end_date = Time::parse($this->request->getData('end_date'));

            if (!$this->Workouts->save($opponent_workout)) {
                return $this->response->withStatus(400);
            }
        }

        if ($this->Workouts->save($workout)) {
            return $this->response->withStringBody(json_encode($workout));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $workout = $this->Workouts->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($workout->isMatch()) {
            $opponent_workout = $this->Workouts->find('all')->where([
                        'sport ' => $workout->sport,
                        'description ' => $workout->description,
                        'date ' => $workout->date,
                        'end_date ' => $workout->end_date,
                        'location_name' => $workout->location_name,
                    ])->first();

            $opponent_workout = $this->Workouts->patchEntity($opponent_workout, $this->request->getData());

            if (isset($this->request->getData()['date'])) {
                $opponent_workout->date = Time::parse($this->request->getData()['date']);
            }
            if (isset($this->request->getData()['end_date'])) {
                $opponent_workout->end_date = Time::parse($this->request->getData()['end_date']);
            }

            if (!$this->Workouts->save($opponent_workout)) {
                return $this->response->withStatus(400);
            }
        }

        $workout = $this->Workouts->patchEntity($workout, $this->request->getData());

        if (isset($this->request->getData()['date'])) {
            $workout->date = Time::parse($this->request->getData()['date']);
        }
        if (isset($this->request->getData()['end_date'])) {
            $workout->end_date = Time::parse($this->request->getData()['end_date']);
        }

        if ($this->Workouts->save($workout)) {
            return $this->response->withStringBody(json_encode($workout));
        } else {
            return $this->response->withStatus(400);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $workout = $this->Workouts->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        if ($workout->isMatch()) {
            $opponent_workout = $this->Workouts->find('all')->where([
                        'sport ' => $workout->sport,
                        'description ' => $workout->description,
                        'date ' => $workout->date,
                        'end_date ' => $workout->end_date,
                        'location_name' => $workout->location_name,
                    ])->first();

            if (!$this->Workouts->delete($opponent_workout)) {
                return $this->response->withStatus(500);
            }
        }

        if (!$this->Workouts->delete($workout)) {
            return $this->response->withStatus(500);
        }

        return $this->response->withStatus(204);
    }

}
