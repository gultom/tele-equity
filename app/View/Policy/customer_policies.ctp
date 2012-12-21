<?php if ($count): ?>
    <table id="customerPoliciesDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('No.' => array ('width' => '10px')),
                array ('Name' => array ('width' => '120px')),
                array ('Premium' => array ('width' => '80px')),
                array ('Cost' => array ('width' => '80px')),
                array ('Del.' => array ('width' => '10px'))
            ));
            ?>
        </thead>
        <tbody>
            <?php foreach ($policies as $key => $value): ?>
            <?php static $no = 1; ?>
            <?= 
            $this->Html->tableCells(array(
                    array (
                        array ("$no.", array ('align' => 'center')),
                        $value['Policy']['Name'],
                        $value['Policy']['Premium'],
                        $value['Policy']['Cost'],
                        $this->Html->link($this->Html->image('icons/icon-minus.png'), 'javascript:void(0)', array('escape' => false, 'onmouseover' => 'Policy.setId('. $value['Policy']['Id'] .')', 'onclick' => 'Policy.initDeleteDialog()'))
                    )
                ),
                array (
                    'onclick' => 'Policy.setId('. $value['Policy']['Id'] .')',
                    'ondblclick' => 'Policy.initEditDialog()',
                ),
                array (
                    'onclick' => 'Policy.setId('. $value['Policy']['Id'] .')',
                    'ondblclick' => 'Policy.initEditDialog()',
                )
            );
            ?>
            <?php ++$no; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->Html->div('info', $count .' policies listed', array ('style' => 'margin: 5px 0 3px 0')); ?>
<?php else: ?>
    <?= $this->Html->div('error', 'data not found', array ('style' => 'text-align: center')); ?>
<?php endif; ?>