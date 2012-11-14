<?php

/**
 * Description of Users
 *
 * @author charles
 */
class UsersController extends AppController {
    public $helpers = array ('Html', 'Form', 'Js');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'doLogin', 'logout');
    }

    public function index() {
        if (true) {
            $this->redirect('/users/login');
        }
    }
    
    public function login() {
        $this->layout = 'login';
        $this->set('title_for_layout', 'Equity Tele-Sales | Login');
    }
    
    public function doLogin() {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException;
        }
        echo 'asd';
    }
}

?>
