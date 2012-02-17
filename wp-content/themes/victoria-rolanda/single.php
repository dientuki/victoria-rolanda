<?php get_header(); ?>
<?php the_post(); ?>

<div id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <article>
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    </article>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>