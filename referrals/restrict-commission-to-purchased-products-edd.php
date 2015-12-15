<?php
/**
 * Plugin Name: AffiliateWP - Restrict Commission To Purchased Products in Easy Digital Downloads
 * Plugin URI: http://affiliatewp.com
 * Description: Affiliates will only be able to earn a commission on a purchased product
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

/**
 * Restrict commission to purchased products in Easy Digital Downloads
 *
 * Make sure to enable "Ignore Zero Referrals?" from Affiliates -> Settings -> Misc
 * If you would like 0.00 referrals to be ignored.
*/
function affwp_edd_restrict_commission_to_purchased_products( $referral_amount, $affiliate_id, $amount, $reference, $product_id ) {

    // get referring affiliate ID
    $affiliate_id = affiliate_wp()->tracking->get_affiliate_id();

    // get user ID of referring affiliate
    $user_id = affwp_get_affiliate_user_id( $affiliate_id );

    if ( ! ( function_exists( 'edd_has_user_purchased' ) && edd_has_user_purchased( $user_id, array( $product_id ) ) ) ) {
        $referral_amount = 0.00;
    }

    return $referral_amount;

}
add_filter( 'affwp_calc_referral_amount', 'affwp_edd_restrict_commission_to_purchased_products', 10, 5 );
