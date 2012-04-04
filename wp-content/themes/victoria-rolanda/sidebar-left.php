<aside class="sidebar" id="sidebar-left">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<section id="day-tweet" class="block"></section>
	<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
	<section id="poll" class="block">
	  <header><h2>Encuesta</h2></header>
	  <?php get_poll();?>
	</section>
	<?php  endif; ?>
<?php endif; ?>
</aside>