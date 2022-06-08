<?php
/**
 * New Product Email.
 *
 * An email sent to the admin when a new Product is created by vendor.
 *
 * @class       Dokan_Email_New_Product_Pending
 * @version     2.6.8
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php esc_html_e( 'Hello,', 'dokan-lite' ); ?></p>

<p><?php esc_html_e( 'A new product is submitted to your site and is pending review', 'dokan-lite' ); ?> <a href="<?php echo esc_url( $data['site_url'] ); ?>" ><?php echo esc_html( $data['site_name'] ); ?></a> </p>
<p><?php esc_html_e( 'Summary of the product:', 'dokan-lite' ); ?></p>
<hr>
<ul>
    <li>
        <strong>
            <?php esc_html_e( 'Title :', 'dokan-lite' ); ?>
        </strong>
        <?php printf( '<a href="%s">%s</a>', esc_url( $data['product_link'] ), esc_html( $data['product-title'] ) ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Price :', 'dokan-lite' ); ?>
        </strong>
        <?php echo wp_kses_post( wc_price( $data['price'] ) ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Vendor :', 'dokan-lite' ); ?>
        </strong>
        <?php
        printf( '<a href="%s">%s</a>', esc_url( $data['seller_url'] ), esc_html( $data['seller-name'] ) ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Category :', 'dokan-lite' ); ?>
        </strong>
        <?php echo esc_html( $data['category'] ); ?>
    </li>

</ul>
<p><?php esc_html_e( 'The product is currently in "pending" status.', 'dokan-lite' ); ?></p>
<p>
<center> 
	<?php printf('<a href="https://wa.me/message/QDX5HF7INHAZF1"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/whatsappIcon.png"></a>'); ?>
	<?php printf('<a href="https://www.facebook.com/Swiddly-276042824251507/"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/facebookIcon.png"></a>'); ?>
	<?php printf('<a href="www.instagram.com/swiddly/"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/instIcon.png"></a>'); ?>
	<?php printf('<a href="https://twitter.com/swiddly_dubai"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/TwitterICon.png"></a>'); ?>
	<?php printf('<a href="https://www.youtube.com/channel/UCH_S0IVfW-4NU1-19nVDbcw"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/YtIcon.png"></a>'); ?>
</center>
</p>

<?php

do_action( 'woocommerce_email_footer', $email );