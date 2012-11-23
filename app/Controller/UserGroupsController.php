<?php
/**
 * Description of UserGroupsController
 *
 * @author Charles
 */
class UserGroupsController extends AppController {
    
    public function view() {
        
    }
    
    public function lists() {
        $this->autoRender = false;
        $groups = array ('' => '(Choose One)');
        $groups = array_merge($groups, $this->UserGroup->find('list', array (
            'fields' => array (
                'UserGroup.id',
                'UserGroup.group_name'
            ),
            'order' => array (
                'UserGroup.group_name'
            )
        )));
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
