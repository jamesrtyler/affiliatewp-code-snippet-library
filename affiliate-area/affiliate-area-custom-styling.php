<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Area Custom Styling
 * Plugin URI: https://affiliatewp.com
 * Description: Adds custom CSS styling to the Affiliate Area
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

function affwp_affiliate_area_styling() {

    // only load CSS on the Affiliate Area
    if ( ! ( function_exists( 'affwp_get_affiliate_area_page_id' ) && is_page( affwp_get_affiliate_area_page_id() ) ) ) {
        return;
    }

    ?>

    <style>

    @media only screen and ( min-width: 1200px ) {

    	#affwp-affiliate-dashboard #affwp-affiliate-dashboard-tabs {
    		margin-bottom: 0;
    	}

    	#affwp-affiliate-dashboard #affwp-affiliate-dashboard-tabs li {
    		padding-right: 0;
    	}

    	#affwp-affiliate-dashboard #affwp-affiliate-dashboard-tabs li.affwp-affiliate-dashboard-tab.active {
            padding-top: 5px;
            background: #fff;
        }

    	li.affwp-affiliate-dashboard-tab {
    		border: 2px solid #f7f7f7;
    		border-bottom: none;
    		position: relative;
    		background: #f7f7f7;
    	}

        .affwp-tab-content {
            padding: 40px;
            border: 2px solid #f7f7f7;
            border-top: none;
        }

    	#affwp-affiliate-dashboard-tabs a {
            display: block;
            padding: 10px 15px;
        }

    	#affwp-affiliate-dashboard {
    	    overflow: hidden;
    	}

    	li.affwp-affiliate-dashboard-tab.active:before,
    	li.affwp-affiliate-dashboard-tab.active:after {
    		content: '';
    		position: absolute;
    		height: 2px;
    		right: 100%;
    		bottom: 0;
    		width: 1200px;
    		background: #f7f7f7;
    	}

    	li.affwp-affiliate-dashboard-tab.active:after {
        	right: auto;
        	left: 100%;
        	width: 4000px;
            z-index: 1;
        }

    }

    /* TwentySixteen theme specific */

    /* remove the dotted line */
    #affwp-affiliate-dashboard-tabs a:active,
    #affwp-affiliate-dashboard-tabs a:focus,
    #affwp-affiliate-dashboard-tabs a:hover {
        outline: 0;
    }

    #affwp-affiliate-dashboard-tabs a {
        box-shadow: none;
    }

    #affwp-affiliate-dashboard-tabs a {
        color: #686868;
    }

    #affwp-affiliate-dashboard-tabs li.affwp-affiliate-dashboard-tab a:hover,
    #affwp-affiliate-dashboard-tabs li.affwp-affiliate-dashboard-tab.active a {
        color: #1a1a1a;
    }

    </style>

    <?php
}
add_action( 'wp_head', 'affwp_affiliate_area_styling', 100 );
