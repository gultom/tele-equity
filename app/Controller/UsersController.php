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
                'User.level_id',
                'User.group_id',
                'User.activity_id',
                'User.activity_time',
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
        
        $this->User->Behaviors->attach('Containable');
        $users = $this->User->find('all', array (
                'contain' => array (
                    'QA' => array (
                        'fields' => array (
                            'QA.username AS Username',
                        )
                    ),
                    'Level' => array (
                        'fields' => array (
                            'Level.name AS Level'
                        )
                    ),
                    'UserGroup' => array (
                        'fields' => array (
                            'UserGroup.name AS Group'
                        ),
                        'Leader' => array (
                            'fields' => array (
                                'Leader.id AS LeaderId',
                                'Leader.username AS LeaderUsername'
                            )
                        )
                    )
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
    
    public function isUsernameExist() {
        $this->autoRender = false;
        $user = $this->User->find('count', array (
            'conditions' => array (
                'User.id <> ' => $this->request->data['id'],
                'User.username' => $this->request->data['username']
            )
        ));
        return json_encode(($user) ? true : false);
    }
    
    public function add() {
        if ($this->RequestHandler->isGet()) {
            $this->loadModel('Level');
            $this->set('levels', $this->User->Level->find('list', array (
                'fields' => array (
                    'Level.id',
                    'Level.name'
                ),
                'order' => 'Level.sort_index'
            )));
        }
        else {
            $this->autoRender = false;
            if ($this->RequestHandler->isAjax()) {
                $this->request->data['User']['password'] = md5($this->request->data['User']['username']);
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
                    'Level.id',
                    'Level.name'
                )
            ));
            
            $this->set(array (
                'levels' => $levels,
                'current_group' => $this->request->data['User']['group_id'],
                'current_qa' => $this->request->data['User']['qa_id']
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
                'User.id',
                'User.username'
            ),
            'conditions' => array (
                'User.level_id' => $level
            ),
            'order' => array (
                'User.username'
            )
        ));
        if ($isAjax)
            return json_encode($users);
    }
    
    public function addPassword($id = null) {
        $this->request->data['UserPassword']['id'] = $id;
        if ($this->RequestHandler->isPost()) {
            $this->User->updateAll(
                    array ('User.password' => 'MD5("'. $this->request->data['UserPassword']['password']. '")'),
                    array ('User.id' => $id)
                    );
        }
    }
    
    public function delete($id) {
        $this->autoRender = false;
        if ($this->User->delete($id))
            return json_encode (true);
        return json_encode (false);
    }
}

?>
