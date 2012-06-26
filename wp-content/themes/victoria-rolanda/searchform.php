	<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text">Buscar:</label>
		<input type="text" class="field" name="s" id="s" placeholder="Buscar" value="<?php echo get_search_query(); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="Buscar" />
	</form>
