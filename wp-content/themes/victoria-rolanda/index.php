<?php get_header(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>