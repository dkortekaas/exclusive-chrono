<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$woocommerce_loop['columns'] = 3;

global $woocommerce_loop;


// Reset according to sidebar or fullwidth pages
if ( empty( $woocommerce_loop['columns'] ) ) {
	if ( is_shop() || is_product_category() || is_product_tag() || is_tax() ) {

		if ( is_shop() ) {
			//$woocommerce_loop['columns'] = Avada()->settings->get( 'woocommerce_shop_page_columns' );
			$woocommerce_loop['columns'] = 4;
		}
		if ( is_product_category() ||
			is_product_tag() ||
			is_tax()
		) {
			//$woocommerce_loop['columns'] = Avada()->settings->get( 'woocommerce_archive_page_columns' );
			$woocommerce_loop['columns'] = 4;
			//$columns = Avada()->settings->get( 'woocommerce_archive_page_columns' );
			$columns = 4;
		}

	}
}
?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="post-content">
        <div class="woocommerce columns-<?php echo $woocommerce_loop['columns']; ?>">
			<ul class="products clearfix products-<?php echo $woocommerce_loop['columns']; ?>">
