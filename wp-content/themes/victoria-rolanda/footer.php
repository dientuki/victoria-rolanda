	<footer id="footer">
	  <div class="wrapper"> 
  		<?php wp_nav_menu( array( 'theme_location' => 'footer',
  		                          'container' => 'nav', 'container_id' => 'footer-menu', 'container_class' => '',
  		                          'menu_class' => 'menu') ); ?>
		</div>		
	</footer>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/libs/jquery-1.7.1.min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/plugins/jcarousellite-1-0-1.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/init.js"></script>
</body>
</html>