

<?= $this->Form->create('User', array ('id' => 'UserAdd')); ?>

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
        $this->Form->input('user_code', array('label' => false, 'class' => 'input-text')),
        'SIP User',
        ':',
        $this->Form->input('sip_user', array('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Level',
        ':',
        $this->Form->input('level', array('label' => false, 'options' => $levels, 'empty' => '(Choose One)', 'class' => 'input-text')),
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
        $this->Form->input('qa', array('label' => false, 'disabled' => 'disabled', 'options' => array(), 'class' => 'input-text')),
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
            $this->Form->checkbox('is_active', array ('disabled' => 'disabled', 'checked' => 'checked')) .' Active', array('colspan' => 6)
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
            $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'addUserDialog\')'))
            , array ('colspan' => 6, 'align' => 'center')
        )
    )
));
?>

</table>

<?= $this->Form->end(); ?>