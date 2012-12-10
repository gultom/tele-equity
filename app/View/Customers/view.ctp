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

<table>
<?=
$this->Html->tableCells (array (
    array (
        $this->Html->tag('button', $this->Html->image('icons/icon-_upload.png', array('align' => 'absmiddle')) . ' Upload', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['upload'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_distribute.png', array('align' => 'absmiddle')). ' Distribute', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['distribute'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_reassign.png', array('align' => 'absmiddle')). ' Reassign', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['reassign'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_recycle.png', array('align' => 'absmiddle')). ' Recycle', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['recycle'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_details.png', array('align' => 'absmiddle')). ' Details', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['details'])),
        $this->Html->tag('button', $this->Html->image('icons/icon-_search.png', array('align' => 'absmiddle')). ' Search', array ('class' => 'transButton', 'onclick' => 'alert("Enabled")', 'disabled' => $buttons['search']))
    )
));
?>
</table>

<div id="clear"></div>
<?= $this->Html->tag('div', '', array('id' => 'customerList')); ?>