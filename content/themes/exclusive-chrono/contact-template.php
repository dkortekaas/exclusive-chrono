<?php
/**
 * Template Name: Contact Page
 *
 * The template for displaying contact pages.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

?>

<?php get_template_part( 'global-templates/google', 'maps' ); ?>

<div id="main" role="main" class="clearfix">
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="post-content">
				<div class="container">
					<div class="row">
						<div class="layout-column">
							<div class="column-wrapper">
								<div class="title title title-size-two">
									<div class="title-sep-container title-sep-container-left">
										<div class="title-sep sep-single sep-solid"></div>
									</div>
									<h2 class="title-heading-center"><?php the_title(); ?></h2>
									<div class="title-sep-container title-sep-container-right">
										<div class="title-sep sep-single sep-solid"></div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="column-wrapper"></div>
							</div>
						</div>

						<div class="layout-column">
							<div class="column-wrapper">
								<?php the_content(); ?>
								<div class="sep-clear"></div>
								<div class="separator full-width-sep sep-none"></div>
								<div class="clearfix"></div>
								<div class="column-wrapper"></div>
							</div>
						</div>

						<div class="layout-column">
							<div class="column-wrapper">
								<div class="sep-clear"></div>
								<div class="separator full-width-sep sep-none"></div>
								<div class="clearfix"></div>
								<div class="column-wrapper">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<?php if(ICL_LANGUAGE_CODE=='en') :
						echo do_shortcode('[contact-form-7 id="25" title="Contact formulier"]');
					else :
						echo do_shortcode('[contact-form-7 id="5838" title="Contact formulier NL"]');
					endif; ?>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>