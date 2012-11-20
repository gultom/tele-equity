<?php

/**
 * Description of CustomersController
 *
 * @author charles
 */

class CustomersController extends AppController {

    public function view() {
        $data = $this->Customer->find('all', array (
            'limit' => 5,
            'conditions' => array (
                'Customer.status_code' => array(4, 5)
            )
        ));
        $this->set('customers', $data);
    }
}

?>
