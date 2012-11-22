
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
    Functions.initDialog("addUserDialog", "Add User", 550, 350);
    Functions.initDialog("editUserDialog", "User Details", 550, 350);
    Functions.initDatatable("usersDatatable", 100);
});
    ', array('inline' => FALSE));
?>

<table>
<?= 
$this->Html->tableCells(array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-group.png', array('align' => 'absmiddle')) . ' Groups', array('class' => 'transButton', 'onclick' => 'alert("showGroup")')),
        $this->Html->tag('button', $this->Html->image('icons/icon-user_add.png', array('align' => 'absmiddle')) . ' Add User', array('class' => 'transButton', 'onclick' => 'User.initAddDialog()')),
        $this->Html->tag('button', $this->Html->image('icons/icon-user_edit.png', array('align' => 'absmiddle')) . ' Edit User', array('class' => 'transButton', 'onclick' => 'User.initEditDialog()')),
    )
));
?>
</table>
<?php
echo 
$this->Html->tag('div', '', array('id' => 'userInfo')) .
$this->Html->tag('div', '', array('id' => 'groupsDialog')) .
$this->Html->tag('div', '', array('id' => 'addUserDialog')) .
$this->Html->tag('div', '', array('id' => 'editUserDialog'));
?>
<div id="clear"></div>
<div id="userList">
    <table id="usersDatatable" class="display">
        <thead>
            <?= 
            $this->Html->tableHeaders( array (
                array ('Level' => array ('width' => '10px')),
                array ('User Code' => array ('width' => '65px')),
                array ('Username' => array ('width' => '10px')),
                array ('Fullname' => array ('width' => '120px')),
                array ('Active' => array ('width' => '10px')),
                array ('Join' => array ('width' => '70px')),
                array ('Expired' => array ('width' => '70px')),
                array ('Group' => array ('width' => '70px')),
                array ('TL' => array ('width' => '10px')),
                array ('QA' => array ('width' => '10px')),
                array ('Ext.' => array ('width' => '10px')),
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
                $value['User']['Active'],
                $value['User']['JoinDate'],
                $value['User']['ExpDate'],
                $value['Group']['Group'],
                $value['Group']['TL'],
                $value['User']['QA'],
                $value['User']['Extension']
            )
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['Id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['Id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        )
    );
    ?>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
