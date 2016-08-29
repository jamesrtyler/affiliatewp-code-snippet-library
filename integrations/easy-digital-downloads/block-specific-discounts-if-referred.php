<?php
/**
 * Plugin Name: AffiliateWP - Easy Digital Downloads - Block Specific Discounts if Referred
 * Plugin URI: https://affiliatewp.com
 * Description: Blocks specific discount codes at checkout if the customer was referred by an affiliate link
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * The discount IDs to be blocked if the customer was referred by an affiliate
 * The discount ID can be found at the end of the URL when editing a discount code
 */
function affwp_edd_blocked_discount_ids() {

	// comma separated list of discount IDs to block
	$discount_ids = array( 295, 123, 50 );

	return $discount_ids;

}

/**
 * Block specific discount codes from being used if a customer was referred by an affiliate link
 */
function affwp_edd_block_discount_at_checkout( $return, $discount_id, $code, $user ) {

	if ( edd_get_cart_contents() && affiliate_wp()->tracking->was_referred() && in_array( $discount_id, affwp_edd_blocked_discount_ids() ) ) {
		edd_set_error( 'edd-discount-error', 'This discount is invalid.' );
		$return = false;
	}

	return $return;

}
add_filter( 'edd_is_discount_valid', 'affwp_edd_block_discount_at_checkout', 10, 4 );
