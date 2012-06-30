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
			//add_image_size('featured_carousel', '660', '290', true);
			add_image_size('footer_carousel', '450', '253', true);
			add_image_size('related', '160', '90', true);
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

function victoriarolanda_admin_header_style() {
	define( 'HEADER_TEXTCOLOR', '' );
	define( 'HEADER_IMAGE', bloginfo( 'template_url' ) . '/images/header-vr.jpg' );
	define( 'HEADER_IMAGE_WIDTH', 990 );
	define( 'HEADER_IMAGE_HEIGHT', 190 );	
}

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
	$day = (60*60*24)*7;
	if ($diff <= $day ) {
		return true;
	}
	
	return false;
}

/*
function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

	return 'hace ' . human_time_diff($d('U'), current_time('timestamp'));

}
*/

function time_ago( $type = 'post' ) {
	$period         = array("segundo", "minuto", "hora", "día", "semana", "mes", "año", "decada");
	$periods         = array("segundos", "minutos", "horas", "dias", "semanas", "meses", "años", "decadas");
	$lengths         = array("60","60","24","7","4.35","12","10");

	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	
	$now = time();
	$date = $d('U');

	// is it future date or past date
	if($now > $date) {
		$difference     = $now - $date;
		//$tense         = "ago";
		 
	} else {
		$difference     = $date - $now;
		//$tense         = "from now";
	}
	 
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	 
	$difference = round($difference);
	 
	if($difference != 1) {
		$pe = $periods[$j];
	} else {
		$pe = $period[$j];
	}
	 
	return "hace $difference $pe";
}
