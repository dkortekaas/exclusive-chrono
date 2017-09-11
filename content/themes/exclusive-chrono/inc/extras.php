<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wbase_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function wbase_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) :
			$classes[] = 'group-blog';
		endif;
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) :
			$classes[] = 'hfeed';
		endif;

		return $classes;
	}
endif;
add_filter( 'body_class', 'wbase_body_classes' );

if ( ! function_exists( 'wbase_adjust_body_class' ) ) :
	/**
	 * Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function wbase_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) :
			if ( 'tag' == $value ) :
				unset( $classes[ $key ] );
			endif;
		endforeach;

		return $classes;

	}
endif;
add_filter( 'body_class', 'wbase_adjust_body_class' );

if ( ! function_exists( 'wbase_change_logo_class' ) ) :
	/**
	 * Filter custom logo with correct classes.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function wbase_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-responsive"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"' , $html );

		return $html;
	}
endif;
add_filter( 'get_custom_logo', 'wbase_change_logo_class' );


/**
 * 
 */
if ( ! function_exists( 'wbase_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @return mixed
	 */
	function wbase_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) :
			return;
		endif;
		?>

		<div class="row">
			<div class="col-md-12">
				<nav class="navigation post-navigation">
					<h2 class="sr-only"><?php _e( 'Post navigation', 'wbase' ); ?></h2>
					<div class="nav-links">
						<?php
							if ( get_previous_post_link() ) :
								previous_post_link( '<span class="nav-previous float-xs-left">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'wbase' ) );
							endif;
							if ( get_next_post_link() ) :
								next_post_link( '<span class="nav-next float-xs-right">%link</span>',     _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'wbase' ) );
							endif;
						?>
					</div>
				</nav>
			</div>
		</div>
		<?php
	}
endif;