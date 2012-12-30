<?php

class ProductsController extends AppController {
    
    public function getCost($id) {
        $this->autoRender = false;
        $this->Product->id = $id;
        return (int)$this->Product->field('cost');
    }
}

?>
