<?php

/**
 * Description of PolicyController
 *
 * @author Charles
 */
class PolicyController extends AppController {
    
    public function load() {
        
    }
    
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
}

?>
