<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 *
 * @method \App\Model\Entity\Member[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $members = $this->Members->find('all');
        $this->set([
            'members' => $members,
            '_serialize' => ['members',]
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $member = $this->Members->get($id);

        $this->set([
            'member' => $member,
            '_serialize' => ['member']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $member = $this->Members->newEntity($this->request->getData());

        if ($this->Members->save($member)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }

        $this->set([
            'message' => $message,
            'member' => $member,
            '_serialize' => ['message', 'member']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $member = $this->Members->get($id);

        if ($this->request->is(['post', 'put'])) {
            $member = $this->Members->patchEntity($member, $this->request->getData());
            if ($this->Members->save($member)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }

        $this->set([
            'message' => $message,
            'member' => $member,
            '_serialize' => ['message', 'member']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $member = $this->Members->get($id);
        $message = 'Deleted';
        if (!$this->Members->delete($member)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
