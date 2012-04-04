<?php get_header(); ?>
<?php the_post(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <article>
    	
    	<header>
    		<h1><?php the_title(); ?></h1>
    		<div class="meta">
    		  <div class="category"><?php the_category(); ?></div>
    		  <time><?php the_date(); ?></time>
    		</div>
    		<?php get_template_part('share', 'single'); ?>
    		<div class="dropline"><?php the_excerpt(); ?></div>
    	</header>
    	
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    	
    	<footer>
    		<div class="tag-list">
    		  <h3>Tags:</h3>
    		  <?php the_tags( '<ul><li class="tag">', '</li><li class="tag">', '</li></ul>')?>
    		</div>
    	  <?php get_template_part('share', 'single'); ?>
    	</footer>
    	
    </article>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>