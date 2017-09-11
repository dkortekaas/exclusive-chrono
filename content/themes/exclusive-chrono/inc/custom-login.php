<?php
/**
 * Custom login setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wbase_custom_login_logo' ) ) :
function wbase_custom_login_logo() {
	$css = '';
	if ( WBASE_LOGIN_WEBLOGIQ == true ) :
		$css = '<style type="text/css">';
	        $css.= '.login h1 a {';
				$css .= 'background-image: url(' . get_parent_theme_file_uri( '/assets/images/login/weblogiq-wp-login.svg' ) .') !important;';
	            $css .= '-webkit-background-size: 110px !important;';
	            $css .= 'background-size: 110px !important;';
	            $css .= 'width: 110px !important;';
	            $css .= 'height: 110px !important;';
	        $css .= '}';
	    $css .= '</style>';
    else :
		$css = '<style type="text/css">';
			$css.= '.login h1 a {';
				$css .= 'background-image: url(' . get_parent_theme_file_uri( '/assets/images/login/bmc-wp-login.jpg' ) .') !important;';
	            $css .= '-webkit-background-size: 150px !important;';
	            $css .= 'background-size: 150px !important;';
	            $css .= 'width: 150px !important;';
	            $css .= 'height: 150px !important;';
	        $css .= '}';
	    $css .= '</style>';	
	endif;
    echo $css;
}
endif;
add_action( 'login_enqueue_scripts', 'wbase_custom_login_logo' );

if ( ! function_exists( 'wbase_custom_login_logo_url' ) ) :
function wbase_custom_login_logo_url() {
	if( WBASE_LOGIN_WEBLOGIQ == true ) :
		return "https://weblogiq.nl";
	else :
		return "https://www.bmcinternetmarketing.nl";
	endif;
}
endif;
add_filter( 'login_headerurl', 'wbase_custom_login_logo_url' );

if ( ! function_exists( 'wbase_custom_login_logo_url_title' ) ) :
function wbase_custom_login_logo_url_title() {
	if ( WBASE_LOGIN_WEBLOGIQ == true ) :
		return __('Developed by internetbureau Weblogiq','wbase');
	else :
		return __('Developed by BMC Internet Marketing','wbase');
	endif;
}
endif;
add_filter( 'login_headertitle', 'wbase_custom_login_logo_url_title' );