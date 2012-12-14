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
            'foreignKey' => 'tm_id',
            'fields' => array (
                'TM.id',
                'TM.username'
            )
        ),
        'TL' => array (
            'className' => 'User',
            'foreignKey' => 'tl_id',
            'fields' => array (
                'TL.id',
                'TL.username'
            )
        ),
        'SPV' => array (
            'className' => 'User',
            'foreignKey' => 'spv_id',
            'fields' => array (
                'SPV.id',
                'SPV.username'
            )
        ),
        'QA' => array (
            'className' => 'User',
            'foreignKey' => 'qa_id',
            'fields' => array (
                'QA.id',
                'QA.username'
            )
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
