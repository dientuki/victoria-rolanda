<?php get_header(); ?>
<?php the_post(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <article>
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    </article>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>