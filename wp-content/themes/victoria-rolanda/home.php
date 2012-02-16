<?php get_header(); ?>

<div id="container" class="wrapper clearfix">
  <div class="container clearfix">
    <section id="home-slideshow" class="slideshow"></section>
    <section id="river-news">
      <?php get_template_part('river-news') ?>
    </section>
    <?php get_sidebar('left'); ?>
    <section id="footer-slideshow" class="slideshow"></section>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>