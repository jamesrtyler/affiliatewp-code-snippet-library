<?php
/**
 * Plugin Name: AffiliateWP - AFGF - Remove Affiliate Registration Form
 * Plugin URI: http://affiliatewp.com/
 * Description: Removes the affiliate registration from the [affiliate_area] shortcode, when using Affiliate Forms For Gravity Forms
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * Remove the registration form from Affiliate Forms for Gravity Forms where the [affiliate_area] shortcode is used
 */
function affwp_afgf_remove_affiliate_registration_form() {
    remove_action( 'template_redirect', 'affwp_afgf_replace_shortcode' );
}
add_action( 'template_redirect', 'affwp_afgf_remove_affiliate_registration_form', 9 );

function affwp_afgf_affiliate_area_shortcode( $atts, $content = null ) {

    ob_start();

    if ( is_user_logged_in() && affwp_is_affiliate() ) {
        // show the affiliate dashboard for logged in affiliates
        affiliate_wp()->templates->get_template_part( 'dashboard' );
    } elseif ( ! is_user_logged_in() ) {
        affiliate_wp()->templates->get_template_part( 'login' );
    }

    return ob_get_clean();

}

// add our new [affiliate_area] shortcode, but without the registration form
add_shortcode( 'affiliate_area', 'affwp_afgf_affiliate_area_shortcode' );
