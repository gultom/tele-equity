<?=
    $this->Html->script(array(
        'lib/jquery/jquery-1.8.2.min',
        'lib/prototype/prototype',
        'app/Users'
    ));

    $this->Html->scriptBlock(
        '
        var Users = new Users();
        '
    );
?>
