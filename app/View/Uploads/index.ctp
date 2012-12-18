<?php
 echo $this->Form->create('Upload',array('type' => 'file','action'=>'import'));
 
?>
<?php echo $this->Form->input('file',array('type'=>'file'));?>
<button type="submit" class="btn btn-primary">Import</button>