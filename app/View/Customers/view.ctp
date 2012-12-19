<?=
$this->Html->script(array(
    'lib/datatables/script',
    'app/Customer',
    'app/Import',
    'app/Call'
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));

$this->Html->scriptBlock (
    '
jQuery(document).ready(function($) {
    Import = new Import();
    Customer = new Customer();
    Functions.initDialog("uploadDialog", "Upload Data", 600, 500);
    Functions.initDialog("detailsDialog", "Customer Details", 800, 480);
    jQuery("#FilterCustomerList").click(function() {
        Customer.load();
    });
});
    ', array ('inline' => false));
?>

<table>
<?=
$this->Html->tableCells (array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-_upload.png', array('align' => 'absmiddle')) . ' Upload', array ('class' => 'transButton', 'onclick' => 'Import.initUploadDialog()', 'disabled' => $buttons['upload'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_distribute.png', array('align' => 'absmiddle')). ' Distribute', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['distribute'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_reassign.png', array('align' => 'absmiddle')). ' Reassign', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['reassign'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_recycle.png', array('align' => 'absmiddle')). ' Recycle', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['recycle'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_details.png', array('align' => 'absmiddle')). ' Details', array ('class' => 'transButton', 'onclick' => 'Customer.initDetailsDialog()', 'disabled' => $buttons['details'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_search.png', array('align' => 'absmiddle')). ' Search', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['search']))
    )
));
?>
</table>

<?= $this->Form->create('FilterCustomer', array ('id' => 'FilterCustomer', 'name' => 'FilterCustomer')); ?>

<fieldset>
    <legend>Filters</legend>
    <table>
<?=
$this->Html->tableCells( array (
    array (
        'Campaign',
        'Status',
        'Response',
        ''
    ),
    array (
        $this->Form->input('campaign_id', array ('label' => false, 'empty' => '(All)', 'options' => $campaigns, 'class' => 'input-text')),
        $this->Form->input('status_code', array ('label' => false, 'empty' => '(All)', 'options' => $statuses, 'class' => 'input-text')),
        $this->Form->input('response_id', array ('label' => false, 'empty' => '(All)', 'options' => $responses, 'class' => 'input-text')),
        $this->Form->button('List', array ('label' => false, 'type' => 'button', 'id' => 'FilterCustomerList', 'class' => 'button'))
    )
));
?>
    </table>
</fieldset>

<?= $this->Form->end(); ?>
<?=
$this->Html->tag('div', '', array ('id' => 'customerInfo')) . 
$this->Html->tag('div', '', array ('id' => 'uploadDialog')) . 
$this->Html->tag('div', '', array ('id' => 'detailsDialog'));
?>
<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'customerList')); ?>