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
            'foreignKey' => 'level_code',
            'conditions' => array (
                'Level.group_id' => 3
            )
        ),
        'Group' => array (
            'className' => 'UserGroup',
            'foreignKey' => 'group_id'
        )
    );
}

?>
