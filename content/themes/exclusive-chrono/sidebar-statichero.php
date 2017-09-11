<?php
/**
 * Static hero sidebar setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$container   = get_theme_mod( 'uwbase_container_type' );
?>

<?php if ( is_active_sidebar( 'statichero' ) ) : ?>

	<div class="wrapper" id="wrapper-static-hero">

		<div class="<?php echo esc_html( $container ); ?>" id="wrapper-static-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'statichero' ); ?>

			</div>

		</div>

	</div>

<?php endif; ?>