<?php 
add_action( 'after_setup_theme', 'victoriarolanda_setup' );

if ( ! function_exists( 'victoriarolanda_setup' ) ) {
  
  function victoriarolanda_setup() {	
    
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();
    
    // This theme uses post thumbnails
    add_theme_support( 'post-thumbnails' );   
    
    add_theme_support( 'menus' );
    
  	// This theme uses wp_nav_menu().
		if (function_exists('register_nav_menus')) {
			register_nav_menus( array(
				'header' => 'Header Navigation',
				'footer' => 'Footer Navigation'
			) );	
		}
		
		if (function_exists('add_image_size')){
			add_image_size('featured_carousel', '660', '290', true);
			add_image_size('footer_carousel', '450', '253', true);
		}		
		
		add_custom_image_header( '', 'victoriarolanda_admin_header_style' );
		
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(
        'before_widget' => '<section id="%1$s" class="block %2$s">',
        'after_widget' => '</section>'
    ));		
		}
		
  }
  
}

function victoriarolanda_admin_header_style() {}

add_filter('next_posts_link_attributes', 'get_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'get_previous_posts_link_attributes');

if (!function_exists('get_next_posts_link_attributes')){
	function get_next_posts_link_attributes($attr){
		$attr = 'rel="next"';
		return $attr;
	}
}
if (!function_exists('get_previous_posts_link_attributes')){
	function get_previous_posts_link_attributes($attr){
		$attr = 'rel="prev"';
		return $attr;
	}
}

function is_new($id) {
	$post_time = get_the_time('U', $id);
	$now = time();
	$diff = $now - $post_time;
	if (date('d', $diff) <= 7 ) {
		return 'has-new';
	}
}