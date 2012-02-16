<?php get_header(); ?>

<div id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>