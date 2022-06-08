<?php
/*
@version 4.3.0
*/

if(!defined('ABSPATH')) {
    exit;
}
?>
<div class="element-title">
	<h1 class="product_title entry-title"><?php the_title(); ?></h1>
	<?php woocommerce_template_single_rating(); ?>
</div>