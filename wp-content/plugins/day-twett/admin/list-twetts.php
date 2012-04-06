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
$today = date('d/m/Y', time());

$is_deleted = false;
$is_deleting = false;

if ( (isset($_GET)) && (isset($_GET['action']))){
	if ($_GET['action'] == 'delete'){
		$is_deleting = true;
		$is_deleted = $twett->delete_twett($_GET['id']);
	}
}

?>
<div class="wrap" id="setting">
	<div class="icon32"></div>
	<h2>Twetts</h2>
	
	<?php if ($is_deleting == true): ?>
		<?php if ($is_deleted == true):?>
			<div class="updated fade"><p>Twett <strong>deleted</strong> sucefull</p></div>
		<?php else:?>
			<div class="error fade"><p>I <strong>can't</strong> delete the twett, try again</p></div>
		<?php endif; ?>
	<?php endif; ?>
	
	<table class="widefat" id="manage_twetts">
		<thead>
			<tr>
				<th width="70px">Day</th>
				<th>Twett</th>				
				<th width="100px" colspan="2" style="text-align: center;">Actions</th>
			</tr>
		</thead>
		<tbody >
		<?php $i = 0;?>
		<?php $twetts = $twett->get_all_twetts();?>
		<?php if ($twetts != false): ?>
			<?php foreach ($twetts as $tw): ?>
				<?php
					$class = '';
					if ($i%2 == 0) {
						$class = $class . 'alternate';
					}
					if ($today == $tw->date) {
						$class = $class . ' highlight';
					}
				?>
				<tr <?php if ($class!=''): ?>class="<?php echo $class; ?>"<?php endif; ?>>
					<td align="center"><?php echo $tw->date;?></td>
					<td>
						<img src="<?php echo $tw->picture;?>" width="48" height="48" alt="<?php echo $tw->user;?>" />
						<div><?php echo $tw->user;?></div>
						<?php echo $twett->sanitize_tweet($tw->text);?>
					</td>
					<td width="50px" align="center" valign="middle"><a href="<?php echo $edit_page ?>&amp;action=edit&amp;id=<?php echo $tw->id;?>" class="edit">Edit</a></td>
					<td width="50px" align="center" valign="middle"><a href="<?php echo $base_page ?>&amp;action=delete&amp;id=<?php echo $tw->id;?>" class="edit">Delete</a></td>
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