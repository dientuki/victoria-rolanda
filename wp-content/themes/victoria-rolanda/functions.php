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
			add_image_size('footer_carousel', '450', '253', true);
		}		
		
		add_custom_image_header( '', 'victoriarolanda_admin_header_style' );
 
  }
  
}

function victoriarolanda_admin_header_style() {}