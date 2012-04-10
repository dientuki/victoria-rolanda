<?php
/*
Plugin Name: Day Twett
Plugin URI: www.mateclass.com/resources/daytweet
Description:  Permite poner en tu web tweets programados
Author: Juan Farias
Author URI: www.mateclass.com
Version: 0.5
*/

/**
 * Activate functions
 * 
 * @return void
 */
function daytweet_activate(){
	include_once dirname(__FILE__) . '/class/common.php';
	include_once dirname(__FILE__) . '/class/daytweetInstall.php';
	$install = new daytweetInstall();
	$install->activate();
	unset($install);
}

/**
 * Deactivate funcionts
 * 
 * @return void
 */
function daytweet_deactivate(){
	include_once dirname(__FILE__) . '/class/common.php';
	include_once dirname(__FILE__) . '/class/daytweetInstall.php';
	$install = new daytweetInstall();
	$install->deactivate();
	unset($install);
}

/**
 * Add the main menu
 * @return void
 */
function daytweet_menu() {
	
	if (function_exists('add_menu_page')) {
		add_menu_page('Day Twett', 'Day Twett', 'manage_day_tweets', 'day-tweet/admin/list-tweets.php', '', plugin_dir_url(__FILE__) . 'icon-16.png');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('day-tweet/admin/list-tweets.php', 'List Tweet', 'List Tweet', 'manage_day_tweets', 'day-tweet/admin/list-tweets.php');
		add_submenu_page('day-tweet/admin/list-tweets.php', 'Add Tweet', 'Add Tweet', 'manage_day_tweets', 'day-tweet/admin/add-tweets.php');
		add_submenu_page('day-tweet/admin/list-tweets.php', 'Settings', 'Settings', 'manage_day_tweets', 'day-tweet/admin/settings.php');
	}	
}

/**
 * Do all the magic
 */
if (is_admin()) {
	add_action('admin_menu', 'daytweet_menu');
	wp_enqueue_style( 'daytweet', plugin_dir_url(__FILE__).'admin/admin.css', null, null);
}

/**
 * call banner.html and include it
 * 
 * @return void
 */
function get_tweet(){
	include_once dirname(__FILE__) . '/class/common.php';
	include_once dirname(__FILE__) . '/class/tweet.php';
	return new dt_tweet();
}

register_activation_hook(__FILE__ , 'daytweet_activate' );
register_deactivation_hook(__FILE__, 'daytweet_deactivate');