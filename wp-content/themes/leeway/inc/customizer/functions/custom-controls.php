<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/


if ( class_exists( 'WP_Customize_Control' ) ) :
	
	// Add simple heading option to the theme customizer
    class Leeway_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>
			
<?php
        }
    }
	
	// Add simple description control to the theme customizer	
	class Leeway_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
<?php
        }
    }
	
	// Add simple textfield control to the theme customizer
	class Leeway_Customize_Text_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="textfield"><?php echo esc_html( $this->label ); ?></span>
			
<?php
        }
    }
	
	// Add simple upgrade button control to the theme customizer
	class Leeway_Customize_Button_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<p>
				<a href="http://themezee.com/themes/leeway/#PROVersion-1" target="_blank" class="button button-secondary">
					<?php echo esc_html( $this->label ); ?>
				</a>
			</p>
			
<?php
        }
    }
	
	
endif;


// Add a callback function to retrieve wether slider is activated or not
function leeway_slider_activated_callback( $control ) {
	
	// Check if Slider is turned on
	if ( $control->manager->get_setting('leeway_theme_options[slider_active_magazine]')->value() == 1 ) :
		return true;
	elseif ( $control->manager->get_setting('leeway_theme_options[slider_active_blog]')->value() == 1 ) :
		return true;
	else :
		return false;
	endif;
	
}


?>