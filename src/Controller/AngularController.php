<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Angular Controller
 */
class AngularController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        
    }

}
