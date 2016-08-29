<?php
/**
 * Plugin Name: AffiliateWP - Easy Digital Downloads - Block All Discounts if Referred
 * Plugin URI: https://affiliatewp.com
 * Description: Blocks all discount codes if the customer was referred by an affiliate link. Also removes the discount field at checkout.
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * Remove the discount field from checkout if the customer was referred by an affiliate link
 */
function affwp_edd_remove_discount_field() {

	if ( affiliate_wp()->tracking->was_referred() ) {
		remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );
	}

}
add_action( 'template_redirect', 'affwp_edd_remove_discount_field' );


/**
 * Block all EDD discount codes if the customer was referred by an affiliate link
 * This prevents any discount code from working via a query string, e.g. /?discount=save20
 */
function affwp_edd_block_discount_at_checkout( $return, $discount_id, $code, $user ) {

	if ( edd_get_cart_contents() && affiliate_wp()->tracking->was_referred() ) {
		edd_set_error( 'edd-discount-error', 'This discount is invalid.' );
		$return = false;
	}

	return $return;

}
add_filter( 'edd_is_discount_valid', 'affwp_edd_block_discount_at_checkout', 10, 4 );
