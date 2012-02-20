<aside class="sidebar" id="sidebar-right">
	<section id="pov" class="block">
		<header>Puntos de vista</header>
		<?php 
		$args = array();
		$args['parent'] = 3;
		$args['hierarchical'] = false;
		$categories = get_categories( $args );
		?> 
		<ul>
			<?php //@todo: debe tener el ultimo post de esa categoria ?>
			<?php foreach ($categories as $category) :?>
				<li><a href="#"><?php echo $category->cat_name; ?></a></li>
			<?php endforeach;?>
		</ul>
	</section>
	<div id="banner300x200" class="banner block" role="banner"></div>
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