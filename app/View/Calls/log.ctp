<?php if ($count): ?>
    <table id="logCallsDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('Call Date' => array ('width' => '60px')),
                array ('Call Time' => array ('width' => '60px')),
                array ('Duration' => array ('width' => '60px')),
                array ('Phone Number' => array ('width' => '100px')),
                array ('Connected' => array ('width' => '50px')),
                array ('Contacted' => array ('width' => '50px')),
                array ('Callback' => array ('width' => '50px')),
                array ('Callback Time' => array ('width' => '80px')),
                array ('CallBack Number' => array ('width' => '100px'))
            ));
            ?>
        </thead>
        <tbody>
            <?php foreach ($logs as $key => $value): ?>
            <?=
               $this->Html->tableCells (array (
                   array (
                       array ($value['Call']['call_date'], array ('align' => 'center')),
                       array ($value['Call']['call_time'], array ('align' => 'center')),
                       array ($value['Call']['duration'], array ('align' => 'center')),
                       array ($value['Call']['phone_number'], array ('align' => 'right')),
                       array (($value['Call']['is_connected']) ? 'Yes' : 'No', array ('align' => 'center')),
                       array (($value['Call']['is_contacted']) ? 'Yes' : 'No', array ('align' => 'center')),
                       array (($value['Call']['is_callback']) ? 'Yes' : 'No', array ('align' => 'center')),
                       array ($value['Call']['callback_time'], array ('align' => 'center')),
                       array ($value['Call']['callback_number'], array ('align' => 'right'))
                   )
               ),
               array (
                   'style' => 'cursor: pointer',
                   'onclick' => 'Call.setId('. $value['Call']['id'] .');Call.getCallNote()',
                   'ondblclick' => 'Call.initDetailsDialog()',
               ),
               array (
                   'style' => 'cursor: pointer',
                   'onclick' => 'Call.setId('. $value['Call']['id'] .');Call.getCallNote()',
                   'ondblclick' => 'User.initDetailsDialog()',
               ));
            ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <?= $this->Html->div('error', 'data not found', array ('style' => 'text-align: center')); ?>
<?php endif; ?>