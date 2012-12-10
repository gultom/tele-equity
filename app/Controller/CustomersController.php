<?php

/**
 * Description of CustomersController
 *
 * @author charles
 */

App::import('Controller', 'User');

class CustomersController extends AppController {

    public function load() {
        $options = array (
            'fields' => array (
                'Customer.id AS Id',
                'Customer.batch_no AS BatchNo',
                'Customer.name AS Name',
                'Status.name AS Status',
                'Response.name AS Response',
                'Customer.tl_username AS TL',
                'Customer.qa_username AS QA',
                'Customer.callback_time AS CallbackTime',
                'Customer.birth_date AS DOB',
                'Customer.company AS Company',
                'Customer.homephone1 AS Homephone1',
                'Customer.homephone2 AS Homephone2',
                'Customer.handphone1 AS Handphone1',
                'Customer.handphone2 AS Handphone2'
            )
        );
        
        $user = $this->Auth->user();
        $level = $user['level_code'];
        $status = array();
        for ($i = -1; $i <= 10; ++$i) {
            $status[] = $i;
        }
        
        switch ($level) {
            case 0: // TM
                $status = array (4, 5 , 7, 9);
                break;
            
            case 1: // QA
                $status = 6;
                break;
            
            case 2: // TL
                $status = array (1, 3, 4, 5, 7, 9);
                break;
            
            case 6: // Collection
                $status = 8;
                break;
            
            case 7: // SPV
                $status = array (1, 2, 3, 4, 5, 7, 9);
                break;
        }
        
        $options = array_merge($options, array ('conditions' => array ('Customer.status_code' => $status)));
        $data = $this->Customer->find('all', $options);
        $this->set('customers', $data);
    }
    
    public function view() {
        $sessions = $this->Auth->user();
        $level = $sessions['level_id'];
        unset($sessions);
        $buttons = array (
            'upload' => (in_array($level, array (1, 2, 3))) ? false : true,
            'distribute' => (in_array($level, array(1, 2, 3, 6, 7)) ? false : true),
            'reassign' => (in_array($level, array(1, 2, 3, 6, 7)) ? false : true),
            'recycle' => (in_array($level, array(1, 2, 3, 6, 7)) ? false : true),
            'details' => (!in_array($level, array(4)) ? false : true),
            'search' => false
        );
        
        $this->loadModel('Campaign');
        $campaigns = $this->Campaign->find('list', array (
            'fields' => array (
                'id', 
                'name'
            ),
        ));
        
        $this->loadModel('CustomerStatus');
        $statuses = $this->CustomerStatus->find('list', array (
            'fields' => array (
                'id',
                'name'
            ),
            'order' => 'CustomerStatus.sort_index'
        ));
        
        $this->loadModel('CustomerResponse');
        $responses = $this->CustomerResponse->find('list', array (
            'fields' => array (
                'id',
                'response'
            )
        ));
        
        $this->set(compact('buttons', 'campaigns', 'statuses', 'responses'));
    }
}

?>
