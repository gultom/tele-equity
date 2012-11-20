<?php

/**
 * Description of InfoController
 *
 * @author charles
 */
class InfoController extends AppController {
    
    public function index() {
        if ($this->Auth->isAuthorized()) {
            self::home();
        }
        else {
            $this->redirect(array (
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    
    public function home() {
        
    }
    
    public function view() {
        
    }
}

?>
