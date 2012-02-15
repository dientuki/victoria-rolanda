<?php get_header(); ?>

<div id="container" class="wrapper">
  <div class="container clearfix">
    <section id="header-slideshow"></section>
    <section id="river-news">
      <?php get_template_part('river-news') ?>
    </section>
    <section id="footer-slideshow"></section>
    <?php get_sidebar('left'); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>