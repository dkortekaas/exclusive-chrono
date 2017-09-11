<?php
/**
 * Sidebar - hero setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php if ( is_active_sidebar( 'hero' ) ) : ?>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner" role="listbox">

		<?php dynamic_sidebar( 'hero' ); ?>

		</div>

			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

			<span class="carousel-control-prev-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php _e('Previous', 'wbase'); ?></span>

			</a>

			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

			<span class="carousel-control-next-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php _e('Next', 'wbase'); ?></span>

		</a>

	</div>

<?php endif; ?>

<script>
jQuery( ".carousel-item" ).first().addClass( "active" );
</script>