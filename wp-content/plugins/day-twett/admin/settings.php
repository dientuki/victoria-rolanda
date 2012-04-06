<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}

$base_name = plugin_basename('day-twett/admin/settings.php');
$base_page = 'admin.php?page='.$base_name;
include_once dirname(dirname(__FILE__)) . '/class/twett.php';

$is_clear = null;
$is_clean = null;
$is_action = false;


if ( (isset($_GET)) && (isset($_GET['action']))){
	$is_action = true;
	
	$twett = new twett(false);	
	
	switch ($_GET['action']){
		case 'cleartwett':
			$is_clear = $twett->clear_twetts();
			break;
		case 'cleardatabase':
			$is_clean = $twett->clean_table();
			break;
		default:
			$is_action = false;
	}

}

?>
<div class="wrap tool-box" id="setting">
	<div class="icon32"></div>
	<h2>Settings</h2>
	
	<?php if ($is_action == true): ?>
		<?php if ($is_clear != null):?>
			<?php if ($is_clear == true): ?>
				<div class="updated fade"><p>Twetts <strong>cleared</strong> sucefull</p></div>
			<?php else:?>
				<div class="error fade"><p>I <strong>can't</strong> clear the twetts, try again</p></div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($is_clean != null):?>
			<?php if ($is_clean == true): ?>
				<div class="updated fade"><p>Database <strong>cleaned</strong> sucefull</p></div>
			<?php else:?>
				<div class="error fade"><p>I <strong>can't</strong> clean the database, try again</p></div>
			<?php endif; ?>
		<?php endif; ?>		
	<?php endif; ?>	
	
	<h3 class="title">Tools for speed up the plugin</h3>
	
	<table class="form-table">
		<tr>
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleartwett" class="button">Clear twetts</a></th>
			<td width="80%">Clear the olds twetts</td>
		</tr>
		<tr>
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleardatabase" class="button">Clear database</a></th>
			<td width="80%">Clean all the database</td>
		</tr>		
	</table>	

</div>