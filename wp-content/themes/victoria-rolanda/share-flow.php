    <div class="share">
      <div class="fb item">
				<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-action="like" data-font="arial"></div>		      
      </div>
      <div class="tw item">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="victoriarolanda" data-lang="es">Twittear</a>
			</div>
      <?php if (has_post_thumbnail()): ?>
			<div class="pi item">
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) )) ?>&desc=<?php echo urlencode(get_the_title());?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
			</div>
			<?php endif; ?> 
    </div>