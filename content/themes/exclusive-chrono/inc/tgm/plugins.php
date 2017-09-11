<?php

function wbase_register_required_plugins() {

    $plugins = array(

        // PREMIUM Plugins - bundled 
        array(
            'name'               => 'WP Rocket', // The plugin name.
            'slug'               => 'wp-rocket', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/wp-rocket_2.9.6.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.9.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.            
        ),
        array(
            'name'               => 'Advanced Custom Fields PRO', // The plugin name.
            'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '5.5.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.            
        ),

		// Woocommerce combo only
        array(
            'name'               => 'WooCommerce Nice Urls', // The plugin name.
            'slug'               => 'woocommerce-nice-urls', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/woocommerce-nice-urls.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.            
        ),

		// WordPress Plugin Repository
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		array(
			'name'      => 'Yoast SEO',
			'slug'      => 'wordpress-seo',
			'required'  => true,
		),
		array(
			'name'      => 'ShortPixel Image Optimizer',
			'slug'      => 'shortpixel-image-optimiser',
			'required'  => false,
		),
		array(
			'name'      => 'Title and Nofollow For Links',
			'slug'      => 'title-and-nofollow-for-links',
			'required'  => true,
		),
		array(
			'name'      => 'Regenerate Thumbnails',
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),
		array(
			'name'      => 'Simple Page Ordering',
			'slug'      => 'simple-page-ordering',
			'required'  => true,
		),
		array(
			'name'      => 'Post Types Order',
			'slug'      => 'post-types-order',
			'required'  => true,
		),
		// Woocommerce combo only
		array(
			'name'      => 'Enhanced Ecommerce Google Analytics Plugin for WooCommerce',
			'slug'      => 'enhanced-e-commerce-for-woocommerce-store',
			'required'  => false,
		),		
		
    );

    $config = array(
        'id'                => 'baseframework',
        'default_path'      => '',
        'parent_slug'       => 'themes.php',
        'menu'              => 'tgmpa-install-plugins',
        'has_notices'       => true,
        'is_automatic'      => true
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wbase_register_required_plugins' );