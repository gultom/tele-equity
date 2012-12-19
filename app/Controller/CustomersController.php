<?php

/**
 * Description of CustomersController
 *
 * @author charles
 */

App::import('Controller', 'User');

class CustomersController extends AppController {
    
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
                'code',
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
        $status = array(); // status code
        for ($i = 0; $i <= 12; ++$i) {
            $status[] = $i;
        }
        
        switch ($level) {
            case 8: // TM
                $status = array (6, 7 , 9, 11);
                break;
            
            case 5: // QA
                $status = 10;
                break;
            
            case 7: // TL
                $status = array (3, 5, 6, 7, 9, 11);
                break;
            
            case 4: // Collection
                $status = 8;
                break;
            
            case 6: // SPV
                $status = array (2, 3, 4, 5, 6, 7, 9, 11);
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
                    'Status.code' =>($filter['status_code']) ? $filter['status_id'] : $status,
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
    
    public function edit($id = null) {
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
        
        if ($this->RequestHandler->isGet()) {
            $this->request->data = $this->Customer->read();
            
            $this->loadModel('Gender');
            $genders = $this->Gender->find('list', array (
                'fields' => array (
                    'Gender.id',
                    'Gender.name'
                ),
                'order' => 'Gender.sort_index'
            ));
            
            $this->loadModel('Identities');
            $identities = $this->Identities->find('list', array (
                'fields' => array (
                    'Identities.id',
                    'Identities.name'
                ),
                'order' => 'Identities.sort_index'
            ));
            
            $this->loadModel('Religion');
            $religions = $this->Religion->find('list', array (
                'fields' => array (
                    'Religion.id',
                    'Religion.name'
                ),
                'order' => 'Religion.sort_index'
            ));
            
            $this->loadModel('Citizenship');
            $citizenships = $this->Citizenship->find('list', array (
                'fields' => array (
                    'Citizenship.id',
                    'Citizenship.name'
                ),
                'order' => 'Citizenship.sort_index'
            ));
            
            $this->loadModel('Job');
            $jobs = $this->Job->find('list', array (
                'fields' => array (
                    'Job.id',
                    'Job.name'
                ),
                'order' => 'Job.sort_index'
            ));
            
            $this->loadModel('Income');
            $incomes = $this->Income->find('list', array (
                'fields' => array (
                    'Income.id',
                    'Income.name'
                ),
                'order' => 'Income.sort_index'
            ));
            
            $this->loadModel('Purpose');
            $purposes = $this->Purpose->find('list', array (
                'fields' => array (
                    'Purpose.id',
                    'Purpose.name'
                ),
                'order' => 'Purpose.sort_index'
            ));
            
            $this->loadModel('TypeOfCard');
            $cards = $this->TypeOfCard->find('list', array (
                'fields' => array (
                    'TypeOfCard.id',
                    'TypeOfCard.name'
                ),
                'order' => 'TypeOfCard.sort_index'
            ));
            
            $this->loadModel('Bank');
            $banks = $this->Bank->find('list', array (
                'fields' => array (
                    'Bank.id',
                    'Bank.shortname'
                ),
                'order' => 'Bank.code'
            ));
            
            $expired = array ('month' => array(), 'year' => array());
            for ($i = 1; $i <= 12; ++$i) {
                $expired['month'][$i] = ($i < 10) ? "0$i" : "$i";
            }
            for ($i = 13; $i <= 99; ++$i) {
                $expired['year'][$i] = "$i";
            }
            
            $this->loadModel('AddressType');
            $addressTypes = $this->AddressType->find('list', array (
                'fields' => array (
                    'AddressType.id',
                    'AddressType.name'
                ),
                'conditions' => array (
                    'AddressType.is_enabled' => 1
                ),
                'order' => 'AddressType.sort_index'
            ));
            
            $this->loadModel('Province');
            $provinces = $this->Province->find('list', array (
                'fields' => array (
                    'Province.id',
                    'Province.name'
                ),
                'order' => 'Province.sort_index'
            ));
            
            $this->set(compact(
                        'genders', 
                        'identities', 
                        'religions',
                        'citizenships', 
                        'jobs',
                        'incomes',
                        'purposes',
                        'cards',
                        'banks',
                        'expired',
                        'addressTypes',
                        'provinces'
                    ));
        }
        elseif ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->request->data['Customer']['update_user'] = $this->session['username'];
            $this->request->data['Customer']['update_time'] = date('Y-m-d H:i:s');
            return json_encode($this->Customer->save($this->request->data) ? true : false);
        }
    }
}

?>
