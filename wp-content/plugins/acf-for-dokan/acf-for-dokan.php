<?php
/**
 * Plugin Name:     ACF For Dokan
 * Plugin URI:      https://wordpress.org/plugins/acf-for-dokan/
 * Description:     Allows admin to create new custom field for vendor add/edit product in vendor dashboard.
 * Author:          krazyplugins
 * Author URI:      https://profiles.wordpress.org/krazyplugins/
 * Text Domain:     acf-for-dokan
 * Domain Path:     /languages
 * Version:         1.3.3
 *
 * @package         ACF_For_Dokan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'ACF_FOR_DOKAN', __FILE__ );
define( 'ACF_FOR_DOKAN_BASENAME', plugin_basename( ACF_FOR_DOKAN ) );
define( 'ACF_FOR_DOKAN_PLUGIN_DIR', plugin_dir_path( ACF_FOR_DOKAN ) );
define( 'ACF_FOR_DOKAN_PLUGIN_URL', plugin_dir_url( ACF_FOR_DOKAN ) );

require_once 'includes/class-' . basename( __FILE__ );

/**
 * Plugin textdomain.
 */
function acf_dokan_textdomain() {
	load_plugin_textdomain( 'acf-for-dokan', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'acf_dokan_textdomain' );

/**
 * Plugin activation.
 */
function acf_dokan_activation() {
	// Activation code here.
}
register_activation_hook( __FILE__, 'acf_dokan_activation' );

/**
 * Plugin deactivation.
 */
function acf_dokan_deactivation() {
	// Deactivation code here.
}
register_deactivation_hook( __FILE__, 'acf_dokan_deactivation' );

/**
 * Initialization class.
 */
function acf_dokan_init() {
	global $acf_for_dokan; 
	$acf_for_dokan = new ACF_For_Dokan;
}
add_action( 'plugins_loaded', 'acf_dokan_init' );
