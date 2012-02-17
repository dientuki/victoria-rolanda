<section id="river-news">
	
  <?php if (is_home() == false):?>
    <header>header</header>
	<?php endif; ?>
	
	<div class="content">
		<?php while ( have_posts() ) : ?>
		  <?php the_post(); ?>
		  <?php $category = get_the_category(); ?>
		  
		  <article class="hnews">
		    <header>
		      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		      <div class="category"><a href="<?php bloginfo( 'url' ); ?>/category/<?php echo $category[0]->category_nicename; ?>" title="<?php echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></div>
		    </header>
		
		    <div class="entry-content">
		      <?php the_excerpt(); ?>
		    </div>
		    
		    <?php if (has_post_thumbnail()): ?>
		    <div class="hmedia">
		      <figure>
		        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		          <?php the_post_thumbnail('featured_thumbnail'); ?>
		        </a>
		        <figcaption><?php the_title(); ?>/figcaption>
		      </figure>
		      <a href="#"></a>
		    </div>
		    <?php endif; ?>
		    
		    <div class="share">
		      <div>fabook</div>
		      <div>twitter</div>
		    </div>
		
		    <footer>
		      <div class="author vcard"></div>      
		    </footer>
		  </article>
		
		<?php endwhile; // End the loop. Whew. ?>
  </div>
  
  <footer>
  	<div class="navigation">
			<div class="previous"><?php previous_posts_link( 'Anterior' ); ?></div>
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>			
				<div class="next"><?php next_posts_link( 'Siguiente' ); ?></div>
			<?php endif; ?>			
		</div>				
  </footer>  

</section>