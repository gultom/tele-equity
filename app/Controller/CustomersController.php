<?php

/**
 * Description of CustomersController
 *
 * @author charles
 */

App::import('Controller', 'User');

class CustomersController extends AppController {

    public function load() {
        $filter = $this->request->query['data']['FilterCustomer'];
        $options = array (
            'contain' => array (
                'Import' => array (
                    'Campaign' => array (
                        'fields' => 'Campaign.name AS Name'
                    ),
                    'fields' => array (
                        'Import.id'
                    )
                ),
                'Status' => array (
                    'fields' => 'Status.name AS Status',
                ),
                'Response' => array (
                    'fields' => 'Response.response AS Response',
                ),
                'TM' => array (
                    'fields' => 'TM.username AS Username'
                ),
                'TL' => array (
                    'fields' => 'TL.username AS Username'
                ),
                'SPV' => array (
                    'fields' => 'SPV.username AS Username'
                ),
                'QA' => array (
                    'fields' => 'QA.username AS Username'
                )
            )
        );
        
        $level = $this->session['level_id'];
        $status = array();
        for ($i = -1; $i <= 10; ++$i) {
            $status[] = $i;
        }
        
        switch ($level) {
            case 8: // TM
                $status = array (4, 5 , 7, 9);
                break;
            
            case 5: // QA
                $status = 6;
                break;
            
            case 7: // TL
                $status = array (1, 3, 4, 5, 7, 9);
                break;
            
            case 4: // Collection
                $status = 8;
                break;
            
            case 6: // SPV
                $status = array (1, 2, 3, 4, 5, 7, 9);
                break;
        }
        
        $notSystem = false;
        
        if (in_array($this->session['level_id'], array (6, 7, 8))) {
            $notSystem = true;
            switch ($this->session['level_id']) {
                case 8:
                    $field = 'tm_id';
                    break;
                case 7:
                    $field = 'tl_id';
                    break;
                case 6:
                    $field = 'spv_id';
                    break;
            }
        }
        
        $conditions = array (
            'conditions' => array (
                    'Customer.status_id' => ($filter['status_id']) ? $filter['status_id'] : $status,
                    ($filter['response_id']) ? array('Customer.response_id' => $filter['response_id']) : null,
                    ($filter['campaign_id']) ? array('Import.campaign_id' => $filter['campaign_id']) : null,
                    ($notSystem) ? array ('Customer.'. $field => $this->session['id']) : null
                )
        );
        
        $options = array_merge($options, $conditions);
        $this->Customer->Behaviors->attach('Containable');
        $customers = $this->Customer->find('all', $options);
        $count = $this->Customer->find('count', $options);
        $this->set(compact('customers', 'count'));
    }
    
    public function view() {
        $this->set('title_for_layout', 'User List');
        $level = $this->session['level_id'];
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
    
    public function details($id) {
        $level = $this->session['level_id'];
        $this->Customer->id = $id;
        $this->Customer->unbindModel(array (
            'belongsTo' => array(
                'Import',
                'TM',
                'TL',
                'SPV',
                'QA'
                )
            ));
        $this->request->data = $this->Customer->read();
        $this->loadModel('Response');
        $responses = $this->Response->find('list', array (
            'fields' => array (
                'Response.id',
                'Response.response'
            )
        ));
        
        $this->loadModel('Status');
        $this->Status->id = $this->request->data['Customer']['status_id'];
        $status = $this->Status->field('name');
        $this->set(compact('responses', 'status', 'level'));
    }
}

?>
