<?php
/**
 * Clean up wp_head()
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Removes the generator tag with WP version numbers. 
 * Hackers will use this to find weak and old WP installs.
 *
 * @return string
 */
if ( ! function_exists( 'wbase_no_generator' ) ) :
	function wbase_no_generator() {
		return '';
	}
endif;
add_filter( 'the_generator', 'no_generator' );

/*
Clean up wp_head() from unused or unsecure stuff
*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

/**
 * Show less info to users on failed login for security.
 * (Will not let a valid username be known.)
 *
 * @return string
 */
if ( ! function_exists( 'wbase_show_less_login_info' ) ) :
	function wbase_show_less_login_info() {
		return '<strong>ERROR</strong>: Stop guessing!';
	}
endif;
add_filter( 'login_errors', 'wbase_show_less_login_info' );

/**
 * Remove WP Version From styles and scripts.
 *
 * @return string
 */
if ( ! function_exists( 'wbase_remove_ver_css_js' ) ) :
	function wbase_remove_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) ) :
			$src = remove_query_arg( 'ver', $src );
		endif;
		return $src;
	}
endif;
add_filter( 'style_loader_src', 'wbase_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'wbase_remove_ver_css_js', 9999 );

/**
 * Remove WP version from RSS
 *
 * @return string
 */
if ( ! function_exists( 'wbase_remove_rss_version' ) ) :
	function wbase_remove_rss_version() { 
		return '';
	}
endif;

/**
 * Disable emojicons introduced with WP 4.2
 *
 * @return string
 */
if ( ! function_exists( 'wbase_disable_wp_emojicons' ) ) :
	function wbase_disable_wp_emojicons() {
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
endif;
add_action( 'init', 'wbase_disable_wp_emojicons' );