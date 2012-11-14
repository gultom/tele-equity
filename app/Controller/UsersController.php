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
        $this->set('formName', 'UserLoginForm');
    }
    
    public function doLogin() {
        $this->autoRender = false;
        if (!$this->RequestHandler->isAjax()) {
            throw new MethodNotAllowedException;
        }
        
        $username = $this->data['User']['username'];
        $password = md5($this->data['User']['password']);
        
        $isValid = $this->User->find('first', array(
            'conditions' => array(
                'User.username' => $username,
                'User.password' => $password
            )
        ));
        
        if ($isValid) {
            $this->Auth->login();
            $this->Session->write('Auth', $isValid);
            echo 123123123;
            $this->redirect(array(
                'controller' => 'customers',
                'action' => 'view'
            ));
            echo 'asddbg';
        }
        else {
            echo 'fail';
        }
    }
}

?>
