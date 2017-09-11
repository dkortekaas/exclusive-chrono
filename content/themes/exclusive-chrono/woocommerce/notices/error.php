<?php
/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>
<ul class="woocommerce-error">
	<?php foreach ( $messages as $message ) : ?>
		<?php if (strpos($message, 'PAY-0') !== false) : ?>
			<li><?php _e('Orders over € 10,000.00 by bank transfer only, for other payment methods please contact us.', 'wbase'); ?></li>
    	<?php else : ?>
			<li><?php echo wp_kses_post( $message ); ?></li>
		<?php endif;?>
	<?php endforeach; ?>
</ul>