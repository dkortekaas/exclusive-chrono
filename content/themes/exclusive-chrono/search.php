<?php
/**
 * The template for displaying search results pages.
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

<?php 
echo '<pre>'; print_r( _get_cron_array() ); echo '</pre>';
?>
<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'wbase' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

					</header

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', 'search' );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main>

			<?php wbase_pagination(); ?>

		</div>

		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div>

</div>

</div>

<?php get_footer(); ?>