<?php
/**
 * Add WooCommerce support
 *
 * @package wbase
 */

if (isset($sitepress)) add_filter('wpseo_posts_join', 'sitemap_per_language', 10, 2);
function sitemap_per_language($join, $type) {
    global $wpdb, $sitepress;
    $lang = $sitepress->get_current_language();
    return " JOIN " . $wpdb->prefix . "icl_translations ON element_id = ID AND element_type = 'post_$type' AND language_code = '$lang'";
}