    <table id="usersDatatable" class="display">
        <thead>
            <?= 
            $this->Html->tableHeaders( array (
                array ('Del.' => array ('width' => '40px')),
                array ('Level' => array ('width' => '120px')),
                array ('User Code' => array ('width' => '65px')),
                array ('Username' => array ('width' => '65px')),
                array ('Fullname' => array ('width' => '120px')),
                array ('Active' => array ('width' => '10px')),
                array ('Join' => array ('width' => '70px')),
                array ('Expired' => array ('width' => '70px')),
                array ('Group' => array ('width' => '70px')),
                array ('TL' => array ('width' => '65px')),
                array ('QA' => array ('width' => '65px')),
                array ('Ext.' => array ('width' => '20px')),
            ));
            ?>
        </thead>
        <tbody>
    <?php foreach($users as $key => $value): ?>
    <?= 
    $this->Html->tableCells(array(
            array (
                $this->Html->link($this->Html->image('icons/icon-user_delete.png'), 'javascript:void(0)', array('escape' => false, 'onmouseover' => 'User.setId('. $value['User']['id'] .')', 'onclick' => 'User.initDeleteDialog()')),
                $value['Level']['Level'],
                $value['User']['usercode'],
                $value['User']['username'],
                $value['User']['fullname'],
                $value['User']['Active'],
                $value['User']['join_date'],
                $value['User']['exp_date'],
                $value['UserGroup']['Group'],
                (isset($value['UserGroup']['Leader'])) ? $value['UserGroup']['Leader']['LeaderUsername'] : '',
                $value['QA']['Username'],
                $value['User']['sip_user']
            )
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        )
    );
    ?>
    <?php endforeach; ?>
        </tbody>
    </table>
