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
							<?php if ( is_cart() || is_checkout() ) :
								echo do_shortcode('[rev_slider alias="marketplace-slider"]');
							else :
								if ( get_field ('slider')) :
									echo do_shortcode(get_field ('slider'));
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
									<div class="title title-size-two">
										<div class="title-sep-container title-sep-container-left">
											<div class="title-sep sep-single sep-solid"></div>
										</div>
										<?php the_title( '<h1 class="title-heading-center" itemprop="name">', '</h1>' ); ?>
										<div class="title-sep-container title-sep-container-right">
											<div class="title-sep sep-single sep-solid"></div>
										</div>
									</div>
									<?php the_content(); ?>

									<?php if ( get_field ('category_id')) : ?>
									<div <?php post_class('landingproducts'); ?> id="post-<?php the_ID(); ?>">
										<div class="post-content">
											<div class="woocommerce columns-5">
												<ul class="products clearfix products-5">
												<?php
												$args = array(
													'posts_per_page' 		=> 999,
													'post_type'             => 'product',
													'post_status'           => 'publish',
													'meta_query'            => array(
														array(
															'key'           => '_visibility',
															'value'         => array('catalog', 'visible'),
															'compare'       => 'IN'
														)
													),
													'tax_query'             => array(
														array(
															'taxonomy'      => 'product_cat',
															'terms'         => get_field ('category_id'),
															'operator'      => 'IN'
														)
													)
												);
												$products = new WP_Query($args);

												while ( $products->have_posts() ) : $products->the_post(); 
												global $product;
												?>
													<li <?php post_class(); ?>>
														<div class="product-wrapper">
															<?php wbase_woocommerce_thumbnail(); ?>

															<div class="description-wrapper row">
																<?php
																$term_list = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
																$cat_id = (int)$term_list[0];	
																?>
																<div class="col-xs-4">
																	<?php
																		$terms = get_the_terms( $post->ID, 'product_cat' );
																		foreach ($terms  as $term  ) :
																			$wthumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
																			$image = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo-home');
																		endforeach;
																	?>
																	<a href="<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>" title="<?php echo $term->name; ?>">
																		<img src="<?php echo $image[0]; ?>" class="logo" />
																	</a>
																</div>
																<div class="col-xs-8">
																	<div class="title">
																		<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
																	</div>
																</div>

																<div class="col-xs-12">
																	<?php if ( $price_html = $product->get_price_html() ) : ?>
																		<span class="price"><?php echo $price_html; ?></span>
																	<?php endif; ?>
																</div>
															</div>
															<div class="product-buttons">
																<div class="product-buttons-container clearfix">
															<?php
															echo apply_filters( 'woocommerce_loop_add_to_cart_link',
																sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button product_type_simple add_to_cart_button ajax_add_to_cart">%s</a>',
																	esc_url( $product->add_to_cart_url() ),
																	esc_attr( isset( $quantity ) ? $quantity : 1 ),
																	esc_attr( $product->id ),
																	esc_attr( $product->get_sku() ),
																	esc_html( $product->add_to_cart_text() )
																),
																$product );

																$styles = '';
																if ( ( ! $product->is_purchasable() || ! $product->is_in_stock() ) && ! $product->is_type( 'external' ) ) {
																	$styles = ' style="float:none;max-width:none;text-align:center;"';
																}
																echo '<a href="' . get_permalink() . '" class="button show_details_button"' . $styles . '>' . esc_attr__( 'Details', 'wbase' ) . '</a>';
															?>
																</div>
															</div>
														</div>
												
													</li>
													<?php endwhile; ?>
													<?php wp_reset_query(); ?>
												</ul>
											</div>
										</div>
									</div>
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