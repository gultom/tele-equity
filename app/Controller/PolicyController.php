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
}

?>
