<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}

global $post, $product;

$cat_count=sizeof((array)get_the_terms($post->ID, 'product_cat'));
$tag_count=sizeof((array)get_the_terms($post->ID, 'product_tag'));
?>
<footer class="item-footer clearfix">
	<?php do_action('woocommerce_product_meta_start'); ?>
	<div class="column sixcol">
		<?php if(wc_product_sku_enabled() && ($product->get_sku()|| $product->is_type('variable'))): ?>
		<div class="item-sku left">
			<span class="fa fa-inbox"></span>
			<span class="sku"><?php echo($sku = $product->get_sku())?$sku:__('N/A', 'makery'); ?></span>
		</div>
		<?php endif; ?>
		<div class="item-category left">
			<span class="fa fa-reorder"></span>
			<?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
		</div>
	</div>
	<div class="column sixcol last">
		<div class="tagcloud right">
			<?php echo wc_get_product_tag_list($product->get_id(), ''); ?>
		</div>
	</div>
	<?php do_action('woocommerce_product_meta_end'); ?>
</footer>
