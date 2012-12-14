<?php

/**
 * Description of Customer
 *
 * @author Charles
 */
class Customer extends AppModel {
    
    public $belongsTo = array (
        'TM' => array (
            'className' => 'User',
            'foreignKey' => 'tm_id'
        ),
        'TL' => array (
            'className' => 'User',
            'foreignKey' => 'tl_id'
        ),
        'SPV' => array (
            'className' => 'User',
            'foreignKey' => 'spv_id'
        ),
        'QA' => array (
            'className' => 'User',
            'foreignKey' => 'qa_id'
        ),
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
