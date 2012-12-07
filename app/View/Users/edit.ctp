
<?= $this->Html->tag('div', '', array ('id' => 'editInfo')); ?>
<?= $this->Html->tag('div', '', array ('id' => 'addPassword')); ?>
<?= $this->Form->create('User', array ('id' => 'UserEdit', 'name' => 'UserEdit')); ?>
<?= $this->Form->input('id', array ('type' => 'hidden')); ?>
<?= $this->Form->input('current_group', array ('type' => 'hidden', 'value' => $current_group)); ?>
<?= $this->Form->input('current_qa', array ('type' => 'hidden', 'value' => $current_qa)); ?>
<table width="100%">

<?= 
$this->Html->tableCells(array(
    array (
        'Username',
        ':',
        $this->Form->input('username', array('label' => false, 'class' => 'input-text')),
        'SIP Host',
        ':',
        $this->Form->input('sip_host', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Fullname',
        ':',
        $this->Form->input('fullname', array('label' => false, 'class' => 'input-text')),
        'SIP Port',
        ':',
        $this->Form->input('sip_port', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'User Code',
        ':',
        $this->Form->input('usercode', array('label' => false, 'class' => 'input-text')),
        'SIP User',
        ':',
        $this->Form->input('sip_user', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Level',
        ':',
        $this->Form->input('level_id', array('label' => false, 'options' => $levels, 'onchange' => 'User.checkLevel(this.value)', 'empty' => '(Choose One)', 'class' => 'input-text')),
        'SIP Pass',
        ':',
        $this->Form->input('sip_pass', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Group',
        ':',
        $this->Form->input('group_id', array('label' => false, 'disabled' => 'disabled', 'options' => array(), 'class' => 'input-text')),
        'Prefix Local',
        ':',
        $this->Form->input('prefix_local', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'QA',
        ':',
        $this->Form->input('qa_id', array('label' => false, 'disabled' => 'disabled', 'options' => array(), 'class' => 'input-text')),
        'Prefix Local',
        ':',
        $this->Form->input('prefix_sljj', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Join Date',
        ':',
        $this->Form->text('join_date', array('id' => 'joinDate', 'value' => date('Y-m-d'), 'class' => 'input-text')),
        'Prefix Mobile',
        ':',
        $this->Form->input('prefix_mobile', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        array (
            $this->Form->checkbox('is_enabled') .' Active', array('colspan' => 6)
        )
    ),
    array (
        array (
            '<hr />', array('colspan' => 6)
        )
    ),
    array (
        array (
            $this->Form->button('Save', array('class' => 'button')) .' '.
            $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'editUserDialog\')'))
            , array ('colspan' => 4, 'align' => 'left')
        ),
        array (
            $this->Form->button($this->Html->image('icons/icon-padlock.png', array('align' => 'absmiddle')) .' Password', array('type' => 'button', 'class' => 'button', 'onclick' => 'User.initAddPasswordDialog()')),
            array ('colspan' => 2, 'align' => 'right')
        )
    )
));
?>

</table>

<?= $this->Form->end(); ?>