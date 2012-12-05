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

    public function add() {
        if ($this->RequestHandler->isGet()) {
            
        }
        else {
            
        }
    }
    
    public function edit($id = null) {
        if ($this->RequestHandler->isGet()) {
            
        }
        else {
            
        }
    }
    
    public function delete() {
        
    }
}

?>
