
<?= $this->Form->create('UserPassword', array ('id' => 'UserPassword', 'name' => 'UserPassword')); ?>
<?= $this->Form->input('id', array ('type' => 'hidden')); ?>
<table width="100%" align="center">
<?=
$this->Html->tableCells ( array (
    array (
        'Enter New Password'
    ),
    array (
        $this->Form->input('password', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        'Re-Enter New Password'
    ),
    array (
        $this->Form->input('password_confirm', array ('label' => false, 'type' => 'password', 'class' => 'input-text'))
    ),
    array (
        array (
            '<hr />' . $this->Form->button('Save', array('class' => 'button')),
            array ('align' => 'right')
        )
    )
));
?>
</table>

<?= $this->Form->end(); ?>