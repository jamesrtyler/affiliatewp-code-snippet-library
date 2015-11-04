<?php
/**
 * Plugin Name: AffiliateWP - Remove Registration Form
 * Plugin URI: http://affiliatewp.com
 * Description: Removes the affiliate registration form from the [affiliate_area] shortcode. Useful for when you want to show the registration form only on another page using the [affiliate_registration] shortcode
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

// remove the standard [affiliate_area] shortcode
remove_shortcode( 'affiliate_area', array( affiliate_wp(), 'affiliate_area' ) );

// add our new [affiliate_area] shortcode, but without the registration form
add_shortcode( 'affiliate_area', 'affwp_custom_affiliate_area_shortcode' );

function affwp_custom_affiliate_area_shortcode( $atts, $content = null ) {

    ob_start();

    if ( is_user_logged_in() && affwp_is_affiliate() ) {
        // show the affiliate dashboard for logged in affiliates
        affiliate_wp()->templates->get_template_part( 'dashboard' );

    } elseif ( ! is_user_logged_in() ) {
        affiliate_wp()->templates->get_template_part( 'login' );
    }

    return ob_get_clean();

}
