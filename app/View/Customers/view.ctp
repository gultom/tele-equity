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

$this->Html->scriptBlock(
    '
jQuery(document).ready(function($) {
    Customer.load();
});
    ', array('inline' => FALSE));
?>

<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'customerList')); ?>