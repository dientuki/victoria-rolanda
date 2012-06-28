<?php get_header(); ?>

<section id="container" class="wrapper clearfix">
  <div class="container clearfix">

    <?php get_template_part('featured-carousel');?>

    <?php if (is_category() || is_tag()):?>
    <header class="section">
    	<span class="category"><?php single_cat_title(); ?></span>
    </header>
    <?php endif; ?>
    
    <?php if (is_search()):?>
    <header class="section">
    	<span class="category">Busqueda</span>
    </header>
    <?php endif; ?>    
    	    
		<?php get_template_part('river-news') ?>
    <?php get_sidebar('left'); ?>

   <?php get_template_part('footer-carousel'); ?>
  </div> 
  <?php get_sidebar('right'); ?>
</section>

<?php get_footer(); ?>