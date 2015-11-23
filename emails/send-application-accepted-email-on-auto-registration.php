<?php
/**
 * Plugin Name: AffiliateWP - Send Application Accepted Email On Auto Registration
 * Plugin URI: http://affiliatewp.com
 * Description: Sends affiliate the application accepted email when they have been auto registered as an affiliate
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

function affwp_send_application_accepted_email_on_auto_registration( $affiliate_id, $status, $args ) {
	add_action( 'affwp_set_affiliate_status', 'affwp_notify_on_approval', 10, 3 );
}
add_action( 'affwp_auto_register_user', 'affwp_send_application_accepted_email_on_auto_registration', 10, 3 );
