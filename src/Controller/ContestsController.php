<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Contests Controller
 *
 * @property \App\Model\Table\ContestsTable $Contests
 *
 * @method \App\Model\Entity\Contest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContestsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $contests = $this->Contests->find('all');
        $this->set([
            'contests' => $contests,
            '_serialize' => ['contests',]
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $contest = $this->Contests->get($id);

        $this->set([
            'contest' => $contest,
            '_serialize' => ['contest']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $contest = $this->Contests->newEntity($this->request->getData());

        if ($this->Contests->save($contest)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }

        $this->set([
            'message' => $message,
            'contest' => $contest,
            '_serialize' => ['message', 'contest']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $contest = $this->Contests->get($id);

        if ($this->request->is(['post', 'put'])) {
            $contest = $this->Contests->patchEntity($contest, $this->request->getData());
            if ($this->Contests->save($contest)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }

        $this->set([
            'message' => $message,
            'contest' => $contest,
            '_serialize' => ['message', 'contest']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $contest = $this->Contests->get($id);
        $message = 'Deleted';
        if (!$this->Contests->delete($contest)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
