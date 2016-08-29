<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Referral Rate Email Tag
 * Plugin URI: https://affiliatewp.com
 * Description: Adds an {affiliate_referral_rate} email tag that displays the affiliate their commission rate
 * Author: Andrew Munro
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

/**
 * Add a new {affiliate_referral_rate} email tag
 */
function affwp_custom_email_tag_affiliate_referral_rate( $email_tags, $this ) {

	$email_tags['affiliate_referral_rate'] = array(
		'tag'         => 'affiliate_referral_rate',
		'description' => __( 'The affiliate\'s referral rate', 'affiliate-wp' ),
		'function'    => 'affwp_email_tag_affiliate_referral_rate'
	);

	return $email_tags;
}
add_filter( 'affwp_email_tags', 'affwp_custom_email_tag_affiliate_referral_rate', 10, 2 );

/**
 * Return the affiliate rate
 */
function affwp_email_tag_affiliate_referral_rate( $affiliate_id = 0 ) {
	return affwp_get_affiliate_rate( $affiliate_id, true );
}
