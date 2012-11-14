<?= 
    $this->Html->script(array(
        'lib/jquery/jquery-1.8.2.min',
        'lib/prototype/prototype',
        'app/Users'
    ), false);
    
    $this->Html->scriptBlock(
        '
        var Users = new Users();
        ',
        array ('inline' => false)
    );
?>
<?= $this->Form->create(array('name' => $formName)); ?>

<?= $this->Form->input('username', array('id' => 'username')); ?>

<?= $this->Form->input('password', array('id' => 'password')); ?>

<?= $this->Form->button('Login', array('type' => 'button', 'onclick' => 'Users.doLogin(\''. $formName .'\')')); ?>

<?= $this->Form->end(); ?>
