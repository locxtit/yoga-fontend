<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Enqueue all scripts for X - Shortcodes.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register and Enqueue Site Scripts
// =============================================================================

// Register and Enqueue Site Scripts
// =============================================================================

function x_shortcodes_enqueue_site_scripts() {

  if ( ! is_admin() ) {

    wp_register_script( 'x-shortcodes',         X_SHORTCODES_URL . '/js/x-shortcodes.min.js',                      array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-backstretch',     X_SHORTCODES_URL . '/js/vendor/backstretch-2.0.3.min.js',          array( 'jquery' ),                                                             NULL, false );
    wp_register_script( 'vend-caroufredsel',    X_SHORTCODES_URL . '/js/vendor/caroufredsel-6.2.1.min.js',         array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-easing',          X_SHORTCODES_URL . '/js/vendor/easing-1.3.0.min.js',               array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-fittext',         X_SHORTCODES_URL . '/js/vendor/fittext-1.1.0.min.js',              array( 'jquery' ),                                                             NULL, false );
    wp_register_script( 'vend-flexslider',      X_SHORTCODES_URL . '/js/vendor/flexslider-2.1.0.min.js',           array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-ilightbox',       X_SHORTCODES_URL . '/js/vendor/ilightbox-2.1.5.min.js',            array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-modernizr',       X_SHORTCODES_URL . '/js/vendor/modernizr-2.7.1.min.js',            NULL,                                                                          NULL, false );
    wp_register_script( 'vend-waypoints',       X_SHORTCODES_URL . '/js/vendor/waypoints-2.0.3.min.js',            array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-alert',      X_SHORTCODES_URL . '/js/vendor/bootstrap/alert-2.3.0.min.js',      array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-collapse',   X_SHORTCODES_URL . '/js/vendor/bootstrap/collapse-2.3.0.min.js',   array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-popover',    X_SHORTCODES_URL . '/js/vendor/bootstrap/popover-2.3.0.min.js',    array( 'jquery', 'vend-boot-tooltip' ),                                        NULL, true );
    wp_register_script( 'vend-boot-tab',        X_SHORTCODES_URL . '/js/vendor/bootstrap/tab-2.3.0.min.js',        array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-tooltip',    X_SHORTCODES_URL . '/js/vendor/bootstrap/tooltip-2.3.0.min.js',    array( 'jquery', 'vend-boot-alert', 'vend-boot-tab', 'vend-boot-transition' ), NULL, true );
    wp_register_script( 'vend-boot-transition', X_SHORTCODES_URL . '/js/vendor/bootstrap/transition-2.3.0.min.js', array( 'jquery' ),                                                             NULL, true );

    wp_enqueue_script( 'x-shortcodes' );
    wp_enqueue_script( 'vend-backstretch' );
    wp_enqueue_script( 'vend-easing' );
    wp_enqueue_script( 'vend-flexslider' );
    wp_enqueue_script( 'vend-modernizr' );
    wp_enqueue_script( 'vend-boot-collapse' );
    wp_enqueue_script( 'vend-boot-popover' );
    wp_enqueue_script( 'vend-boot-tab' );
    wp_enqueue_script( 'vend-boot-tooltip' );
    wp_enqueue_script( 'vend-boot-transition' );
    if ( x_has_shortcode( 'responsive_text' ) ) {
      wp_enqueue_script( 'vend-fittext' );
    }
    if ( x_has_shortcode( 'lightbox' ) ) {
      wp_enqueue_script( 'vend-ilightbox' );
    }
    if ( x_has_shortcode( 'column' ) || x_has_shortcode( 'vc_column' ) || x_has_shortcode( 'recent_posts' ) || x_has_shortcode( 'skill_bar' ) ) {
      wp_enqueue_script( 'vend-waypoints' );
    }
    if ( x_has_shortcode( 'alert' ) ) {
      wp_enqueue_script( 'vend-boot-alert' );
    }

  }

}

add_action( 'wp_enqueue_scripts', 'x_shortcodes_enqueue_site_scripts' );