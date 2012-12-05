    <table id="groupsDatatable" class="display">
        <thead>
            <?= 
            $this->Html->tableHeaders( array (
                array ('Del.' => array ('width' => '20px')),
                array ('Name' => array ('width' => '80px')),
                array ('Lead By' => array ('width' => '40px')),
                array ('Leader' => array ('width' => '80px'))
            ));
            ?>
        </thead>
        <tbody>
    <?php foreach($groups as $key => $value): ?>
    <?= 
    $this->Html->tableCells(array(
            array (
                array ($this->Html->link($this->Html->image('icons/icon-group_delete.png'), 'javascript:void(0)', array('escape' => false, 'onmouseover' => 'UserGroup.setId('. $value['UserGroup']['Id'] .')', 'onclick' => 'UserGroup.initDeleteDialog()')), array ('align' => 'center')),
                $value['UserGroup']['Name'],
                array ($value['UserGroup']['Type'], array ('align' => 'center')),
                $value['Leader']['Leader']
            )
        ), 
        array (
            'onclick' => 'UserGroup.setId('. $value['UserGroup']['Id'] .')',
            'ondblclick' => 'UserGroup.initEditDialog()',
        ), 
        array (
            'onclick' => 'UserGroup.setId('. $value['UserGroup']['Id'] .')',
            'ondblclick' => 'UserGroup.initEditDialog()',
        )
    );
    ?>
    <?php endforeach; ?>
        </tbody>
    </table>
