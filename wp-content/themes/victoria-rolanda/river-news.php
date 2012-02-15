<?php while ( have_posts() ) : ?>
  <?php the_post(); ?>
  
  <article>
  	<header>
  		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  		<div class="category"><?php the_category();?></div>
  	</header>
  	<div class="content">
			<figure>
			</figure>  	
  	</div>
  	<footer>
    	<div class=""></div>
    	<div class=""></div>
  	</footer>
  </article>

<?php endwhile; // End the loop. Whew. ?>