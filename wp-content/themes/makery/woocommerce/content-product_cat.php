<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}

global $woocommerce_loop;

if(empty($woocommerce_loop['loop'])) {
	$woocommerce_loop['loop']=0;
}

if(empty($woocommerce_loop['columns'])) {
	$woocommerce_loop['columns']=apply_filters('loop_shop_columns', 3);
}

$width='four';
if($woocommerce_loop['columns']==4) {
	$width='three';
}

$woocommerce_loop['loop']++;
?>
<div class="product-category column <?php echo $width; ?>col <?php if($woocommerce_loop['loop']%$woocommerce_loop['columns']==0) { ?>last<?php } ?>">
	<?php do_action('woocommerce_before_subcategory', $category); ?>	
		<?php do_action('woocommerce_before_subcategory_title', $category); ?>
		<h3 class="category-title">
			<a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>">
				<?php
				echo $category->name;
				if($category->count>0) {
					echo apply_filters('woocommerce_subcategory_count_html', ' ('.$category->count.')', $category);
				}					
				?>
			</a>
		</h3>
		<?php do_action('woocommerce_after_subcategory_title', $category); ?>	
	<?php do_action('woocommerce_after_subcategory', $category); ?>
</div>