<?php
/*
Plugin Name: Day Twett
Plugin URI: 
Description: 
Author: 
Author URI: 
Version: 0.10
*/

/**
 * Activate functions
 * 
 * @return void
 */
function daytwett_activate(){
	include_once dirname(__FILE__) . '/class/daytwettInstall.php';
	$install = new daytwettInstall();
	$install->activate();
	unset($install);
}

/**
 * Deactivate funcionts
 * 
 * @return void
 */
function daytwett_deactivate(){
	include_once dirname(__FILE__) . '/class/daytwettInstall.php';
	$install = new daytwettInstall();
	$install->deactivate();
	unset($install);
}

/**
 * Add the main menu
 * @return void
 */
function daytwett_menu() {
	
	if (function_exists('add_menu_page')) {
		add_menu_page('Day Twett', 'Day Twett', 'manage_day_twetts', 'day-twett/admin/list-twetts.php', '', plugin_dir_url(__FILE__) . 'icon-16.png');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('day-twett/admin/list-twetts.php', 'List Tweet', 'List Tweet', 'manage_day_twetts', 'day-twett/admin/list-twetts.php');
		add_submenu_page('day-twett/admin/list-twetts.php', 'Add Tweet', 'Add Tweet', 'manage_day_twetts', 'day-twett/admin/add-twetts.php');
		add_submenu_page('day-twett/admin/list-twetts.php', 'Settings', 'Settings', 'manage_day_twetts', 'day-twett/admin/settings.php');
	}	
}

/**
 * Do all the magic
 */
if (is_admin()) {
	add_action('admin_menu', 'daytwett_menu');
	wp_enqueue_style( 'daytwett', plugin_dir_url(__FILE__).'admin/admin.css', null, null);

}

/**
 * call banner.html and include it
 * 
 * @return void
 */
function get_twett(){
	include_once dirname(__FILE__) . '/class/twett.php';
	return new twett();
}

register_activation_hook(__FILE__ , 'daytwett_activate' );
register_deactivation_hook(__FILE__, 'daytwett_deactivate');