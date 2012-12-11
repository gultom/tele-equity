<?php

/**
 * Description of CampaignController
 *
 * @author Charles
 */
class CampaignsController extends AppController {
    
    public function index() {
        self::view();
    }
    
    public function view() {
        $this->view = ($this->RequestHandler->isAjax()) ? 'load' : 'view';
        $this->set('title_for_layout', 'Campaign List');
        
        $campaigns = $this->Campaign->find('all', array (
            'fields' => array (
                'Campaign.id AS Id',
                'Campaign.name AS Name',
                'Campaign.insert_time AS Added',
                'Campaign.insert_user AS AddedBy'
            ),
            'order' => 'Added DESC'
        ));
        $this->set(compact('campaigns'));
    }
    
    public function add() {
        if ($this->RequestHandler->isPost()) {
            $this->autoRender = false;
            $this->Campaign->create();
            $this->request->data['Campaign']['insert_user'] = $this->session['username'];
            $this->request->data['Campaign']['insert_time'] = date('Y-m-d H:i:s');
            return json_encode(($this->Campaign->save($this->request->data)) ? true : false);
        }
    }
    
    public function isNameExist() {
        $this->autoRender = false;
        $campaign = $this->Campaign->find('count', array (
            'conditions' => array (
                'Campaign.id <> ' => $this->request->data['id'],
                'Campaign.name' => $this->request->data['name']
            )
        ));
        return json_encode(($campaign) ? true : false);
    }
}

?>
