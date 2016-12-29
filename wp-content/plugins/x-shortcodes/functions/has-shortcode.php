<?php

// =============================================================================
// FUNCTIONS/HAS-SHORTCODE.PHP
// -----------------------------------------------------------------------------
// Checks for the existence of a shortcode.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Has Shortcode
// =============================================================================

// Has Shortcode
// =============================================================================

if ( ! function_exists( 'x_has_shortcode' ) ) :
  function x_has_shortcode( $shortcode = '', $attribute = '' ) {

    $post_to_check = get_post( get_the_ID() );
    $post_content  = $post_to_check->post_content;
    $found         = false;

    if ( ! $shortcode ) {
      return $found;
    }

    if ( stripos( $post_content, '[' . $shortcode ) !== false ) {
      $found = true;
    }

    return $found;

  }
endif;