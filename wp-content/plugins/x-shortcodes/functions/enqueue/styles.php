<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/STYLES.PHP
// -----------------------------------------------------------------------------
// Enqueue all styles for X - Shortcodes.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register and Enqueue Site Styles
// =============================================================================

// Register and Enqueue Site Styles
// =============================================================================

function x_shortcodes_enqueue_site_styles() {

  if ( ! is_admin() ) {

    $stack            = ( get_theme_mod( 'x_stack' )            ) ? get_theme_mod( 'x_stack' )            : 'integrity';
    $integrity_design = ( get_theme_mod( 'x_integrity_design' ) ) ? get_theme_mod( 'x_integrity_design' ) : 'light';

    wp_register_style( 'x-shortcodes-integrity-light', X_SHORTCODES_URL . '/css/integrity-light.css', NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-integrity-dark',  X_SHORTCODES_URL . '/css/integrity-dark.css',  NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-renew',           X_SHORTCODES_URL . '/css/renew.css',           NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-icon',            X_SHORTCODES_URL . '/css/icon.css',            NULL, '1.0.0', 'all' );

    switch ( $stack ) {
      case 'integrity':
        if ( $integrity_design == 'dark' ) {
          wp_enqueue_style( 'x-shortcodes-integrity-dark' );
        } else {
          wp_enqueue_style( 'x-shortcodes-integrity-light' );
        }
        break;
      case 'renew':
        wp_enqueue_style( 'x-shortcodes-renew' );
        break;
      case 'icon':
        wp_enqueue_style( 'x-shortcodes-icon' );
        break;
    }

  }

}

add_action( 'wp_enqueue_scripts', 'x_shortcodes_enqueue_site_styles' );