<?php
/**
 * Left sidebar check.
 *
 * @package wbase
 */
?>

<div class="hidden-xs hidden-sm">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</div>

<?php {
	$html = '';
	$html = '<div class="';
	if ( is_active_sidebar( 'shop-sidebar' ) || is_active_sidebar( 'left-sidebar' ) ) {
		$html .= 'col-md-9 content-area" id="primary">';
	} else {
		$html .= 'col-md-12 content-area" id="primary">';
	}
	echo $html;
	// } elseif ( is_active_sidebar( 'right-sidebar' ) && is_active_sidebar( 'left-sidebar' ) ) {
	// 	$html = '<div class="';
	// 	if ( 'both' === $sidebar_pos ) {
	// 		$html .= 'col-md-6 content-area" id="primary">';
	// 	} else {
	// 		$html .= 'col-md-12 content-area" id="primary">';
	// 	}
	// 	echo $html;
	// } else {
	//     echo '<div class="col-md-12 content-area" id="primary">';
	// }
}
