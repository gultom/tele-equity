
<?=
$this->Html->script(array(
    'lib/datatables/script',
    'app/UserGroup.js',
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));

$this->Html->scriptBlock(
    '
jQuery(document).ready(function($) {
    UserGroup = new UserGroup();
    Functions.initDialog("groupsDialog", "Group Lists", 500, 400);
    Functions.initDialog("addUserDialog", "Add User", 550, 380);
    Functions.initDialog("editUserDialog", "User Details", 550, 380);
    Functions.initConfirmationDialog("deleteUserDialog", "Delete Confirmation", 300, 150, function() {
        User.del();
        jQuery("#deleteUserDialog").dialog("close");
    });
    User.load();
});
    ', array('inline' => FALSE));
?>

<table>
<?= 
$this->Html->tableCells(array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-group.png', array('align' => 'absmiddle')) . ' Groups', array('class' => 'transButton', 'onclick' => 'UserGroup.initShowGroupsDialog()')),
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
$this->Html->tag('div', '', array('id' => 'editUserDialog')) .
$this->Html->tag('div', '', array('id' => 'deleteUserDialog'));
?>

<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'userList')); ?>
