<!doctype html>
<!--[if lt IE 7]> <html class="no-js oldie ie6" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js oldie ie7" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js oldie ie8" lang="es"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/carousel.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-page="home">
	<div id="header-975x75" class="banner" role="banner"></div>
	<header id="header" class="wrapper <?php if (get_header_image() == false ):?>default<?php endif;?>">
		<?php if ( get_header_image() ):?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		<?php endif; ?>
		<a id="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<div class="tagline hidden"><?php bloginfo( 'description' ); ?></div>
		<?php wp_nav_menu( array( 'theme_location' => 'header',
		                          'container' => 'nav', 'container_id' => 'header-menu', 'container_class' => '',
		                          'menu_class' => 'menu') ); ?>
	</header>
	