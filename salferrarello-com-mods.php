<?php
/*
 * Plugin Name: salferrarello.com modifications
 * Plugin URI: http://salferrarello.com/
 * Description: Since I'm using the default Bootstrap Genesis Theme, I'm putting my customizations in this plugin
 * Version: 1.3.0
 * Author: Sal Ferrarello
 * Author URI: http://salferrarello.com/
 */

 // Loads my favicon from this plugin
add_filter( 'genesis_pre_load_favicon', 'sf_genesis_pre_load_favicon' );
function sf_genesis_pre_load_favicon( $favicon_url ) {
	$plugin_dir_path = plugin_dir_url(__FILE__);
    return $plugin_dir_path . 'images/favicon.ico';
}

/**
 * Add a warning alert on Draft posts.
 */
add_action( 'genesis_entry_footer', 'sf_genesis_draft_notice' );
function sf_genesis_draft_notice() {
	global $post;
	if ( ! in_category( 'draft', $post ) ) {
		// Make no changes.
		return;
	}
?>
<div class="alert alert-warning" role="alert">
	<strong>Warning!</strong>
	This is a draft, not a finalized post. See <a href="https://salferrarello.com/draft-blog-posts/">full draft disclosure</a>.
</div>
<?php
}

// filter post_info to use 'Last updated' date.
add_filter( 'genesis_post_info', 'sf_genesis_post_info_add_last_mod' );
/**
 * Change Genesis Post Info:
 * - date to last modified date
 * - remove "Leave a comment"
 *
 * @since 1.0.0
 *
 * @param  string $post_info string (with shortcodes) for post info.
 * @return string Genesis default post info with modified instead of publish date
 */
function sf_genesis_post_info_add_last_mod( $post_info ) {
	$post_info =
		__( 'Last updated on', 'genesis-last-modified-post-info' ) . ' [post_modified_date] by [post_author_posts_link] [post_edit]';
	return $post_info;
}

/**
 * Disable fallback images (specifically on archive pages).
 */
add_filter( 'genesis_get_image_default_args', 'sf_genesis_disable_image_fallback' );
function sf_genesis_disable_image_fallback( $args ) {
	$args['fallback'] = false;
	return $args;
}
