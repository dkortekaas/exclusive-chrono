<?php
    // $isSecure = false;
    // if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') :
    //     $isSecure = true;
    // elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') :
    //     $isSecure = true;
    // endif;
    // $REQUEST_PROTOCOL = $isSecure ? 'https://' : 'http://';
    // wp_redirect( $REQUEST_PROTOCOL . $_SERVER['HTTP_HOST'], 301 ); exit;
?>

<?php
get_header(); ?>

<div id="main" role="main" class="clearfix">
	<div id="content">
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-content">
                <div class="container">
                    <div class="row">

                        <div class="layout-column">
                            <div class="column-wrapper">
                                <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
                                <?php if ( is_plugin_active('LayerSlider/layerslider.php') ) : ?>
                                    <?php echo do_shortcode('[layerslider id="4"]'); ?>
                                <?php endif; ?>
                                <div class="sep-clear"></div>
                                <div class="separator sep-none"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title title-size-two">
                                            <div class="title-sep-container title-sep-container-left">
                                                <div class="title-sep sep-single sep-solid"></div>
                                            </div>
                                            <h2 class="title-heading-center" itemprop="name"><?php _e('Page Not Found', 'wbase') ?></h2>
                                            <div class="title-sep-container title-sep-container-right">
                                                <div class="title-sep sep-single sep-solid"></div>
                                            </div>
                                        </div>

                                        <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wbase' ); ?></h1>
                                        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'wbase' ); ?></p>
                                        <?php get_search_form(); ?>                                
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
	</div>
</div>

<?php get_footer();