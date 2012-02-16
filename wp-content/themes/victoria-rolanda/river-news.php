<section id="river-news">
<?php while ( have_posts() ) : ?>
  <?php the_post(); ?>
  
  <article class="hnews">
  	<header>
  		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  		<div class="category"><?php the_category();?></div>
  	</header>

  	<div class="entry-content">
  	</div>

  	<div class="hmedia">
  		<figure>
  		</figure>
  		<a href="#"></a>
  	</div>

		<div class="share">
			<div>fabook</div>
			<div>twitter</div>
 		</div>

  	<footer>
  		<div class="author vcard"></div>    	
  	</footer>
  </article>

<?php endwhile; // End the loop. Whew. ?>
</section>