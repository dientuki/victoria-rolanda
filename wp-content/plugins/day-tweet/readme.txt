=== Day Tweet ===
Contributors: dientuki
Tags: twitter
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 3.3.1

Permite poner en tu web tweets programados

== Description ==

Permite poner en tu web tweets programados

== Installation ==

1. Upload the 'daytweet' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Day Tweet -> Add Tweet
4. Add an url and a date
5. Put this html in your site

  <?php if (function_exists('get_tweet')): ?>
    <?php $tweet = get_tweet(); ?>
    <?php if ($tweet->has_tweet != false): ?>
      <section id="day-tweet" class="block">
        <header><h2><span>Tweet</span> del día</h2></header>
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
  
6. Enjoy

== Changelog ==

= 0.5 =
* First commit