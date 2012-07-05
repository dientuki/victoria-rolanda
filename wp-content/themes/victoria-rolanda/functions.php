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


add_filter('comment_form_default_fields', 'comments_fields');
function comments_fields($fields) {
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
		
	$fields['author'] = '<div class="item clearfix"><label for="author">Nombre:</label><input id="author" class="field" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '<span class="required">*</span>' : '' ) . '</div>';	
	$fields['email'] = '<div class="item clearfix"><label for="email">Email:</label><input id="email" class="field" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '<span class="required">*</span>' : '' ) . '</div>';
	$fields['url'] = '';
	return $fields;
}

function get_data_page(){
	if (is_single() || is_page()) {
		return 'news';
	}
	
	if ( (is_home() == false) || ($paged >= 1) ) {
		return false;
	}
	
	if (is_home() || is_front_page()){
		return 'home';
	}
}

function get_logged(){
	
	if (is_user_logged_in() == false){
		return false;
	}
	
	global $userdata;
	get_currentuserinfo();
	//die(print_r($userdata));
	
	$html  = ' <div id="wp-user" class="social-conect">';
	$html .= get_avatar( $userdata->user_email, 48 );
	$html .= '<div class="user-info">';
	$html .= '<span clas="user">'.$userdata->user_nicename .'</span> &middot; <a class="logout" href="' . admin_url( 'profile.php' ) . '" title="Administrador">Ver panel</a> &middot; <a class="logout" href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) . '">Salir</a>';
	$html .= '</div></div>';
	
	//$html .= get_avatar( $userdata->ID, 48 ); 
	
	
	return $html;
	//'<p class="logged-in-as">' . $user_identity . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
}
