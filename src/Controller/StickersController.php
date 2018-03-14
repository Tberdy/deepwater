<?php

namespace App\Controller;

use App\Controller\ApiController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Stickers Controller
 *
 * @property \App\Model\Table\StickersTable $Stickers
 *
 * @method \App\Model\Entity\Sticker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StickersController extends ApiController {
    
    public function initialize() {
        parent::initialize();

        $this->Auth->allow(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $stickers = $this->Stickers->find('all');
        return $this->response->withStringBody(json_encode($stickers));
    }

    /**
     * View method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $sticker = $this->Stickers->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        return $this->response->withStringBody(json_encode($sticker));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $sticker = $this->Stickers->newEntity($this->request->getData());

        if ($this->Stickers->save($sticker)) {
            return $this->response->withStringBody(json_encode($sticker));
        }
        
        return $this->response->withStatus(400);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        try {
            $sticker = $this->Stickers->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }

        $patchedSticker = $this->Stickers->patchEntity($sticker, $this->request->getData());
        
        if ($this->Stickers->save($patchedSticker)) {
            return $this->response->withStringBody(json_encode($patchedSticker));
        }
        
        return $this->response->withStatus(400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        try {
            $sticker = $this->Stickers->get($id);
        } catch (RecordNotFoundException $ex) {
            return $this->response->withStatus(404)->withStringBody(json_encode($this->error_entity_not_found));
        }
        
        if ($this->Stickers->delete($sticker)) {
            return $this->response->withStatus(204);
        }
       
        return $this->response->withStatus(500);
    }

}
