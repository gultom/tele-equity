<?= $this->Form->create('User'); ?>
<table align="center">
    <tr>
        <td align="center"><?= $this->Html->image('equity-life-indonesia-logo.gif'); ?></td>
    </tr>
    <tr>
        <td><label for="Username">Username</label></td>
    </tr>
    <tr>
        <td><?= $this->Form->input('username', array('class' => 'input-text', 'label' => false)); ?></td>
    </tr>
    <tr>
        <td><label for="Password">Password</label></td>
    </tr>
    <tr>
        <td><?= $this->Form->input('password', array('class' => 'input-text', 'label' => false)); ?></td>
    </tr>
    <tr>
        <td align="right"><?= $this->Form->submit("Login", array('class' => 'button')); ?></td>
    </tr>
</table>
<?= $this->Form->end(); ?>