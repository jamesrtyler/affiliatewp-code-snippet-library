<?php
/**
 * Plugin Name: AffiliateWP - Show Full Name
 * Plugin URI: https://affiliatewp.com/
 * Description: Show the affiliate's first and last name on the Affiliates & Referrals screen
 * Author: Andrew Munro, Sumobi
 * Author URI: https://affiliatewp.com
 * Version: 1.0.1
 */

/**
 * By default AffiliateWP shows the "display name" on the Affiliates -> Affiliates screen
 * This shows the affiliates first and last name, if present
 * If no last name is present, it will show the first name
 * If no first or last name is present, it will show the display name
 */
function affwp_custom_affiliates_show_full_name( $value, $affiliate ) {

	$display_name = affiliate_wp()->affiliates->get_affiliate_name( $affiliate->affiliate_id );
	$name         = affwp_get_affiliate_name( $affiliate->affiliate_id  );

	if ( $name ) {
		$value = sprintf( '<a href="%s">%s</a>', get_edit_user_link( $affiliate->user_id ), $name );
	} elseif ( $display_name ) {
		$value = sprintf( '<a href="%s">%s</a>', get_edit_user_link( $affiliate->user_id ), $display_name );
	} else {
		$value = __( '(user deleted)', 'affiliate-wp' );
	}

	return $value;

}
add_filter( 'affwp_affiliate_table_name', 'affwp_custom_affiliates_show_full_name', 10, 2 );

/**
 * By default AffiliateWP shows the "display name" on the Affiliates -> Referrals screen
 * This shows the affiliates first and last name, if present
 * If no last name is present, it will show the first name
 * If no first or last name is present, it will show the display name
 */
function affwp_custom_referrals_show_full_name( $value, $referral ) {

	$display_name   = affiliate_wp()->affiliates->get_affiliate_name( $referral->affiliate_id );
	$name           = affwp_get_affiliate_name( $referral->affiliate_id  );
	$affiliate_name = $name ? $name : $display_name;

	$value = apply_filters( 'affwp_referral_affiliate_column', '<a href="' . admin_url( 'admin.php?page=affiliate-wp-referrals&affiliate_id=' . $referral->affiliate_id ) . '">' . $affiliate_name . '</a>', $referral );

	return $value;

}
add_filter( 'affwp_referral_table_affiliate', 'affwp_custom_referrals_show_full_name', 10, 2 );
