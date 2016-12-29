<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'leeway_customize_register_general_settings' );

function leeway_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'leeway_section_general', array(
        'title'    => __( 'General Settings', 'leeway' ),
        'priority' => 10,
		'panel' => 'leeway_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'leeway_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'leeway_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'leeway_control_layout', array(
        'label'    => __( 'Theme Layout', 'leeway' ),
        'section'  => 'leeway_section_general',
        'settings' => 'leeway_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => __( 'Left Sidebar', 'leeway' ),
            'right-sidebar' => __( 'Right Sidebar', 'leeway')
			)
		)
	);
	
	// Add Default Fonts Header
	$wp_customize->add_setting( 'leeway_theme_options[default_fonts]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Leeway_Customize_Header_Control(
        $wp_customize, 'leeway_control_default_fonts', array(
            'label' => __( 'Default Fonts', 'leeway' ),
            'section' => 'leeway_section_general',
            'settings' => 'leeway_theme_options[default_fonts]',
            'priority' => 2
            )
        )
    );
	
	// Add Settings and Controls for Deactivate Google Font setting
	$wp_customize->add_setting( 'leeway_theme_options[deactivate_google_fonts]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'leeway_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'leeway_control_deactivate_google_fonts', array(
        'label'    => __( 'Deactivate Google Fonts in case your language is not compatible.', 'leeway' ),
        'section'  => 'leeway_section_general',
        'settings' => 'leeway_theme_options[deactivate_google_fonts]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
}