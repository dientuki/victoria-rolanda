<?php global $wpdb; ?>
<aside class="sidebar" id="sidebar-right">
	<section id="pov" class="block block-black">
		<header><h2>Puntos de vista</h2></header>
		<?php 
		$args = array();
		$args['parent'] = 3;
		$args['hierarchical'] = false;
		$args['hide_empty'] = 0;
		$categories = get_categories( $args );
		unset($args);
		?> 
		<ul class="clearfix">
			<?php //@todo: debe tener el ultimo post de esa categoria ?>
			<?php foreach ($categories as $category) :?>
			  <?php $query = new WP_Query(array('posts_per_page'=>1, 'cat' => $category->cat_ID)); ?>
			  <?php while ( $query->have_posts() ): ?>
				  <?php $query->the_post(); ?>
					<li class="<?php echo is_new(get_the_ID()); ?>"><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo $category->cat_name; ?></a></li>
				<?php endwhile; ?>
			<?php endforeach;?>
		</ul>
	</section>
	<div id="banner300x250" class="banner block" role="banner">
		<img src="<?php bloginfo( 'template_url' ); ?>/images/ad-1.jpg" width="298" />
	</div>
	<section id="ranking" class="block carousel">
		<header>
			<div class="prev selected">Más leidas</div>
			<div class="next">Más comentadas</div>
		</header>
		<?php //@todo: fix the querys?>
		<div class="carousel-wrapper">
			<ul class="first">
				<?php 
				$x = 1;
				$limit = 5;
				$date = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d")-30,   date("Y")));
				$sql = "SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '$date' AND post_status = 'publish' AND post_type = 'post' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT 0, $limit";
				$query = $wpdb->get_results($sql, OBJECT);
				?>		
				<?php  ?>		
				<?php foreach ($query as $post): ?>
				  <?php setup_postdata($post); ?>
					<?php the_post(); ?>
					<li class="item"><span><?php echo $x; ?></span> <a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></li>
					<?php $x++; ?>
				<?php endforeach;?>
				<?php  ?>
			</ul>
			<ul>
				<?php 
				$args = array();
				$x = 1;
				$args['posts_per_page'] = 2;
				$args['order'] = 'ASC';
				$args['orderby'] = 'comment_count';
				$query = new WP_Query($args);
				?>
				<?php while ( $query->have_posts() ): ?>
					<?php $query->the_post(); ?>
					<li class="item"><?php echo $x; ?> <a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></li>
					<?php $x++; ?>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
	<section id="follow-fb" class="block">
	  <header><h2><span>Seguinos</span> en facebook</h2></header>
		<div class="fb-like-box" data-href="http://www.facebook.com/platform" height="258" data-border-color="#ffffff" data-width="288" data-show-faces="true" data-stream="false" data-header="false"></div>	
	</section>
</aside>