<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and <header>
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/safari-pinned-tab.svg" color="#293149">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>">
	<meta name="msapplication-config" content="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicons/browserconfig.xml">
	<meta name="theme-color" content="#293149">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="header-wrapper">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container rel">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="navbar-brand hidden-lg">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
					</a>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="navbar-brand visible-lg lg">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
					</a>
				</div>
				<div class="header-icons hidden-xs">
					<div class="my-account">
					<?php if ( is_user_logged_in() ) : ?>
						<button class="dropdown-toggle hidden-xs" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<?php
								global $current_user;
								wp_get_current_user();
								echo get_avatar( $current_user->ID, 30 );
							?>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woocommerce'); ?>"><?php _e('My Account','woocommerce'); ?></a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo wp_logout_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Logout','woocommerce'); ?>"><?php _e('Logout','woocommerce'); ?></a></li>
						</ul>
					<?php else : ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login','woocommerce'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login.svg" width="32" height="32" alt="<?php _e('Login','woocommerce'); ?>"></a>
					<?php endif; ?>
					</div>
					<div class="mini-cart">
					<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
						$count = WC()->cart->cart_contents_count; ?>
						<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'wbase' ); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/shopcart.svg" width="32" height="32" alt="<?php _e('View your shopping cart','woocommerce'); ?>">
							<?php if ( $count > 0 ) : ?>
							<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
							<?php endif; ?>
						</a>
					<?php endif; ?>
					</div>
					<div class="languages">
					<?php
						$languages = icl_get_languages('skip_missing=0&orderby=code');
						if ( !empty( $languages ) ) :
							foreach ( $languages as $l ) :
								if(!$l['active']) echo '<a href="'.$l['url'].'">';
								echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
								if(!$l['active']) echo '</a>';
							endforeach;
						endif;
					?>
					</div>
					<?php echo do_shortcode('[wd_asp id=1]'); ?>
				</div>
			</div>
			<div class="container border-bottom">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<div class="header-icons hidden-sm hidden-md hidden-lg">
						<div class="my-account">
						<?php if ( is_user_logged_in() ) : ?>
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woocommerce'); ?>" title="<?php _e('My Account','woocommerce'); ?>" class="mob-btn visible-xs">
							<?php
								global $current_user;
								wp_get_current_user();
								echo get_avatar( $current_user->ID, 30 );
							?>						
							</a>
						<?php else : ?>
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login','woocommerce'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login.svg" width="32" height="32" alt="<?php _e('Login','woocommerce'); ?>"></a>
						<?php endif; ?>
						</div>
						<div class="mini-cart">
						<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
							$count = WC()->cart->cart_contents_count; ?>
							<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'wbase' ); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/shopcart.svg" width="32" height="32" alt="<?php _e('View your shopping cart','woocommerce'); ?>">
								<?php if ( $count > 0 ) : ?>
								<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
								<?php endif; ?>
							</a>
						<?php endif; ?>
						</div>
						<div class="languages">
						<?php
							$languages = icl_get_languages('skip_missing=0&orderby=code');
							if ( !empty( $languages ) ) :
								foreach ( $languages as $l ) :
									if(!$l['active']) echo '<a href="'.$l['url'].'">';
									echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
									if(!$l['active']) echo '</a>';
								endforeach;
							endif;
						?>
						</div>
					</div>
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'primary',
						'fallback_cb'     => false,
						'container'       => false,
						'depth' 		  => 1,
						'menu_class'      => 'nav navbar-nav',
						'menu_id'         => 'main-menu',
						'walker'          => new WP_Bootstrap_Navwalker(),
					));
					?>
				</div>
			</div>
		</nav>
		<div class="clearfix"></div>
	</header>