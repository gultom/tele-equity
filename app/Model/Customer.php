<?php

/**
 * Description of Customer
 *
 * @author Charles
 */
class Customer extends AppModel {
    
    public $belongsTo = array (
        'Status' => array (
            'className' => 'CustomerStatus',
            'foreignKey' => 'status_code',
            'conditions' => array (
                'Status.group_id' => 4
            )
        ),
        'Response' => array (
            'className' => 'CustomerResponse',
            'foreignKey' => 'result_code',
            'conditions' => array (
                'Response.group_id' => 5
            )
        )
    );
}

?>
