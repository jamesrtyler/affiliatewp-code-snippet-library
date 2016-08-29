<?php
/**
 * Plugin Name: AffiliateWP - Limit Referrals
 * Plugin URI: http://affiliatewp.com
 * Description: Limit the amount of referrals an affiliate can receive
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

function affwp_custom_limit_referrals( $return, $args ) {

    $limit = 10;

    // count affiliate's referrals
    $referral_count = affwp_count_referrals( $args['affiliate_id'], array( 'pending', 'unpaid', 'paid' ) );

    if ( $referral_count >= $limit ) {
        return false;
    }

    return true;

}
add_filter( 'affwp_integration_create_referral', 'affwp_custom_limit_referrals', 10, 2 );
