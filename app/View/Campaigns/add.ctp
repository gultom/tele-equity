<?= $this->Html->tag('div', '', array ('id' => 'campaignInfo')); ?>
<?= $this->Form->create('Campaign', array ('id' => 'CampaignAdd', 'name' => 'CampaignAdd')); ?>

<table width="100%">
<?=
$this->Html->tableCells(array (
    array (
        'Campaign Name',
        $this->Form->input('name', array ('label' => false, 'class' => 'input-text', 'onkeyup' => 'Functions.textToUpper(this)'))
    ),
    array (
        array (
            '<hr />' .
            $this->Form->button('Save', array ('class' => 'button')) .' '. 
            $this->Form->button('Cancel', array ('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'addCampaignDialog\')')),
            array (
                'colspan' => 2,
                'align' => 'center'
            )
        )
    )
));
?>
</table>