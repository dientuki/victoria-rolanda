<aside class="sidebar" id="sidebar-left">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	
	<?php if (function_exists('get_tweet')): ?>
		<?php $tweet = get_tweet(); ?>
		<?php if ($tweet->has_tweet != false): ?>
			<section id="day-tweet" class="block">
			  <header><h2><span>Twett</span> destacado</h2></header>
				<div class="content">
					<img class="avatar" src="<?php echo $tweet->get_picture()?>"  width="48" height="48" alt="<?php echo $tweet->get_user();?>" />
					<p><a class="user" rel="nofollow" target="_blank" href="http://twitter.com/<?php echo $tweet->get_user(); ?>"><?php echo $tweet->get_user(); ?></a></p>
					<?php echo $tweet->get_text(); ?>
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