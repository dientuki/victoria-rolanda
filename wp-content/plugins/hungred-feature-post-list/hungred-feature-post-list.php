<?php 
/*
Plugin Name: Hungred Feature Post List
Plugin URI: http://hungred.com/useful-information/wordpress-plugin-hungred-feature-post-list/
Description: This plugin is design for hungred.com and people who face the same problem! Please visit the plugin page for more information.
Author: Clay lua
Version: 2.0.3
Author URI: http://hungred.com
*/

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

require_once("hungred.php");
$hungredObj = new Hungred_Tools();
add_action('wp_dashboard_setup', array($hungredObj,'widget_setup'));	
/*
Structure of the plugin
*/
/*
Name: add_hfpl_to_admin_panel_actions
Usage: use to add an options on the Setting section of Wordpress
Parameter: 	NONE
Description: this method depend on hfpl_admin for the interface to be produce when the option is created
			 on the Setting section of Wordpress
*/

function add_hfpl_to_admin_panel_actions() {
    $plugin_page = add_options_page("Hungred Feature Post List", "Hungred Feature Post List", 10, "Hungred-Feature-Post-List", "hfpl_admin");  
	add_action( 'admin_head-'. $plugin_page, 'hfpl_admin_header' );

}
add_action('admin_menu', 'add_hfpl_to_admin_panel_actions');

/*
Name: hfpl_admin_header
Usage: stop hfpl admin page from caching
Parameter: 	NONE
Description: this method is to stop hfpl admin page from caching so that the preview is shown.
*/
function hfpl_admin_header()
{
nocache_headers();
}
/*
Name: hfpl_admin
Usage: provide the GUI of the admin page
Parameter: 	NONE
Description: this method depend on hfpl_admin_page.php to display all the relevant information on our admin page
*/
function hfpl_admin(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	 }
	global $hungredObj;
	$support_links = "";
	$plugin_links = array();
	$plugin_links["url"] = "http://hungred.com/useful-information/wordpress-plugin-hungred-feature-post-list/";
	$plugin_links["wordpress"] = "hungred-hungred-feature-post-list";
	$plugin_links["development"] = "https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=i_ah_yong%40hotmail%2ecom&lc=MY&item_name=Support%20Hungred%20Post%20Thumbnail%20Development&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest";
	$plugin_links["donation"] = "https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=i_ah_yong%40hotmail%2ecom&lc=MY&item_name=Coffee&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted";
	$plugin_links["pledge"] = "<a href='http://www.pledgie.com/campaigns/6187'><img alt='Click here to lend your support to: Hungred Wordpress Development and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/6187.png?skin_name=chrome' border='0' /></a>";
	$support_links = "http://wordpress.org/tags/hungred-hungred-feature-post-list";
	require_once('hfpl_admin_page.php'); 
	?>
	<div class="postbox-container" id="hungred_sidebar" style="width:20%;">
		<div class="metabox-holder">	
			<div class="meta-box-sortables">
				<?php
					$hungredObj->news(); 
					$hungredObj->plugin_like($plugin_links);
					$hungredObj->plugin_support($support_links);
				?>
			</div>
			<br/><br/><br/>
		</div>
	</div>
	<?php
	 
}
/*
Name: hfpl_post_option
Usage: add a container into Wordpress post section
Parameter: 	NONE
Description: this method adds a container to Wordpress post section for user to upload images for their thumbnail.
			 This method depends on hfpl_post_display for GUI.
*/
function hfpl_post_option()
{
	add_meta_box( "hfpl_box", "Hungred Feature Post List Options", "hfpl_post_display", 'post', "side", "low" );	
}
/*
Name: hfpl_post_option
Usage: include the file and print them out to the container provided by Wordpress on the post section
Parameter: 	NONE
Description: This method depends on hfpl_post_page.php for the code.
*/
function hfpl_post_display()
{
	require_once(WP_PLUGIN_DIR .'/hungred-feature-post-list/hfpl_post_page.php');
}
/*
Name: hfpl_loadcss
Usage: load the relevant CSS external files into Wordpress post section
Parameter: 	NONE
Description: uses wp_enqueue_style for safe printing of CSS style sheets
*/
function hfpl_loadcss()
{
	wp_enqueue_style('hfpl_ini',WP_PLUGIN_URL.'/hungred-feature-post-list/css/hfpl_ini.css');
}
/*
Name: hfpl_loadjs
Usage: load the relevant JavaScript external files into Wordpress post section
Parameter: 	NONE
Description: uses wp_enqueue_script for safe printing of JavaScript
*/
function hfpl_loadjs()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('hfpl_ini', WP_PLUGIN_URL.'/hungred-feature-post-list/js/hfpl_ini.js');
}
add_action('admin_print_scripts', 'hfpl_loadjs');
add_action('admin_print_styles', 'hfpl_loadcss');
add_action('admin_menu', 'hfpl_post_option');
function hfpl_id()
{
	echo "
	<!-- This site is power up by Hungred Feature Post List -->
	";
}
add_action('wp_head', 'hfpl_id');
/*
Name: hfpl_install
Usage: upload all the table required by this plugin upon activation for the first time
Parameter: 	NONE
Description: the structure of our Wordpress plugin
*/
function hfpl_install()
{
	global $wpdb;
	$table = $wpdb->prefix."hfpl_records";
	$structure = "DROP TABLE `".$table."`";
	$wpdb->query($structure);
	
	$table = $wpdb->prefix."hfpl_options";
	$structure = "DROP TABLE `".$table."`";
	$wpdb->query($structure);
	
    
	$table = $wpdb->prefix."hfpl_record";
	$structure = "CREATE TABLE `".$table."` (
		hfpl_post_id bigint(20) NOT NULL DEFAULT 0,
		hfpl_status VARCHAR(1) NOT NULL DEFAULT '0',
		hfpl_idx VARCHAR(254) NOT NULL,
		time TIMESTAMP NOT NULL,
		PRIMARY KEY (hfpl_post_id),
		INDEX(hfpl_idx)
	);";
    require_once ABSPATH . "wp-admin/includes/upgrade.php";
	$return = dbDelta($structure);
}
if ( function_exists('register_activation_hook') )
	register_activation_hook('hungred-feature-post-list/hungred-feature-post-list.php', 'hfpl_install');
	
/*
Name: hfpl_uninstall
Usage: delete hfpl table
Parameter: 	NONE
Description: the structure of our Wordpress plugin
*/
function hfpl_uninstall()
{
	global $wpdb;

	$table = $wpdb->prefix."hfpl_records";
	$structure = "DROP TABLE `".$table."`";
	$wpdb->query($structure);
	$table = $wpdb->prefix."hfpl_record";
	$structure = "DROP TABLE `".$table."`";
	$wpdb->query($structure);
	$table = $wpdb->prefix."hfpl_options";
	$structure = "DROP TABLE `".$table."`";
	$wpdb->query($structure);
}
if ( function_exists('register_uninstall_hook') )
    register_uninstall_hook(__FILE__, 'hfpl_uninstall');
	

	
function hfpl_post_delete()
{
	global $post;
	global $wpdb;
	$deletedID = $post->ID;
	$table = $wpdb->prefix."hfpl_records";
	$sqlquery = "DELETE FROM `".$table."`
				WHERE `hfpl_post_id` = '".$deletedID."'";
	$wpdb->query($sqlquery);	
}	
add_action('delete_post', 'hfpl_post_delete');


if (!class_exists("HFPL_WIDGET")) {
	class HFPL_WIDGET extends WP_Widget{
		function HFPL_WIDGET() {
			 parent::WP_Widget(false, $name = 'Hungred Feature Post List');
		}
		
		/** @see WP_Widget::widget */
		function widget($args, $instance) {	
			global $wpdb, $current_user;
			extract( $args );
			$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( '' ) : $instance['title']);
	        //$HFPL_type = empty( $instance['HFPL_NO'] ) ? '' : $instance['HFPL_NO'];
			$feature_number =  $instance['HFPL_NO'];
			$feature_type =  $instance['HFPL_TYPE'];
			$feature_idx =  $instance['HFPL_IDX'];
	$table = $wpdb->prefix."hfpl_record";
	$query = "SELECT * FROM `".$table."` WHERE 1 AND `hfpl_status` = 't' AND hfpl_idx = '".$feature_idx."'";
	$row = $wpdb->get_results($query);
	
	$feature_post = Array();
	if($feature_type == 'B' || $feature_type == 'S')
		foreach ($row as $post) {
			
			$feature_post[] = $post->hfpl_post_id;
			if(count($feature_post) >= $feature_number)
				break;
		}
		
	if($feature_type == 'B' || $feature_type == 'R')
	if(count($feature_post) < $feature_number)
	{
		$shortage = $feature_number- count($feature_post);
		$rand_posts = get_posts('numberposts='.$feature_number.'&orderby=rand');
		$i = 0;
		foreach( $rand_posts as $post ) :
			if(!in_array($post->ID, $feature_post))
				$feature_post[] = $post->ID;
			if($i > $shortage)
				break;
		endforeach;
	}
	

	extract($args); 
	echo $before_widget;
	echo $before_title.$title.$after_title;
	echo '<ul>';
	foreach($feature_post as $postid)
	{
		$post = get_post($postid, OBJECT);
		echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
	}
	echo '</ul>'. $after_widget;


		}

		/** @see WP_Widget::update */
		function update($new_instance, $old_instance) {				
			$instance = $old_instance;
	                $instance['title'] = strip_tags($new_instance['title']);
	                $instance['HFPL_NO'] = $new_instance['HFPL_NO'];
					$instance['HFPL_TYPE'] = $new_instance['HFPL_TYPE'];
					$instance['HFPL_IDX'] = $new_instance['HFPL_IDX'];
	                return $instance;
		}

		/** @see WP_Widget::form */
		function form($instance) {		
			$instance = wp_parse_args( (array) $instance, array( 'HFPL_NO' => '5','HFPL_NO' => 'B', 'title' => '', 'HFPL_CLASS', 'widget') );
			$title = esc_attr($instance['title']);
			?>
	                <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
					<p>
						<label for="<?php echo $this->get_field_id('HFPL_NO'); ?>"><?php _e( 'Post Numbers:' ); ?></label>
						<select name="<?php echo $this->get_field_name('HFPL_NO'); ?>" id="<?php echo $this->get_field_id('HFPL_NO'); ?>" class="widefat">
							<option value=''></option>
								<?php
									$loop = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
									foreach($loop as $value){
										echo '<option value="'.$value.'" '.selected( $instance['HFPL_NO'], $value ).'>'.$value.'</option>';
									}
								?>
						</select>
	                </p>
					<p>
						<label for="<?php echo $this->get_field_id('HFPL_TYPE'); ?>"><?php _e( 'Feature Type:' ); ?></label>
						<select name="<?php echo $this->get_field_name('HFPL_TYPE'); ?>" id="<?php echo $this->get_field_id('HFPL_TYPE'); ?>" class="widefat">
							<?php
								$loop = array('S'=>'Selected Only','R'=>'Random','B'=>'Both');

								while ($value = current($loop)) {

									echo '<option value="'.key($loop).'" '.selected( $instance['HFPL_TYPE'], key($loop) ).'>'.$value.'</option>';
									next($loop);
								}
							?>
						</SELECT>
					</p>
					<input type="hidden" style="display:none" name="<?php echo $this->get_field_name('HFPL_IDX'); ?>" value="<?php echo $this->get_field_name('HFPL_IDX');  ?>" />
	<?php
		}
	}
	add_action('widgets_init', create_function('', 'return register_widget("HFPL_WIDGET");'));
}
?>