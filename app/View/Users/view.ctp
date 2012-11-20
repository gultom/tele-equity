
<?=
$this->Html->script(array(
    'lib/datatables/script'
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));

$this->Html->scriptBlock(
    '
jQuery(document).ready(function($) {
    Functions.initDatatable("usersDatatable", 100);
});
    ', array('inline' => FALSE));
?>

<table>
<?= 
$this->Html->tableCells(array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-group.png', array('align' => 'absmiddle')) . ' Groups', array('class' => 'transButton', 'onclick' => 'alert("showGroup")')),
        $this->Html->tag('button', $this->Html->image('icons/icon-user_add.png', array('align' => 'absmiddle')) . ' Add User', array('class' => 'transButton', 'onclick' => 'alert("showAddUser")')),
        $this->Html->tag('button', $this->Html->image('icons/icon-user_edit.png', array('align' => 'absmiddle')) . ' Edit User', array('class' => 'transButton', 'onclick' => 'alert("showEditUser")')),
    )
));
?>
</table>
<div id="clear"></div>
<table id="usersDatatable" class="display">
    <thead>
        <?= 
        $this->Html->tableHeaders( array (
            'Level',
            'User Code',
            'Username',
            'Fullname',
            'Active',
            'Join Date',
            'Exp. Date',
            'Group',
            'TL',
            'QA',
            'Extension'
        ));
        ?>
    </thead>
    <tbody>
<?php foreach($users as $key => $value): ?>
<?= 
$this->Html->tableCells(array(
    array (
        $value['ListValue']['Level'],
        $value['User']['UserCode'],
        $value['User']['Username'],
        $value['User']['Fullname'],
        ($value['User']['Active']) ? 'Yes' : 'No',
        $value['User']['JoinDate'],
        $value['User']['ExpDate'],
        $value['UserGroup']['GroupName'],
        $value['UserGroup']['TL'],
        $value['User']['QA'],
        $value['User']['Extension']
    )
));
?>
<?php endforeach; ?>
    </tbody>
</table>
