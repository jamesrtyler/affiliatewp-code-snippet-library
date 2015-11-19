<?php
/**
 * Plugin Name: AffiliateWP - Allow Referral Emails
 * Plugin URI: http://affiliatewp.com
 * Description: Disables approval, rejection, and registration emails
 * Author: Michael Beil
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

// AffiliateWP v1.6+ required

// Disables email on affiliate registration
remove_action( 'affwp_register_user', 'affwp_notify_on_registration', 10, 3 );
remove_action( 'affwp_auto_register_user', 'affwp_notify_on_registration', 10, 3 );

// Disables email on affiliate approval
remove_action( 'affwp_set_affiliate_status', 'affwp_notify_on_approval', 10, 3 );
​
// Disables email on pending affiliate registration
remove_action( 'affwp_register_user', 'affwp_notify_on_pending_affiliate_registration', 10, 3 );
remove_action( 'affwp_auto_register_user', 'affwp_notify_on_pending_affiliate_registration', 10, 3 );

// Disables email on rejected affiliate registration
remove_action( 'affwp_set_affiliate_status', 'affwp_notify_on_rejected_affiliate_registration', 10, 3 );