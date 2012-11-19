<?php

/**
 * Description of CustomersController
 *
 * @author charles
 */

class CustomersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $userMenu = $this->requestAction('/users/getmenus');
        $this->set('menu', $userMenu);
    }

    public function view() {
        
    }
}

?>
