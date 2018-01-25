<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Workouts Controller
 *
 * @property \App\Model\Table\WorkoutsTable $Workouts
 *
 * @method \App\Model\Entity\Workout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorkoutsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $idMember = $this->request->getParam('member_id');
        
        $workouts = $this->Workouts->find('all')->matching('Members', function ($q) use ($idMember) {
            return $q->where(['Members.id' => $idMember]);
        });
        
        $this->set([
            'workouts' => $workouts,
            '_serialize' => ['workouts']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $workout = $this->Workouts->get($id);
        $this->set([
            'workout' => $workout,
            '_serialize' => ['workout']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $workout = $this->Workouts->newEntity($this->request->getData());
        $workout->member_id = $this->request->getParam('member_id');
        
        if ($this->Workouts->save($workout)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'workout' => $workout,
            '_serialize' => ['message', 'workout']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $workout = $this->Workouts->get($id);
        if ($this->request->is(['post', 'put'])) {
            $workout = $this->Workouts->patchEntity($workout, $this->request->getData());
            if ($this->Devices->save($workout)) {
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
     * @param string|null $id Workout id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $workout = $this->Workouts->get($id);
        $message = 'Deleted';
        if (!$this->Workouts->delete($workout)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
