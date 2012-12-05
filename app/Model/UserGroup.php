<?php

/**
 * Description of UserGroup
 *
 * @author Charles
 */
class UserGroup extends AppModel {
    
    public $belongsTo = array (
        'Leader' => array (
            'foreignKey' => 'user_id'
        )
    );
}

?>
