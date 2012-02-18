<aside class="sidebar" id="sidebar-right">
	<section id="pov" class="block">
		<header>Puntos de vista</header>
		<?php 
		$args = array();
		$arg['parent'] = 1;
		$arg['hierarchical'] = false;
		$categories = get_categories( $args );
		?> 
		<ul>
			<?php foreach ($categories as $category) :?>
				<li><a href="#"><?php echo $category->cat_name; ?></a></li>
			<?php endforeach;?>
		</ul>
	</section>
	<div id="banner300x200" class="banner block" role="banner"></div>
	<section id="ranking" class="block"></section>
	<section id="follow-fb" class="block"></section>
</aside>