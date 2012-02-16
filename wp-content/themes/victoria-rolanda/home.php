<?php get_header(); ?>

<div id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <section id="home-slideshow" class="slideshow"></section>
    <?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>
    <section id="footer-slideshow" class="slideshow"></section>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>