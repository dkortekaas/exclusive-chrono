<?php
/**
 * The template for displaying all woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$container   = get_theme_mod( 'wbase_container_type' );
//$sidebar_pos = get_theme_mod( 'wbase_sidebar_position' );

$term_id = $wp_query->get_queried_object_id();
$post_id = 'product_cat_'.$term_id;
$cat_description = get_field('category_text', $post_id);
?>

<div id="main" role="main" class="clearfix">
	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
	<?php if ( is_plugin_active('LayerSlider/layerslider.php') ) : ?>
		<?php echo do_shortcode('[layerslider id="4"]'); ?>
	<?php endif; ?>
	<div class="sep-clear"></div>
	<section id="content">
		<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">
			<div class="row">
				<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>
				<main class="site-main fade-in" id="main">
					<?php if ( function_exists('yoast_breadcrumb') ) :
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					endif; ?>
					<?php if (is_single()) : ?>
					<h2 itemprop="name" class="product_title entry-title visible-xs"><?php the_title(); ?></h2>
					<?php endif; ?>
					<?php woocommerce_content(); ?>
					<?php if ( $cat_description ) : ?>
					<div class="category-description">
						<?php echo $cat_description; ?>
					</div>
					<?php endif; ?>
				</main>
				<?php get_template_part( 'global-templates/right-sidebar-check', 'none' ); ?>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>