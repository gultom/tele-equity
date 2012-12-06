<?php

/**
 * Description of UserGroup
 *
 * @author Charles
 */
class UserGroup extends AppModel {
    
    public $virtualFields = array (
        'Type' => 'CASE WHEN (UserGroup.type = 0) THEN "TL" ELSE "SPV" END'
    );
    public $belongsTo = array (
        'Leader' => array (
            'foreignKey' => 'user_id'
        )
    );
}

?>
