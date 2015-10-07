<?php

/**
 * Plugin Name: Affiliate Forms For Gravity Forms - Prefix Username
 * Plugin URI: http://affiliatewp.com
 * Description: Prefixes the affiliate username when username is a number.
 * Author: Michael Beil, michaelbeil
 * Author URI: http://michaelbeil.com
 * Version: 1.0
 */

/**
 * Prefix the affiliate username
 */
function affwp_custom_affiliatewp_afgf_insert_user( $args) {
    // change this prefix. If a username of 1234 is entered, the affiliate's username will become a1234
    $username_prefix = 'a';
    $args['user_login'] = $username_prefix . $args['user_login'];
    return $args;
}
add_filter( 'affiliatewp_afgf_insert_user', 'affwp_custom_affiliatewp_afgf_insert_user' );
