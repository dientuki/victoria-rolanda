<?php get_header(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">
		<?php 
			$args = array();
			$args['posts_per_page'] = 5;
			$args['cat'] = 1;
			$args['meta_key'] = 'dbt_text';
			$args['meta_value'] = 'test de algo';
			$query = new WP_Query($args);
		?>
		<section id="home-carousel" class="carousel">
			<div class="button prev">&lt;</div>
			<div class="button next">&gt;</div>		
			<div class="carousel-wrapper">
			<?php while ( $query->have_posts() ): ?>
				<?php $query->the_post(); ?>
					<article>
						<header>
							<h1><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></h1>
							<div class="dropline"><?php the_excerpt(); ?></div>
						</header>
						<?php if (has_post_thumbnail()): ?>
							<figure>
								<a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php the_post_thumbnail('featured_thumbnail'); ?></a>
								<figcaption class="hidden"><?php echo the_title(); ?></figcaption>
							</figure>
						<?php endif; ?>
					</article>				
			<?php endwhile;?>
			</div>
		</section>

		<?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>
    
    <?php
      $args = array();
      $args['posts_per_page'] = 5;
      $args['cat'] = 1;
      $query = new WP_Query($args);
    ?>    
    <section id="footer-carousel" class="carousel">
			<div class="button prev">&lt;</div>
			<div class="button next">&gt;</div>
			
			<header><h2>Moda</h2></header>
			<div class="carousel-wrapper">
			<?php while ( $query->have_posts() ): ?>
				<?php $query->the_post(); ?>
					<article>
						<header>
							<h1><a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></h1>
							<div class="dropline"><?php the_excerpt(); ?></div>
						</header>
						<?php if (has_post_thumbnail()): ?>
							<figure>
								<a href="<?php the_permalink() ?>" title="<?php echo the_title(); ?>"><?php the_post_thumbnail('featured_thumbnail'); ?></a>
								<figcaption class="hidden"><?php echo the_title(); ?></figcaption>
							</figure>
						<?php endif; ?>
					</article>				
			<?php endwhile;?>
			</div>
    </section>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>