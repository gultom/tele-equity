<?=
$this->Html->script(array(
    'lib/datatables/script'
), false);

$this->Html->css(array (
    'lib/datatables/default'
), null, array (
    'inline' => false
))
?>


<?php foreach ($customers as $key => $value): ?>
<?= var_dump($value['Customer']['customer']) .'<br />'; ?>
<?php endforeach; ?>