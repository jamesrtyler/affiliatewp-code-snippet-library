<?php
/**
 * Plugin Name: AffiliateWP - Dequeue frontend stylesheet
 * Plugin URI: http://affiliatewp.com
 * Description: Dequeues the small forms.min.css file which styles the login and affiliate area on the frontend.
 * Author: NateWr
 * Author URI: http://github.com/NateWr
 * Version: 1.0
 */

function affwp_disable_affiliate_area_stylesheet() {
    wp_dequeue_style( 'affwp-forms' );
}
add_action( 'wp_head', 'affwp_disable_affiliate_area_stylesheet', 1 );
add_action( 'wp_footer', 'affwp_disable_affiliate_area_stylesheet' );
