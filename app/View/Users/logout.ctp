<?php
$reasons = array (
    'SHALAT' => 'SHALAT',
    'BRIEFING' => 'BRIEFING',
    'TOILET' => 'TOILET',
    'LUNCH' => 'LUNCH',
    'DRINK' => 'DRINK',
    'COACHING' => 'COACHING',
    'OTHER' => 'OTHER'
);
?>

<?=
$this->Form->create('UserLogout', array ('id' => 'UserLogout', 'name' => 'UserLogout')) .

'<table align="center">' .
$this->Html->tableCells(array (
    array($this->Form->input('activity', array ('label' => false, 'class' => 'input-text', 'style' => 'width: 247px', 'options' => $reasons, 'empty' => '(Choose one)', 'onchange' => 'User.setLogoutReason(this.value)'))),
    array($this->Form->input('activity_info', array ('label' => false, 'class' => 'input-text', 'style' => 'width: 240px; display: none', 'onkeyup' => 'Functions.textToUpper(this)'))),
    array('<hr />'),
    array(array ($this->Form->button('Logout', array('class' => 'button')) .' '. $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'logoutDialog\')')), array ('align' => 'center')))
)) .

'</table>' .
$this->Form->end(); 
?>
