<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}

$base_name = plugin_basename('day-tweet/admin/settings.php');
$base_page = 'admin.php?page='.$base_name;

include_once dirname(dirname(__FILE__)) . '/class/common.php';
include_once dirname(dirname(__FILE__)) . '/class/backend.php';

$is_clear = null;
$is_clean = null;
$is_action = false;


if ( (isset($_GET)) && (isset($_GET['action']))){
	$is_action = true;
	
	$tweet = new dt_backend();	
	
	switch ($_GET['action']){
		case 'cleartweet':
			$is_clear = $tweet->clear_tweets();
			break;
		case 'cleardatabase':
			$is_clean = $tweet->clean_table();
			break;
		default:
			$is_action = false;
	}

}

?>
<div class="wrap tool-box">
	<div class="icon32"></div>
	<h2>Settings</h2>
	
	<?php if ($is_action == true): ?>
		<?php if ($is_clear != null):?>
			<?php if ($is_clear == true): ?>
				<div class="updated fade"><p>Twetts <strong>cleared</strong> sucefull</p></div>
			<?php else:?>
				<div class="error fade"><p>I <strong>can't</strong> clear the tweets, try again</p></div>
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
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleartweet" class="button">Clear tweets</a></th>
			<td width="80%">Clear the olds tweets</td>
		</tr>
		<tr>
			<th width="20%" scope="row" valign="top"><a href="<?php echo $base_page ?>&amp;action=cleardatabase" class="button">Clear database</a></th>
			<td width="80%">Clean all the database</td>
		</tr>		
	</table>	

</div>