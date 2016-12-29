<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = leeway_theme_options();
	
	// Display Featured Post Slideshow if activated
	if ( isset($theme_options['slider_active_blog']) and $theme_options['slider_active_blog'] == true ) :

		get_template_part( 'featured-content-slider' );

	endif; 
?>

	<div id="wrap" class="clearfix">
	
		<section id="content" class="primary" role="main">
		 
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'content', $theme_options['posts_length'] );
		
			endwhile;
			
		leeway_display_pagination();

		endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	