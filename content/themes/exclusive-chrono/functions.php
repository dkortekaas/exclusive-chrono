<?php
/**
 * WBase functions and definitions
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Set site owner for login.
 */
define('WBASE_LOGIN_WEBLOGIQ', true);

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Theme plugin activation.
 */
if ( is_admin() ) :
    require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
    require get_template_directory() . '/inc/tgm/plugins.php';
endif;

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load functions to secure WP install.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Disable Dasboard widgets.
 */
require get_template_directory() . '/inc/dashboard.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom comments.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load WooCommerce functions if WooCommerce is active.
 */
if ( class_exists( 'WooCommerce' ) ) :
    require get_template_directory() . '/inc/woocommerce.php';
endif;

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Create Custom posts.
 */
require get_template_directory() . '/inc/custom-posts.php';

/**
 * Duplicate post/page.
 */
require get_template_directory() . '/inc/duplicate.php';

/**
 * Register Options page.
 */
require get_template_directory() . '/inc/options.php';

/**
 * Disable all WordPress auto updates.
 */
require get_template_directory() . '/inc/disable-updates.php';

/**
 * Support Rich Snippets - Schema.org
 */
require get_template_directory() . '/inc/rich-snippets.php';

/**
 * Yoast WPML support.
 */
require get_template_directory() . '/inc/yoast-wpml.php';

/**
 * Hide 'Out of stock products' in Ajax search plugin
 */
add_filter( 'asp_results', 'filter_asp_results', 1, 1 );
 
function filter_asp_results($results){
 
  /* If the results are grouped */
  if (isset($results['grouped'])) {
    foreach ($results['items'] as $i_k=>$data) {
        if ($i_k == 'name') continue;
         
        // $result['data'] holds the results here               
        foreach($results['items'][$i_k]['data'] as $r_k => &$result) {
 
          if (asp_unset_if_hidden($result))
            unset($results['items'][$i_k]['data'][$r_k]);
           
        }     
    }
    /**
     *  You need to return the $results variable here,
     *  since the changes are made directly 
     **/    
    return $results;
   
  /* Non-grouped */ 
  } else {
      foreach($results as $k => &$result) {
 
        if (asp_unset_if_hidden($result))
          unset($results[$k]);
           
      }
 
      return $results;
  }
}
 
function asp_unset_if_hidden( $v ) {
  // Visibility key in WooCommerce
  $key = '_visibility';
   
  if (!isset($v->post_type) || $v->post_type != 'product') return false;
  $visibility = get_post_meta( $v->id, $key, true );
  if ($visibility != 'visible')
    return true;
   
  return false;
}
