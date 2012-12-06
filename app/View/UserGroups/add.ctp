
<?= $this->Html->tag('div', '', array ('id' => 'addGroupInfo')); ?>
<?= $this->Form->create('UserGroup', array ('id' => 'UserGroupAdd', 'name' => 'UserGroupAdd')); ?>

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
            $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'addGroupDialog\')'))
            , array ('colspan' => 3, 'align' => 'center')
        )
    )
));
?>