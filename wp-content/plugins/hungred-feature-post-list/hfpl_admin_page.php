<?php
/*  Copyright 2009  Clay Lua  (email : clay@hungred.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<div class="hfpl_wrap">
	<div class="wrap">
	<?php    echo "<h2>" . __( 'Hungred Feature Post List Configuration' ) . "</h2>"; ?>
	</div>
	<form name="hfpl_form" id="hfpl_form" class="hfpl_admin" onsubmit="return validate()" enctype="multipart/form-data" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<div class="postbox-container" id="hfpl_admin">
		<div class="metabox-holder">		
			<div class="meta-box-sortables ui-sortable" >
				<?php
					$option = (get_option('widget_hfpl_widget'));
					$nothing = true;
					foreach($option as $key){
						
						if($key['HFPL_IDX'] == "")
							continue;
						else
							$nothing = false;
					
				?>
				<div class=''>		
					<?php    echo "<h3  class='hndle'>" . __( 'Selected Feature Post' ) . " - ".$key['title'] . "</h3>"; ?>
					<table class="widefat post fixed" cellspacing="0">
						<thead>
						<tr>
					<?php print_column_headers('edit'); ?>
						</tr>
						</thead>

						<tfoot>
						<tr>
					<?php print_column_headers('edit', false); ?>
						</tr>
						</tfoot>

						<tbody>
					<?php 
					global $wpdb;
					$table = $wpdb->prefix."hfpl_record";
					$query = "SELECT * FROM `".$table."` WHERE 1 AND `hfpl_status` = 't' AND `hfpl_idx` = '".$key['HFPL_IDX']."'";
					$row = $wpdb->get_results($query);
					foreach ($row as $post) {
						$detail = get_post($post->hfpl_post_id, OBJECT);
						_post_row($detail, $comment_pending_count[$post->hfpl_post_id], $mode);
					}

					?>
						</tbody>
					</table>
				</div>
				<?php
					}
					if($nothing){
				?>
					<div class='postbox'>	
						<?php    echo "<h3  class='hndle'>" . __( 'Feature Error Section' ) . "</h3>"; ?>
						<div class='inside size'>
							<p><div class='label'>
							</div>
							<div class="hfpl_red">
							<?php echo __("No feature post widget is being used. Please use at least one widget before accessing this place."); ?>
							</div>
							</p>
						</div>
					</div>
				<?php
					}
				?>

				
					<?php if($error != ""){?>
					<div class='postbox'>	
						<?php    echo "<h3  class='hndle'>" . __( 'Feature Error Section' ) . "</h3>"; ?>
						<div class='inside size'>
							<p><div class='label'>
							<?php _e("Error Message: " ); ?>
							</div>
							<div class="hfpl_red">
							<?php echo __($error); ?>
							</div>
							</p>
						</div>
					</div>
					<?php }?>
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
/*
Name: validate
Usage: use to validate the form upon user submission
Parameter: 	NONE
Description: use to validate all the basic inputs by the users
*/
function validate()
{
	var number = document.getElementById('hfpl_no_post');
	var height = document.getElementById('hfpl_height');

	if(isNumeric(number, "Invalid number found in feature number"))
	{
		return true;
	}
						
					
	return false;
	
}
/*
Name: isNumeric
Usage: use to validate width, height, space and gap text box
Parameter: 	elem: the DOM object of each element
			helperMsg: the pop out box message
Description: This is a simple method to check whether a given text box string contains 
			 numbers and '.' symbols
*/
function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9.]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
</script>
