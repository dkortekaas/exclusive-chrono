<?php
/**
 * WBase enqueue scripts and styles
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wbase_enqueue_styles' ) ) :
	/**
	 * Load theme's CSS sources.
	 */
	function wbase_enqueue_styles() {
		// Get the theme data.
		$the_theme = wp_get_theme();

		$query_args = array(
			'family' => 'Open+Sans:400,600,700',
			'subset' => 'latin,latin-ext',
		);
		wp_enqueue_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
		wp_enqueue_style( 'exclusive-chrono-style', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), $the_theme->get( 'Version' ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'wbase_enqueue_styles' );


if ( ! function_exists( 'wbase_enqueue_scripts' ) ) :
	/**
	 * Load theme's JavaScript sources.
	 */
	function wbase_enqueue_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'exclusive-chrono-scripts', get_template_directory_uri() . '/assets/js/theme.min.js', array('jquery'), $the_theme->get( 'Version' ), true );
		//wp_enqueue_script( 'exclusive-chrono-scripts', get_template_directory_uri() . '/assets/js/excl-chrono.min.js', array('jquery'), $the_theme->get( 'Version' ), true );		
		wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), $the_theme->get( 'Version' ), true );
		//wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), $the_theme->get( 'Version' ), true );
		
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array(), $the_theme->get( 'Version' ), false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'excanvas', get_template_directory_uri() . '/assets/js/excanvas.js', array(), $the_theme->get( 'Version' ), false );
		wp_script_add_data( 'excanvas', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'woocommerce-js', get_template_directory_uri() . '/assets/js/woocommerce.js', array('jquery'), $the_theme->get( 'Version' ), true );


		// Conditional loading for older IE versions.
		wp_register_script( 'avada-ie9',  get_template_directory_uri() . '/assets/js/avada-ie9.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'avada-ie9' );
		wp_script_add_data( 'avada-ie9', 'conditional', 'IE 9' );

		wp_register_script( 'avada-ie8',  get_template_directory_uri() . '/assets/js/respond.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'avada-ie8' );
		wp_script_add_data( 'avada-ie8', 'conditional', 'lt IE 9' );

		wp_register_script( 'html5shiv',  get_template_directory_uri() . '/assets/js/html5shiv.js', array(), $the_theme->get( 'Version' ), false );
		wp_enqueue_script( 'html5shiv' );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		wp_register_script( 'excanvas',  get_template_directory_uri() . '/assets/js/excanvas.js', array(), $the_theme->get( 'Version' ), false );
		wp_enqueue_script( 'excanvas' );
		wp_script_add_data( 'excanvas', 'conditional', 'lt IE 9' );

		wp_register_script( 'avada-ie8',  get_template_directory_uri() . '/assets/js/avada-ie8.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'avada-ie8' );
		wp_script_add_data( 'avada-ie8', 'conditional', 'lt IE 9' );



    	if(is_page('Contact')) :
			wp_enqueue_script( 'gmaps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDtUzjL6cHfs4zlmqULOLtqH1g8fuflTKE', array('jquery'), $the_theme->get( 'Version' ), true );
    	endif;
		// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		// 	wp_enqueue_script( 'comment-reply' );
		// endif;
	}
endif;
add_action( 'wp_enqueue_scripts', 'wbase_enqueue_scripts' );


// Admin
if ( ! function_exists( 'wbase_enqueue_admin_scripts' ) ) :
	/**
	 * Load theme's CSS sources.
	 */
	function wbase_enqueue_admin_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();
    	//wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.min.css', array(), $the_theme->get( 'Version' ) );
		wp_enqueue_script('admin_script', get_template_directory_uri() . '/assets/js/chrono-admin.js', array(), $the_theme->get( 'Version' ) );
	}
endif;
add_action('admin_enqueue_scripts', 'wbase_enqueue_admin_scripts');