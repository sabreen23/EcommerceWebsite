<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}

remove_filter('the_title', 'wc_page_endpoint_title');
$order=wc_get_order($order_id);
?>
<table class="profile-fields">
	<tbody>
		<tr>
			<th><?php _e('Number', 'makery'); ?></th>
			<td>
				<?php echo $order->get_order_number(); ?>
			</td>
		</tr>
		<tr>
			<th><?php _e('Date', 'makery'); ?></th>
			<td>
				<?php echo date_i18n(get_option('date_format'), strtotime($order->get_date_created())); ?>
			</td>
		</tr>
		<tr>
			<th><?php _e('Status', 'makery'); ?></th>
			<td>
				<?php echo wc_get_order_status_name($order->get_status()); ?>
			</td>
		</tr>
		<?php
		if(!ThemexCore::checkOption('shop_multiple')) {
			$author=themex_author($order->get_id());
			$shop=ThemexUser::getShop($author);
			if(!empty($shop)) {
			?>
			<tr>
				<th><?php _e('Shop', 'makery'); ?></th>
				<td>
					<a href="<?php echo get_permalink($shop); ?>"><?php echo get_the_title($shop); ?></a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>
<table class="profile-table shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e('Product', 'makery' ); ?></th>
			<th class="product-total"><?php _e('Total', 'makery' ); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if(sizeof($order->get_items())>0){
		foreach($order->get_items() as $item){
			$_product=apply_filters('woocommerce_order_item_product', $order->get_product_from_item($item), $item);
			?>
			<tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
				<td class="product-name">
					<?php
						if($_product && !$_product->is_visible() )
							echo apply_filters('woocommerce_order_item_name', $item['name'], $item );
						else
							echo apply_filters('woocommerce_order_item_name', sprintf('<a href="%s">%s</a>', get_permalink($item['product_id']), $item['name']), $item );

						echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">'.sprintf('&times; %s', $item['qty']).'</strong>', $item);

						wc_display_item_meta($item);

						if($_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted()){

							$download_files=$item->get_item_downloads($item );
							$i=0;
							$links=array();

							foreach($download_files as $download_id => $file ){
								$i++;

								$links[]='<small class="product-download"><a href="'.esc_url($file['download_url'] ).'">'.esc_html($file['name'] ).'</a></small>';
							}

							echo '<br/>'.implode('<br/>', $links);
						}
					?>
				</td>
				<td class="product-total">
					<?php echo $order->get_formatted_line_subtotal($item); ?>
				</td>
			</tr>
			<?php
			if($order->has_status(array('completed', 'processing')) && ($purchase_note=get_post_meta($_product->get_id(), '_purchase_note', true))){
				?>
				<tr class="product-purchase-note">
					<td colspan="3"><?php echo wpautop(do_shortcode($purchase_note)); ?></td>
				</tr>
				<?php
			}
		}
	}

	do_action('woocommerce_order_items_table', $order);
	?>
	</tbody>
	<tfoot>
	<?php
	if($totals=$order->get_order_item_totals()){
		foreach($totals as $total){
			?>
			<tr>
				<th scope="row"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		}
	}
	?>
	</tfoot>
</table>
<table class="profile-table">
	<tbody>
		<tr>
			<th><?php _e('Customer Details', 'makery'); ?></th>
			<td>
				<?php if($order->get_billing_email()!='') { ?>
				<strong><?php _e('Email:', 'makery'); ?></strong>&nbsp;<?php echo $order->get_billing_email(); ?><br />
				<?php } ?>
				<?php if($order->get_billing_phone()!='') { ?>
				<strong><?php _e('Phone:', 'makery'); ?></strong>&nbsp;<?php echo $order->get_billing_phone(); ?>
				<?php } ?>
				<?php do_action('woocommerce_order_details_after_customer_details', $order); ?>
			</td>
		</tr>
		<tr>
			<?php if(!wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option('woocommerce_calc_shipping')!=='no' && $order->get_formatted_shipping_address()!=$order->get_formatted_billing_address()){ ?>
			<th><?php _e('Billing Address', 'makery'); ?></th>
			<?php } else { ?>
			<th><?php _e('Customer Address', 'makery'); ?></th>
			<?php } ?>
			<td>
				<address><?php echo $order->get_formatted_billing_address(); ?></address>
			</td>
		</tr>
		<?php if(!wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option('woocommerce_calc_shipping')!=='no' && $order->get_formatted_shipping_address()!=$order->get_formatted_billing_address()){ ?>
		<tr>
			<th><?php _e('Shipping Address', 'makery'); ?></th>
			<td>
				<address><?php echo $order->get_formatted_shipping_address(); ?></address>
			</td>
		</tr>
		<?php } ?>
		<?php if($order->get_customer_note()!='') { ?>
		<tr>
			<th><?php _e('Customer Note', 'makery'); ?></th>
			<td>
				<?php echo nl2br(esc_html($order->get_customer_note())); ?>
			</td>
		</tr>
		<?php } ?>
		<?php
		$note=ThemexWoo::getNote($order->get_id());

		if(!empty($note)) {
		?>
		<tr>
			<th><?php _e('Order Note', 'makery'); ?></th>
			<td>
				<?php echo nl2br(esc_html($note)); ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php do_action('woocommerce_order_details_after_order_table', $order); ?>
