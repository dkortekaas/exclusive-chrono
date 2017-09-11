<?php
/**
 * Custom posts setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Portfolio.
 */
//add_action( 'init', 'wbase_create_portfolio_post_type' );
//add_action( 'init', 'wbase_create_portfolio_taxonomy' );

/**
 * Testimonial.
 */
add_action( 'init', 'wbase_create_testimonial_post_type' );


if ( ! function_exists( 'wbase_create_portfolio_post_type' ) ) :
	/**
 	 * Portfolio post type.
 	 */
	function wbase_create_portfolio_post_type() {

		$labels = array(
			'name' 					=> __('Portfolio', 'wbase'),
			'singular_name' 		=> __('Portfolio Item', 'wbase'),
			'add_new' 				=> __('Add New', 'wbase'),
			'add_new_item' 			=> __('Add New Portfolio item', 'wbase'),
			'edit_item' 			=> __('Edit Portfolio item', 'wbase'),
			'new_item' 				=> __('New Portfolio item', 'wbase'),
			'all_items' 			=> __('All Portfolio items', 'wbase'),
			'view_item' 			=> __('View Portfolio item', 'wbase'),
			'search_items' 			=> __('Search Portfolio item', 'wbase'),
			'not_found' 			=> __('No Portfolio item found', 'wbase'),
			'not_found_in_trash' 	=> __('No Portfolio item found in Trash', 'wbase'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> __('Portfolio', 'wbase'),
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'exclude_from_search' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'show_in_nav_menus' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> true, 
			'hierarchical' 			=> true,
			'menu_position' 		=> 4,
			'menu_icon'				=> 'dashicons-portfolio',
			'supports' 				=> array('title', 'editor', 'thumbnail'),
			'rewrite' 				=> array('slug' => 'portfolio-item'),
			'with_front' 			=> false
		);
	
		register_post_type('portfolio',$args);
	}
endif;


if ( ! function_exists( 'wbase_create_portfolio_taxonomy' ) ) :
	/**
 	 * Portfolio post type.
 	 */
	function wbase_create_portfolio_taxonomy() {
		
		$labels = array(
			'name'                       => __('Portfolio Categories', 'wbase'),
			'singular_name'              => __('Portfolio Category', 'wbase'),
			'search_items'               => __('Search Portfolio Categories', 'wbase'),
			'popular_items'              => __('Popular Portfolio Categories', 'wbase'),
			'all_items'                  => __('All Portfolio Categories', 'wbase'),
			'edit_item'                  => __('Edit Portfolio Category', 'wbase'),
			'update_item'                => __('Update Portfolio Category', 'wbase'),
			'add_new_item'               => __('Add New Portfolio Category', 'wbase'),
			'new_item_name'              => __('New Portfolio Category Name', 'wbase'),
			'separate_items_with_commas' => __('Separate Portfolio Categories with commas', 'wbase'),
			'add_or_remove_items'        => __('Add or remove Portfolio Categories', 'wbase'),
			'choose_from_most_used'      => __('Choose from the most used Portfolio Categories', 'wbase'),
			'not_found'                  => __('No Portfolio Category found.', 'wbase'),
			'menu_name'                  => __('Portfolio Categories', 'wbase'),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'portfolio-category' ),
		);

		register_taxonomy("portfolio_categories", "portfolio", $args);
}
endif;

/**
 * Testimonial.
 */
if ( ! function_exists( 'wbase_create_testimonial_post_type' ) ) :
	/**
 	 * Testimonial post type.
 	 */
	function wbase_create_testimonial_post_type() {

		$labels = array(
			'name' 					=> __('Testimonials', 'wbase'),
			'singular_name' 		=> __('Testimonial', 'wbase'),
			'add_new' 				=> __('Add New', 'wbase'),
			'add_new_item' 			=> __('Add New Testimonial', 'wbase'),
			'edit_item' 			=> __('Edit Testimonial', 'wbase'),
			'new_item' 				=> __('New Testimonial', 'wbase'),
			'all_items' 			=> __('All Testimonials', 'wbase'),
			'view_item' 			=> __('View Testimonial', 'wbase'),
			'search_items' 			=> __('Search Testimonial', 'wbase'),
			'not_found' 			=> __('No Testimonial found', 'wbase'),
			'not_found_in_trash' 	=> __('No Testimonial found in Trash', 'wbase'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> __('Testimonials', 'wbase'),
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'exclude_from_search' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'show_in_nav_menus' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> true, 
			'hierarchical' 			=> true,
			'menu_position' 		=> 20,
			'menu_icon'				=> 'dashicons-testimonial',
			'supports' 				=> array('title', 'editor', 'thumbnail'),
			'rewrite' 				=> array('slug' => 'testimonial'),
			'with_front' 			=> false
		);
	
		register_post_type('testimonial',$args);
	}
endif;