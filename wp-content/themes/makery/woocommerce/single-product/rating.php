<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}

global $product;

if(get_option('woocommerce_enable_review_rating')==='no') {
	return;
}

$count=$product->get_rating_count();
$average=$product->get_average_rating();

if($count>0) {
?>
<div class="title-option right" title="<?php printf(_n('%s Review', '%s Reviews', $count, 'makery'), $count); ?>">
	<div class="element-rating" data-score="<?php echo $average; ?>"></div>
	<div class="hidden"><?php echo $average; ?></div>
</div>
<?php } ?>