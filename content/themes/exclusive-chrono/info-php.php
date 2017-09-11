<?php
/**
 * Template Name: PHP Info
 *
 * @package wbase
 */

/**
 * No direct access.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<div id="main" role="main" class="clearfix">
	<div id="content">
		<?php echo phpinfo(); ?>
	</div>
</div>

<?php get_footer(); ?>