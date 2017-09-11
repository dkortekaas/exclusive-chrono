<?php
/**
 * Declaring widgets
 *
 * @package wbase
 */

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function wbase_count_widgets( $sidebar_id ) {
	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;
	
	$sidebars_widgets_count = $_wp_sidebars_widgets;
	
	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
			// Four widgets er row if there are exactly four or more than six
			$widget_classes .= ' col-sm-3';
		elseif ( 6 == $widget_count ) :
			// If two widgets are published
			$widget_classes .= ' col-sm-2';
		elseif ( $widget_count >= 3 ) :
			// Three widgets per row if there's three or more widgets 
			$widget_classes .= ' col-sm-4';
		elseif ( 2 == $widget_count ) :
			// If two widgets are published
			$widget_classes .= ' col-sm-6';
		elseif ( 1 == $widget_count ) :
			// If just on widget is active
			$widget_classes .= ' col-sm-12';
		endif; 
		return $widget_classes;
	endif;
}


if ( ! function_exists( 'wbase_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function wbase_widgets_init() {
		// Set up our array of widgets
		$widgets = array(
			__( 'Left Sidebar', 'wbase' ) => 'left-sidebar',
			__( 'Right Sidebar', 'wbase' ) => 'right-sidebar',
			__( 'Shop Sidebar', 'wbase' ) => 'shop-sidebar',
			__( 'Footer Sidebar 1', 'wbase' ) => 'footer-1',
			__( 'Footer Sidebar 2', 'wbase' ) => 'footer-2',
			__( 'Footer Sidebar 3', 'wbase' ) => 'footer-3',
			__( 'Footer Sidebar 4', 'wbase' ) => 'footer-4',
			__( 'Footer Full', 'wbase' ) => 'footerfull'
		);
		
		// Loop through them to create our widget areas
		foreach ( $widgets as $widget => $id ) :
			if ( $id == 'statichero' ) :
				$before_widget 	= '<div id="%1$s" class="static-hero-widget %2$s '. wbase_count_widgets( 'statichero' ) .'">';
				$after_widget 	= '</div>';
			elseif ( $id == 'footerfull' ) :
				$before_widget 	= '<div id="%1$s" class="footer-widget %2$s '. wbase_count_widgets( 'footerfull' ) .'">';
				$after_widget 	= '</div>';
			elseif ( $id == 'shop-sidebar' ) :
				$before_widget 	= '<aside id="%1$s" class="widget col-md-3 %2$s">';
				$after_widget 	= '</aside>';
			else :
				$before_widget 	= '<aside id="%1$s" class="widget %2$s">';
				$after_widget 	= '</aside>';
			endif;

			register_sidebar( array(
				'name'			=> $widget,
				'id'            => $id,
				'before_widget'	=> $before_widget,
				'after_widget'	=> $after_widget,
				'before_title'	=> apply_filters( 'generate_start_widget_title', '<div class="title title-size-two"><h2 class="title-heading-left">' ),
				'after_title'	=> apply_filters( 'generate_end_widget_title', '</h2><div class="title-sep-container"><div class="title-sep sep-double"></div></div></div>' ),
			) );
		endforeach;
	}
}
add_action( 'widgets_init', 'wbase_widgets_init' );