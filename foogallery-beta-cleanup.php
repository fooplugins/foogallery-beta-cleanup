<?php
/**
 * Plugin Name: FooGallery Beta Cleanup
 * Plugin URI:  https://fooplugins.com/
 * Description: Delete all FooGallery beta upgrade data so that a newer beta version can be tested
 * Version:     1.0.0
 * Author:      FooPlugins
 * Author URI:  https://fooplugins.com
 * License: GPL2
 */

/**
 * @package     FooGallery Beta Cleanup
 * @copyright   Copyright (c) 2017, FooPlugins, Inc.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function foogallery_beta_cleanup() {
	delete_post_meta_by_key( '_foogallery_settings' );
	delete_option( 'foogallery-version' );

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	deactivate_plugins( plugin_basename( __FILE__ ) );

	wp_die( 'FooGallery upgrade data successfully cleared! You are now safe to install and activate the latest version of FooGallery beta.', __( 'Error' ), array( 'back_link' => true ) );
}

add_action( 'plugins_loaded', 'foogallery_beta_cleanup' );