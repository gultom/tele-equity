<?php

/**
 * Description of PriceController
 *
 * @author Charles
 */
class PricesController extends AppController {
    
    public function getPrice($productId, $planId, $ageInMonth) {
        $data = $this->Price->find('first', array (
            'fields' => array (
                'Price.price'
            ),
            'joins' => array (
                array (
                    'table' => 'plans',
                    'alias' => 'Plan',
                    'foreignKey' => false,
                    'conditions' => array (
                        'Plan.id = Price.plan_id'
                    )
                ),
                array (
                    'table' => 'products',
                    'alias' => 'Product',
                    'foreignKey' => false,
                    'conditions' => array (
                        'Product.id = Plan.product_id'
                    )
                )
            ),
            'conditions' => array (
                'Product.id' => $productId,
                'Plan.id' => $planId,
                'Price.age_start <=' => $ageInMonth,
                'Price.age_end >=' => $ageInMonth
            )
        ));
        
        return (count($data) ? (int)$data['Price']['price'] : 0);
    }
}

?>
