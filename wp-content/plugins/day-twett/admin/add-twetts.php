<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}

function twett_time($twett_time = FALSE, $fieldname = 'date') {
	global $month;
	if ($twett_time == false) { $twett_time = time(); }
	
	echo '<div id="'.$fieldname.'" style="display:block">'."\n";
	$day = gmdate('j', $twett_time);
	echo '<select name="'.$fieldname.'_day" size="1">'."\n";
	for($i = 1; $i <=31; $i++) {
		if ($i < 10) {
			$ii = '0'.$i;
		} else {
			$ii = $i;
		}		
		if($day == $i) {
			echo "<option value=\"$ii\" selected=\"selected\">$i</option>\n";
		} else {
			echo "<option value=\"$ii\">$i</option>\n";
		}
	}
	echo '</select>&nbsp;&nbsp;'."\n";
	
	$month2 = gmdate('n', $twett_time);
	echo '<select name="'.$fieldname.'_month" size="1">'."\n";
	for($i = 1; $i <= 12; $i++) {
		if ($i < 10) {
			$ii = '0'.$i;
		} else {
			$ii = $i;
		}
		if($month2 == $i) {
			echo "<option value=\"$ii\" selected=\"selected\">$month[$ii]</option>\n";
		} else {
			echo "<option value=\"$ii\">$month[$ii]</option>\n";
		}
	}
	echo '</select>&nbsp;&nbsp;'."\n";
	
	$year = gmdate('Y', $twett_time);
	echo '<select name="'.$fieldname.'_year" size="1">'."\n";
	for($i = 2000; $i <= ($year+10); $i++) {
		if($year == $i) {
			echo "<option value=\"$i\" selected=\"selected\">$i</option>\n";
		} else {
			echo "<option value=\"$i\">$i</option>\n";
		}
	}
	echo '</select>'."\n";
	
	echo '</div>'."\n";
}

function validate_url($url){
	return preg_match("/^(http|https):\/\/twitter\.com\/(?:#!\/)?(\w+)\/status(es)?\/(\d+)$/", $url);
}

$base_name = plugin_basename('day-twett/admin/add-twetts.php');
$base_page = 'admin.php?page='.$base_name;
$list_name = plugin_basename('day-twett/admin/list-twetts.php');
$list_page = 'admin.php?page='.$list_name;
include_once dirname(dirname(__FILE__)) . '/class/twett.php';
$twett = new twett(false);

$action = 'add';
if ( (isset($_GET)) && (isset($_GET['action']))){
	
	if ($_GET['action'] == 'edit') {
		$action = 'edit';
		$tw = $twett->get_twett($_GET['id']);
	}
}

if (  (isset($_POST)) && (count($_POST) > 0) ) {
	
	$action_status = false;
	
	if (isset($_POST['id'])){
		//edit
		$values = array();
		$values['url'] = $_POST['url'];
		$values['date_show'] = $_POST['date_year'] . '-' . $_POST['date_month'] . '-' . $_POST['date_day'];
		if ( (validate_url($values['url']) == true) && ( checkdate($_POST['date_month'],$_POST['date_day'],$_POST['date_year']) == true)){
			$action_status = $twett->edit_twett($_POST['id'], $values);
		}		
	} else {
		//add
		$values = array();
		$values['url'] = $_POST['url'];
		$values['date_show'] = $_POST['date_year'] . '-' . $_POST['date_month'] . '-' . $_POST['date_day'];
		if ( (validate_url($values['url']) == true) && ( checkdate($_POST['date_month'],$_POST['date_day'],$_POST['date_year']) == true) ){
			$action_status = $twett->add_twett($values);
		} 
		
	}
	
} 




?>
<form method="post" action="<?php $_SERVER[PHP_SELF]?>" >
	<div class="wrap">
		<div class="icon32"></div>
		<h2><?php echo $action == 'add'? 'Add':'Edit'; ?> twett</h2>
	
		<?php if (  (isset($_POST)) && (count($_POST) > 0) ) :?>

			<?php if (isset($_POST['id'])): ?>
				<?php if ($action_status == true):?>
					<div class="updated fade"><p>Twett <strong>edited</strong> sucefull</p></div>
				<?php else:?>
					<div class="error fade"><p>I <strong>can't</strong> edit the twett, check the values</p></div>
				<?php endif; ?>	
			
			<?php else : ?>						
							
				<?php if ($action_status == true):?>
					<div class="updated fade"><p>Twett <strong>added</strong> sucefull</p></div>
				<?php else:?>
					<div class="error fade"><p>I <strong>can't</strong> add the twett, check the values</p></div>
				<?php endif; ?>
			<?php endif; ?>								
		<?php endif; ?>							

		<?php if ($action == 'edit'):?>
			<input type="hidden" value="<?php echo $_GET['id']?>" name="id" />
		<?php endif; ?>
		<table class="form-table">
			<tr>
				<th width="20%" scope="row" valign="top">Twett url:</th>
				<td width="80%">
					<?php if ($action == 'edit'): ?>
						<input type="text" size="70" value="<?php echo $tw->url; ?>" name="url" />
					<?php else: ?>
						<input type="text" size="70" value="" name="url" />
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th width="20%" scope="row" valign="top">Day:</th>
				<?php
				  $tt = false; 
					if ($action == 'edit') {
					  $date = explode('/', $tw->date);
					  $tt = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
					}	
				?>
				<td width="80%"><?php twett_time($tt); ?></td>
			</tr>		
		</table>	
		<p style="text-align: center;">
		  <input type="submit" value="<?php echo $action == 'add'? 'Add':'Edit'; ?>" class="button-primary" /> &nbsp; <a href="<?php echo $list_page ?>" class="button">Cancel</a>
		</p>
		
	</div>
</form>