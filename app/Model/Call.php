<?php

/**
 * Description of Call
 *
 * @author Charles
 */
class Call extends AppModel {
    
    public $hasMany = array (
        'Customer' => array (
            'foreignKey' => 'customer_id'
        )
    );
}

?>
