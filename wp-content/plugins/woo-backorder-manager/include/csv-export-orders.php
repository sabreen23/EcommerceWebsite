<?php
// no need for the template engine
define( 'WP_USE_THEMES', false );
// Load WordPress Core
require_once( '../../../../wp-load.php' );

// user has sufficient capabilities?
if ( ! current_user_can( 'view_woocommerce_reports' ) ) {
	_e( 'No access! Please login first.', 'woo-backorder-manager' );
	die();
}

header( 'Content-type: text/csv; charset=utf-8' );
header( 'Content-Disposition: attachment; filename=backorders-orders-' . date( 'Y-m-d' ) . '.csv' );

// header column
echo __( 'Order', 'woo-backorder-manager' ) . ';';
echo __( 'SKU', 'woo-backorder-manager' ) . ';';
echo __( 'Product', 'woo-backorder-manager' ) . ';';
echo __( 'Customer name', 'woo-backorder-manager' ) . ';';
echo __( 'Customer email address', 'woo-backorder-manager' ) . ';';
echo __( 'Date', 'woo-backorder-manager' ) . ';';
echo __( 'Quantity', 'woo-backorder-manager' ) . "\r\n";

global $wpdb;

// Transform backordered terms array into SQL string
$backordered_terms = isset( $_GET['backordered_terms'] ) ? implode( "','", array_map( 'esc_sql', $_GET['backordered_terms'] ) ) : 'Backordered';

$export_order_statuses = get_option( 'wcbm_backorder_report_order_statuses' );
if ( false === $export_order_statuses) {
	// Never set on settings page => use default.
	$export_order_statuses = ['wc-processing', 'wc-pending', 'wc-on-hold'];
}

// Get orders using a query (too advanced for get_posts)
$query_results = $wpdb->get_results( "SELECT {$wpdb->prefix}woocommerce_order_itemmeta.order_item_id, {$wpdb->prefix}woocommerce_order_items.order_id, {$wpdb->prefix}woocommerce_order_items.order_item_name, {$wpdb->posts}.post_date, {$wpdb->prefix}woocommerce_order_itemmeta.meta_value AS quantity
	FROM {$wpdb->prefix}woocommerce_order_itemmeta
	LEFT JOIN {$wpdb->prefix}woocommerce_order_items ON ( {$wpdb->prefix}woocommerce_order_items.order_item_id = {$wpdb->prefix}woocommerce_order_itemmeta.order_item_id )
	LEFT JOIN {$wpdb->posts} ON ({$wpdb->prefix}woocommerce_order_items.order_id = {$wpdb->posts}.ID)
	WHERE ({$wpdb->prefix}woocommerce_order_itemmeta.meta_key IN ('{$backordered_terms}'))
	AND ({$wpdb->posts}.post_status IN ('" . implode( "','", $export_order_statuses ) . "'))
	AND ({$wpdb->prefix}woocommerce_order_itemmeta.meta_value != '0')
	ORDER BY {$wpdb->posts}.post_date DESC", OBJECT );

foreach ( $query_results as $query_result ) :

	// Order
	echo '#' . $query_result->order_id . ';';

	// Get product ID
	$product_id = wc_get_order_item_meta( $query_result->order_item_id, '_product_id', true );

	// Get WC_Product
	if ( $product = wc_get_product( $product_id ) ) {
		// SKU
		$sku = $product->get_sku();
		// enclose SKU and escape ""
		echo '"' . str_replace( '"', '""', $sku ) . '";';
	} else {
		echo '"";';
	}

	// Item description (enclose and escape "")
	echo '"' . str_replace( '"', '""', $query_result->order_item_name ) . '";';

	// Customer name (enclose and escape "")
	$first_name = get_post_meta( $query_result->order_id, '_billing_first_name', true );
	$last_name = get_post_meta( $query_result->order_id, '_billing_last_name', true);
	echo '"' . str_replace( '"', '""', $first_name . ' ' . $last_name ) . '";';

	// Customer mail (enclose and escape "")
	echo '"' . str_replace( '"', '""', get_post_meta( $query_result->order_id, '_billing_email', true) ) . '";';

	// Date
	echo $query_result->post_date . ';';

	// Quantity
	echo $query_result->quantity . ';';

	echo "\r\n";

endforeach;
