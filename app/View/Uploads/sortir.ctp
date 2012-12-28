<?php
$this->Html->script(array(
    'lib/datatables/script',
    'app/UserGroup.js',
), false);

$this->Html->css(array (
    'lib/datatables/style'
), null, array (
    'inline' => false
));

$this->Html->scriptBlock(
    '
jQuery(document).ready(function($) {
    UserGroup = new UserGroup();
    Functions.initDialog("groupsDialog", "Group Lists", 500, 400);
    Functions.initDialog("addUserDialog", "Add User", 550, 380);
    Functions.initDialog("editUserDialog", "User Details", 550, 380);
    Functions.initConfirmationDialog("deleteUserDialog", "Delete Confirmation", 300, 150, function() {
        User.del();
        jQuery("#deleteUserDialog").dialog("close");
    });
    Uploads.sortir();
});
    ', array('inline' => FALSE));
?>
<style>
table{
width: 1280px !important;
}
th {
background-color: green;
color: #fff;
}
#userList{
width:100%;
overflow:scroll;
}
</style>
<div id="userList">
<table id="usersDatatable" class="display">
<thead>
<tr>
	<th> No </th>
    <th width="10%"> Name </th>
    <th> Birth Date </th>
    <th> Home Address 1 </th>
    <th> Home Address 2 </th>
    <th> Home Address 3 </th>
    <th> Home Address 4 </th>
    <th> Home City </th>
    <th> Home Zipcode </th>
    <th> Home Phone 1 </th>
    <th> Home Phone 2 </th>
    <th> Handphone 1 </th>
    <th> Handphone 2 </th>
    <th> Company Name </th>
    <th> Office Address 1 </th>
    <th> Office Address 2 </th>
    <th> Office City </th>
    <th> Office Zipcode </th>
    <th> Office Phone 1 </th>
    <th> Office Phone 2 </th>
</tr>            
</thead>

<?php $i=1; foreach($clean as $l): 
if ($l['Uploads']['status']=='duplicates'){ $color='#f900';}?>
<tr style="color:<?php if ($l['Uploads']['status']=='duplicates'){ echo 'red';} else { echo '#000';}?>;">
	<td><?php echo $i;?></td>
    <td><?php echo $l['Uploads']['name'];?></td>
    <td><?php echo $l['Uploads']['birth_date'];?> </td>
    <td><?php echo $l['Uploads']['home_addr1'];?> </td>
    <td><?php echo $l['Uploads']['home_addr2'];?> </td> 
    <td><?php echo $l['Uploads']['home_addr3'];?> </td>
    <td><?php echo $l['Uploads']['home_addr4'];?> </td>
    <td><?php echo $l['Uploads']['home_city'];?> </td>
    <td><?php echo $l['Uploads']['home_zip'];?> </td>
    <td><?php echo $l['Uploads']['homephone1'];?> </td>
    <td><?php echo $l['Uploads']['homephone2'];?> </td>
    <td><?php echo $l['Uploads']['handphone1'];?> </td>
    <td><?php echo $l['Uploads']['handphone2'];?> </td>
    <td><?php echo $l['Uploads']['company'];?> </td>
    <td><?php echo $l['Uploads']['office_addr1'];?> </td>
    <td><?php echo $l['Uploads']['office_addr2'];?> </td>
    <td><?php echo $l['Uploads']['office_city'];?> </td>
    <td><?php echo $l['Uploads']['office_zip'];?> </td>
    <td><?php echo $l['Uploads']['officephone1'];?> </td>
    <td><?php echo $l['Uploads']['officephone2'];?> </td>
    
    <?php $i++;?>
</tr>
<?php endforeach; unset($l);?>
</table>

Notes :
Red = Duplicates
<?php
 echo $this->Form->create('Upload',array('action'=>'save'));
?>
Champaign
<select name="champaign">
<option value="1">1</option>
<option value="2">2</option>
</select>
<input type="submit" value="submit"/>
</form>
</div>
