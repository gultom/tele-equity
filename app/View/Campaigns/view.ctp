<?=
$this->Html->script(array(
    'lib/datatables/script',
    'app/Campaign'
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));

$this->Html->scriptBlock (
    '
    jQuery(document).ready(function($) {
        Campaign = new Campaign();
        Functions.initDialog("addCampaignDialog", "Add Campaign", 300, 170);
        Functions.initDialog("editCampaignDialog", "Edit Campaign", 300, 170);;
        Functions.initConfirmationDialog("deleteCampaignDialog", "Delete Confirmation", 300, 150, function() {
            Campaign.del();
            jQuery("#deleteCampaignDialog").dialog("close");
        });
        Campaign.load();
    });
    ', array ('inline' => false));
?>

<table>
<?=
$this->Html->tableCells(array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-plus.png', array('align' => 'absmiddle')) . ' Add', array('class' => 'transButton', 'onclick' => 'Campaign.initAddDialog()')),
        $this->Html->tag('button', $this->Html->image('icons/icon-pencil.png', array('align' => 'absmiddle')) . ' Edit', array('class' => 'transButton', 'onclick' => 'Campaign.initEditDialog()'))
    )
));
?>
</table>

<?php
echo 
$this->Html->tag('div', '', array ('id' => 'campaignInfo')) .
$this->Html->tag('div', '', array ('id' => 'addCampaignDialog')) .
$this->Html->tag('div', '', array ('id' => 'editCampaignDialog')) .
$this->Html->tag('div', '', array ('id' => 'deleteCampaignDialog')) .
$this->Html->tag('div', '', array ('id' => 'clear')) .
$this->Html->tag('div', '', array ('id' => 'campaignList'));
?>

