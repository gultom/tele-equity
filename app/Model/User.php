<?php

/**
 * Description of User
 *
 * @author charles
 */
class User extends AppModel {
    
    public $virtualFields = array('Active' => 'CASE WHEN (User.is_enabled = 0) THEN "No" ELSE "Yes" END');
    public $belongsTo = array (
        'Level' => array (
            'className' => 'UserLevel',
            'foreignKey' => 'level_id'
        ),
        'UserGroup' => array (
            'foreignKey' => 'group_id'
        ),
        'QA' => array (
            'className' => 'User',
            'foreignKey' => 'qa_id'
        )
    );
}

?>
