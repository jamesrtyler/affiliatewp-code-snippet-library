<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Area Logout Link
 * Plugin URI: http://affiliatewp.com
 * Description: Add a "logout" link to the existing links within the Affiliate Area
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

function affwp_custom_affiliate_area_logout_link( $affiliate_id, $active_tab ) {

     $redirect = function_exists( 'affiliate_wp' ) && affiliate_wp()->settings->get( 'affiliates_page' ) ? affiliate_wp()->login->get_login_url() : home_url();
     ?>
    <li class="affwp-affiliate-dashboard-tab<?php echo $active_tab == 'settings' ? ' active' : ''; ?>">
        <a href="<?php echo wp_logout_url( $redirect ); ?>"><?php _e( 'Log out', 'affiliate-wp' ); ?></a>
    </li>
<?php }
add_action( 'affwp_affiliate_dashboard_tabs', 'affwp_custom_affiliate_area_logout_link', 100, 2 );
