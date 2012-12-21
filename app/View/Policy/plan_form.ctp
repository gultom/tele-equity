<?= $this->Form->create('Policy', array ('id' => 'planForm', 'name' => 'planForm')); ?>
<?= $this->Form->input('id', array ('type' => 'hidden', 'value' => $dataPlan['Policy']['id'])); ?>

<table style="margin-left: 30px">

<?=
$this->Html->tableCells (array (
    array (
        array ('Product :', array ('align' => 'right')),
        $this->Form->input('product_id', array ('label' => false, 'options' => $products, 'empty' => '(choose one)', 'class' => 'input-text', 'onchange' => 'Product.setId(this.value);Plan.listPlan()'))
    ),
    array (
        array ('Plan :', array ('align' => 'right')),
        $this->Form->input('plan_id', array ('label' => false, 'options' => array(), 'empty' => '(choose one)', 'class' => 'input-text', 'onchange' => 'Plan.getPremium()'))
    ),
    array (
        array ('Premi :', array ('align' => 'right')),
        $this->Html->tag('div', 'Rp. '. number_format($dataPlan['Policy']['premium'], 0, '', '.'), array ('id' => 'policyPremium'))
    ),
    array (
        array ('Cost :', array ('align' => 'right')),
        $this->Html->tag('div', 'Rp. '. number_format($dataPlan['Policy']['policy_cost'], 0, '', '.'), array ('id' => 'policyCost'))
    ),
    array (
        array ('First Installment :', array ('align' => 'right')),
        $this->Html->tag('div', 'Rp. '. number_format(($dataPlan['Policy']['premium'] + $dataPlan['Policy']['policy_cost']), 0, '', '.'), array ('id' => 'policyFirstInstallment'))
    )
));
?>

</table>
<?= $this->Form->end(); ?>