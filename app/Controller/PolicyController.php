<?php

/**
 * Description of PolicyController
 *
 * @author Charles
 */
class PolicyController extends AppController {
    
    public function tabs() {
        
    }
    
    public function customerPolicies($custId = null) {
        $this->view = 'customer_policies';
        $options = array (
            'fields' => array (
                'Policy.id AS Id',
                'Policy.name AS Name',
                'Policy.premium AS Premium',
                'Policy.policy_cost AS Cost'
            ),
            'conditions' => array (
                'Policy.customer_id' => $custId
            )
        );
        $policies = $this->Policy->find('all', $options);
        $count = $this->Policy->find('count', $options);
        $this->set(compact('policies', 'count'));
    }
    
    public function add($custId = null) {
        if ($this->RequestHandler->isGet()) {
            $customer_id = $custId;
            $this->loadModel('PolicyRelationships');
            $relationships = $this->PolicyRelationships->find('list', array (
                'fields' => array (
                    'PolicyRelationships.id',
                    'PolicyRelationships.name'
                ),
                'condition' => array (
                    'PolicyRelationships.is_enabled' => 1
                ),
                'order' => 'PolicyRelationships.sort_index'
            ));
            
            $this->loadModel('Gender');
            $genders = $this->Gender->find('list', array (
                'fields' => array (
                    'Gender.id',
                    'Gender.name'
                ),
                'order' => 'Gender.sort_index'
            ));
            
            $this->loadModel('Religion');
            $religions = $this->Religion->find('list', array (
                'fields' => array (
                    'Religion.id',
                    'Religion.name'
                ),
                'order' => 'Religion.sort_index'
            ));
            
            $this->loadModel('Identities');
            $identities = $this->Identities->find('list', array (
                'fields' => array (
                    'Identities.id',
                    'Identities.name'
                ),
                'order' => 'Identities.sort_index'
            ));
            
            $this->loadModel('Citizenship');
            $citizenships = $this->Citizenship->find('list', array (
                'fields' => array (
                    'Citizenship.id',
                    'Citizenship.name'
                ),
                'order' => 'Citizenship.sort_index'
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
                        'customer_id',
                        'relationships',
                        'genders',
                        'religions',
                        'identities',
                        'citizenships',
                        'provinces'
                    ));
        }
        else {
            if ($this->RequestHandler->isPost()) {
                $this->autoRender = false;
                $this->Policy->create();
                $data = array ('result' => false, 'id' => $this->Policy->getLastInsertId());
                if ($this->Policy->save($this->request->data)) {
                    $data['result'] = true;
                    $data['id'] = $this->Policy->getLastInsertId();
                }
                return json_encode($data);
            }
        }
    }
    
    public function edit($id = null) {
        if ($this->RequestHandler->isGet()) {
            $this->Policy->id = $id;
            $this->request->data = $this->Policy->read();
            
            $this->loadModel('PolicyRelationships');
            $relationships = $this->PolicyRelationships->find('list', array (
                'fields' => array (
                    'PolicyRelationships.id',
                    'PolicyRelationships.name'
                ),
                'condition' => array (
                    'PolicyRelationships.is_enabled' => 1
                ),
                'order' => 'PolicyRelationships.sort_index'
            ));
            
            $this->loadModel('Gender');
            $genders = $this->Gender->find('list', array (
                'fields' => array (
                    'Gender.id',
                    'Gender.name'
                ),
                'order' => 'Gender.sort_index'
            ));
            
            $this->loadModel('Religion');
            $religions = $this->Religion->find('list', array (
                'fields' => array (
                    'Religion.id',
                    'Religion.name'
                ),
                'order' => 'Religion.sort_index'
            ));
            
            $this->loadModel('Identities');
            $identities = $this->Identities->find('list', array (
                'fields' => array (
                    'Identities.id',
                    'Identities.name'
                ),
                'order' => 'Identities.sort_index'
            ));
            
            $this->loadModel('Citizenship');
            $citizenships = $this->Citizenship->find('list', array (
                'fields' => array (
                    'Citizenship.id',
                    'Citizenship.name'
                ),
                'order' => 'Citizenship.sort_index'
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
                        'relationships',
                        'genders',
                        'religions',
                        'identities',
                        'citizenships',
                        'provinces'
                    ));
        }
        else {
            if ($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                return json_encode($this->Policy->save($this->request->data) ? true : false);
            }
        }
    }
    
    public function delete($id) {
        $this->autoRender = false;
        return json_encode($this->Policy->delete($id) ? true : false);
    }
    
    public function loadPlan($id) {
        $this->view = 'plan_form';
        $this->Policy->id = $id;
        $dataPlan = $this->Policy->find('first', array (
            'fields' => array (
                'Policy.id',
                'Policy.birth_date',
                'Policy.product_id',
                'Policy.plan_id',
                'Policy.premium',
                'Policy.policy_cost',
                '(Policy.premium + Policy.policy_cost) AS first_installment'
            ),
            'conditions' => array (
                'Policy.id' => $id
            )
        ));
        
        $this->request->data['Policy']['birth_date'] = $dataPlan['Policy']['birth_date'];
        $this->request->data['Policy']['product_id'] = $dataPlan['Policy']['product_id'];
        $this->request->data['Policy']['premium'] = (int)$dataPlan['Policy']['premium'];
        $this->request->data['Policy']['policy_cost'] = (int)$dataPlan['Policy']['policy_cost'];
        
        $this->loadModel('Product');
        $products = $this->Product->find('list', array (
            'fields' => array (
                'Product.id',
                'Product.name'
            ),
            'conditions' => array (
                'Product.is_enabled' => 1
            ),
            'order' => 'Product.sort_index'
        ));
        
        $this->set(compact('dataPlan', 'products'));
    }
    
    private function calculateAgeInMonth($dob) {
        $this->autoRender = false;
        $dateStart = new DateTime($dob);
        $dateEnd = new DateTime(date('Y-m-d'));
        $diff = $dateStart->diff($dateEnd);
        
        return ($diff->format("%y") * 12) + $diff->format("%m");
    }
    
    public function calculatePremium($id, $productId, $planId) {
        $this->autoRender = false;
        $this->Policy->id = $id;
        $ageInMonth = self::calculateAgeInMonth($this->Policy->field('birth_date'));
        $price = $this->requestAction('/prices/getprice/'. $productId .'/'. $planId .'/'. $ageInMonth);
        $cost = $this->requestAction('/products/getcost/'. $productId);
        return json_encode(array (
                'price' => $price,
                'cost' => $cost
            ));
    }
    
    public function savePlan() {
        $this->autoRender = false;
        return json_encode($this->Policy->save($this->request->data) ? true : false);
    }
}

?>
