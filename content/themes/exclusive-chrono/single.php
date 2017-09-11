<?php
/**
 * The template for displaying all single posts.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$container   = get_theme_mod( 'wbase_container_type' );
$sidebar_pos = get_theme_mod( 'wbase_sidebar_position' );
?>

<div class="wrapper" id="single-wrapper">
	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">
		<div class="row">
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>
			<main class="site-main" id="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'loop-templates/content', 'single' ); ?>
						<?php wbase_post_nav(); ?>
					<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				<?php endwhile; ?>
			</main>
		</div>
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
			<?php get_sidebar( 'right' ); ?>
		<?php endif; ?>
	</div>
</div>
</div>

<?php get_footer(); ?>