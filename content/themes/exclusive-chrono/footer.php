<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$the_theme = wp_get_theme();
$container = get_theme_mod( 'wbase_container_type' );
?>

    <div class="footer">
        <footer class="container footer-widget-area widget-area">
            <div class="row">
                <div class="col-xs-12 footer-logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer-logo.png" alt=""<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                    <?php
                    $wbase_social_options = get_option('wb_social_options');
                    if ( (isset($wbase_social_options['wb_footer_social_icons'])) && (trim($wbase_social_options['wb_footer_social_icons']) == '1' ) ) :
                        echo '<ul class="footer-social">';
                            $facebook = $pinterest = $linkedin = $twitter = $googleplus = $instagram = $youtube = $behance = "";
                            if ( isset ($wbase_social_options['wb_facebook_url']) ) $facebook = $wbase_social_options['wb_facebook_url'];
                            if ( isset ($wbase_social_options['wb_pinterest_url']) ) $pinterest = $wbase_social_options['wb_pinterest_url'];
                            if ( isset ($wbase_social_options['wb_linkedin_url']) ) $linkedin = $wbase_social_options['wb_linkedin_url'];
                            if ( isset ($wbase_social_options['wb_twitter_url']) ) $twitter = $wbase_social_options['wb_twitter_url'];
                            if ( isset ($wbase_social_options['wb_googleplus_url']) ) $googleplus = $wbase_social_options['wb_googleplus_url'];
                            if ( isset ($wbase_social_options['wb_instagram_url']) ) $instagram = $wbase_social_options['wb_instagram_url'];
                            if ( isset ($wbase_social_options['wb_youtube_url']) ) $youtube = $wbase_social_options['wb_youtube_url'];
                            if ( isset ($wbase_social_options['wb_behance_url']) ) $behance = $wbase_social_options['wb_behance_url'];
                            if ( $facebook != "" ) echo('<li><a href="' . $facebook . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Facebook', 'wbase') .'"><i class="fa fa-facebook"></i></a></li>' );
                            if ( $pinterest != "" ) echo('<li><a href="' . $pinterest . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Pinterest', 'wbase') .'"><i class="fa fa-pinterest"></i></a></li>' );
                            if ( $linkedin != "" ) echo('<li><a href="' . $linkedin . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on LinkedIn', 'wbase') .'"><i class="fa fa-linkedin"></i></a></li>' );
                            if ( $twitter != "" ) echo('<li><a href="' . $twitter . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Twitter', 'wbase') .'"><i class="fa fa-twitter"></i></a></li>' );
                            if ( $googleplus != "" ) echo('<li><a href="' . $googleplus . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Google+', 'wbase') .'"><i class="fa fa-google-plus"></i></a></li>' );
                            if ( $instagram != "" ) echo('<li><a href="' . $instagram . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Instagram', 'wbase') .'"><i class="fa fa-instagram"></i></a></li>' );
                            if ( $youtube != "" ) echo('<li><a href="' . $youtube . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on YouTube', 'wbase') .'"><i class="fa fa-youtube"></i></a></li>' );
                            if ( $behance != "" ) echo('<li><a href="' . $behance . '" target="_blank" rel="nofollow" class="social_media" title="'. __('Follow Us on Behance', 'wbase') .'"><i class="fa fa-behance"></i></a></li>' );
                        echo '</ul>';
                    endif;
                    ?>
                </div>
                <div class="widget-area">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="column col-lg-4 col-md-4 col-sm-4">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="column col-lg-4 col-md-4 col-sm-4 <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) { echo ICL_LANGUAGE_CODE; } ?>">
                        <?php do_action('icl_language_selector'); ?> 
                    </div>
                    <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="column col-lg-4 col-md-4 col-sm-4">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </footer>

        <footer id="footer" class="container footer-copyright-area footer-copyright-center">
            <div class="row">
                <div class="copyright-content">
                    <div class="copyright-notice">
                        <div>
                            &copy; Copyright
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            <a href='<?php echo esc_url( home_url( '/' ) ); ?>'><?php bloginfo( 'name' ); ?></a> | All Rights Reserved | Made by <a href="https://www.staalwit.nl" rel="nofollow" target="_blank">Staalwit</a>
                        </div>
                        <p class="align-center">
                            <br/>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/payment_cards_footer.png" alt="logo_footer" class="payment_logo">
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    </div>
	<?php wp_footer(); ?>
    <script>
        jQuery(window).scroll(function () {
            if (jQuery( window ).width() > 792) {
                if (jQuery(".navbar").offset().top > 50) {
                    jQuery('.navbar-header').show();
                    jQuery(".navbar").addClass("top-nav-collapse");
                    jQuery('.navbar-brand.lg img').attr('src', '<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png'); //change src
                } else {
                    jQuery('.navbar-header').hide();
                    jQuery(".navbar").removeClass("top-nav-collapse");
                    jQuery('.navbar-brand.lg img').attr('src', '')
                }
            }
        });

        jQuery(document).ready(function(){
            jQuery('.slick').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                arrows: false,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                ]
            });
        });

	var $quantityBoxes;
	var $quantitySelector = '.qty';

	$quantityBoxes = jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).find( $quantitySelector );

	if ( $quantityBoxes && 'date' != $quantityBoxes.prop( 'type' ) ) {

		// Add plus and minus boxes
		$quantityBoxes.parent().addClass( 'buttons_added' ).prepend( '<input type="button" value="-" class="minus" />' );
		$quantityBoxes.addClass( 'input-text' ).after( '<input type="button" value="+" class="plus" />' );

		// Target quantity inputs on product pages
		jQuery( 'input' + $quantitySelector + ':not(.product-quantity input' + $quantitySelector + ')' ).each( function() {
				var $min = parseFloat( jQuery( this ).attr( 'min' ) );

				if ( $min && $min > 0 && parseFloat( jQuery( this ).val() ) < $min ) {
					jQuery( this ).val( $min );
				}
		});

		jQuery( '.plus, .minus' ).unbind( 'click' );

		jQuery( '.plus, .minus' ).on( 'click', function() {

				// Get values
				var $quantityBox     = jQuery( this ).parent().find( $quantitySelector ),
				    $currentQuantity = parseFloat( $quantityBox.val() ),
				    $maxQuantity     = parseFloat( $quantityBox.attr( 'max' ) ),
				    $minQuantity     = parseFloat( $quantityBox.attr( 'min' ) ),
				    $step            = $quantityBox.attr( 'step' );

				// Fallback default values
				if ( ! $currentQuantity || '' === $currentQuantity  || 'NaN' === $currentQuantity ) {
					$currentQuantity = 0;
				}
				if ( '' === $maxQuantity || 'NaN' === $maxQuantity ) {
					$maxQuantity = '';
				}

				if ( '' === $minQuantity || 'NaN' === $minQuantity ) {
					$minQuantity = 0;
				}
				if ( 'any' === $step || '' === $step  || undefined === $step || 'NaN' === parseFloat( $step )  ) {
					$step = 1;
				}

				// Change the value
				if ( jQuery( this ).is( '.plus' ) ) {

					if ( $maxQuantity && ( $maxQuantity == $currentQuantity || $currentQuantity > $maxQuantity ) ) {
						$quantityBox.val( $maxQuantity );
					} else {
						$quantityBox.val( $currentQuantity + parseFloat( $step ) );
					}

				} else {

					if ( $minQuantity && ( $minQuantity == $currentQuantity || $currentQuantity < $minQuantity ) ) {
						$quantityBox.val( $minQuantity );
					} else if ( $currentQuantity > 0 ) {
						$quantityBox.val( $currentQuantity - parseFloat( $step ) );
					}

				}

				// Trigger change event
				$quantityBox.trigger( 'change' );
			}
		);
	}


    jQuery(document).ready(function () {
        size_li = jQuery(".brands-holder").children().length;
        x=8;
        jQuery('.brands-holder li:lt('+x+')').addClass('show');
        jQuery('#loadMore').click(function () {
            x= (x+4 <= size_li) ? x+8 : size_li;
            jQuery('.brands-holder li:lt('+x+')').slideDown().addClass('show');
            jQuery('#showLess').show();
            if(x >= size_li){
                jQuery('#loadMore').hide();
            }
        });
        jQuery('#showLess').click(function () {
            x=(x-4<0) ? 8 : x-8;
            jQuery('.brands-holder li').not(':lt('+x+')').hide();
            jQuery('#loadMore').show();
            jQuery('#showLess').show();
            if(x == 8){
                jQuery('#showLess').hide();
            }
        });
    });

    </script>

<?php if( is_page( 'contact' ) ) : ?>
<script>

        var geocoder;
        var address = "Markt 54, 6461 ED Kerkrade";
        if(document.getElementById("map") !== null) {
            var mymap = document.getElementById("map");
            initMap(mymap);
        }
        if(document.getElementById("smallmap") !== null) {
            var mysmallmap = document.getElementById("smallmap");
            initMap(mysmallmap);
        }

        function initMap(map) {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);

            var styledMapType = new google.maps.StyledMapType(
                [
                    {
                        "featureType": "landscape",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "stylers": [
                            {
                                "hue": "#00aaff"
                            },
                            {
                                "saturation": -100
                            },
                            {
                                "gamma": 2.15
                            },
                            {
                                "lightness": 12
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "lightness": 24
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": 57
                            }
                        ]
                    }
                ],
                {name: 'WBase Map'}
            );

            var mapOptions = {
                zoom: 20,
                center: latlng,
                disableDefaultUI: true,
                scrollwheel: false,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
                }
            };
            var map = new google.maps.Map(map, mapOptions);

            if (geocoder) {
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
            
                if (status == google.maps.GeocoderStatus.OK) {
                    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                        map.setCenter(results[0].geometry.location);

                        var infowindow = new google.maps.InfoWindow({
                            content: '<strong><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></strong><br/>' + address,
                            size: new google.maps.Size(150, 50)
                        });

                        var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            title: address,
                            animation: google.maps.Animation.DROP,
                            icon: "<?php echo get_stylesheet_directory_uri(); ?>/assets/images/exclusive-chrono-marker.png",
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });

        }

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('wbase_map', styledMapType);
        map.setMapTypeId('wbase_map');    
    }
</script>
<?php endif; ?>

<script>

    jQuery(document).ready(function () {

        if ( jQuery( "#wpadminbar" ).length ) {
            jQuery(".navbar-default").css("margin-top",'32px');
        }

        jQuery("#dropdownMenu1").mouseenter(function(){
            jQuery(".dropdown-menu").show(); 
        });

        jQuery(".header-icons").mouseleave(function(){
            jQuery(".dropdown-menu").hide(); 
        });

        jQuery('.woocommerce-info:empty').remove();
    });

    jQuery(document.body).on("added_to_cart", function( data ) {
        jQuery('.cart_updated_ajax' ).remove();
        jQuery('.site-main').prepend(' <span class="cart_updated_ajax"><a href="' + wc_add_to_cart_params.cart_url + '" title="' + wc_add_to_cart_params.i18n_view_cart + '"><?php _e('Product Added to Cart!', 'wbase'); ?></a></span>');
        jQuery('html, body').animate({
            scrollTop: jQuery('.cart_updated_ajax').offset().top - 100
        }, 2000);
        jQuery('.cart_updated_ajax').delay(3000).fadeOut(400)
    });

    jQuery(document).ready(function($) {
        $('#yith-searchsubmit').addClass("fa").val("\uf002");
    });

    jQuery(document).ready(function($) {
        $('.ajaxsearchpro .innericon').append('<i class="fa fa-search" aria-hidden="true"></i>');
    });

    jQuery(document).ready(function($) {
        jQuery('#fade-quote-carousel').carousel({
            interval: 5000
        });
    });

</script>
</body>
</html>