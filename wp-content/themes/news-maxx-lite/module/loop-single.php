<?php 
if ( have_posts() ) { 
	while ( have_posts() ) {
        the_post();
        get_template_part( 'module/format-single', get_post_format() );

    	comments_template();
	} // endwhile
} // endif
