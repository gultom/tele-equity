<table>
<?=
$this->Html->tableCells(array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-group_add.png', array('align' => 'absmiddle')) . ' Add Group', array('class' => 'transButton', 'onclick' => 'UserGroup.initAddDialog()')),
        $this->Html->tag('button', $this->Html->image('icons/icon-group_edit.png', array('align' => 'absmiddle')) . ' Edit Group', array('class' => 'transButton', 'onclick' => 'UserGroup.initEditDialog()')),
    )
));
?>

</table>
<?php
echo 
$this->Html->tag('div', '', array('id' => 'userGroupInfo')) .
$this->Html->tag('div', '', array('id' => 'addGroupDialog')) .
$this->Html->tag('div', '', array('id' => 'editGroupDialog'));
?>

<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'groupList')); ?>