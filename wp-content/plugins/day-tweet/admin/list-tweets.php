<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}

$base_name = plugin_basename('day-tweet/admin/list-tweets.php');
$base_page = 'admin.php?page='.$base_name;
$edit_name = plugin_basename('day-tweet/admin/add-tweets.php');
$edit_page = 'admin.php?page='.$edit_name;

include_once dirname(dirname(__FILE__)) . '/class/common.php';
include_once dirname(dirname(__FILE__)) . '/class/backend.php';

$tweet = new dt_backend();
$today = date('d/m/Y', time());

$is_deleted = false;
$is_deleting = false;

if ( (isset($_GET)) && (isset($_GET['action']))){
	if ($_GET['action'] == 'delete'){
		$is_deleting = true;
		$is_deleted = $tweet->delete_tweet($_GET['id']);
	}
}

?>
<div class="wrap">
	<div class="icon32"></div>
	<h2>Twetts</h2>
	
	<?php if ($is_deleting == true): ?>
		<?php if ($is_deleted == true):?>
			<div class="updated fade"><p>Twett <strong>deleted</strong> sucefull</p></div>
		<?php else:?>
			<div class="error fade"><p>I <strong>can't</strong> delete the tweet, try again</p></div>
		<?php endif; ?>
	<?php endif; ?>
	
	<table class="widefat" id="manage_tweets">
		<thead>
			<tr>
				<th width="70px">Day</th>
				<th>Twett</th>				
				<th width="100px" colspan="3" style="text-align: center;">Actions</th>
			</tr>
		</thead>
		<tbody >
		<?php $i = 0;?>
		<?php $tweets = $tweet->get_all_tweets();?>
		<?php if ($tweets != false): ?>
			<?php foreach ($tweets as $tw): ?>
				<?php
					$class = '';
					if ($i%2 == 0) {
						$class = $class . 'alternate';
					}
					if ($today == $tw->date) {
						$class = $class . ' highlight';
					}
					if ($tw->has_tweet == false) {
						$class='error';
					}
				?>
				<tr <?php if ($class!=''): ?>class="<?php echo $class; ?>"<?php endif; ?>>
					<td align="center"><?php echo $tw->date;?></td>
					<td class="content">
						<img src="<?php echo $tw->picture;?>" width="48" height="48" alt="<?php echo $tw->user;?>" />
						<div><?php echo $tw->user;?></div>
						<?php echo $tweet->sanitize_tweet($tw->text);?>
					</td>
					<td width="50px" align="center" valign="middle"><a href="<?php echo $edit_page ?>&amp;action=edit&amp;id=<?php echo $tw->id;?>" class="edit">Edit</a></td>
					<td width="50px" align="center" valign="middle"><a href="<?php echo $base_page ?>&amp;action=delete&amp;id=<?php echo $tw->id;?>" class="edit">Delete</a></td>
					<td width="50px" align="center" valign="middle"><a href="<?php echo $base_page ?>&amp;action=check&amp;id=<?php echo $tw->id;?>" class="edit">Check</a></td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="5" align="center"><strong>No tweets yet</strong></td>
			</tr>
		<?php endif; ?>
		</tbody>
  </table>

</div>