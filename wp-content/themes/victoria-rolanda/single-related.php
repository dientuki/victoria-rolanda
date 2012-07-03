<?php $tags = wp_get_post_tags($post->ID); ?>
<?php if ($tags == false) return; ?>

<?php 
$first_tag = $tags[0]->term_id;

$args['tag__in'] = array($first_tag);
$args['post__not_in'] = array($post->ID);
$args['post_per_page'] = 4;
$args['ignore_sticky_posts'] = 1;
$query = new WP_Query($args);
?>
<?php if( $query->have_posts() ): ?>

	<section id="related" class="block">
		<header><h2>Quizas tambien te interese</h2></header>
		<div class="content">
		<?php $i = 1; ?>
		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<article class="item item-<?php echo $i ?>" >
				<?php if (has_post_thumbnail()): ?>
					<figure>
						<a href="<?php the_permalink() ?>" title='<?php the_title_attribute(); ?>'><?php the_post_thumbnail('related'); ?></a>
						<figcaption class="hidden"><?php echo the_title(); ?></figcaption>
					</figure>
				<?php endif; ?>
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title='<?php the_title_attribute(); ?>'><?php the_title(); ?></a></h1>
			</article>
			<?php if ($i%4 == 0) $i = 1; ?>
			<?php $i++; ?>
		<?php endwhile; ?>
		</div>
	</section>

<?php endif; ?>
