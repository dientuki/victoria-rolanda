<?php 
if(!current_user_can('manage_polls')) {
	die('Access Denied');
}
$base_name = plugin_basename('day-twett/admin/add-twetts.php');
$base_page = 'admin.php?page='.$base_name;
$list_name = plugin_basename('day-twett/admin/list-twetts.php');
$list_page = 'admin.php?page='.$list_name;

function twett_time($twett_time = FALSE, $fieldname = 'date') {
	global $month;
	if ($twett_time == false) { $twett_time = time(); }
	
	echo '<div id="'.$fieldname.'" style="display:block">'."\n";
	$day = gmdate('j', $twett_time);
	echo '<select name="'.$fieldname.'_day" size="1">'."\n";
	for($i = 1; $i <=31; $i++) {
		if($day == $i) {
			echo "<option value=\"$i\" selected=\"selected\">$i</option>\n";
		} else {
			echo "<option value=\"$i\">$i</option>\n";
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
			echo "<option value=\"$i\" selected=\"selected\">$month[$ii]</option>\n";
		} else {
			echo "<option value=\"$i\">$month[$ii]</option>\n";
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
?>
<div class="wrap" id="setting">
	<div class="icon32"></div>
	<h2>Add twett</h2>

	<table class="form-table">
		<tr>
			<th width="20%" scope="row" valign="top">Twett</th>
			<td width="80%"><input type="text" size="70" value="" /></td>
		</tr>
		<tr>
			<th width="20%" scope="row" valign="top">Day</th>
			<td width="80%"><?php twett_time(); ?></td>
		</tr>		
	</table>	
	<p style="text-align: center;">
	  <input type="submit" value="Add"  class="button-primary" /> &nbsp; <a href="<?php echo $list_page ?>" class="button">Cancel</a>
	</p>
</div>