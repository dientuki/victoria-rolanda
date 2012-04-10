<?php get_header(); ?>
<?php the_post(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <article class="hnews new" id="post-<?php the_ID(); ?>">
    	
    	<header>
    		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
    		<div class="meta">
					<?php	$category = get_the_category(); $category = $category[0];	?>    		    		
   		  	<a class="category" rel="category" title="Ver todas las entradas en <?php echo $category->cat_name; ?>" href="<?php echo get_category_link($category->term_id ) ?>"><?php echo $category->cat_name; ?></a>
    		  <time><?php the_date(); ?></time>
    		</div>
    		<?php get_template_part('share', 'single'); ?>
    		<div class="dropline"><?php the_excerpt(); ?></div>
    	</header>

    	<?php if (has_post_thumbnail()): ?>
    	<figure>
    	  <?php the_post_thumbnail('featured_thumbnail'); ?>
    	  <figcaption class="hidden"><?php the_title(); ?></figcaption>
    	</figure>
    	<?php endif; ?>
    	
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    	
    	<footer>
    		<div class="tag-list clearfix">
    		  <h3>Tags:</h3>
    		  <?php the_tags( '', ', ', '.')?>
    		</div>
    	  <?php get_template_part('share', 'single'); ?>
    	</footer>
    	
    </article>
    
    <?php comments_template( '', true ); ?>
    <?php get_template_part( 'single', 'related' ); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>