<?php
/**
 * Description of UserGroupsController
 *
 * @author Charles
 */
class UserGroupsController extends AppController {
    
    public function view() {
        $groups = $this->Group->find('all', array (
            'fields' => array (
                'Group.id AS Id',
                'Group.name AS Name',
                'Group.Type'
            ),
            'order' => 'Group.insert_time'
        ));
        $this->set(compact($groups));
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
        
    }
    
    public function edit() {
        
    }
    
    public function delete() {
        
    }
}

?>
