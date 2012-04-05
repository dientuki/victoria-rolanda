<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}
$base_name = plugin_basename('day-twett/admin/list-twetts.php');
$base_page = 'admin.php?page='.$base_name;
$edit_name = plugin_basename('day-twett/admin/add-twetts.php');
$edit_page = 'admin.php?page='.$edit_name;
include_once dirname(dirname(__FILE__)) . '/class/twett.php';
$twett = new twett(false);
?>
<div class="wrap" id="setting">
	<div class="icon32"></div>
	<h2>Twetts</h2>
	
	
	<table class="widefat">
		<thead>
			<tr>
				<th width="70px">Day</th>
				<th>Twett</th>				
				<th width="100px" colspan="2" style="text-align: center;">Actions</th>
			</tr>
		</thead>
		<tbody id="manage_polls">
		<?php $i = 0;?>
		<?php $twetts = $twett->get_all_twetts();?>
		<?php if ($twetts != false): ?>
			<?php foreach ($twetts as $tw): ?>
				<tr <?php if($i%2 == 0) echo 'class="alternate"'; ?>>
					<td align="center"><?php echo $tw->date;?></td>
					<td>
						<img src="<?php echo $tw->picture;?>" />
						<?php echo $tw->text;?>
					</td>
					<td width="50px" align="center"><a href="<?php echo $edit_page ?>&amp;action=edit&amp;id=1" class="edit">Edit</a></td>
					<td width="50px" align="center"><a href="<?php echo $base_page ?>&amp;action=delete&amp;id=1" class="edit">Delete</a></td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="5" align="center"><strong>No twetts yet</strong></td>
			</tr>
		<?php endif; ?>
		</tbody>
  </table>

</div>