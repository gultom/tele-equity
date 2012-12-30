<?= $this->Html->tag('div', '', array ('id' => 'planInfo')); ?>
<?= $this->Form->create('Policy', array ('id' => 'PolicyPlanForm', 'name' => 'PolicyPlanForm')); ?>
<?= $this->Form->input('id', array ('type' => 'hidden', 'value' => $dataPlan['Policy']['id'])); ?>
<?= $this->Form->input('currentPlanId', array ('type' => 'hidden', 'value' => $dataPlan['Policy']['plan_id'])); ?>

<table style="margin-left: 30px">

<?=
$this->Html->tableCells (array (
    array (
        array ('Product :', array ('align' => 'right')),
        $this->Form->input('product_id', array ('label' => false, 'options' => $products, 'empty' => '(choose one)', 'class' => 'input-text', 'onchange' => 'Product.setId(this.value);Plan.listPlan()'))
    ),
    array (
        array ('Plan :', array ('align' => 'right')),
        $this->Form->input('plan_id', array ('label' => false, 'options' => array(), 'empty' => '(choose one)', 'class' => 'input-text', 'onchange' => 'Plan.setId(this.value);Policy.calculatePremium()'))
    ),
    array (
        array ('Premi :', array ('align' => 'right')),
        ' Rp. '. $this->Form->input('premium', array ('label' => false, 'div' => false, 'type' => 'text', 'class' => 'input-text', 'readonly' => true))
    ),
    array (
        array ('Cost :', array ('align' => 'right')),
        ' Rp. '. $this->Form->input('policy_cost', array ('label' => false, 'div' => false, 'type' => 'text', 'class' => 'input-text', 'readonly' => true))
    ),
    array (
        array ('First Installment :', array ('align' => 'right')),
        ' Rp. '. $this->Form->input('first_installment', array ('label' => false, 'div' => false, 'class' => 'input-text', 'value' => (int)($dataPlan['Policy']['premium'] + $dataPlan['Policy']['policy_cost']), 'readonly' => true))
    ),
    array (
        array ('<hr />', array ('colspan' => 3, 'align' => 'center'))
    ),
    array (
        array ($this->Form->button('Save', array ('class' => 'button')), array ('align' => 'center', 'colspan' => 2))
    )
));
?>

</table>
<?= $this->Form->end(); ?>
