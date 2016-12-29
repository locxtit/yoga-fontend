<?php
/***
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard. 
 *
 */


// Add Theme Info page to admin menu
add_action('admin_menu', 'leeway_add_theme_info_page');
function leeway_add_theme_info_page() {
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	add_theme_page( 
		sprintf( __( 'Welcome to %1$s %2$s', 'leeway' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), 
		__('Theme Info', 'leeway'), 
		'edit_theme_options', 
		'leeway', 
		'leeway_display_theme_info_page'
	);
	
}


// Display Theme Info page
function leeway_display_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( __( 'Welcome to %1$s %2$s', 'leeway' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php _e('Important Links:', 'leeway'); ?></strong>
				<a href="http://themezee.com/themes/leeway/" target="_blank"><?php _e('Theme Page', 'leeway'); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('Changelog', 'leeway'); ?></a>
				<a href="http://preview.themezee.com/leeway/" target="_blank"><?php _e('Theme Demo', 'leeway'); ?></a>
				<a href="http://themezee.com/docs/leeway-documentation/" target="_blank"><?php _e('Theme Documentation', 'leeway'); ?></a>
				<a href="http://wordpress.org/support/view/theme-reviews/leeway?filter=5" target="_blank"><?php _e('Rate this theme', 'leeway'); ?></a>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
				
					<h3><?php printf( __( 'Getting Started with %s', 'leeway' ), $theme->get( 'Name' ) ); ?></h3>
						
					<div class="section">
						<h4><?php _e( 'Theme Documentation', 'leeway' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'leeway' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/docs/leeway-documentation/" target="_blank" class="button button-secondary">
								<?php printf( __( 'View %s Documentation', 'leeway' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Theme Options', 'leeway' ); ?></h4>
						
						<p class="about">
							<?php printf( __( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'leeway' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e('Customize Theme', 'leeway'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Pro Version', 'leeway' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need more features? Purchase the Pro Version to get additional features and advanced customization options.', 'leeway' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/themes/leeway/#PROVersion-1" target="_blank" class="button button-secondary">
								<?php printf( __( 'Learn more about %s Pro', 'leeway' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( __( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'leeway' ), 
				$theme->get( 'Name' ),
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/leeway?filter=5" title="Leeway Review">' . __( 'rate it', 'leeway' ) . '</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


// Add CSS for Theme Info Panel
add_action('admin_enqueue_scripts', 'leeway_theme_info_page_css');
function leeway_theme_info_page_css($hook) { 

	// Load styles and scripts only on theme info page
	if ( 'appearance_page_leeway' != $hook ) {
		return;
	}
	
	// Embed theme info css style
	wp_enqueue_style('leeway-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');

}


?>