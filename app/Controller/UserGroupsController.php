<?php
/**
 * Description of UserGroupsController
 *
 * @author Charles
 */
class UserGroupsController extends AppController {
    
    public function view() {
        
    }
    
    public function load() {
        $groups = $this->UserGroup->find('all', array (
            'fields' => array (
                'UserGroup.id AS Id',
                'UserGroup.name AS Name',
                'Leader.username AS Leader',
                'UserGroup.Type'
            ),
            'order' => 'UserGroup.insert_time'
        ));
        $this->set(compact('groups'));
    }
    
    public function lists() {
        $this->autoRender = false;
        $groups = $this->UserGroup->find('list', array (
            'fields' => array (
                'UserGroup.id',
                'UserGroup.name'
            ),
            'order' => array (
                'UserGroup.name'
            )
        ));
        return json_encode($groups);
    }
    
    public function listLeaders($type = null) {
        $this->autoRender = false;
        $this->loadModel('User');
        return json_encode($this->UserGroup->Leader->find('list', array (
            'fields' => array (
                'Leader.id',
                'Leader.username'
            ),
            'conditions' => array (
                'Leader.level_id' => ($type == 0) ? 7 : 6
            )
        )));
    }

    public function add() {
        if ($this->RequestHandler->isGet()) {
            $this->set('types', array (0 => 'TL', 1 => 'SPV'));
        }
        else {
            $this->autoRender = false;
            if ($this->RequestHandler->isAjax()) {
                $data = $this->Auth->user();
                $this->request->data['UserGroup']['insert_time'] = date('Y-m-d H:i:s');
                $this->request->data['UserGroup']['insert_user'] = $data['username'];
                $this->UserGroup->create();
                if ($this->UserGroup->save($this->request->data))
                    return json_encode(true);
                return json_encode(false);
            }
        }
    }
    
    public function edit($id = null) {
        if ($this->RequestHandler->isGet()) {
            $this->UserGroup->id = $id;
            $this->request->data = $this->UserGroup->read();
            $this->set(array (
                'types' => array (0 => 'TL', 1 => 'SPV'),
                'current_leader' => $this->request->data['UserGroup']['user_id']
            ));
        }
        else {
            $this->autoRender = false;
            $data = $this->Auth->user();
            $this->request->data['UserGroup']['update_time'] = date('Y-m-d H:i:s');
            $this->request->data['UserGroup']['update_user'] = $data['username'];
            if ($this->UserGroup->save($this->request->data))
                return json_encode(true);
            return json_encode(false);
        }
    }
    
    public function delete() {
        
    }
}

?>
