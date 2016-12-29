		
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-excerpt'); ?>>
		
		<h2 class="post-title entry-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="postmeta clearfix"><?php leeway_display_postmeta(); ?></div>
		
		<?php leeway_display_thumbnail_index(); ?>

		<div class="entry clearfix">
			<?php the_excerpt(); ?>
			<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Read more', 'leeway'); ?></a>
		</div>
		
		<div class="postinfo clearfix"><?php leeway_display_postinfo(); ?></div>

	</article>