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
		<h3 class="comments-title"><?php
		printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'twentyten' ),
		number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
		?></h3>
	</header>

	<div class="content">
		<?php if ( have_comments() ) : ?>
			<ul class="commentlist">
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
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
						<article id="comment-<?php comment_ID(); ?>" class="comment">
							<footer class="comment-meta">
								<div class="comment-author vcard">
									<?php
										$avatar_size = 68;
										if ( '0' != $comment->comment_parent )
											$avatar_size = 39;
				
										echo get_avatar( $comment, $avatar_size );
				
										/* translators: 1: comment author, 2: date and time */
										printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
											sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
											sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
												esc_url( get_comment_link( $comment->comment_ID ) ),
												get_comment_time( 'c' ),
												/* translators: 1: date, 2: time */
												sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
											)
										);
									?>
				
									<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .comment-author .vcard -->
				
								<?php if ( $comment->comment_approved == '0' ) : ?>
									<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
									<br />
								<?php endif; ?>
				
							</footer>
				
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
		<?php if (comments_open() ) : ?>
			<?php comment_form(); ?>
		<?php else:?>
			<p class="nocomments">No se puede comentar más</p>
		<?php endif;?>	
	</footer>

</section>