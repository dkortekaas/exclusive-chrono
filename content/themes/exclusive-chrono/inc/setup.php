<?php
/**
 * Theme basic setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

require get_template_directory() . '/inc/theme-settings.php';

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) :
	$content_width = 1170;
endif;

if ( ! function_exists( 'wbase_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function wbase_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'wbase', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'wbase' ),
			'top' => __( 'Top Menu', 'wbase' ),
			'footer' => __( 'Footer Menu', 'wbase' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Adding Thumbnail basic support
		add_theme_support( 'post-thumbnails' );

        // Add Image Sizes
		//@ https://developer.wordpress.org/reference/functions/add_image_size/
		add_image_size( 'brand-logo-home', 200, 90, true);
		add_image_size( 'product-image-home', 255, 191, true);
		add_image_size( 'product-image', 380, 285, true);
		add_image_size( 'brand-logo', 165, 110);
		add_image_size( 'testimonial', 45, 45);
		//add_image_size( 'brand-logo-home', 150, 78, true );					// 150 pixels wide by 78 pixels tall, hard crop mode
		//add_image_size( 'custom-size', 220, 220, array( 'left', 'top' ) ); 	// Hard crop left top

		// Adding support for Widget edit icons in customizer
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wbase_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the Wordpress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add excerpt to pages.
		add_post_type_support('page', 'excerpt');

		// Add WooCommerce Support
		add_theme_support( 'woocommerce');

		// Styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width
		add_editor_style('assets/css/editor-style.css' );

		// Check and setup theme default settings.
		setup_theme_default_settings();
	}
endif;
add_action( 'after_setup_theme', 'wbase_setup' );

if ( ! function_exists( 'wbase_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function wbase_custom_excerpt_more( $more ) {
		return '';
	}
}
add_filter( 'excerpt_more', 'wbase_custom_excerpt_more' );

if ( ! function_exists( 'wbase_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function wbase_all_excerpts_get_more_link( $post_excerpt ) {
		return $post_excerpt . ' [...]<p><a class="btn btn-secondary read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More...', 'wbase' ) . '</a></p>';
	}
}
add_filter( 'wp_trim_excerpt', 'wbase_all_excerpts_get_more_link' );

// 
if ( ! function_exists( 'wbase_add_title_to_attachment_image' ) ) :
	/**
	 * Adds a title to images
	 *
	 * @param string $attr Image's attributes.
	 * @param string $attachment Image's' attachment post.
	 *
	 * @return string
	 */
    function wbase_add_title_to_attachment_image( $attr, $attachment ) {
        if(esc_attr( $attachment->post_title )) :
            $attr['title'] = esc_attr( $attachment->post_title );
        endif;
        return $attr;
    }
endif;
add_filter( 'wp_get_attachment_image_attributes', 'wbase_add_title_to_attachment_image', 10, 2 );