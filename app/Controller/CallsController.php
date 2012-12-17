<?php

/**
 * Description of CallsController
 *
 * @author Charles
 */
class CallsController extends AppController {
    
    public function getLog($customer_id) {
        $this->view = 'log';
        $count = $this->Call->find('count', array (
            'conditions' => array (
                'Call.customer_id' => $customer_id
            )
        ));
        $logs = $this->Call->find('all', array (
            'conditions' => array (
                'Call.customer_id' => $customer_id
            ),
            'order' => array (
                'Call.call_date DESC',
                'Call.call_time DESC'
            )
        ));
        $this->set(compact('count', 'logs'));
    }
    
    public function getCallNote($id) {
        $this->autoRender = false;
        $this->Call->id = $id;
        return json_encode(is_null($this->Call->field('call_note')) ? '' : $this->Call->field('call_note'));
    }
}

?>
