<?php
/**
 * Partial template for content in page.php
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="post-content">
			<div class="container">
				<div class="row">

					<div class="layout-column">
						<div class="column-wrapper">
							<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
							<?php if ( is_plugin_active('LayerSlider/layerslider.php') ) : ?>

								<?php if ( is_cart() || is_checkout() ) :
									echo do_shortcode('[layerslider id="4"]');
								else :
									if ( get_field ('slider')) :
										echo do_shortcode(get_field ('slider'));
									endif;
								endif;
							endif; ?>
							<div class="sep-clear"></div>
							<div class="separator sep-none"></div>

							<div class="row">
								<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
								<div class="col-sm-8">
								<?php else : ?>
								<div class="col-sm-12">
								<?php endif; ?>
								<?php if (!is_page( array( 'legal', 'voorwaarden' ))) : ?>
									<div class="title title-size-two">
										<div class="title-sep-container title-sep-container-left">
											<div class="title-sep sep-single sep-solid"></div>
										</div>
										<?php the_title( '<h2 class="title-heading-center" itemprop="name">', '</h2>' ); ?>
										<div class="title-sep-container title-sep-container-right">
											<div class="title-sep sep-single sep-solid"></div>
										</div>
									</div>
								<?php endif; ?>
									<?php the_content(); ?>

									<?php if( have_rows('usps') ):
										$total = 0;
										$total = count( get_field('usps') );
										$totalrec = floor($total)/2;
										$counter = 0;
									 ?>
										<ul class="usps col-md-6">
										<?php while( have_rows('usps') ): the_row(); 
											$link = get_sub_field('text');
											?>
											<li class="usp">
												<?php the_sub_field('text'); ?>
											</li>
											<?php $counter++; ?>
											<?php if ( $counter == $totalrec ) : ?>
												</ul>
												<ul class="usps  col-md-6">
											<?php endif; ?>
										<?php endwhile; ?>
										</ul>
									<?php endif; ?>
								</div>
								<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
									<?php get_sidebar( 'right' ); ?>
								<?php endif; ?>
							</div>

							<div class="sep-clear"></div>

							<?php get_template_part( 'global-templates/logo', 'carousel' ); ?>

							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>