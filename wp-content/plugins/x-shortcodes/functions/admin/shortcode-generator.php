<?php

// =============================================================================
// FUNCTIONS/ADMIN/SHORTCODE-GENERATOR.PHP
// -----------------------------------------------------------------------------
// Adds the shortcode generator button to the TinyMCE interface.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add Shortcode Generator Button
// =============================================================================

// Add Shortcode Generator Button
// =============================================================================

class X_Shortcodes_Add_Shortcode_Generator_Button {

  function __construct() {
    add_action( 'init', array( &$this, 'init' ) );
  }
  
  function init() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
      return;
    }

    if ( get_user_option( 'rich_editing' ) == 'true' ) {
      add_filter( 'mce_external_plugins', array( &$this, 'x_shortcodes_plugin' ) );
      add_filter( 'mce_buttons', array( &$this,'x_shortcodes_register' ) );
    }  
  }

  function x_shortcodes_plugin( $plugin_array ) {
    if ( floatval( get_bloginfo( 'version' ) ) >= 3.9 ) {
      $tinymce_js = X_SHORTCODES_URL .'/js/admin/tinymce.min.js';
    } else {
      $tinymce_js = X_SHORTCODES_URL .'/js/admin/tinymce-legacy.min.js';
    }
    $plugin_array['x_shortcodes'] = $tinymce_js;
    return $plugin_array;
  }

  function x_shortcodes_register( $buttons ) {
    array_push( $buttons, 'x_shortcodes_button' );
    return $buttons;
  }

}

$x_shortcodes = new X_Shortcodes_Add_Shortcode_Generator_Button;