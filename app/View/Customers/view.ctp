<?=
$this->Html->script(array(
    'lib/datatables/script',
    'app/Customer'
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));
?>

<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'customerList')); ?>