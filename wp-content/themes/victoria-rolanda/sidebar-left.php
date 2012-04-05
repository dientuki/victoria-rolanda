<aside class="sidebar" id="sidebar-left">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	
	<?php if (function_exists('get_twett')): ?>
		<?php $twett = get_twett(); ?>
		<?php if ($twett->has_twett != false): ?>
			<section id="day-twett" class="block">
			  <header><h2><span>Twett</span> del día</h2></header>
				<div class="content">
					<img src="<?php echo $twett->get_picture()?>" />
					<?php echo $twett->get_user(); ?> <?php echo $twett->get_text(); ?>
				</div>
			  <footer>
			    <a href="https://twitter.com/victoriarolanda" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="small"  data-show-screen-name="true">Seguir a @victoriarolanda</a>
			  </footer>
			</section>
    <?php  endif; ?>
	<?php  endif; ?>
	
	<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
	<section id="poll" class="block block-black">
	  <header><h2>Encuesta</h2></header>
	  <?php get_poll();?>
	</section>
	<?php  endif; ?>
<?php endif; ?>
</aside>