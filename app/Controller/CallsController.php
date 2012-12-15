<?php

/**
 * Description of CallsController
 *
 * @author Charles
 */
class CallsController extends AppController {
    
    public function getLog($customer_id) {
        $this->view = 'log';
        $count = 0;
        $logs = $this->Call->find('all', array (
            'conditions' => array (
                'Call.customer_id' => $customer_id
            )
        ));
        $this->set(compact('count', 'logs'));
    }
}

?>
