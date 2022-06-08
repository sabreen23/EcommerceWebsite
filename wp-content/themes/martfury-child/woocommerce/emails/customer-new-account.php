<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer username */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $user_login ) ); ?></p>
<?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>
<p><?php printf( esc_html__( 'Thanks for creating an account on %1$s. Your username is %2$s. You can access your account area to view orders, change your password, and more at: %3$s', 'woocommerce' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>', make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
	<?php /* translators: %s: Auto generated password */ ?>
	<p><?php printf( esc_html__( 'Your password has been automatically generated: %s', 'woocommerce' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>
<?php endif; ?>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}
?>
<p>
<center> 
	<?php printf('<a href="https://wa.me/message/QDX5HF7INHAZF1"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/whatsappIcon.png"></a>'); ?>
	<?php printf('<a href="https://www.facebook.com/Swiddly-276042824251507"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/facebookIcon.png"></a>'); ?>
	<?php printf('<a href="www.instagram.com/swiddly"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/instIcon.png"></a>'); ?>
	<?php printf('<a href="https://twitter.com/swiddly_dubai"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/TwitterICon.png"></a>'); ?>
	<?php printf('<a href="https://www.youtube.com/channel/UCH_S0IVfW-4NU1-19nVDbcw"><img src="http://www.swiddly.com/wp-content/uploads/2021/12/YtIcon.png"></a>'); ?>
</center>
</p>
<?php
do_action( 'woocommerce_email_footer', $email );

