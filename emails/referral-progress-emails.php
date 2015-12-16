<?php
/**
 * Plugin Name: AffiliateWP - Referral Progress Emails
 * Plugin URI: http://affiliatewp.com
 * Description: Email affiliates when they reach specific paid referral goals
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

/**
 * Email the affiliate
 * Referrals must be "paid" before they will count towards the total referral count
 */
function affwp_referral_progress_emails( $referral_id, $new_status, $old_status ) {

  // only count paid referrals
  if ( ! function_exists( 'affiliate_wp' ) || ( 'paid' != $new_status ) ) {
    return;
  }

  // set up referral count goals
  // this would send an email on the 5th, 10th, 20th and 50th paid referral
  $referral_goals = array( 5, 10, 20, 50 );

  // get referral
  $referral = affwp_get_referral( $referral_id );

  // get affiliate ID
  $affiliate_id = $referral->affiliate_id;

  // get the referral count for the affiliate
  $referral_count = affiliate_wp()->affiliates->get_column( 'referrals', $affiliate_id );

  // only send email if referral goal has been reached
  if ( ! in_array( $referral_count, $referral_goals ) ) {
    return;
  }

  // return if no affiliate ID or no referral
  if ( empty( $affiliate_id ) || empty( $referral ) ) {
  	return;
  }

  // set up email
  $emails  = new Affiliate_WP_Emails;
  $emails->__set( 'affiliate_id', $affiliate_id );
  $emails->__set( 'referral', $referral );

  // get the affiliate's email address
  $email = affwp_get_affiliate_email( $affiliate_id );

  // get affiliate's name
  $name = affiliate_wp()->affiliates->get_affiliate_name( $affiliate_id );

  // set the email subject
  $subject = sprintf( __( 'Woohoo! You have reached %s referrals!', 'affiliate-wp' ), $referral_count );

  // set the message
  $message  = sprintf( __( 'Congratulations %s!', 'affiliate-wp' ), $name ) . "\n\n";
  $message .= sprintf( __( 'You\'ve reached a total of %s paid referrals! Keep going, you\'re doing great!', 'affiliate-wp' ), $referral_count ) . "\n\n";
  $message .= sprintf( __( 'Log in to your affiliate area to check your progress: %s', 'affiliate-wp' ), affiliate_wp()->login->get_login_url() ) . "\n\n";

  // send the email
  $emails->send( $email, $subject, $message );

}
add_action( 'affwp_set_referral_status', 'affwp_referral_progress_emails', 10, 3 );
