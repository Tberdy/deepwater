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
class StickersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $stickers = $this->paginate($this->Stickers);

        $this->set(compact('stickers'));
    }

    /**
     * View method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sticker = $this->Stickers->get($id, [
            'contain' => ['Earnings']
        ]);

        $this->set('sticker', $sticker);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sticker = $this->Stickers->newEntity();
        if ($this->request->is('post')) {
            $sticker = $this->Stickers->patchEntity($sticker, $this->request->getData());
            if ($this->Stickers->save($sticker)) {
                $this->Flash->success(__('The sticker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sticker could not be saved. Please, try again.'));
        }
        $this->set(compact('sticker'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sticker = $this->Stickers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sticker = $this->Stickers->patchEntity($sticker, $this->request->getData());
            if ($this->Stickers->save($sticker)) {
                $this->Flash->success(__('The sticker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sticker could not be saved. Please, try again.'));
        }
        $this->set(compact('sticker'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sticker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sticker = $this->Stickers->get($id);
        if ($this->Stickers->delete($sticker)) {
            $this->Flash->success(__('The sticker has been deleted.'));
        } else {
            $this->Flash->error(__('The sticker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
