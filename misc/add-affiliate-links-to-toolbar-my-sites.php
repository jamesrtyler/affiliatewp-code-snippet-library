<?php
/**
 * Plugin Name: AffiliateWP - Add Affiliate Links to My Sites Toolbar Drop-down
 * Plugin URI: http://affiliatewp.com
 * Description: Automatically adds jump links to the Affiliates admin page in each site's toolbar submenu in the My Sites drop-down.
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

/**
 * Adds 'Affiliates' Toolbar links in the My Sites drop-down.
 *
 * @param WP_Admin_Bar $wp_admin_bar Toolbar instance.
 */
function affwp_affiliate_toolbar_links( $wp_admin_bar ) {
	foreach ( $wp_admin_bar->user->blogs as $blog ) {
		$blog_id = $blog->userblog_id;

		// Add 'Affiliates' link.
		$wp_admin_bar->add_menu( array(
			'parent' => "blog-{$blog->userblog_id}",
			'id'     => "affiliates-blog-{$blog_id}",
			'title'  => __( 'Affiliates', 'affiliate-wp' ),
			'href'   => add_query_arg( 'page', 'affiliate-wp', get_admin_url( $blog_id, 'admin.php' ) )
		) );

//		// Uncomment to remove these links as well.
//		// Remove 'New Post'.
//		$wp_admin_bar->remove_menu( "blog-{$blog_id}-n" );
//
//		// Remove 'View Comments'.
//		$wp_admin_bar->remove_menu( "blog-{$blog_id}-c" );
//
//		// Remove 'Visit Site'.
//		$wp_admin_bar->remove_menu( "blog-{$blog_id}-v" );
	}
}
add_action( 'admin_bar_menu', 'affwp_affiliate_toolbar_links', 100 );
