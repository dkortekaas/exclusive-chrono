<?php
/**
 * Check and setup theme's default settings
 *
 * @package wbase
 *
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function setup_theme_default_settings() {

	// check if settings are set, if not set defaults.
	// Caution: DO NOT check existence using === always check with == .
	// Latest blog posts style.
	$wbase_posts_index_style = get_theme_mod( 'wbase_posts_index_style' );
	if ( '' == $wbase_posts_index_style ) :
		set_theme_mod( 'wbase_posts_index_style', 'default' );
	endif;

	// Sidebar position.
	$wbase_sidebar_position = get_theme_mod( 'wbase_sidebar_position' );
	if ( '' == $wbase_sidebar_position ) :
		set_theme_mod( 'wbase_sidebar_position', 'right' );
	endif;

	// Container width.
	$wbase_container_type = get_theme_mod( 'wbase_container_type' );
	if ( '' == $wbase_container_type ) :
		set_theme_mod( 'wbase_container_type', 'container' );
	endif;
}