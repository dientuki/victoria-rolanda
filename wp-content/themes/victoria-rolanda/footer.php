	<footer id="footer">
	  <div class="wrapper"> 
  		<?php wp_nav_menu( array( 'theme_location' => 'footer',
  		                          'container' => 'nav', 'container_id' => 'footer-menu', 'container_class' => '',
  		                          'menu_class' => 'menu') ); ?>
		</div>		
	</footer>
	<div id="fb-root"></div>
	<!-- Analitic -->
	
	<script src="<?php bloginfo( 'template_url' ); ?>/js/libs/jquery-1.7.1.min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/plugins/jcarousellite-1-0-1.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/init.js"></script>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=181963141873249";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
		
</body>
</html>