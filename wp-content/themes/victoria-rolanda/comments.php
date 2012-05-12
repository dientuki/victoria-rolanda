<?php if ( post_password_required() ) : ?>
	<section id="comments">
		<p class="nopassword">Este post es protegido, fuera de aqui!</p>
	</section><!-- #comments -->
<?php
		return;
	endif;
?>

<section id="comments">
	
	<header>
		<h2 class="comments-title">Comentarios <sup>(<?php echo get_comments_number(); ?>)</sup></h2>
	</header>

	<div class="content">
		<?php if ( have_comments() ) : ?>
			<ul id="commentlist">	
				<?php foreach($comments as $comment):?>
					<?php switch ( $comment->comment_type ) :
						case 'pingback' :
						case 'trackback' :
					?>
					<li class="post pingback">
						<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link('Editar', '<span class="edit-link">', '</span>' ); ?></p>
					<?php
							break;
						default :
					?>
					<?php ?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
						<article id="comment-<?php comment_ID(); ?>">
							<header class="comment-meta">
								<?php
									$avatar_size = 48;
		
									echo get_avatar( $comment, $avatar_size );
								?>
								<div class="user-info">
									<span class="user fn"><?php comment_author_link(); ?></span> &middot; <a class="time" href="<?php comment_link( $comment->comment_ID ); ?>"><time pubdate datetime="<?php comment_time( 'c' )?>"><?php echo time_ago()?></time></a>
								</div>
								
								<span class="edit-link"><?php edit_comment_link( 'Editar' ); ?></span>
				
								<?php if ( $comment->comment_approved == '0' ) : ?>
									<em class="comment-awaiting-moderation">Tu comentario esta esperando moderacion</em>
									<br />
								<?php endif; ?>
				
							</header>
				
							<div class="comment-content"><?php comment_text(); ?></div>
				
							<div class="reply">
								<?php //comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</div><!-- .reply -->
							
						</article><!-- #comment-## -->
				
					<?php
							break;
					endswitch; ?>				
				<?php endforeach; ?>
			</ul>		
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div>
			<?php endif;?>		
		
		<?php else: ?>
		
		<?php endif; ?>	
	</div>
	
	<footer>
	
	<?php comment_form(); ?>

	</footer>

</section>