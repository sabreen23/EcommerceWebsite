<?php
/**
 * Plugin Name: WooCommerce Backorder Manager
 * Plugin URI:  https://wordpress.org/plugins/woo-backorder-manager/
 * Description: View reports with products and orders in backorder, manage backorder email notifications, export backorders to CSV.
 * Version: 2.3
 * Author: jeffrey-wp
 * Author URI: https://1.envato.market/c/1206953/275988/4415?subId1=wcbm&subId2=plugin&subId3=profile&u=https%3A%2F%2Fcodecanyon.net%2Fuser%2Fjeffrey-wp%2F
 * Text Domain: woo-backorder-manager
 * Domain Path: /languages/
 * WC requires at least: 3.0.9
 * WC tested up to: 5.2.2
 */

/** If this file is called directly, abort. */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/**
 * class WooBackorderManager
 * the main class
  */
class WooBackorderManager {

	/**
	 * Initialize the hooks and filters
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'wcbm_admin_notices' ) );
		add_filter( 'plugin_action_links', array( $this, 'wcbm_plugin_action_links' ), 10, 2 );
		add_action( 'plugins_loaded', array( $this, 'wcbm_load_plugin_textdomain' ) );

		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_section_backordermanager' ) );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'backordermanager_all_settings' ), 10, 2 );
		add_action( 'woocommerce_email', array( $this, 'woocommerce_remove_email_notifications' ) );

		add_filter( 'manage_edit-shop_order_columns', array( $this, 'add_shop_order_column_backorders' ), 10, 1 );
		add_action( 'manage_shop_order_posts_custom_column',  array( $this, 'add_shop_order_column_backorders_content' ), 10, 1 );

		add_filter( 'woocommerce_admin_reports', array( $this, 'register_backorder_reports' ), 10, 1 );
	}


	/**
	 * Show admin notices
	 * @action admin_notices
	 */
	public function wcbm_admin_notices() {

		// check if WooCommerce is active
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			// Checks if WooCommerce is "Network Active" on a multisite installation of WordPress.
			if ( is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
				return false;
			}
			?>
			<div class="error message"><p>
				<?php printf(
					__( '%s plugin is enabled but not effective. It requires WooCommerce in order to work.', 'woo-backorder-manager' ),
					'<strong>WooCommerce Backorder Manager</strong>'
				); ?>
			</p></div>
			<?php
		}
	}


	/**
	 * Show extra links on plugin overview page
	 * @param array $links
	 * @param string $file
	 * @return array
	 * @filter plugin_action_links
	 */
	public function wcbm_plugin_action_links( $links, $file ) {
		if ( $file != plugin_basename( __FILE__ ) )
			return $links;

		return array_merge(
			array(
				'settings'      => '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=backordermanager' ) . '">' . __( 'Settings', 'woo-backorder-manager' ) . '</a>',
				'report_orders' => '<a href="' . admin_url( 'admin.php?page=wc-reports&tab=orders&report=on_backorder' ) . '">' . __( 'Orders report', 'woo-backorder-manager' ) . '</a>',
				'report_stock'  => '<a href="' . admin_url( 'admin.php?page=wc-reports&tab=stock&report=on_backorder' ) . '">' . __( 'Stock report', 'woo-backorder-manager' ) . '</a>',
				'pro'           => '<a href="https://1.envato.market/c/1206953/275988/4415?subId1=wcbm&subId2=plugin&subId3=profile&u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwoocommerce-backorder-manager%2F19624014" style="color:#60a559;" target="_blank" title="' . __( 'Try WooCommerce Backorder Manager Pro - 100% money back guarantee', 'woo-backorder-manager' ) . '">' . __( 'Try Pro Version', 'woo-backorder-manager' ) . '</a>'
			),
			$links
		);
	}


	/**
	 * Load text domain
	 * @action plugins_loaded
	 */
	public function wcbm_load_plugin_textdomain() {
		load_plugin_textdomain( 'woo-backorder-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Create the section 'Backorder Manager' beneath the products tab
	 * @param array $sections
	 * @filter woocommerce_get_sections_products
	 */
	public function add_section_backordermanager( $sections ) {
		$sections['backordermanager'] = __( 'Backorder Manager', 'woo-backorder-manager' );
		return $sections;
	}


	/**
	 * Add settings to the section 'Backorder Manager'
	 * @param array $settings
	 * @param string $current_section
	 * @filter woocommerce_get_sections_products
	 */
	public function backordermanager_all_settings( $settings, $current_section ) {

		// check if the current section is what we want
		if ( $current_section == 'backordermanager' ) {

			$wcbm_backorder_report_order_statuses = get_option( 'wcbm_backorder_report_order_statuses' );
			if ( false === $wcbm_backorder_report_order_statuses) {
				update_option( 'wcbm_backorder_report_order_statuses', ['wc-processing', 'wc-pending', 'wc-on-hold'] );
			}
			$export_order_statuses = wc_get_order_statuses();

			$settings = array(
				'section_title' => array(
					'name'     => __( 'Backorder Manager', 'woo-backorder-manager' ),
					'type'     => 'title',
					'desc'     => '',
					'id'       => 'wcbm_section_title',
				),
				'wcbm_backorder_mail_notification' => array(
					'name'     => __( 'Backorder email notifications', 'woo-backorder-manager' ),
					'type'     => 'checkbox',
					'desc_tip' => __( 'Don\'t send email notifications when a backorder is made.', 'woo-backorder-manager' ),
					'desc'     => __( 'Disable backorder email notifications', 'woo-backorder-manager' ),
					'id'       => 'wcbm_backorder_mail_notification',
				),
				'wcbm_backorder_report_order_statuses' => array(
					'name'     => __( 'Report orders on backorder', 'woo-backorder-manager' ),
					'type'     => 'multiselect',
					'desc_tip' => __( 'Select which orders statuses should appear on report orders on backorder.', 'woo-backorder-manager' ),
					'desc'     => __( 'Selected order statuses appear in report orders on backorder', 'woo-backorder-manager' ),
					'id'       => 'wcbm_backorder_report_order_statuses',
					'options'  => $export_order_statuses,
				),
				'section_end' => array(
					'type' => 'sectionend',
					'id'   => 'wcbm_section_end',
				)
			);
		}

		return $settings;
	}


	/*
	 * Unhook/remove WooCommerce Emails
	 * @param $email_class
	 * @action woocommerce_email
	 */
	function woocommerce_remove_email_notifications( $email_class ) {

		$backorder_mail_notification = get_option( 'wcbm_backorder_mail_notification' );

		if ( false !== $backorder_mail_notification && 'no' !== $backorder_mail_notification ) {
			// unhooks sending email backorders during store events
			remove_action( 'woocommerce_product_on_backorder_notification', array( $email_class, 'backorder' ) );
		}
	}


	/**
	 * Add columns backorders to the shop order overview page.
	 *
	 * @param array $order_columns Columns on the shop order overview page.
	 * @filter manage_edit-shop_order_columns
	 */
	public function add_shop_order_column_backorders( $order_columns ) {
		$altered_order_columns = array_slice( $order_columns , 0, 2, true ) +
								 array( 'wcmb_backorders' => __( 'Backorders?', 'woo-backorder-manager' ) ) +
								 array_slice( $order_columns , 2, NULL, true) ;
		return $altered_order_columns;
	}


	/**
	 * Add content to the backorders column on the shop order overview page.
	 *
	 * @param string $colname The column name.
	 * @action manage_shop_order_posts_custom_column
	 */
	public function add_shop_order_column_backorders_content( $colname ) {
		global $the_order;

		if ( $colname === 'wcmb_backorders' ) {
			$items = $the_order->get_items();
			$backorders = 0;
			foreach ( $items as $item ) {
				if ( $item['Backordered'] ) {
					$backorders += $item['Backordered'];
				}
			}
			if ( ! empty( $backorders ) ) {
				echo $backorders;
			}
		}
	}


	/**
	 * Show reports 'On Backorder'
	 * @param array $reports
	 * @filter woocommerce_admin_reports
	 */
	public function register_backorder_reports( $reports ) {

		$orders_on_backorder = array(
			'title'       => __( 'On backorder', 'woo-backorder-manager' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_backorder_orders_report' ),
		);

		$reports['orders']['reports']['on_backorder'] = $orders_on_backorder;


		$stock_on_backorder = array(
			'title'       => __( 'On backorder', 'woo-backorder-manager' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_backorder_stock_report' ),
		);

		$reports['stock']['reports']['on_backorder'] = $stock_on_backorder;


		return $reports;
	}


	/**
	 * Callback for orders on backorder report
	 */
	public function get_backorder_orders_report() {
		include_once( 'include/wc_report_orders_backorders.php' );

		if ( ! class_exists( 'WC_Report_Orders_Backorders' ) )
			return;

		$report = new WC_Report_Orders_Backorders;
		$report->output_report();
	}


	/**
	 * Callback for stock on backorder report
	 */
	public function get_backorder_stock_report() {
		include_once( 'include/wc_report_stock_backorders.php' );

		if ( ! class_exists( 'WC_Report_Stock_Backorders' ) )
			return;

		$report = new WC_Report_Stock_Backorders;
		$report->output_report();
	}

}
$woobackordermanager = new WooBackorderManager();
