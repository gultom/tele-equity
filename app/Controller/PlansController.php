<?php

/**
 * Description of PlansController
 *
 * @author Charles
 */
class PlansController extends AppController {
    
    public function listPlan($productId) {
        $this->autoRender = false;
        return (json_encode($this->Plan->find('list', array (
            'fields' => array (
                'Plan.id',
                'Plan.name'
            ),
            'conditions' => array (
                'Plan.product_id' => $productId
            ),
            'order' => 'Plan.name'
        ))));
    }
}

?>
