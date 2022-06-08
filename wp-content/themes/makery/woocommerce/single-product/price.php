<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}

global $product;
?>
<div class="item-price">
	<div class="price">
		<?php echo $product->get_price_html(); ?>
	</div>	
</div>