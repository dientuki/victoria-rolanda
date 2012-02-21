<?php get_header(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">

    <?php if (is_home()): get_template_part('featured-carousel'); endif ?>

		<?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>

   <?php if (is_home()): get_template_part('footer-carousel') ; endif; ?>
  </div> 
  <?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>