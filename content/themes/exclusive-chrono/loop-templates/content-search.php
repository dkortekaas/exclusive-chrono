<?php
/**
 * Search results partial template.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">

				<?php wbase_posted_on(); ?>

			</div>

		<?php endif; ?>

	</header>

	<div class="entry-summary">

		<?php the_excerpt(); ?>

	</div>

	<footer class="entry-footer">

		<?php wbase_entry_footer(); ?>

	</footer>

</article>