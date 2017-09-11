<?php
/**
 * Left sidebar check.
 *
 * @package wbase
 */
?>
<div class="visible-xs visible-sm">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</div>

<?php {
	$html = '';
	$html = '<div class="';
	if ( is_active_sidebar( 'shop-sidebar' ) || is_active_sidebar( 'right-sidebar' ) ) {
		$html .= 'col-md-9 content-area" id="primary">';
	} else {
		$html .= 'col-md-12 content-area" id="primary">';
	}
	echo $html;
}
