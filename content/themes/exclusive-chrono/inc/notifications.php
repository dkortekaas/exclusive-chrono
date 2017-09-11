<?php
/**
 * Setup WP Notifications
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Remove WP update notification for all users except sysadmin
 *
 * @return string
 */
global $user_login;
wp_get_current_user();
if ( ! current_user_can( 'update_plugins' ) ) :
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
endif;