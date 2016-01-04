<?php
/**
 * Plugin Name: AffiliateWP - Per Category Referral Amounts (WooCommerce)
 * Plugin URI: http://affiliatewp.com
 * Description: Set referral amounts for products based on their product category
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

function affwp_custom_per_category_referral_amounts_wc( $referral_amount, $affiliate_id, $amount, $reference, $product_id ) {

  // Example One: Specifying an array of categories to alter the commission for.
  // Separate by a comma and use either the term name, term_id, or slug
  $categories = array( 'category-one', 5 );

	if ( has_term( $categories, 'product_cat', $product_id ) ) {
		$referral_amount = $amount * 0.3; // 30% commission for these categories
	}

  // Example Two: Specifying 1 category by its slug
	if ( has_term( 'some-category', 'product_cat', $product_id ) ) {
		$referral_amount = 50; // $50.00 commission for a product in this category
	}

	// Example Three: Specifying a category by term ID
	if ( has_term( 2, 'product_cat', $product_id ) ) {
		$referral_amount = $amount * 0.8; // 80% commission for a product in this category
	}

  // return the referral amount
  return $referral_amount;

}
add_filter( 'affwp_calc_referral_amount', 'affwp_custom_per_category_referral_amounts_wc', 10, 5 );
