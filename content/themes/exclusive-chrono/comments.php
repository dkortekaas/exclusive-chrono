<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) :
	return;
endif;
?>

<div class="comments-area" id="comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) :
					printf( esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'wbase' ), '<span>' . get_the_title() . '</span>' );
				else :
					printf(
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'wbase' ) ),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				endif;
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comment-navigation" id="comment-nav-above">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wbase' ); ?></h1>
				<?php if ( get_previous_comments_link() ) : ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wbase' ) ); ?></div>
				<?php endif;
					if ( get_next_comments_link() ) : ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wbase' ) ); ?></div>
				<?php endif; ?>
			</nav>
		<?php endif; ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comment-navigation" id="comment-nav-below">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wbase' ); ?></h1>
				<?php if ( get_previous_comments_link() ) : ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wbase' ) ); ?></div>
				<?php endif;
					if ( get_next_comments_link() ) : ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wbase' ) ); ?></div>
				<?php endif; ?>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wbase' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); ?>

</div>