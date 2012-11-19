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
        $userMenu = self::getMenus();
        $this->set('menu', $userMenu);
    }

    public function index() {
        if (!$this->Auth->login()) {
            $this->redirect('/users/login');
        }
        else {
            $this->redirect(array(
                'controller' => 'info',
                'action' => 'home'
            ));
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
            self::updateLastLogin($data['username']);
            $this->redirect(array('controller' => 'info', 'action' => 'home'));
        }
        
        $this->Session->setFlash('Wrong Username or Password');
        $this->redirect('login/');
    }
    
    public function getUserData() {
        return $this->Auth->user();
    }
    
    private function updateLastLogin($username) {
        $this->User->updateAll(
            array(
                'User.activity_time' => "'". date('Y-m-d H:i:s' ."'")
            ),
            array(
                'User.username' => $username
            )
        );
    }
    
    public function getMenus() {
        $user = self::getUserData();
        $level = $user['level_code'];
        unset($user);
        
        $menus = array (
            'Home' => array (
                'controller' => 'info',
                'action' => 'home'
            ),
            'Info' => array (
                'controller' => 'info',
                'action' => 'view'
            ),
            'Customers' => array (
                'controller' => 'customers',
                'action' => 'view'
            )
        );
        
        if ($level > 1) {
            $menus = array_merge($menus, array (
                'Monitor' => array (
                    'controller' => 'dashboard',
                    'action' => 'monitor'
                )
            ));
        }
        
        if ($level > 2) {
            $menus = array_merge($menus, array (
                'Collections' => array (
                    'controller' => 'collection',
                    'action' => 'index'
                ),
                'Reports' => array (
                    'controller' => 'report',
                    'action' => 'index'
                ),
                'Salesfile' => array (
                    'controller' => 'report',
                    'action' => 'salesfile'
                ),
                'Users' => array (
                    'controller' => 'users',
                    'action' => 'view'
                ),
                'Campaigns' => array (
                    'controller' => 'campaigns',
                    'action' => 'view'
                ),
                'Settings' => array (
                    'controller' => 'settings',
                    'action' => 'index'
                )
            ));
        }
        return $menus;
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
