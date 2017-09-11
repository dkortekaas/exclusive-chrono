<?php
/**
 * Custom header setup.
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function wbase_duplicate_post_as_draft() {

	/**
	 * Creates post duplicate as a draft and redirects then to the edit post screen
	 *
	 */
	global $wpdb;

	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) :
		wp_die('No post to duplicate has been supplied!');
	endif;

    // get the original post id
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );

    // and all the original post data then
	$post = get_post( $post_id );

    // current user will be the new post author
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
    // if post data exists, create the post duplicate
    if (isset( $post ) && $post != null) :

        // new post data array
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

        // insert the post by wp_insert_post() function
		$new_post_id = wp_insert_post( $args );

        // get all current post terms ad set them to the new post draft
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) :
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		endforeach;

        // duplicate all post meta just in two SQL queries
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) :
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) :
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			endforeach;
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		endif;
 
        // finally, redirect to the edit post screen for the new draft
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
    else :
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	endif;
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'wbase_duplicate_post_as_draft' );

function wbase_duplicate_post_link( $actions, $post ) {

	/**
	 * Add the duplicate link to action list for post_row_actions.
	 *
	 */
	if ($post->post_type=='event' && current_user_can('edit_posts')) :
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="'. __('Duplicate this item','wbase') .'" rel="permalink">'. __('Duplicate','wbase') .'</a>';
	endif;
	return $actions;
}
add_filter( 'post_row_actions', 'wbase_duplicate_post_link', 10, 2 );