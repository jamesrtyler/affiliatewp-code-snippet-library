<?php
/**
 * Plugin Name: AffiliateWP - Contact Form 7 Integration
 * Plugin URI: http://affiliatewp.com/
 * Description: Redirects the user to a success/thanks page and generates a referral
 * Author: Pippin Williamson and Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

/**
 * Set up
 * 1. Change the $page_id variable in the affwp_cf7_get_success_page_id() function to match your success page in WordPress
 * 2. Modify the affwp_cf7_get_form_amount() function to reflect your form ID (found on the Contact Forms page) and the amount that the referral should be based on
 */

/**
 * Set the page ID of the success page
 * 
 * @since 1.0
 */
function affwp_cf7_get_success_page_id() {
	// enter the page ID of the success/thanks page in WordPress
	$page_id = 254;

	return $page_id;
}

/**
 * Set the amount of the form
 * 
 * @since 1.0
 */
function affwp_cf7_get_form_amount( $id = 0 ) {
	
	$id = isset( $id ) ? $id : '';

	// enter the contact form 7 ID
	if ( 252 == $id ) {
		// enter the total amount the referral should be calculated off for this form ID
		$amount = 100;
	}

	// define more form IDs and amounts as needed
	
	// if ( 6650 == $id ) {
	// 	$amount = 500;
	// }
	
	if ( $id ) {
		return $amount;
	}

	return false;
}

/**
 * Add the conversion tracking script to the thanks/success page
 *
 * @since 1.0 
 */
function affwp_cf7_conversion_script() {

	// return if not thanks page
	if ( ! is_page( affwp_cf7_get_success_page_id() ) ) {
		return;
	}

	// get the amount
	$amount  = isset( $_GET['amount'] ) ? $_GET['amount'] : '';

	// referral arguments
	$args = array(
		'status' => 'unpaid',
		'amount' => $amount,
	);

	// add the conversion script to the page
	affiliate_wp()->tracking->conversion_script( $args );
}
add_action( 'wp_head', 'affwp_cf7_conversion_script' );

/**
 * Redirect the user to the thanks/success page after submitting the form
 *
 * @since 1.0
 */
function affwp_cf7_success_page_redirect( $contact_form ) {

	// Success page ID
	$success_page = affwp_cf7_get_success_page_id();

	$submission = WPCF7_Submission::get_instance();

	// get the value of the name field
	$name = $submission->get_posted_data( 'your-name' );

	// get the description
	$description = rawurlencode( $contact_form->title() );

	// add customer's email address to the description
	$description .= ' - ' . $submission->get_posted_data( 'your-email' );

	// set the reference to be the first name
	$reference = isset( $name ) ? rawurlencode( $name ) : '';

	// redirect to success page
	if ( $success_page ) {

		$wpcf7 = WPCF7_ContactForm::get_current();

		$wpcf7->set_properties(
			array(
		 		'additional_settings' => "on_sent_ok: \"location.replace(' " . add_query_arg( array( 'description' => $description, 'reference' => $reference, 'amount' => affwp_cf7_get_form_amount( $contact_form->id() ) ), get_permalink( $success_page ) ) . " ');\"",
			)
		);

	}
}
add_action( 'wpcf7_before_send_mail', 'affwp_cf7_success_page_redirect' );