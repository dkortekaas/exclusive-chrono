<?php
/**
 * WBase Theme Customizer
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'wbase_customize_register' ) ) :
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function wbase_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
endif;
add_action( 'customize_register', 'wbase_customize_register' );

if ( ! function_exists( 'wbase_theme_customize_register' ) ) :
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function wbase_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'wbase_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'wbase' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'wbase' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'wbase_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'wbase' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'wbase' ),
					'section'     => 'wbase_theme_layout_options',
					'settings'    => 'wbase_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'wbase' ),
						'container-fluid' => __( 'Full width container', 'wbase' ),
					),
					'priority'    => '10',
				)
			) );

		$wp_customize->add_setting( 'wbase_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wbase_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'wbase' ),
					'description' => __( "Set sidebar's default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.",
					'wbase' ),
					'section'     => 'wbase_theme_layout_options',
					'settings'    => 'wbase_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'wbase' ),
						'left'  => __( 'Left sidebar', 'wbase' ),
						'both'  => __( 'Left & Right sidebars', 'wbase' ),
						'none'  => __( 'No sidebar', 'wbase' ),
					),
					'priority'    => '20',
				)
			) );
	}
endif;
add_action( 'customize_register', 'wbase_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'wbase_customize_preview_js' ) ) :
	/**
	 * Setup JS integration for live previewing.
	 */
	function wbase_customize_preview_js() {
		wp_enqueue_script( 'wbase_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
endif;
add_action( 'customize_preview_init', 'wbase_customize_preview_js' );