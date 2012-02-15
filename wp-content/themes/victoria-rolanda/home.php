<?php get_header(); ?>

<div id="container" class="wrapper">
  <div class="container clearfix">
    <section id=""></section>
    <section id="content">
      <?php get_template_part('river-news') ?>
    </section>
    <?php get_sidebar('left'); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</div>
<?php get_footer(); ?>