
<?= $this->Html->tag('div', '', array ('id' => 'editGroupInfo')); ?>
<?= $this->Form->create('UserGroup', array ('id' => 'UserGroupEdit', 'name' => 'UserGroupEdit')); ?>
<?= $this->Form->input('id', array ('type' => 'hidden')); ?>
<?= $this->Form->input('current_leader', array ('type' => 'hidden', 'value' => $current_leader)); ?>

<table width="100%">

<?=
$this->Html->tableCells(array (
    array (
        'Group Name',
        ':',
        $this->Form->input('name', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Group Type',
        ':',
        $this->Form->input('type', array ('label' => false, 'options' => $types, 'class' => 'input-text', 'onchange' => 'UserGroup.checkType(this.value)', 'empty' => '(Choose One)'))
    ),
    array (
        'Group Leader',
        ':',
        $this->Form->input('user_id', array ('label' => false, 'options' => array(), 'class' => 'input-text'))
    ),
    array (
        array (
            '<hr />', array('colspan' => 3)
        )
    ),
    array (
        array (
            $this->Form->button('Save', array('class' => 'button')) .' '.
            $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'editGroupDialog\')'))
            , array ('colspan' => 3, 'align' => 'center')
        )
    )
));
?>