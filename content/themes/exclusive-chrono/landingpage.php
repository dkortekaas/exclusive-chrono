<?php
/**
 * Template Name: Landing Page
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<div id="main" role="main" class="clearfix">
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'loop-templates/content', 'landingpage' ); ?>
			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>