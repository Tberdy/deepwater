<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Stickers Controller
 *
 * @property \App\Model\Table\StickersTable $Stickers
 *
 * @method \App\Model\Entity\Sticker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StickersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $stickers = $this->Stickers->find('all');
        $this->set([
            'stickers' => $stickers,
            '_serialize' => ['stickers',]
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $sticker = $this->Stickers->get($id);

        $this->set([
            'sticker' => $sticker,
            '_serialize' => ['sticker']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $sticker = $this->Stickers->newEntity($this->request->getData());

        if ($this->Stickers->save($sticker)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }

        $this->set([
            'message' => $message,
            'member' => $sticker,
            '_serialize' => ['message', 'sticker']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $sticker = $this->Stickers->get($id);

        if ($this->request->is(['post', 'put'])) {
            $sticker = $this->Stickers->patchEntity($sticker, $this->request->getData());
            if ($this->Stickers->save($sticker)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }

        $this->set([
            'message' => $message,
            'sticker' => $sticker,
            '_serialize' => ['message', 'sticker']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $sticker = $this->Stickers->get($id);
        $message = 'Deleted';
        if (!$this->Stickers->delete($sticker)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

}
