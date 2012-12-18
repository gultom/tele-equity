<?php

/**
 * Description of PolicyController
 *
 * @author Charles
 */
class PolicyController extends AppController {
    
    public function load() {
        debug($this->Policy->find('all'));
    }
}

?>
