<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'right-sidebar' ) ) :
	return;
endif;

$sidebar_pos = get_theme_mod( 'wbase_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
<?php else : ?>
<div class="col-md-4 widget-area" id="right-sidebar" role="complementary">
<?php endif; ?>

<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div>