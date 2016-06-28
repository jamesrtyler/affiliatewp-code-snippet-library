<?php
/**
 * Plugin Name: AffiliateWP - Grant AffiliateWP admin privileges to a specific WordPress user
 * Plugin URI: http://affiliatewp.com
 * Description: Gives admin privileges to a specific WordPress user
 * Author: ramiabraham
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

// Specify the ID of the user
$user = new WP_User( '23' );
$user->add_cap( 'view_affiliate_reports' );
$user->add_cap( 'export_affiliate_data' );
$user->add_cap( 'manage_affiliate_options' );
$user->add_cap( 'manage_affiliates' );
$user->add_cap( 'manage_referrals' );
$user->add_cap( 'manage_visits' );
$user->add_cap( 'manage_creatives' );
