<aside class="sidebar" id="sidebar-right">
	<section id="pov" class="block">
		<header><h2>Puntos de vista</h2></header>
		<?php 
		$args = array();
		$args['parent'] = 3;
		$args['hierarchical'] = false;
		$args['hide_empty'] = 0;
		$categories = get_categories( $args );
		?> 
		<ul>
			<?php //@todo: debe tener el ultimo post de esa categoria ?>
			<?php foreach ($categories as $category) :?>
			  <?php $query = new WP_Query(array('posts_per_page'=>1, 'cat' => $category->cat_ID)); ?>
			  <?php while ( $query->have_posts() ): ?>
				  <?php $query->the_post(); ?>
					<li class="<?php is_new(get_the_ID()); ?>"><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo $category->cat_name; ?></a></li>
				<?php endwhile; ?>
			<?php endforeach;?>
		</ul>
	</section>
	<div id="banner300x250" class="banner block" role="banner">
		<img src="<?php bloginfo( 'template_url' ); ?>/images/ad-1.jpg" width="300" height="250" />
	</div>
	<section id="ranking" class="block carousel">
		<header>
			<div class="">Más leidas</div>
			<div class="">Más comentadas</div>
		</header>
		<div class="wrapper">
			<ul>
				<?php 
				$args = array();
				$x = 1;
				$arg['posts_per_page'] = 5;
				$arg['order'] = 'ASC';
				$arg['orderby'] = 'comment_count';
				$query = new WP_Query($args);
				?>
				<?php while ( $query->have_posts() ): ?>
					<?php $query->the_post(); ?>
					<li><?php echo $x; ?><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
			<ul>
				<?php 
				$args = array();
				$x = 1;
				$arg['posts_per_page'] = 5;
				$arg['order'] = 'ASC';
				$arg['orderby'] = 'comment_count';
				$query = new WP_Query($args);
				?>
				<?php while ( $query->have_posts() ): ?>
					<?php $query->the_post(); ?>
					<li><?php echo $x; ?><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
	<section id="follow-fb" class="block"></section>
</aside>