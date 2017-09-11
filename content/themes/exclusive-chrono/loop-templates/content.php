<?php
/**
 * Post rendering content according to caller of get_template_part.
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

	<?php echo get_the_post_thumbnail( $post->ID, 'large', array('itemprop' => 'image') ); ?>

	<div class="entry-content" itemprop="mainContentOfPage">

		<?php the_excerpt(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'wbase' ),
			'after'  => '</div>',
		) );
		?>

	</div>

	<footer class="entry-footer">

		<?php wbase_entry_footer(); ?>

	</footer>

</article>