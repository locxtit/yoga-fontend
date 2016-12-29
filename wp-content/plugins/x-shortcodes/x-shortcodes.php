<?php

/*

Plugin Name: X &ndash; Shortcodes
Plugin URI: http://theme.co/x/
Description: Includes all shortcode functionality for X.
Version: 2.2.1
Author: Themeco
Author URI: http://theme.co/
Text Domain: __x__

*/

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Initialize the Plugin and Require Files
//   03. Automatic Updates
// =============================================================================

// Define Constants
// =============================================================================

define( 'X_SHORTCODES_VERSION', '2.2.1' );
define( 'X_SHORTCODES_URL', plugins_url( '', __FILE__ ) );



// Initialize the Plugin and Require Files
// =============================================================================

function x_shortcodes_init() {

  //
  // Load plugin textdomain.
  //

  load_plugin_textdomain( '__x__', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );


  //
  // Include frontend functionality.
  //

  require_once( 'functions/version-output.php' );
  require_once( 'functions/has-shortcode.php' );
  require_once( 'functions/shortcodes.php' );


  //
  // Enqueue styles and scripts.
  //

  require_once( 'functions/enqueue/styles.php' );
  require_once( 'functions/enqueue/scripts.php' );

}

add_action( 'init', 'x_shortcodes_init' );

require_once( 'functions/admin/user.php' );
require_once( 'functions/admin/shortcode-generator.php' );



// Automatic Updates
// =============================================================================

class X_Plugin_Automatic_Update {

  public $api_url;
  public $package_type;
  public $plugin_slug;
  public $plugin_file;

  public function X_Plugin_Automatic_Update( $api_url, $type, $slug ) {
    $this->api_url      = $api_url;
    $this->package_type = $type;
    $this->plugin_slug  = $slug;
    $this->plugin_file  = $slug . '/' . $slug . '.php';
  }

  public function print_api_result() {
    print_r( $res ); return $res;
  }

  public function check_for_plugin_update( $checked_data ) {
    if ( empty( $checked_data->checked ) ) {
      return $checked_data;
    }

    $request_args = array(
      'slug'         => $this->plugin_slug,
      'version'      => $checked_data->checked[$this->plugin_file],
      'package_type' => $this->package_type,
    );

    $request_string = $this->prepare_request( 'basic_check', $request_args );
    $raw_response   = wp_remote_post( $this->api_url, $request_string );

    if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
      $response = unserialize( $raw_response['body'] );
      if ( is_object( $response ) && ! empty( $response ) ) {
        $checked_data->response[$this->plugin_file] = $response;
      }
    }

    return $checked_data;
  }

  public function plugins_api_call( $def, $action, $args ) {
    if ( ! isset( $args->slug ) || $args->slug != $this->plugin_slug ) {
      return false;
    }

    $plugin_info        = get_site_transient( 'update_plugins' );
    $current_version    = $plugin_info->checked[$this->plugin_file];
    $args->version      = $current_version;
    $args->package_type = $this->package_type;
    $request_string     = $this->prepare_request( $action, $args );
    $request            = wp_remote_post( $this->api_url, $request_string );

    if ( is_wp_error( $request ) ) {
      $res = new WP_Error( 'plugins_api_failed', 'An Unexpected HTTP Error occurred during the API request. <a href="?" onclick="document.location.reload(); return false;">Try again</a>', $request->get_error_message() );
    } else {
      $res = unserialize( $request['body'] );
      if ( $res === false ) {
        $res = new WP_Error( 'plugins_api_failed', 'An unknown error occurred', $request['body'] );
      }
    }

    return $res;
  }

  public function prepare_request( $action, $args ) {
    $site_url = site_url();
    $wp_info  = array(
      'site-url' => $site_url,
      'version'  => floatval( get_bloginfo( 'version' ) ),
    );

    return array(
      'body' => array(
        'action'  => $action, 'request' => serialize( $args ),
        'api-key' => md5( $site_url ),
        'wp-info' => serialize( $wp_info ),
      ),
      'user-agent' => 'WordPress/' . floatval( get_bloginfo( 'version' ) ) . '; ' . get_bloginfo( 'url' )
    );
  }

}

$update = new X_Plugin_Automatic_Update( 'http://theme.co/updates/', 'stable', basename( dirname( __FILE__ ) ) );

add_filter( 'pre_set_site_transient_update_plugins', array( $update, 'check_for_plugin_update' ) );
add_filter( 'plugins_api', array( $update, 'plugins_api_call' ), 10, 3 );