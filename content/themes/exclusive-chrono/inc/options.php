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

add_action( 'admin_menu', 'wbase_add_admin_menu' );
add_action( 'admin_init', 'wbase_display_options_init' );
add_action( 'admin_init', 'wbase_usp_options_init' );
add_action( 'admin_init', 'wbase_feature_options_init' );
add_action( 'admin_init', 'wbase_social_options_init' );
if ( class_exists( 'WooCommerce' ) ) :
	add_action( 'admin_init', 'wbase_woocommerce_options_init' );
endif;


/* Add Options page to menu */
function wbase_add_admin_menu() {
	add_submenu_page( 'themes.php', 'WBase', __( 'Theme options', 'wbase' ), 'manage_options', 'wbase', 'wbase_options_page' );
}


/* Register Display options */
function wbase_display_options_init() { 
	register_setting( 'displayOptions', 'wb_display_options' );

	add_settings_section(
		'wb_displayOptions_section', 
		__( 'Your section description', 'wbase' ), 
		'wb_display_options_section_callback', 
		'displayOptions'
	);

	add_settings_field( 
		'wb_text_field_0', 
		__( 'Settings field description', 'wbase' ), 
		'wb_text_field_0_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);

	add_settings_field( 
		'wb_copyright_footer', 
		__( 'Footer Copyright', 'wbase' ), 
		'wb_copyright_footer_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);

	add_settings_field( 
		'wb_text_field_1', 
		__( 'Settings field description', 'wbase' ), 
		'wb_text_field_1_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);

	add_settings_field( 
		'wb_checkbox_field_2', 
		__( 'Settings field description', 'wbase' ), 
		'wb_checkbox_field_2_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);

	add_settings_field( 
		'wb_radio_field_3', 
		__( 'Settings field description', 'wbase' ), 
		'wb_radio_field_3_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);

	add_settings_field( 
		'wb_select_field_5', 
		__( 'Settings field description', 'wbase' ), 
		'wb_select_field_5_render', 
		'displayOptions', 
		'wb_displayOptions_section' 
	);
}


function wbase_usp_options_init() { 
	register_setting( 'uspOptions', 'wb_usp_options' );

	add_settings_section(
		'wb_uspOptions_section', 
		__( 'Header USPs', 'wbase' ), 
		'wb_usp_options_section_callback', 
		'uspOptions'
	);

	add_settings_field( 
		'wb_usp_0', 
		__( 'USP 1', 'wbase' ), 
		'wb_usp_0_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);

	add_settings_field( 
		'wb_usp_1', 
		__( 'USP 2', 'wbase' ), 
		'wb_usp_1_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);

	add_settings_field( 
		'wb_usp_2', 
		__( 'USP 3', 'wbase' ), 
		'wb_usp_2_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);

	add_settings_field( 
		'wb_usp_3', 
		__( 'USP 4', 'wbase' ), 
		'wb_usp_3_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);

	add_settings_field( 
		'wb_usp_4', 
		__( 'USP 5', 'wbase' ), 
		'wb_usp_4_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);
	add_settings_field( 
		'wb_usp_5', 
		__( 'USP 6', 'wbase' ), 
		'wb_usp_5_render', 
		'uspOptions', 
		'wb_uspOptions_section' 
	);
}

/* Register Feature options */
function wbase_feature_options_init() { 
	register_setting( 'featureOptions', 'wb_feature_options' );

	add_settings_section(
		'wb_featureOptions_section', 
		__( 'Features', 'wbase' ), 
		'wb_feature_options_section_callback', 
		'featureOptions'
	);

	add_settings_field( 
		'wb_show_features', 
		__( 'Show features', 'wbase' ), 
		'wb_show_features_render', 
		'featureOptions', 
		'wb_featureOptions_section' 
	);
}


/* Register Social options */
function wbase_social_options_init() { 

	register_setting( 'socialOptions', 'wb_social_options' );

	add_settings_section(
		'wb_socialOptions_section', 
		__( 'Enter your social profiles', 'wbase' ), 
		'wb_social_options_section_callback', 
		'socialOptions'
	);

	add_settings_field( 
		'wb_footer_social_icons', 
		__( 'Social Media icons in Footer', 'wbase' ), 
		'wb_footer_social_icons_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_facebook_url', 
		__( 'Facebook URL', 'wbase' ), 
		'wb_facebook_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_twitter_url', 
		__( 'Twitter URL', 'wbase' ), 
		'wb_twitter_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_linkedin_url', 
		__( 'LinkedIn URL', 'wbase' ), 
		'wb_linkedin_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_googleplus_url', 
		__( 'Goolge+ URL', 'wbase' ), 
		'wb_googleplus_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);


	add_settings_field( 
		'wb_instagram_url', 
		__( 'Instagram URL', 'wbase' ), 
		'wb_instagram_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_pinterest_url', 
		__( 'Pinterest URL', 'wbase' ), 
		'wb_pinterest_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);

	add_settings_field( 
		'wb_youtube_url', 
		__( 'YouTube URL', 'wbase' ), 
		'wb_youtube_url_render', 
		'socialOptions', 
		'wb_socialOptions_section' 
	);	
}


/* Register WooCommerce options */
function wbase_woocommerce_options_init() { 

	register_setting( 'woocommerceOptions', 'wb_woocommerce_options' );

	add_settings_section(
		'wb_woocommerceOptions_section', 
		__( 'Woocommerce options', 'wbase' ), 
		'wb_woocommerce_options_section_callback', 
		'woocommerceOptions'
	);

	add_settings_field( 
		'wb_cutting_costs', 
		__( 'Cutting Costs', 'wbase' ), 
		'wb_cutting_costs_render', 
		'woocommerceOptions', 
		'wb_woocommerceOptions_section' 
	);

}


/* Render display Fields */
function wbase_text_field_0_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<input type='text' name='wb_display_options[wb_text_field_0]' value='<?php echo $options['wb_text_field_0']; ?>'>
	<?php
}

function wb_text_field_1_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<input type='text' name='wb_display_options[wb_text_field_1]' value='<?php echo $options['wb_text_field_1']; ?>'>
	<?php
}

function wb_checkbox_field_2_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<input type='checkbox' name='wb_display_options[wb_checkbox_field_2]' <?php checked( $options['wb_checkbox_field_2'], 1 ); ?> value='1'>
	<?php
}

function wb_radio_field_3_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<input type='radio' name='wb_display_options[wb_radio_field_3]' <?php checked( $options['wb_radio_field_3'], 0 ); ?> value='0'>
	<?php
}

function wb_copyright_footer_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<textarea cols='40' rows='5' name='wb_display_options[wb_copyright_footer]'><?php echo $options['wb_copyright_footer']; ?></textarea>
	<?php
}

function wb_select_field_5_render(  ) { 
	$options = get_option( 'wb_display_options' );
	?>
	<select name='wb_display_options[wb_select_field_5]'>
		<option value='1' <?php selected( $options['wb_select_field_5'], 1 ); ?>>Option 1</option>
		<option value='2' <?php selected( $options['wb_select_field_5'], 2 ); ?>>Option 2</option>
	</select>
	<?php
}


/* Render usp Fields */
function wb_usp_0_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_0]' value='<?php echo $options['wb_usp_0']; ?>'>
	<?php
}
function wb_usp_1_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_1]' value='<?php echo $options['wb_usp_1']; ?>'>
	<?php
}
function wb_usp_2_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_2]' value='<?php echo $options['wb_usp_2']; ?>'>
	<?php
}
function wb_usp_3_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_3]' value='<?php echo $options['wb_usp_3']; ?>'>
	<?php
}
function wb_usp_4_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_4]' value='<?php echo $options['wb_usp_4']; ?>'>
	<?php
}
function wb_usp_5_render(  ) { 
	$options = get_option( 'wb_usp_options' );
	?>
	<input type='text' class='regular-text' name='wb_usp_options[wb_usp_5]' value='<?php echo $options['wb_usp_5']; ?>'>
	<?php
}

/* Render features Fields */
function wb_show_features_render(  ) { 
	$options = get_option( 'wb_feature_options' );
	?>
	<input type='radio' name='wb_feature_options[wb_show_features]' <?php checked( $options['wb_show_features'], 1 ); ?> value='1'>
	<?php
}


/* Render Social Fields */
function wb_footer_social_icons_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='checkbox' name='wb_social_options[wb_footer_social_icons]' <?php checked( $options['wb_footer_social_icons'], 1 ); ?> value='1'>
	<?php
}

function wb_facebook_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_facebook_url]' value='<?php echo $options['wb_facebook_url']; ?>'>
	<?php
}

function wb_twitter_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_twitter_url]' value='<?php echo $options['wb_twitter_url']; ?>'>
	<?php
}

function wb_linkedin_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_linkedin_url]' value='<?php echo $options['wb_linkedin_url']; ?>'>
	<?php
}

function wb_googleplus_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_googleplus_url]' value='<?php echo $options['wb_googleplus_url']; ?>'>
	<?php
}

function wb_instagram_url_render(  ) {
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_instagram_url]' value='<?php echo $options['wb_instagram_url']; ?>'>
	<?php
}

function wb_pinterest_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_pinterest_url]' value='<?php echo $options['wb_pinterest_url']; ?>'>
	<?php
}

function wb_youtube_url_render(  ) { 
	$options = get_option( 'wb_social_options' );
	?>
	<input type='text' class='regular-text' name='wb_social_options[wb_youtube_url]' value='<?php echo $options['wb_youtube_url']; ?>'>
	<?php
}


/* Render Woocommerce Fields */
function wb_cutting_costs_render(  ) { 
	$options = get_option( 'wb_woocommerce_options' );
	?>
	<input type='text' name='wb_woocommerce_options[wb_cutting_costs]' value='<?php echo $options['wb_cutting_costs']; ?>'>
	<?php
}


/* Callback */
function wb_display_options_section_callback(  ) { 
	echo __( 'Display section description', 'wbase' );
}

function wb_usp_options_section_callback(  ) { 
	echo __( 'Enter USPs below', 'wbase' );
}

function wb_social_options_section_callback(  ) { 
	echo __( 'Social section description', 'wbase' );
}

function wb_feature_options_section_callback(  ) { 
	echo __( 'Features section description', 'wbase' );
}

function wb_woocommerce_options_section_callback(  ) { 
	echo __( 'Woocommerce section description', 'wbase' );
}


/* Page */
function wbase_options_page(  ) { 
	?>

	<div class="wrap">
     
		<h2>Theme Options</h2>
		<?php settings_errors(); ?>

		<?php
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
		?>
         
		<h2 class="nav-tab-wrapper">
    		<a href="?page=wbase&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Display Options', 'wbase' ) ?></a>
    		<a href="?page=wbase&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Social Options', 'wbase' ) ?></a>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<a href="?page=wbase&tab=woocommerce_options" class="nav-tab <?php echo $active_tab == 'woocommerce_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'WooCommerce Options', 'wbase' ) ?></a>
			<?php endif; ?>
		</h2>
         
        <form method="post" action="options.php">
 		<?php
		if( $active_tab == 'display_options' ) :
			//settings_fields( 'displayOptions' );
			//do_settings_sections( 'displayOptions' );

			settings_fields( 'uspOptions' );
			do_settings_sections( 'uspOptions' );

			//settings_fields( 'featureOptions' );
			//do_settings_sections( 'featureOptions' );
		elseif( $active_tab == 'woocommerce_options' ) :
			settings_fields( 'woocommerceOptions' );
			do_settings_sections( 'woocommerceOptions' );
        else :
			settings_fields( 'socialOptions' );
			do_settings_sections( 'socialOptions' );
        endif;

		submit_button();
		?>
        </form>

    </div>

	<?php
}
?>