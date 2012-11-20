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
        $this->set('title_for_layout', 'User List');
        $users = $this->User->query("SELECT ListValue.list_data AS Level,
                                     User.id AS Id,
                                     User.usercode AS UserCode,
                                     User.username AS Username,
                                     User.fullname AS Fullname,
                                     User.is_enabled AS Active,
                                     User.join_date AS JoinDate,
                                     User.exp_date AS ExpDate,
                                     User.qa_username AS QA,
                                     UserGroup.group_name AS GroupName,
                                     UserGroup.tl_username AS TL,
                                     User.sip_user AS Extension
                                     FROM users AS User
                                     LEFT JOIN _list_values AS ListValue ON ListValue.list_code=User.level_code
                                     LEFT JOIN user_groups AS UserGroup ON UserGroup.id=User.group_id
                                     WHERE ListValue.group_id=3
                                     ORDER BY User.username");
        
        $this->set('users', $users);
    }
}

?>
