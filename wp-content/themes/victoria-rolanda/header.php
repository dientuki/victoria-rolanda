<!doctype html>
<!--[if lt IE 7]> <html class="no-js oldie ie6" lang="es" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js oldie ie7" lang="es" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js oldie ie8" lang="es" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="es" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="es" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width,initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		$title = wp_title( '|', false, 'right' );
	
		// Add the blog name.
		$title = $title . get_bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = $title . " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title = $title . ' | ' . sprintf( 'Página %s', max( $paged, $page ) );
	
		?>	
	<title><?php echo $title; ?></title>
	
	<meta property="og:title" content="<?php echo $title; ?>" />
	
	<?php if (is_single() || is_page()): ?>
	<meta property="og:type" content="article" />
	<meta property="og:description" content="<?php the_excerpt_rss(); ?>" />
	<meta property="description" content="<?php the_excerpt_rss(); ?>" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<?php else: ?>
	<meta property="og:type" content="website" />
	<meta property="og:description" content="<?php bloginfo( 'description'); ?>" />
	<meta property="description" content="<?php bloginfo( 'description'); ?>" />
	<meta property="og:url" content="http://<?php echo $_SERVER["SERVER_NAME"] .$_SERVER["REQUEST_URI"] ?>" />
	<?php endif;?>
	
	<meta property="og:image" content="<?php bloginfo( 'template_url' ); ?>/images/logo.png" />
	<meta property="og:site_name" content="Victoria Rolanda" />
	<meta property="og:region" content="Buenos Aires" />
	<meta property="og:country-name" content="Argentina"/>
		
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/fonts.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/carousel.css" />
	<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/responsive.css" /> -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/wp-polls.css" />
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie-min.css" />
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script src="<?php bloginfo( 'template_url' ); ?>/js/libs/modernizr.js"></script>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="home">
	<section id="header-box" class="wrapper">
		<ul class="follow-us clearfix">
			<li class="title">Seguinos:</li>
			<li><a class="item fb" href="http://www.facebook.com/RevistaVictoriaRolanda" target="_blank" title="Seguinos en Facebook">facebook</a></li>
			<li><a class="item tw" href="http://www.twitter.com/VictoriaRolanda" target="_blank" title="Seguinos en Twitter">twitter</a></li>
			<li><a class="item pi" href="http://pinterest.com/victoriarolanda" target="_blank" title="Seguinos en Pinterest">pinterest</a></li>
			<li><a class="item rss" href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="Suscribirse a este sitio usando RSS">rss</a></li>
		</ul>
		<div class="fb-like" data-send="false" data-width="580" data-show-faces="false" data-action="recommend" data-href="http://victoriarolanda.com.ar"></div>
		<?php get_search_form(); ?>
	</section>
	<header id="header" class="wrapper">
		<?php if ( get_header_image() ):?>
			<img class="header-image" src="<?php header_image(); ?>" width="990" height="190" alt="<?php bloginfo( 'name' ); ?>" />
		<?php else: ?>
		  <img class="header-image" src="<?php echo bloginfo( 'template_url' ) . '/images/header-vr.jpg' ?>" width="990" height="190" alt="<?php bloginfo( 'name' ); ?>" />
		<?php endif; ?>
		<a id="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<div class="tagline hidden"><?php bloginfo( 'description' ); ?></div>
		<?php wp_nav_menu( array( 'theme_location' => 'header',
		                          'container' => 'nav', 'container_id' => 'header-menu', 'container_class' => '',
		                          'menu_class' => 'menu') ); ?>
	</header>
	