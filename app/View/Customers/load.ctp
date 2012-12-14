<?php if ($count): ?>
    <table id="customersDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('Campaign' => array ('width' => '80px')),
                array ('Batch' => array ('width' => '80px')),
                array ('Name' => array ('width' => '120px')),
                array ('Status' => array ('width' => '40px')),
                array ('TM' => array ('width' => '50px')),
                array ('TL' => array ('width' => '50px')),
                array ('SPV' => array ('width' => '50px')),
                array ('QA' => array ('width' => '50px')),
                array ('Response' => array ('width' => '100px')),
                array ('DOB' => array ('width' => '40px')),
                array ('Company' => array ('width' => '70px')),
                array ('Home ph. 1' => array ('width' => '50px')),
                array ('Home ph. 2' => array ('width' => '50px')),
                array ('Handphone 1' => array ('width' => '50px')),
                array ('Handphone 2' => array ('width' => '50px'))
            ));
            ?>
        </thead>
        <tbody>
            <?php foreach ($customers as $key => $value): ?>
            <?= 
            $this->Html->tableCells(array(
                    array (
                        $value['Import']['Campaign']['Name'],
                        $value['Customer']['batch_no'],
                        $value['Customer']['name'],
                        $value['Status']['Status'],
                        $value['TM']['Username'],
                        $value['TL']['Username'],
                        $value['SPV']['Username'],
                        $value['QA']['Username'],
                        $value['Response']['Response'],
                        $value['Customer']['birth_date'],
                        $value['Customer']['company'],
                        $value['Customer']['homephone1'],
                        $value['Customer']['homephone2'],
                        $value['Customer']['handphone1'],
                        $value['Customer']['handphone2']
                    )
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['id'] .')',
                    'ondblclick' => 'Customer.initDetailsDialog()',
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['id'] .')',
                    'ondblclick' => 'Customer.initDetailsDialog()',
                )
            );
            ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->Html->div('info', $count .' customer(s) listed', array ('style' => 'margin: 5px 0 3px 0')); ?>
<?php else: ?>
    <?= $this->Html->div('error', 'data not found', array ('style' => 'text-align: center')); ?>
<?php endif; ?>