<?= 
    $this->Html->script(array(
        'lib/prototype/prototype',
        'app/Users'
    ), false);
?>
<?= $this->Form->create(array('name' => 'UserLoginForm')); ?>

<?= $this->Form->input('username', array('id' => 'username')); ?>

<?= $this->Form->button('Login', array('type' => 'button', 'onclick' => 'Users.doLogin()')); ?>

<?= $this->Form->end(); ?>
