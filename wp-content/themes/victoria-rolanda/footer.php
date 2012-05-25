	<footer id="footer">
  		<?php wp_nav_menu( array( 'theme_location' => 'footer',
  		                          'container' => 'nav', 'container_id' => 'footer-menu', 'container_class' => '',
  		                          'menu_class' => 'menu') ); ?>
	</footer>
	<div id="fb-root"></div>

	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-9399238-5']);
	_gaq.push(['_trackPageview']);

	(function() {
	  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>		
	
	<script src="<?php bloginfo( 'template_url' ); ?>/js/libs/jquery-1.7.1.min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/plugins/jcarousellite-1-0-1.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/plugins/wp-polls.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/init.js"></script>
	
</body>
</html>