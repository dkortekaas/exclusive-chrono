
    <div class="separator full-width-sep sep-none"></div>
    <div class="title title-size-two">
        <div class="title-sep-container title-sep-container-left">
            <div class="title-sep sep-single sep-solid"></div>
        </div>
        <h2 class="title-heading-center"><?php _e('Our Brands', 'wbase'); ?></h2>
        <div class="title-sep-container title-sep-container-right">
            <div class="title-sep sep-single sep-solid"></div>
        </div>
    </div>
    <div class="image-carousel image-carousel-auto carousel-border">
        <ul class="slick carousel-holder">
        <?php
            $wcatTerms = get_terms('product_cat', array('hide_empty' => 0 ));
            $counter = 0;
            foreach($wcatTerms as $wcatTerm) :
                $wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
                $term_link = get_term_link( $wcatTerm );
                if ( $wthumbnail_id > 0 ) :
                    $image = wp_get_attachment_image_src($wthumbnail_id, 'brand-logo'); ?>
                    <li class="carousel-item">
                        <div class="carousel-item-wrapper" style="visibility: inherit;">
                            <div class="image-wrapper hover-type-liftup">
                                <a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $wcatTerm->name; ?>">
                                    <img width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" src="<?php echo $image[0]; ?>" class="aligncenter" alt="<?php echo $wcatTerm->name; ?>">
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php $counter++;
                endif;
            endforeach; ?>
        </ul>
        </div>
    </div>