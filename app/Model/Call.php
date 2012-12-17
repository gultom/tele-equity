<?php

/**
 * Description of Call
 *
 * @author Charles
 */
class Call extends AppModel {
    
    public $belongsTo = array (
        'Customer' => array (
            'foreignKey' => 'customer_id',
            'fields' => array (
                'Customer.id',
                'Customer.name'
            )
        )
    );
}

?>
