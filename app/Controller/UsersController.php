<?php

/**
 * Description of Users
 *
 * @author charles
 */

class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'doLogin', 'logout');
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
    
    public function logout() {
        $this->autoRender = false;
        $this->Auth->logout();
        $this->Session->setFlash('Logout Success');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'index'
        ));
    }
    
    public function view() {
        $this->view = ($this->RequestHandler->isAjax()) ? 'load' : 'view';
        $this->set('title_for_layout', 'User List');
        $users = $this->User->find('all', array (
                'fields' => array (
                    'User.id AS Id',
                    'Level.list_data AS Level',
                    'User.usercode AS UserCode',
                    'User.username AS Username',
                    'User.fullname AS Fullname',
                    'User.Active',
                    'User.join_date AS JoinDate',
                    'User.exp_date AS ExpDate',
                    'Group.group_name AS Group',
                    'Group.tl_username AS TL',
                    'User.qa_username AS QA',
                    'User.sip_user AS Extension'
                ),
                'order' => array (
                    'User.Active DESC',
                    'Level.sort_index ASC',
                    'Fullname ASC'
                )
            )
        );
        $this->set('users', $users);
    }
    
    public function add() {
        if ($this->RequestHandler->isGet()) {
            $this->loadModel('Level');
            $this->set('levels', $this->User->Level->find('list', array (
                'fields' => array (
                    'Level.list_data'
                ),
                'conditions' => array (
                    'Level.group_id' => 3
                )
            )));
        }
        else {
            $this->autoRender = false;
            if ($this->RequestHandler->isAjax()) {
                $this->User->create();
                if ($this->User->save($this->request->data))
                    return json_encode (true);
                return json_encode (false);
            }
        }
    }
    
    public function edit($id = null) {
        if ($this->RequestHandler->isGet()) {
            $this->User->id = $id;
            $this->request->data = $this->User->read();
            $this->loadModel('Level');
            $levels = $this->Level->find('list', array (
                'fields' => array (
                    'Level.list_data'
                ),
                'conditions' => array (
                    'Level.group_id' => 3
                )
            ));
            
            $this->set(array (
                'levels' => $levels,
                'current_group' => $this->request->data['User']['group_id'],
                'current_qa' => $this->request->data['User']['qa_username']
            ));
        }
        elseif ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->request->data['User']['update_time'] = date('Y-m-d H:i:s');
            if ($this->User->save($this->request->data)) {
                return json_encode (true);
            }
        }
    }
    
    public function getUserByLevel($level) {
        $this->autoRender = false;
        $isAjax = ($this->RequestHandler->isAjax()) ? true : false;
        $users = $this->User->find(($isAjax) ? 'list' : 'all', array (
            'fields' => array (
                'User.username',
                'User.username'
            ),
            'conditions' => array (
                'User.level_code' => $level
            ),
            'order' => array (
                'User.username'
            )
        ));
        if ($isAjax)
            return json_encode($users);
        return $users;
    }
}

?>
