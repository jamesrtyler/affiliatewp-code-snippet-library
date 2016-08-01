<?php
/**
 * Plugin Name: AffiliateWP - Toolbar Affiliate Area link
 * Plugin URI: https://affiliatewp.com/
 * Description: Add an "Affiliate Area" link to the WordPress toolbar
 * Author: Andrew Munro, Sumobi
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */


 /**
  * Add an "Affiliate Area" link to the WordPress toolbar
  */
 function affwp_toolbar_affiliate_area_link( $wp_admin_bar ) {

 	if ( ! affwp_is_affiliate() ) {
 		return;
 	}

 	$args = array(
 		'id'    => 'affiliate_area',
 		'title' => 'Affiliate Area',
 		'href'  => affwp_get_affiliate_area_page_url()
 	);

 	$wp_admin_bar->add_node( $args );

 }
 add_action( 'admin_bar_menu', 'affwp_toolbar_affiliate_area_link', 999 );

 /**
  * Add CSS for loading the icon to both front and back-end
  */
 function affwp_toolbar_affiliate_area_css() {

 	if ( ! affwp_is_affiliate() ) {
 		return;
 	}

 	$path = AFFILIATEWP_PLUGIN_URL . 'assets/fonts/dashicons.';

 	?>
 	<style>

 	@font-face {
 	  font-family: "affwp-dashicons";
 	  src:url( "<?php echo $path; ?>eot");
 	  src:url("<?php echo $path; ?>eot?#iefix") format("embedded-opentype"),
 	    url("<?php echo $path; ?>woff") format("woff"),
 	    url("<?php echo $path; ?>ttf") format("truetype"),
 	    url("<?php echo $path; ?>svg#dashicons") format("svg");
 	}

 	#wpadminbar #wp-admin-bar-affiliate_area > .ab-item:before {
 		font-family: 'affwp-dashicons';
 		content: "\e000";
 		top: 2px;
 	}

 	</style>
 	<?php
 }
 add_action( 'wp_head', 'affwp_toolbar_affiliate_area_css' );
 add_action( 'admin_head', 'affwp_toolbar_affiliate_area_css' );
