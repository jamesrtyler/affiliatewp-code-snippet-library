<?php
/**
 * Plugin Name: AffiliateWP - Redirect Non-affiliates
 * Plugin URI: https://affiliatewp.com
 * Description: Redirect non-affiliates to the site homepage if the user logs in via the Affiliate Area
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * Redirect non-affiliates to the site homepage if they try and log in via the Affiliate Area
 */
function affwp_custom_login_redirect( $redirect ) {

	if ( ! ( affwp_is_affiliate() ) ) {
		$redirect = site_url();
	}

	return $redirect;
}
add_filter( 'affwp_login_redirect', 'affwp_custom_login_redirect' );
