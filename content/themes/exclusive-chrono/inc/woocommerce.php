<?php
/**
 * Add WooCommerce support
 *
 * @package wbase
 */

function loop_columns() {
return 5; // 5 products per row
}
add_filter('loop_shop_columns', 'loop_columns', 999);

//add_filter( 'woocommerce_show_page_title', 'shop_title', 10 );

//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//add_action( 'woocommerce_before_main_content', 'before_container', 10 );
//add_action( 'woocommerce_after_main_content', 'after_container', 10 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'add_sidebar', 10 );


/**
 * Products Loop.
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'wbase_woocommerce_add_product_wrappers_open', 30 );
//add_action( 'woocommerce_shop_loop_item_title', 'category_title', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'wbase_woocommerce_add_product_wrappers_close', 20 );

add_action( 'woocommerce_after_shop_loop_item', 'wbase_woocommerce_template_loop_add_to_cart', 10 );
add_action( 'wbase_woocommerce_buttons_on_rollover', 'wbase_woocommerce_rollover_buttons_linebreak', 15 );
add_action( 'woocommerce_after_shop_loop_item', 'show_details_button', 15 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'wbase_show_product_loop_outofstock_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wbase_woocommerce_before_shop_loop_item_title_open', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wbase_woocommerce_before_shop_loop_item_title_close', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'before_shop_item_buttons', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'wbase_woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'show_details_button', 15 );
add_action( 'woocommerce_after_shop_loop_item', 'after_shop_item_buttons', 20 );


/**
* Single Product Page
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'add_product_border', 19 );
add_action( 'woocommerce_single_product_summary', 'wbase_woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'wbase_woocommerce_stock_html', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
add_action( 'woocommerce_proceed_to_checkout', 'wbase_woocommerce_proceed_to_checkout', 10 );
//add_action( 'woocommerce_before_account_navigation', 'wbase_top_user_container', 10 );


if ( ! function_exists( 'wbase_woocommerce_support' ) ) :
	/**
	 * Declares WooCommerce theme support.
	 */
	function wbase_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		// hook in and customizer form fields.
		//add_filter( 'woocommerce_form_field_args', 'wbase_woocommerce_form_field_args', 10, 3 );
	}
endif;
add_action( 'after_setup_theme', 'wbase_woocommerce_support' );

/**
 * Filter hook function monkey patching form classes
 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
 *
 * @param string $args Form attributes.
 * @param string $key Not in use.
 * @param null   $value Not in use.
 *
 * @return mixed
 */
function wbase_woocommerce_form_field_args( $args, $key, $value = null ) {
	// Start field type switch case.
	switch ( $args['type'] ) :
		/* Targets all select input type elements, except the country and state select input types */
		case 'select' :
			// Add a class to the field's html element wrapper - woocommerce
			// input types (fields) are often wrapped within a <p></p> tag.
			$args['class'][] = 'form-group';
			// Add a class to the form input itself.
			$args['input_class']       = array( 'form-control', 'input-lg' );
			$args['label_class']       = array( 'control-label' );
			$args['custom_attributes'] = array(
				'data-plugin'      => 'select2',
				'data-allow-clear' => 'true',
				'aria-hidden'      => 'true',
				// Add custom data attributes to the form input itself.
			);
			break;
		// By default WooCommerce will populate a select with the country names - $args
		// defined for this specific input type targets only the country select element.
		case 'country' :
			$args['class'][]     = 'form-group single-country';
			$args['label_class'] = array( 'control-label' );
			break;
		// By default WooCommerce will populate a select with state names - $args defined
		// for this specific input type targets only the country select element.
		case 'state' :
			// Add class to the field's html element wrapper.
			$args['class'][] = 'form-group';
			// add class to the form input itself.
			$args['input_class']       = array( '', 'input-lg' );
			$args['label_class']       = array( 'control-label' );
			$args['custom_attributes'] = array(
				'data-plugin'      => 'select2',
				'data-allow-clear' => 'true',
				'aria-hidden'      => 'true',
			);
			break;
		case 'password' :
		case 'text' :
		case 'email' :
		case 'tel' :
		case 'number' :
			$args['class'][]     = 'form-group';
			$args['input_class'] = array( 'form-control', 'input-lg' );
			$args['label_class'] = array( 'control-label' );
			break;
		case 'textarea' :
			$args['input_class'] = array( 'form-control', 'input-lg' );
			$args['label_class'] = array( 'control-label' );
			break;
		case 'checkbox' :
			$args['label_class'] = array( 'custom-control custom-checkbox' );
			$args['input_class'] = array( 'custom-control-input', 'input-lg' );
			break;
		case 'radio' :
			$args['label_class'] = array( 'custom-control custom-radio' );
			$args['input_class'] = array( 'custom-control-input', 'input-lg' );
			break;
		default :
			$args['class'][]     = 'form-group';
			$args['input_class'] = array( 'form-control', 'input-lg' );
			$args['label_class'] = array( 'control-label' );
			break;
	endswitch;
	return $args;
}


/**
 * Custom Fields
 *
 */
add_action( 'woocommerce_product_options_general_product_data', 'wbase_woocommerce_add_custom_fields' );
add_action( 'woocommerce_process_product_meta', 'wbase_woocommerce_save_custom_fields' );
add_action( 'woocommerce_product_after_variable_attributes', 'wbase_variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'wbase_save_variation_settings_fields', 10, 2 );
add_filter( 'woocommerce_available_variation', 'wbase_load_variation_settings_fields' );
add_filter('woocommerce_cart_shipping_method_full_label', 'wbase_add_free_label', 10, 2);

// Add Delivery field
function wbase_woocommerce_add_custom_fields() {
	woocommerce_wp_text_input( array(
		'id' 			=> '_delivery_field',
		'label' 		=> __( 'Delivery', 'wbase' ),
		'description' 	=> __( 'Enter the delivery time in days.', 'wbase' ),
		'desc_tip' 		=> 'true'
	) );
}

// Save Delivery field
function wbase_woocommerce_save_custom_fields( $post_id ) {
	update_post_meta( $post_id, '_delivery_field', esc_attr( $_POST['_delivery_field'] ) );
}

// Add max width and length fields
function wbase_variation_settings_fields( $loop, $variation_data, $variation ) {
	// Max. length
	woocommerce_wp_text_input( 
		array( 
			'id'          		=> '_max_length[' . $variation->ID . ']', 
			'label'       		=> __( 'Max. length', 'wbbase' ), 
			'desc_tip'    		=> 'true',
			'description' 		=> __( 'Enter the maximum length here.', 'wbbase' ),
			'value'       		=> get_post_meta( $variation->ID, '_max_length', true ),
			'custom_attributes' => array(
							'step' 	=> 'any',
							'min'	=> '0'
						) 
		)
	);
	// Max. width
	woocommerce_wp_text_input( 
		array( 
			'id'          		=> '_max_width[' . $variation->ID . ']', 
			'label'       		=> __( 'Max. width', 'wbbase' ), 
			'desc_tip'    		=> 'true',
			'description' 		=> __( 'Enter the maximum width here.', 'wbbase' ),
			'value'       		=> get_post_meta( $variation->ID, '_max_width', true ),
			'custom_attributes' => array(
							'step' 	=> 'any',
							'min'	=> '0'
						) 
		)
	);
}

// Save max width and length fields
function wbase_save_variation_settings_fields( $post_id ) {
	// Max. length
	$max_length = $_POST['_max_length'][ $post_id ];
	if( ! empty( $max_length ) ) :
		update_post_meta( $post_id, '_max_length', esc_attr( $max_length ) );
	endif;
	// Max. width
	$max_width = $_POST['_max_width'][ $post_id ];
	if( ! empty( $max_width ) ) :
		update_post_meta( $post_id, '_max_width', esc_attr( $max_width ) );
	endif;
}

// Add New Variation Settings
function wbase_load_variation_settings_fields( $variations ) {
	// duplicate the line for each field
	$variations['max_length'] = get_post_meta( $variations[ 'variation_id' ], '_max_length', true );
	$variations['max_width'] = get_post_meta( $variations[ 'variation_id' ], '_max_width', true );

	return $variations;
}

//Add Free when shipping = 0
function wbase_add_free_label($label, $method) {
	if ($method->cost == 0) :
		$label .= __( 'Free', 'wbbase' );
	endif;
	return $label;
}



// Only for: Enhanced E-commerce for Woocommerce store
// if ( is_plugin_active( 'enhanced-e-commerce-for-woocommerce-store/woocommerce-enhanced-ecommerce-google-analytics-integration.php' ) ) :
// 	/**
// 	 * Enhanced E-commerce for Woocommerce store
// 	 * De id moet _wpmr hebben anders pakt de plugin het niet op.
// 	 * Er zijn nog enkele die ook werken maar _wpmr werkt voor custom post fields.
// 	 *
// 	 * @return mixed
// 	 */
// 	if ( ! function_exists( 'wbase_add_wpmr_ga_price' ) ) :
// 		function wbase_add_wpmr_ga_price() {
// 			global $woocommerce, $post;

// 			echo '<div class="options_group">';
// 				woocommerce_wp_text_input(
// 					array(
// 						'id'            => '_wpmr_ga_price',
// 						'label'         => __( 'GA Price', 'wbbase' ),
// 						'placeholder'   => '',
// 						'description'   => __( 'Enter the custom GA Price here.', 'wbbase' ),
// 						'type'          => 'number',
// 						'desc_tip'      => 'true',
// 						'custom_attributes' => array(
// 								'step' 	=> 'any',
// 								'min'	=> '0'
// 							)
// 					)
// 				);
// 			echo '</div>';
// 		}
// 	endif;
// 	add_action( 'woocommerce_product_options_general_product_data', 'wbase_add_wpmr_ga_price' );

// 	// Save WPMR GA_Price Field
// 	if ( ! function_exists( 'wbase_save_wpmr_ga_price' ) ) :
// 		function wbase_save_wpmr_ga_price( $post_id ) {
// 			$woocommerce_number_field = $_POST['_wpmr_ga_price'];
// 			if( !empty( $woocommerce_number_field ) ) :
// 				update_post_meta( $post_id, '_wpmr_ga_price', esc_attr( $woocommerce_number_field ) );
// 			endif;
// 		}
// 	endif;
// 	add_action( 'woocommerce_process_product_meta', 'wbase_save_wpmr_ga_price' );
// endif;


// // Only for: Table Rate Shipping Plugin
// if ( is_plugin_active( 'table-rate-shipping-for-woocommerce/mh-wc-table-rate.php' ) ) :
// 	add_filter( 'woocommerce_cart_shipping_method_full_label', 'wbase_woocommerce_remove_shipping_label', 10, 2 );
// 	add_filter( 'wpo_wcpdf_woocommerce_totals', 'wbase_woocommerce_totals', 10, 2 );

// 	// Remove Title Table Rate Shipping
// 	function wbase_woocommerce_remove_shipping_label($full_label, $method) {
//     	$full_label = str_replace("Staffel: ","",$full_label);
//     	$full_label = str_replace("Staffel","",$full_label);
//     	return $full_label;
// 	}

// 	// Remove the "via" text in shipping method
// 	function wbase_woocommerce_totals ( $totals, $order ) {
//     	if (!isset($totals['shipping'])) :
//         	return $totals;
//     	endif;

//     	$totals['shipping']['value'] =  substr($totals['shipping']['value'], 0, strpos( $totals['shipping']['value'], '<small'));
//     	return $totals;
// 	}
// endif;


/** PRODUCTS **/

/**
 * Adds the sidebar.
 */
function add_sidebar() {
	do_action( 'wbase_after_content' );
}

/**
 * Adds the linebreak where needed.
 */
function wbase_woocommerce_rollover_buttons_linebreak() {
	global $product; ?>
	<?php if ( $product && ( ( $product->is_purchasable() && $product->is_in_stock() ) || $product->is_type( 'external' ) ) ) : ?>
		<span class="fusion-rollover-linebreak">
			<?php echo ''; ?>
		</span>
	<?php endif;
}


/**
 * Adds a div that is used for borders.
 */
function add_product_border() {
	echo '<div class="product-border"></div>';
}


/**
 * Single Product Page functions.
 */
function wbase_woocommerce_template_single_title() {
	?>
	<h2 itemprop="name" class="product_title entry-title hidden-xs"><?php the_title(); ?></h2>
	<?php
}


/**
 * Add the availability HTML.
 */
function wbase_woocommerce_stock_html() {
	global $product;

	// Availability.
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
	?>
	<div class="wbase-availability">
		<?php echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product ); ?>
	</div>
	<?php
}


/**
 * Cart Page functions.
 */
function wbase_woocommerce_proceed_to_checkout() {
	?>
	<a href="" class="button button-default button-medium button default medium update-cart"><?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?></a>
	<?php
}


/**
 * Account Page functions.
 */
function wbase_top_user_container() {
	global $woocommerce, $current_user;
	?>
	<div class="wbase-myaccount-user">
		<span class="username">
			<?php if ( $current_user->display_name ) { ?>
				<span class="hello">
					<?php printf(
						__( 'Hello %1$s (not %2$s? %3$s)', 'wbase' ),
						'<strong>' . esc_html( $current_user->display_name ) . '</strong></span><span class="not-user">',
						esc_html( $current_user->display_name ),
						'<a href="' . esc_url( wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) ) ) . '">' . esc_attr__( 'Sign Out', 'wbase' ) . '</a>'
					); ?>
				</span>
			<?php } else { ?>
				<span class="hello"><?php esc_attr_e( 'Hello', 'wbase' ); ?></span>
			<?php } ?>

		</span>

		<span class="view-cart"><a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>"><?php esc_attr_e( 'View Cart', 'wbase' ); ?></a></span>
	</div>
	<?php
}

/**
 * Opens a div.
 */
function wbase_woocommerce_single_product_summary_open() {
	echo '<div class="summary-container">';
}
add_action( 'woocommerce_single_product_summary', 'wbase_woocommerce_single_product_summary_open', 1 );

/**
 * Closes the div.
 */
function wbase_woocommerce_single_product_summary_close() {
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'wbase_woocommerce_single_product_summary_close', 100 );

add_action( 'woocommerce_after_single_product_summary', 'wbase_woocommerce_after_single_product_summary', 15 );
/**
 * Markupo to add after the summary on single products.
 */
function wbase_woocommerce_after_single_product_summary() {

	$nofollow = ' rel="noopener noreferrer nofollow"';
	$social = '<div class="clearfix"></div>';
	if ( ! wp_is_mobile() ) {
		$facebook_url = 'http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . get_permalink() . '&p&#91;title&#93;=' . wp_strip_all_tags( get_the_title(), true );
	} else {
		$facebook_url = 'https://m.facebook.com/sharer.php?u=' . get_permalink();
	}

	$social .= '<ul class="social-share clearfix">
		<li class="facebook">
			<a href="' . $facebook_url . '" target="_blank"' . $nofollow . '>
				<i class="fontawesome-icon medium circle-yes fa fa-facebook"></i>
				<div class="woo-social-share-text"><span>' . __( 'Share On Facebook', 'wbase' ) . '</span></div>
			</a>
		</li>
		<li class="twitter">
			<a href="https://twitter.com/share?text=' . wp_strip_all_tags( get_the_title(), true ) . '&amp;url=' . urlencode( get_permalink() ) . '" target="_blank"' . $nofollow . '>
				<i class="fontawesome-icon medium circle-yes fa fa-twitter"></i>
				<div class="woo-social-share-text"><span>' . __( 'Tweet This Product', 'wbase' ) . '</span></div>
			</a>
		</li>
		<li class="pinterest">';
		$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$social .= '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( wp_strip_all_tags( get_the_title(), true ) ) . '&amp;media=' . urlencode( $full_image[0] ) . '" target="_blank"' . $nofollow . '>
				<i class="fontawesome-icon medium circle-yes fa fa-pinterest"></i>
				<div class="woo-social-share-text"><span>' . __( 'Pin This Product', 'wbase' ) . '</span></div>
			</a>
		</li>
		<li class="email">
			<a href="mailto:?subject=' . rawurlencode( html_entity_decode( wp_strip_all_tags( get_the_title(), true ), ENT_COMPAT, 'UTF-8' ) ) . '&body=' . get_permalink() . '" target="_blank"' . $nofollow . '>
				<i class="fontawesome-icon medium circle-yes fa fa-envelope-o"></i>
				<div class="woo-social-share-text"><span>' . __( 'Mail This Product', 'wbase' ) . '</span></div>
			</a>
		</li>
	</ul>';

	echo $social;
}


/**
 * Open wrapper divs.
 */
function wbase_woocommerce_add_product_wrappers_open() {
	?>
	<div class="description-wrapper row">
	<?php
}

/**
 * Renders the category title.
 */
function category_title() {
	$term_list = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
	$cat_id = (int)$term_list[0];
	?>
	<h1 class="category-title"><a href="<?php echo get_term_link($cat_id, 'product_cat'); ?>"><?php echo get_cat_name($cat_id); ?></a></h1>
	<?php
}

/**
 * Renders the product title.
 */
function product_title() {
	$term_list = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
	$cat_id = (int)$term_list[0];	
	?>
	<div class="col-xs-4">
		<?php
			$terms = get_the_terms( get_the_ID(), 'product_cat' );
			foreach ($terms  as $term  ) :
				$wthumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo-home');
			endforeach;
		?>
		<a href="<?php the_permalink(); ?>" title="<?php echo $term->name; ?>">
			<img src="<?php echo $image[0]; ?>" class="logo" />
		</a>
	</div>
	<div class="col-xs-8">
		<div class="title">
			<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
		</div>
	</div>
	<?php
}

/**
 * Closes previously opened wrappers.
 */
function wbase_woocommerce_add_product_wrappers_close() {
	?>
	</div>
	<?php
}	


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product_summary', 'wbase_woocommerce_output_related_products', 15 );
/**
 * Add related products.
 */
function wbase_woocommerce_output_related_products() {
	global $post;

	$number_of_columns = get_post_meta( $post->ID, 'pyre_number_of_related_products', true );
	if ( in_array( get_post_meta( $post->ID, 'pyre_number_of_related_products', true ), array( 'default', '' ) ) || ! get_post_meta( $post->ID, 'pyre_number_of_related_products', true ) ) :
		$number_of_columns = 4;
	endif;
	$terms = wp_get_post_terms( $post->ID, 'product_cat' );
	foreach ( $terms as $term ) $cats_array[] = $term->term_id;

	$args = array( 
		'post__not_in'	 	=> array( $post->ID ), 
		'posts_per_page' 	=> 3,
		'columns'        	=> 4,
		'orderby'        	=> 'rand',
		'post_status'		=> 'publish', 
		'post_type' 		=> 'product', 
		'tax_query' 		=> array( 
								array(
									'taxonomy' => 'product_cat',
									'field' => 'id',
									'terms' => $cats_array
								)
							)
	);	

	echo '<div class="clearfix"></div>';
	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'wbase_woocommerce_upsell_display', 10 );
/**
 * Displays upsells.
 */
function wbase_woocommerce_upsell_display() {
	global $product, $woocommerce_loop, $post;

	$upsells = $product->get_upsells();

	if ( count( $upsells ) == 0 ) {
		return;
	}
	?>
	<div class="clearfix"></div>
	<?php
	$number_of_columns = get_post_meta( $post->ID, 'pyre_number_of_related_products', true );
	if ( in_array( get_post_meta( $post->ID, 'pyre_number_of_related_products', true ), array( 'default', '' ) ) || ! get_post_meta( $post->ID, 'pyre_number_of_related_products', true ) ) {
		//$number_of_columns = Avada()->settings->get( 'woocommerce_related_columns' );
		$number_of_columns = 4;
	}
	woocommerce_upsell_display( - 1, $number_of_columns );
}


/**
 * Prints the out of stock warning.
 */
function wbase_show_product_loop_outofstock_flash() {
	global $product; ?>
	<?php if ( ! $product->is_in_stock() ) : ?>
		<div class="fusion-out-of-stock">
			<div class="fusion-position-text">
				<?php esc_attr_e( 'Out of stock', 'wbase' ); ?>
			</div>
		</div>
	<?php endif;
}


/**
 * Adds the link to permalink.
 */
function wbase_woocommerce_before_shop_loop_item_title_open() {
	?>
	<a href="<?php the_permalink(); ?>" class="product-images">
	<?php
}

/**
 * Closes the link.
 */
function wbase_woocommerce_before_shop_loop_item_title_close() {
	?>
	</a>
	<?php
}


/**
 * Content before the item buttons.
 */
function before_shop_item_buttons() {
	global $post;
	$html = '';
	$buttons_container = '<div class="product-buttons"><div class="product-buttons-container clearfix">';
	if ( isset( $_SERVER['QUERY_STRING'] ) ) {
		parse_str( $_SERVER['QUERY_STRING'], $params );
		if ( isset( $params['product_view'] ) ) {
			$product_view = $params['product_view'];
			if ( 'list' == $product_view ) {
				$html = '<div class="product-excerpt product-' . $product_view . '">';
				$html .= '<div class="product-excerpt-container">';
				$html .= '<div class="post-content">';
				$html .= do_shortcode( $post->post_excerpt );
				$html .= '</div>';
				$html .= '</div>';
				$html .= $buttons_container;
				$html .= ' </div>';

				echo $html;
			} else {
				echo $buttons_container;
			}
		} else {
			echo $buttons_container;
		}
	} else {
		echo $buttons_container;
	}
}


/**
 * Add to cart loop.
 */
function wbase_woocommerce_template_loop_add_to_cart( $args = array() ) {
	global $product;

	if ( $product && ( ( $product->is_purchasable() && $product->is_in_stock() ) || $product->is_type( 'external' ) ) ) {

		//if ( version_compare( self::get_wc_version(), '2.5', '>=' ) ) {

			$defaults = array(
				'quantity' => 1,
				'class'    => implode( ' ', array_filter( array(
					'button',
					'product_type_' . $product->product_type,
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
				) ) ),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
		//}

		wc_get_template( 'loop/add-to-cart.php' , $args );
	}
}


/**
 * Renders the "Details" button.
*/
function show_details_button() {
	global $product;

	$styles = '';
	if ( ( ! $product->is_purchasable() || ! $product->is_in_stock() ) && ! $product->is_type( 'external' ) ) {
		$styles = ' style="float:none;max-width:none;text-align:center;"';
	}
	echo '<a href="' . get_permalink() . '" class="button show_details_button"' . $styles . '>' . esc_attr__( 'Details', 'wbase' ) . '</a>';
}


/**
 * Closes 2 divs that were previously opened.
 */
function after_shop_item_buttons() {
	echo '</div></div>';
}








add_action( 'woocommerce_before_shop_loop_item_title', 'wbase_woocommerce_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
/**
 * Shows the product image.
 */
function wbase_woocommerce_thumbnail() {
	global $product, $woocommerce;

	$items_in_cart = array();

	if ( $woocommerce->cart && $woocommerce->cart->get_cart() && is_array( $woocommerce->cart->get_cart() ) ) {
		foreach ( $woocommerce->cart->get_cart() as $cart ) {
			$items_in_cart[] = $cart['product_id'];
		}
	}

	$id      = get_the_ID();
	$in_cart = in_array( $id, $items_in_cart );
	$size    = 'product-image-home';

	$attachment_image = '';
	//if ( Avada()->settings->get( 'woocommerce_disable_crossfade_effect' ) ) {
		// $gallery = get_post_meta( $id, '_product_image_gallery', true );

		// if ( ! empty( $gallery ) ) {
		// 	$gallery          = explode( ',', $gallery );
		// 	$first_image_id   = $gallery[0];
		// 	$attachment_image = wp_get_attachment_image( $first_image_id, $size, false, array( 'class' => 'hover-image' ) );
		// }
	//}
	$thumb_image = get_the_post_thumbnail( $id, $size );

	// if ( $attachment_image ) {
	// 	$classes = 'crossfade-images';
	// } else {
		$classes = 'featured-image';
	//}

	echo '<span class="' . $classes . '">';
	//echo $attachment_image;
	echo $thumb_image;
	if ( $in_cart ) {
		echo '<span class="cart-loading"><i class="icon-check-square-o"></i></span>';
	} else {
		echo '<span class="cart-loading"><i class="icon-spinner"></i></span>';
	}
	echo '</span>';
}


/**
 * Modifies the pagination.
 */
function change_pagination( $options ) {
	$options['prev_text'] 	= '<span class="page-prev"></span><span class="page-text">' . __( 'Previous', 'wbase' ) . '</span>';
	$options['next_text'] 	= '<span class="page-text">' . __( 'Next', 'wbase' ) . '</span><span class="page-next"></span>';
	$options['type']		= 'plain';

	return $options;
}

// Remove Coupon message
function woocommerce_rename_coupon_message_on_checkout() {
	return '';
}
add_filter( 'woocommerce_checkout_coupon_message', 'woocommerce_rename_coupon_message_on_checkout' );




/* begin checkout hooks */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_checkout_form', 'avada_woocommerce_checkout_coupon_form', 10 );
/**
 * Adds coupon form in the checkout page.
 *
 * @param array $args The form arguments.
 */
function avada_woocommerce_checkout_coupon_form( $args ) {
	global $woocommerce;

	if ( ! WC()->cart->coupons_enabled() ) {
		return;
	}
	?>

	<form class="woocommerce-content-box full-width checkout_coupon" method="post">

		<h2 class="promo-code-heading fusion-alignleft"><?php _e( 'Have A Promotional Code?', 'Avada' ); ?></h2>

		<div class="coupon-contents fusion-alignright">
			<div class="form-row form-row-first fusion-alignleft coupon-input">
				<input type="text" name="coupon_code" class="input-text"
				       placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value=""/>
			</div>

			<div class="form-row form-row-last fusion-alignleft coupon-button">
				<input type="submit" class="fusion-button button-default button-small button default small"
				       name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>"/>
			</div>

			<div class="clear"></div>
		</div>
	</form>
<?php
}

//if ( ! Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
	add_action( 'woocommerce_before_checkout_form', 'avada_woocommerce_before_checkout_form' );
//}
/**
 * Markup to add before the checkout form.
 *
 * @param array $args Not used in this context.
 */
function avada_woocommerce_before_checkout_form( $args ) {
	global $woocommerce;
	?>

	<ul class="woocommerce-side-nav woocommerce-checkout-nav">
		<li class="is-active">
			<a data-name="col-1" href="#">
				<?php _e( 'Billing Address', 'Avada' ); ?>
			</a>
		</li>
		<?php if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() ) : ?>
			<li>
				<a data-name="col-2" href="#">
					<?php _e( 'Shipping Address', 'Avada' ); ?>
				</a>
			</li>
		<?php
		elseif ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) :

			if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

				<li>
					<a data-name="col-2" href="#">
						<?php esc_attr_e( 'Additional Information', 'Avada' ); ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<li>
			<a data-name="order_review" href="#">
				<?php _e( 'Review &amp; Payment', 'Avada' ); ?>
			</a>
		</li>
	</ul>

	<div class="woocommerce-content-box avada-checkout">

<?php

}

//if ( ! Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
	add_action( 'woocommerce_after_checkout_form', 'avada_woocommerce_after_checkout_form' );
//}

/**
 * Closes the div after the checkout form.
 *
 * @param array $args The arguments (not used here).
 */
function avada_woocommerce_after_checkout_form( $args ) {
	echo '</div>';
}

//if ( Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
	add_action( 'woocommerce_checkout_before_customer_details', 'avada_woocommerce_checkout_before_customer_details' );
//}
/**
 * Markup to add before the customer details form.
 *
 * @param array $args The form arguments. Not used in the context of this function.
 */
function avada_woocommerce_checkout_before_customer_details( $args ) {
	global $woocommerce;

	if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() || apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) && ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) ) {
		return;
	} else {
		echo '<div class="avada-checkout-no-shipping">';
	}
}

//if ( Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
	add_action( 'woocommerce_checkout_after_customer_details', 'avada_woocommerce_checkout_after_customer_details' );
//}
/**
 * Adds markup after the customer details form.
 *
 * @param array $args The form arguments. Not used in the context of this function.
 */
function avada_woocommerce_checkout_after_customer_details( $args ) {
	global $woocommerce;

	if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() || apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) && ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) ) {
		echo '<div class="clearboth"></div>';
	} else {
		echo '<div class="clearboth"></div>';
	}
	//echo '<div class="woocommerce-content-box full-width">';
}


add_action( 'woocommerce_checkout_billing', 'avada_woocommerce_checkout_billing', 20 );
/**
 * Add checkout billing markup.
 *
 * @param array $args The form arguments. Not used in the context of this function.
 */
function avada_woocommerce_checkout_billing( $args ) {
	global $woocommerce;

	$data_name = 'order_review';
	if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() || apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) && ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) ) {
		$data_name = 'col-2';
	}

	//if ( ! Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
		?>

		<a data-name="<?php echo esc_attr( $data_name ); ?>" href="#"
		   class="fusion-button button-default button-medium  button default medium continue-checkout pull-right"><?php esc_attr_e( 'Continue', 'Avada' ); ?></a>
		<div class="clearboth"></div>
		<?php
	//}

}

add_action( 'woocommerce_checkout_shipping', 'avada_woocommerce_checkout_shipping', 20 );
/**
 * Add checkout shipping markup.
 *
 * @param array $args The form arguments. Not used in the context of this function.
 */
function avada_woocommerce_checkout_shipping( $args ) {

	//if ( ! Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
		?>
		<!--
		<a data-name="order_review" href="#"
		   class="fusion-button button-default button-medium continue-checkout button default medium"><?php //_e( 'Continue', 'Avada' ); ?></a>
		<div class="clearboth"></div>
		-->
		<?php
	//}

}

add_filter( 'woocommerce_enable_order_notes_field', 'avada_enable_order_notes_field' );
/**
 * Determines if we should enable order notes or not.
 *
 * @return bool
 */
function avada_enable_order_notes_field() {
	return 0;
}

//if ( Avada()->settings->get( 'woocommerce_one_page_checkout' ) ) {
	add_action( 'woocommerce_checkout_after_order_review', 'avada_woocommerce_checkout_after_order_review', 20 );
//}

/**
 * Closes the div.
 */
function avada_woocommerce_checkout_after_order_review() {
	echo '</div>';
}

// Function under myaccount hooks.
//remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
//add_action( 'woocommerce_thankyou', 'avada_woocommerce_view_order', 10 );
/* End checkout hooks */

/* Begin my-account hooks */

/**
 * Open a div if needed.
 */
function avada_woocommerce_before_customer_login_form() {
	global $woocommerce;
	if ( 'yes' !== get_option( 'woocommerce_enable_myaccount_registration' ) ) {
		echo '<div id="customer_login" class="woocommerce-content-box full-width">';
	}
}
add_action( 'woocommerce_before_customer_login_form', 'avada_woocommerce_before_customer_login_form' );

add_action( 'woocommerce_after_customer_login_form', 'avada_woocommerce_after_customer_login_form' );
/**
 * Markup to add after the customer-login form.
 */
function avada_woocommerce_after_customer_login_form() {
	global $woocommerce;
	if ( 'yes' !== get_option( 'woocommerce_enable_myaccount_registration' ) ) {
		echo '</div>';
	}
}
/* End my-account hooks */


add_action( 'woocommerce_cart_collaterals', 'avada_woocommerce_cart_collaterals', 5 );
/**
 * Adds coupon code form.
 *
 * @param array $args The formarguments.
 */
function avada_woocommerce_cart_collaterals( $args ) {
	global $woocommerce;
	?>
	<div class="shipping-coupon">
		<?php echo cart_shipping_calc(); ?>
		<?php if ( WC()->cart->coupons_enabled() ) : ?>
			<div class="coupon">
				<h2><?php esc_attr_e( 'Have A Promotional Code?', 'Avada' ); ?></h2>
				<input type="text" name="coupon_code" class="input-text" id="avada_coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
				<input type="submit" class="fusion-apply-coupon fusion-button fusion-button-default fusion-button-small button default small" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'Avada' ); ?>" />
				<?php do_action( 'woocommerce_cart_coupon' ); ?>
			</div>
		<?php endif; ?>
	</div>
<?php
}
/**
 * Adds shipping calculation markup & form.
 */
function cart_shipping_calc() {
	global $woocommerce;

	if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
		return;
	}
	?>

	<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

	<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

		<h2><span href="#" class="shipping-calculator-button"><?php _e( 'Calculate Shipping', 'woocommerce' ); ?></span>
		</h2>

		<div class="avada-shipping-calculator-form">

			<p class="form-row form-row-wide">
				<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
					<option value=""><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
					<?php
					foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					}
					?>
				</select>
			</p>

			<div class="<?php if ( Avada()->settings->get( 'avada_styles_dropdowns' ) ) : ?>avada-select-parent fusion-layout-column fusion-one-half fusion-spacing-yes<?php endif; ?>">
				<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );
				?>

				<?php if ( is_array( $states ) && empty( $states ) ) : // Hidden Input. ?>

					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county', 'woocommerce' ); ?>" />

				<?php elseif ( is_array( $states ) ) : // Dropdown Input. ?>

					<span>
						<select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county', 'woocommerce' ); ?>">
							<option value=""><?php _e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
							<?php
							foreach ( $states as $ckey => $cvalue ) {
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
							}
							?>
						</select>
					</span>

				<?php else : // Standard Input. ?>

					<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / county', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />

				<?php endif; ?>
			</div>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

				<p class="form-row form-row-wide">
					<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
				</p>

			<?php endif; ?>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

				<div class="form-row form-row-wide fusion-layout-column fusion-one-half fusion-spacing-yes fusion-column-last">
					<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
				</div>

			<?php endif; ?>

			<p>
				<button type="submit" name="calc_shipping" value="1" class="fusion-button button-default button-small button small default"><?php _e( 'Update Totals', 'woocommerce' ); ?></button>
			</p>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>

<?php
}

// Add previous and next links to products under the product details
function wc_next_prev_products_links() {
	echo '<div class="product-nav col-xs-12">';
    previous_post_link( '%link', __('Previous', 'wbase') );
	echo ' | ';
	next_post_link( '%link', __('Next','wbase') );
	echo '</div>';
}
add_action( 'woocommerce_after_single_product_summary', 'wc_next_prev_products_links', 5 );

function next_link_attributes($output) {
	$class = 'class="next"';
    return str_replace('<a href=', '<a '.$class.' href=', $output);
}
add_filter('next_post_link', 'next_link_attributes');

function prev_link_attributes($output) {
	$class = 'class="prev"';
    return str_replace('<a href=', '<a '.$class.' href=', $output);
}
add_filter('previous_post_link', 'prev_link_attributes');


// Display 12 products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// Disable Reviews
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count; ?>
		<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/shopcart.svg" width="32" height="32" alt="<?php _e('View your shopping cart','woocommerce'); ?>">
			<?php if ( $count > 0 ) : ?>
			<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
			<?php endif; ?>
		</a>
	<?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );


/**
 * Remove Quantity in all product type
 */
function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );

/**
 * Rename product tabs
 */
function wc_rename_tabs( $tabs ) {

	//$tabs['description']['title'] = __( 'More Information' );					// Rename the description tab
	//$tabs['reviews']['title'] = __( 'Ratings' );								// Rename the reviews tab
	$tabs['additional_information']['title'] = __( 'Specifications', 'wbase' );	// Rename the additional information tab

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wc_rename_tabs', 98 );