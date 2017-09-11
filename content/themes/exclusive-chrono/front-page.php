<?php
/**
  * The template for displaying the homepage.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

		<div class="flexslider">
			<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
			<?php if ( is_plugin_active('LayerSlider/layerslider.php') ) : ?>		
				<?php if ( get_field ('slider')) :
				echo do_shortcode(get_field ('slider'));
				endif; ?>
			<?php endif; ?>
            <div class="scroll">
                <div class="mouse">
                    <div class="wheel"></div>
                </div>
            </div>
        </div>

		<div class="visible-xs">
			<?php echo do_shortcode('[wd_asp id=1]'); ?>
		</div>

        <div id="main" class="clearfix width-100">
            <div id="content" class="full-width">

                <div class="post-content">
					<div class="chrono-title title chrono-title-center">
						<div class="title-sep-container title-sep-container-left">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
						<h2 class="title-heading-center"><?php the_title(); ?></h2>
						<div class="title-sep-container title-sep-container-right">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
					</div>
                    <?php the_content(); ?>
                </div>

				<div class="container partners">
					<div class="row">
						<div class="col-sm-6 partner">
							<p><?php _e('Trusted seller', 'wbase'); ?></p>
							<a rel="nofollow" target="_blank" href="http://www.chrono24.com/en/dealer/svenotten/liste.htm?dosearch=1&searchexplain=1&watchTypeId=U&MVAL=&MODEL=&SEARCH_PMIN=0&SEARCH_PMAX=0&SEARCH_PCURR=USD&SORTORDER=1&STARTSEARCH=Display+offers"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/chrono24.png" alt="Chrono24" /></a>
						</div>
						<div class="col-sm-6 partner">
							<p><?php _e('Insured shipments by', 'wbase'); ?></p>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dhl.png" alt="DHL" />
						</div>						
					</div>
				</div>

                <div id="brands" class="fullwidth">
					<div class="chrono-title title chrono-title-center">
						<div class="title-sep-container title-sep-container-left">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
						<h2 class="title-heading-center"><?php _e('Browse Brands', 'wbase') ?></h2>
						<div class="title-sep-container title-sep-container-right">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
					</div>
                    <div class="container">
                        <div class="row ">
                            <div class="col-xs-12">
                                <ul class="brands-holder row">
									<?php 
									$wcatTerms = get_terms('product_cat', array('hide_empty' => 0 ));
									$counter = 0;
									foreach($wcatTerms as $wcatTerm) :
										$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
										if ( $wthumbnail_id > 0 ) :
											$image = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo-home'); ?>
												<li class="brand-item col-xs-6 col-md-3">
													<a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>" title="<?php echo $wcatTerm->name; ?>">
														<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" class="aligncenter" />
													</a>
												</li>
											<?php $counter++;
										endif;
									endforeach; ?>
									<?php wp_reset_query(); ?>
                                </ul>
								<div class="button-well">
									<div id="loadMore" class="btn btn-home"><?php _e('Load more', 'wbase'); ?></div>
								</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="new-arrivals" class="fullwidth">
                    <div class="chrono-title title chrono-title-center">
                        <div class="title-sep-container title-sep-container-left">
                            <div class="title-sep sep-single sep-solid"></div>
                        </div>
                        <h2 class="title-heading-center"><?php _e('New Arrivals', 'wbase') ?></h2>
                        <div class="title-sep-container title-sep-container-right">
                            <div class="title-sep sep-single sep-solid"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="carousel-holder row">
								<?php
									$args = array( 
										'post_type' => 'product',
										'posts_per_page' => 4,
										'orderby' =>'publish_date',
										'order' => 'DESC',
										'meta_query' => array(
            								array(
                								'key' => '_stock_status',
                								'value' => 'instock'
            								)
										)
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
										<li class="carousel-item col-sm-6 col-md-3">
											<div class="product-wrapper">
												<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'product-image-home'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>
												</a>
												<div class="description-wrapper row">
													<div class="col-xs-4">
														<?php
															$terms = get_the_terms( $post->ID, 'product_cat' );
															foreach ($terms  as $term  ) :
																$wthumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
																$image = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo-home');
															endforeach;
														?>
														<a href="<?php the_permalink(); ?>" title="<?php echo $term->name; ?>">
															<img src="<?php echo $image[0]; ?>" class="logo" />
														</a>
													</div>
													<div class="col-xs-8">
														<div class="title">
															<h4><a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
														</div>
													</div>
													<div class="col-xs-12">
														<span class="price"><?php echo $product->get_price_html(); ?></span>
													</div>
												</div>

											</div>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="button-well">
                                    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" title="<?php _e('View Collection', 'wbase') ?>" class="btn btn-home"><?php _e('View Collection', 'wbase') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="testimonials" class="bg-parallax">
                    <div class="chrono-title title chrono-title-center">
                        <div class="title-sep-container title-sep-container-left">
                            <div class="title-sep sep-single sep-solid"></div>
                        </div>
                        <h2 class="title-heading-center"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.png" alt="Testimonials" /></h2>
                        <div class="title-sep-container title-sep-container-right">
                            <div class="title-sep sep-single sep-solid"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="container">
                        <div class="row">
                            <div class="testimonials">
								<div class="carousel slide carousel-fade" id="fade-quote-carousel" data-ride="carousel" data-interval="5000">
									<ol class="carousel-indicators">
										<?php
											$args = array( 'post_type' => 'testimonial', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order'  => 'ASC' );
											$loop = new WP_Query( $args );
											$counter = 0;
											if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
												$class = '';
												$data = get_post_meta( $loop->post->ID, 'testimonial', true );
												$image = wp_get_attachment_image_src(get_field('photo'), 'testimonial');
												$class = ($counter == 0) ? ' class="active"' : '';
												if( !empty($image) ): ?>
													<li data-target="#fade-quote-carousel" data-slide-to="<?php echo $counter; ?>"<?php echo $class; ?>><img src="<?php echo $image[0]; ?>" width="45px" /></li>
												<?php else : ?>
													<li data-target="#fade-quote-carousel" data-slide-to="<?php echo $counter; ?>"<?php echo $class; ?>></li>
												<?php endif; ?>
											<?php
												$counter++;
											endwhile;
											endif;
										?>
										
									</ol>
									<div class="carousel-inner" role="listbox">						
									<?php
										$args = array( 'post_type' => 'testimonial', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' );
										$loop = new WP_Query( $args );
										$counter = 0;
										if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
											$data = get_post_meta( $loop->post->ID, 'testimonial', true );
											$classa = ($counter == 0) ? ' active' : '';
										?>
										<div class="item<?php echo $classa ?>">
											<div class="quote">
												<blockquote>
													<?php the_content() ?>
												</blockquote>
											</div>
											<div class="info">
												<div class="name">
													<?php echo get_field('name'); ?>
												</div>
												<div class="country">
													<?php echo get_field('country'); ?>
												</div>
											</div>
										</div>
										<?php 
										$counter++;
										endwhile; 
										endif;
									?>
									<?php wp_reset_postdata(); ?>
									</div>
								</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div id="top-models" class="fullwidth">
					<div class="chrono-title title chrono-title-center">
						<div class="title-sep-container title-sep-container-left">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
						<h2 class="title-heading-center"><?php _e('Top Models', 'wbase') ?></h2>
						<div class="title-sep-container title-sep-container-right">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
					</div>
                    <div class="clearfix"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="carousel-holder row">
								<?php
									$args = array( 
										'post_type' => 'product',
										'posts_per_page' => 4,
										'meta_key' => '_price',
										'orderby' => 'meta_value_num',
										'meta_query' => array(
            								array(
                								'key' => '_stock_status',
                								'value' => 'instock'
            								)
										)
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
										<li class="carousel-item col-sm-6 col-md-3">
											<div class="product-wrapper">
												<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'product-image-home'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>
												</a>
												<div class="description-wrapper row">
													<div class="col-xs-4">
														<?php 
															$terms = get_the_terms( $post->ID, 'product_cat' );
															foreach ($terms  as $term  ) :
																$wthumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
																$wimage = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo-home');																
															endforeach;
														?>
														<a href="<?php the_permalink(); ?>" title="<?php echo $term->name; ?>">
															<img src="<?php echo $wimage[0]; ?>" class="logo" />
														</a>
													</div>													
													<div class="col-xs-8">
														<div class="title">
															<h4><a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
														</div>
													</div>
													<div class="col-xs-12">
														<span class="price"><?php echo $product->get_price_html(); ?></span>
													</div>
												</div>
											</div>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="button-well">
                                    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" title="<?php _e('View Collection', 'wbase') ?>" class="btn btn-home"><?php _e('View Collection', 'wbase') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="instagram" class="fullwidth">
					<div class="chrono-title title chrono-title-center">
						<div class="title-sep-container title-sep-container-left">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
						<h2 class="title-heading-center"><?php _e('Instagram', 'wbase') ?></h2>
						<div class="title-sep-container title-sep-container-right">
							<div class="title-sep sep-single sep-solid"></div>
						</div>
					</div>
					<div class="clearfix"></div>
                </div>

				<?php get_sidebar( 'footerfull' ); ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>