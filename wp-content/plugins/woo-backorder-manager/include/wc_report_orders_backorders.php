<?php
/** If this file is called directly, abort. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Report_Stock' ) ) {
	require_once( WP_PLUGIN_DIR . '/woocommerce/includes/admin/reports/class-wc-report-stock.php' );
}

/**
 * class WC_Report_Orders_Backorders
 * the 'Orders On backorder' report class
 */
class WC_Report_Orders_Backorders extends WC_Report_Stock {

	/**
	 * No items found text
	 */
	public function no_items() {
		_e( 'No backordered items found.', 'woo-backorder-manager' );
	}


	/**
	 * Translate a string to another locale.
	 *
	 * @param string $string
	 * @param string $locale
	 * @param string $textdomain
	 */
	private function jeffreywp_translate_to_locale( $string, $locale, $textdomain = 'woocommerce' ){

		if ( $locale === 'en_US' ) {
			return $string; // Default WP language doesn't need translating.
		}

		$mo = new MO;
		$mofile = get_home_path() . 'wp-content/languages/plugins/' . $textdomain . '-' . $locale . '.mo';
		$mo->import_from_file( $mofile );
		$translation = $mo->translate( $string ); // Get the translation.

		return $translation;
	}

	private function jeffreywp_get_backordered_terms() {
		$backordered_terms = [
			'Backordered', // WooCommerce default backordered meta term.
			__( 'Backordered', 'woocommerce' ), // WC backordered meta term in admin language.
		];

		$language_website = get_locale();
		// website language is different from admin language?
		if ( $language_website !== get_user_locale() ) {
			$backordered_terms[] = $this->jeffreywp_translate_to_locale( 'Backordered', $language_website ); // WC backordered meta term in website language.
		}

		return array_unique( $backordered_terms );
	}


	/**
	 * Get Products matching stock criteria
	 */
	public function get_items() {
		global $wpdb;

		$this->items = array();

		$backordered_terms = $this->jeffreywp_get_backordered_terms();

		// Transform backordered terms array into SQL string
		$backordered_terms = implode( "','", array_map( 'esc_sql', $backordered_terms ) );

		$export_order_statuses = get_option( 'wcbm_backorder_report_order_statuses' );
		if ( false === $export_order_statuses) {
			// Never set on settings page => use default.
			$export_order_statuses = ['wc-processing', 'wc-pending', 'wc-on-hold'];
		} elseif ( empty( $export_order_statuses ) ) {
			// Show warning orders statuses set to empty.
			echo '<div class="error message"><p>';
			echo __('You have not selected any orders statuses for export.', 'woo-backorder-manager' ) . '<br /><br />';
			echo '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=backordermanager' ) . '" class="button-secondary">' . __( 'Select order status for export', 'woo-backorder-manager' ) . '</a>';
			echo '</p></div>';

			return;
		}

		// Get orders using a query (too advanced for get_posts)
		$this->items = $wpdb->get_results( "SELECT {$wpdb->prefix}woocommerce_order_itemmeta.order_item_id, {$wpdb->prefix}woocommerce_order_items.order_id, {$wpdb->prefix}woocommerce_order_items.order_item_name, {$wpdb->posts}.post_date, {$wpdb->prefix}woocommerce_order_itemmeta.meta_value AS quantity
		FROM {$wpdb->prefix}woocommerce_order_itemmeta
		LEFT JOIN {$wpdb->prefix}woocommerce_order_items ON ( {$wpdb->prefix}woocommerce_order_items.order_item_id = {$wpdb->prefix}woocommerce_order_itemmeta.order_item_id )
		LEFT JOIN {$wpdb->posts} ON ({$wpdb->prefix}woocommerce_order_items.order_id = {$wpdb->posts}.ID)
		WHERE ({$wpdb->prefix}woocommerce_order_itemmeta.meta_key IN ('{$backordered_terms}'))
		AND ({$wpdb->posts}.post_status IN ('" . implode( "','", $export_order_statuses ) . "'))
		AND ({$wpdb->prefix}woocommerce_order_itemmeta.meta_value != '0')
		ORDER BY {$wpdb->posts}.post_date DESC" );
	}


	/**
	 * Output the report
	 */
	public function output_report() {
		global $wcbm_total_backorder_items;

		$backordered_terms = $this->jeffreywp_get_backordered_terms();
		// Transform backordered terms array into URL string
		$backordered_terms = implode( '&backordered_terms[]=', $backordered_terms );

		$this->prepare_items();
		echo '<div class="woocommerce-reports-wide">';
		$this->display();
		echo '</div>';
		echo '<p><a href="' . esc_url( plugin_dir_url( __FILE__ ) . 'csv-export-orders.php?backordered_terms[]=' . $backordered_terms ) . '">' . __( 'CSV export', 'woo-backorder-manager' ) . '</a> | ' . sprintf ( __( 'Total orders with items on backorder: %d', 'woo-backorder-manager' ), $wcbm_total_backorder_items ) . '</p>';
	}


	/**
	 * Get column value.
	 * @param mixed $item
	 * @param string $column_name
	 */
	public function column_default( $item, $column_name ) {
		global $wcbm_total_backorder_items;

		if ( ! $wcbm_total_backorder_items ) {
			$wcbm_total_backorder_items = 0;
		}

		switch( $column_name ) {

			case 'order_id' :
				echo '<a href="' . get_admin_url( null, 'post.php?post=' . $item->order_id . '&action=edit' ) . '">#' . $item->order_id . '</a>';
				$wcbm_total_backorder_items++;
				break;

			case 'product' :
				// Get product ID
				$product_id = wc_get_order_item_meta( $item->order_item_id, '_product_id', true );
				// Get WC_Product
				if ( $product = wc_get_product( $product_id ) ) {
					echo '<a href="' . get_admin_url( null, 'post.php?post=' . $product_id . '&action=edit' ) . '">';
					// SKU available?
					if ( $sku = $product->get_sku() ) {
						echo $sku . ' - ';
					}
					echo $item->order_item_name . '</a>';
				} else {
					// product has no link (product is deleted)
					echo $item->order_item_name;
				}
				break;

			case 'customer_name' :
				$first_name = get_post_meta( $item->order_id, '_billing_first_name', true );
				$last_name = get_post_meta( $item->order_id, '_billing_last_name', true) ;
				echo $first_name . ' ' . $last_name;
				break;

			case 'order_date' :
				echo $item->post_date;
				break;

			case 'quantity' :
				echo $item->quantity;
				break;
		}
	}


	/**
	 * get_columns function.
	 */
	public function get_columns() {

		$columns = array(
			'order_id'      => __( 'Order', 'woo-backorder-manager' ),
			'product'       => __( 'Product', 'woo-backorder-manager' ),
			'customer_name' => __( 'Customer name', 'woo-backorder-manager' ),
			'order_date'    => __( 'Date', 'woo-backorder-manager' ),
			'quantity'      => __( 'Quantity', 'woo-backorder-manager' ),
		);

		return $columns;
	}


	/**
	 * prepare_items function.
	 */
	public function prepare_items() {
		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );

		$this->get_items();
	}
}
