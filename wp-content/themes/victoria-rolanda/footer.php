	<footer id="footer">
  		<?php wp_nav_menu( array( 'theme_location' => 'footer',
  		                          'container' => 'nav', 'container_id' => 'footer-menu', 'container_class' => '',
  		                          'menu_class' => 'menu') ); ?>
	</footer>
	<div id="fb-root"></div>

	<script type="text/javascript" charset="utf-8">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-9399238-5']);
	_gaq.push(['_trackPageview']);

	(function() {
	  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>		
	
	<script type="text/javascript" charset="utf-8">
		var VR = {};
		VR.BASE_PATH='<?php bloginfo( 'template_url' ); ?>';
	</script>	
	
	<script src="<?php bloginfo( 'template_url' ); ?>/js/libs/LAB-min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/lab-min.js"></script>
	
</body>
</html>