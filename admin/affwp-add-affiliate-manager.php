<?php
/**
 * Plugin Name: AffiliateWP - Add AffiliateWP Manager
 * Plugin URI: http://affiliatewp.com/
 * Description: Add AffiliateWP management permissions for a specific user; specify the user ID on line 26.
 * Author: AffiliateWP Team
 * Author URI: http://affiliatewp.com
 * Version: 0.1
 * Text Domain: affiliatewp-affiliate-manager
 * Domain Path: languages
 *
 * AffiliateWP is distributed under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * AffiliateWP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AffiliateWP. If not, see <http://www.gnu.org/licenses/>.
 */

function affwp_custom_add_affiliate_manager_caps() {
	$user_id = '1';
	$user = new WP_User( $user_id );
	$user->add_cap( 'view_affiliate_reports' );
	$user->add_cap( 'export_affiliate_data' );
	$user->add_cap( 'manage_affiliate_options' );
	$user->add_cap( 'manage_affiliates' );
	$user->add_cap( 'manage_referrals' );
	$user->add_cap( 'manage_visits' );
	$user->add_cap( 'manage_creatives' );
}
add_action( 'admin_init', 'affwp_custom_add_affiliate_manager_caps');
