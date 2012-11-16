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
        if ($this->RequestHandler->isGet()) {
            throw new MethodNotAllowedException;
        }
        
        $data['username'] = $this->data['User']['username'];
        $data['password'] = md5($this->data['User']['password']);
        
        $isValid = $this->User->find('first', array(
            'conditions' => array (
                'User.username' => $data['username'],
                'User.password' => $data['password']
            )
        ));
        
        if ($isValid) {
            $this->Auth->login();
            $this->Session->write('Auth', $isValid);
            $this->redirect(array('controller' => 'customers', 'action' => 'view'));
        }
        
        $this->Session->setFlash('Username/Password failed');
        $this->redirect('login/');
    }
}

?>
