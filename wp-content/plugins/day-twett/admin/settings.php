<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}
$base_name = plugin_basename('day-twett');
$base_page = 'admin.php?page='.$base_name;
?>
<div class="wrap" id="setting">
	<div class="icon32"></div>
	<h2>Settings</h2>
	
	<table class="form-table">
		<tr>
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleartwett" class="button">Clear twetts</a></th>
			<td width="80%">Clear the olds twetts</td>
		</tr>
		<tr>
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleardatabase" class="button">Clear database</a></th>
			<td width="80%">Clear all the database</td>
		</tr>		
	</table>	

</div>