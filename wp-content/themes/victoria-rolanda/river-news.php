<section id="river-news">
			
  <?php if (is_home() == false):?>
    <header>header</header>
	<?php endif; ?>
	<?php //query_posts('ignore_sticky_posts=1') ?>
	<?php //if ( $paged > 1 ) query_posts('paged=' . $paged) ?>
	<div class="content">
		<?php while ( have_posts() ) : ?>
		  <?php the_post(); ?>
		  <?php $category = get_the_category(); ?>
		  
		  <article class="hnews">
		    <header>
		      <div class="category"><a href="<?php bloginfo( 'url' ); ?>/category/<?php echo $category[0]->category_nicename; ?>" title="<?php echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></div>
		      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		    </header>
		
		    <div class="entry-content">
		      <?php the_excerpt(); ?>
		    </div>
		    
		    <div class="hmedia">
		    <figure>
		    <?php if (has_post_thumbnail()): ?>	      
		        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		          <?php the_post_thumbnail('thumbnail'); ?>
		        </a>
		    <?php else:?>
		    	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		    		<img src="<?php bloginfo( 'template_url' ); ?>/images/post-default.jpg" width="100" height="100" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
		    	</a>	    
		    <?php endif; ?>
		      </figure>
		      <figcaption class="hidden"><?php the_title(); ?></figcaption>
		    		    
		      <?php comments_popup_link( '0 comentarios', '1 comentario', '% comentarios', 'comments'); ?>
		    </div>
		    
		    
		    <div class="share">
		      <div class="fb item">fabook</div>
		      <div class="tw item">twitter</div>
		    </div>
		
		    <footer>
		      <div class="author vcard">
		      	Por: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"><?php the_author()?></a>
		      </div>      
		    </footer>
		  </article>
		
		<?php endwhile; // End the loop. Whew. ?>
  </div>
  
  <footer>
  	<div class="pager clearfix<?php if ( $paged == 0 ) : ?> only-next<?php endif;?>">
			<?php if ( $paged > 1 ) : ?>		
			<div class="button previous"><?php previous_posts_link( 'Anterior' ); ?></div>
			<?php endif; ?>				
			<div class="button next"><?php next_posts_link( 'Siguiente' ); ?></div>
		</div>				
  </footer>  

</section>
<?php wp_reset_query();?>