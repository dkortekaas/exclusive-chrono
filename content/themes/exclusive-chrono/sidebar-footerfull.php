<?php
/**
 * Sidebar setup for footer full.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$container   = get_theme_mod( 'wbase_container_type' );
?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>
	<div class="wrapper" id="wrapper-footer-full">
		<div class="<?php echo esc_html( $container ); ?>" id="footer-full-content" tabindex="-1">
			<div class="row">
				<?php dynamic_sidebar( 'footerfull' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>