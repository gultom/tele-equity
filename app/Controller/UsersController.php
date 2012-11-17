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
        if (!$this->Auth->login()) {
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
            'fields' => array (
                'User.username',
                'User.usercode',
                'User.level_code',
                'User.activity_time',
                'User.activity_code',
                'User.sip_host',
                'User.sip_port',
                'User.sip_user',
                'User.sip_pass',
                'User.prefix_local',
                'User.prefix_sljj',
                'User.prefix_mobile'
            ),
            'conditions' => array (
                'User.username' => $data['username'],
                'User.password' => $data['password'],
                'User.is_enabled' => 1
            )
        ));
        
        if ($isValid) {
            $this->Auth->login();
            $this->Session->write('Auth', $isValid);
            $this->redirect(array('controller' => 'customers', 'action' => 'view'));
        }
        
        $this->Session->setFlash('Wrong Username or Password');
        $this->redirect('login/');
    }
    
    public function updateLastLogin($username) {
        $this->User->updateAll(
            array(
                'User.activity_time' => date('Y-m-d H:i:s')
            ),
            array(
                'User.username' => $username
            )
        );
    }
    
    public function logout() {
        $this->autoRender = false;
        $this->Auth->logout();
        $this->Session->setFlash('Logout Success');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'index'
        ));
    }
}

?>
