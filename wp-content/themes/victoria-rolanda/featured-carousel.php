		<?php 
			$args = array();
			$args['post__in'] = get_option( 'sticky_posts' );
			$args['posts_per_page'] = 5;
			$args['ignore_sticky_posts'] = 1;
			$query = new WP_Query($args);
		?>
		<section id="featured-carousel" class="carousel">
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