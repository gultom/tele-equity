<?php if ($count): ?>
    <table id="logCallsDatatable" class="display">
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
        </tbody>
    </table>
<?php else: ?>
    <?= $this->Html->div('error', 'data not found', array ('style' => 'text-align: center')); ?>
<?php endif; ?>