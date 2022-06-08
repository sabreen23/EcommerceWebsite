<?php
/**
 * New Withdraw request Email.
 *
 * An email sent to the admin when a new withdraw request is created by vendor.
 *
 * @class       Dokan_Vendor_Withdraw_Request
 * @version     2.6.8
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p>
    <?php esc_html_e( 'Hi,', 'dokan-lite' ); ?>
</p>
<p>
    <?php esc_html_e( 'A new withdraw request has been made by', 'dokan-lite' ); ?> <?php echo esc_attr( $data ['username'] ); ?>.
</p>
<hr>
<ul>
    <li>
        <strong>
            <?php esc_html_e( 'Username : ', 'dokan-lite' ); ?>
        </strong>
        <?php
        printf( '<a href="%s">%s</a>', esc_attr( $data['profile_url'] ), esc_attr( $data['username'] ) ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Request Amount:', 'dokan-lite' ); ?>
        </strong>
        <?php echo wp_kses_post( $data['amount'] ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Payment Method: ', 'dokan-lite' ); ?>
        </strong>
        <?php echo esc_attr( $data['method'] ); ?>
    </li>
</ul>

<?php echo wp_kses_post( sprintf( __( 'You can approve or deny it by going <a href="%s"> here </a>', 'dokan-lite' ), esc_attr( $data['withdraw_page'] ) ) );?>
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
do_action( 'woocommerce_email_footer', $email );?>
