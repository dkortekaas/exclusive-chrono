<?php
/**
 * Disabe Default Dashboard Widgets
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function wbase_disable_default_dashboard_widgets() {
	global $wp_meta_boxes;

    // WP Default
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );        // Activity
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );       // At a Glance
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] ); // Recent Comments
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );  // Incoming Links
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );            // WordPress News
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );         // Quick Press
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );       // Recent Drafts

    // Plugins
	//unset( $wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now'] );   // BBPress
	//unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget''] );          // Yoast SEO
	//unset( $wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard'] );        // Gravity Forms
}
add_action( 'wp_dashboard_setup', 'wbase_disable_default_dashboard_widgets', 999 );


/**
 * Add a Support widget to the dashboard.
 */
function wbase_add_dashboard_support() {
    wp_add_dashboard_widget(
        'wbase_dashboard_support',          // Widget slug.
        'WBase Support',                    // Title.
        'wbase_support_dashboard_widget'    // Display function.
    );
}
add_action( 'wp_dashboard_setup', 'wbase_add_dashboard_support' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function wbase_support_dashboard_widget() {
	// Display Support mail link.
	echo __('Need Support? <a href="mailto:support@weblogiq.nl">Mail Us</a>', 'wbase');
}