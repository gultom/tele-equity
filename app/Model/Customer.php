<?php

/**
 * Description of Customer
 *
 * @author Charles
 */
class Customer extends AppModel {
    
    public $belongsTo = array (
        'User',
        'Status' => array (
            'className' => 'CustomerStatus',
            'foreignKey' => 'status_id'
        ),
        'Response' => array (
            'className' => 'CustomerResponse',
            'foreignKey' => 'response_id'
        ),
        'Import'
    );
}

?>
