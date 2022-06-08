<?php
add_action( 'wp_enqueue_scripts', 'martfury_child_enqueue_scripts', 20 );
function martfury_child_enqueue_scripts() {
	wp_enqueue_style( 'martfury-child-style', get_stylesheet_uri() );
	if ( is_rtl() ) {
		wp_enqueue_style( 'martfury-rtl', get_template_directory_uri() . '/rtl.css', array(), '20180105' );
	}
}

/**
* change currency symbol to AED
*/

add_filter( 'woocommerce_currency_symbol', 'wc_change_uae_currency_symbol', 10, 2 );

function wc_change_uae_currency_symbol( $currency_symbol, $currency ) {
switch ( $currency ) {
case 'AED':
$currency_symbol = 'AED ';
break;
}

return $currency_symbol;
}
/**
 * Validation add for product cover image
 *
 * @param array $errors
 * @return array $errors 
 */
function dokan_can_add_product_validation_customized( $errors ) {
  $postdata       = wp_unslash( $_POST );
  $featured_image = absint( sanitize_text_field( $postdata['feat_image_id'] ) );
  $_regular_price = absint( sanitize_text_field( $postdata['_regular_price'] ) );
  if ( isset( $postdata['feat_image_id'] ) && empty( $featured_image ) && ! in_array( 'Please upload a product cover image' , $errors ) ) {
      $errors[] = 'Please upload a product cover image';
  }
  if ( isset( $postdata['_regular_price'] ) && empty( $_regular_price ) && ! in_array( 'Please insert product price' , $errors ) ) {
      $errors[] = 'Please insert product price';
  }
  return $errors;
}
add_filter( 'dokan_can_add_product', 'dokan_can_add_product_validation_customized', 35, 1 );
add_filter( 'dokan_can_edit_product', 'dokan_can_add_product_validation_customized', 35, 1 );
function dokan_new_product_popup_validation_customized( $errors, $data ) {
  if ( isset( $data['_regular_price'] ) && ! $data['_regular_price'] ) {
    return new WP_Error( 'no-price', __( 'Please insert product price', 'dokan-lite' ) );
  }
  if ( isset( $data['feat_image_id'] ) && ! $data['feat_image_id'] ) {
    return new WP_Error( 'no-image', __( 'Please select AT LEAST ONE Picture', 'dokan-lite' ) );
  }
}
add_filter( 'dokan_new_product_popup_args', 'dokan_new_product_popup_validation_customized', 35, 2 );
/**
* change landing page after login

function admin_default_page() {
  return 'www.swiddly.com/';
}

add_filter('login_redirect', 'admin_default_page');
*/
add_action( 'woocommerce_before_single_product_summary', 'seller_phone_on_single' );
/*
function seller_phone_on_single() {
     global $product;
    $seller = get_post_field( 'post_author', $product->get_id());
    $author  = get_user_by( 'id', $seller );
    $store_info = dokan_get_store_info( $author->ID );
      ?>
        <span class="details"><p>
			<?php printf('Contact the Seller on %s <a href="tel:%s" ><button style="background-color: var(--mf-background-primary-color);color: var(--mf-background-primary-text-color);" id="btn" > Call Number ! </button></a>', $store_info['phone'],$store_info['phone'])?><br>
			<?php printf('*Mention you found the listing on Swiddly')?>
			</p>
			
			
            
        </span>
    <?php
        
}
*/
/**
 * Rename WooCommerce "Brands" to "Manufacturers"
 *
 * @param array $args
 *
 * @return array
 
add_filter( 'register_taxonomy_product_brand', 'woocomerce_brands_filter', 10, 1 );
function woocomerce_brands_filter( $args ) {

 // Change the labels
 $args['label'] = __( 'Book Condition', 'custom' );
 $args['labels'] = array(
 'name' => __( 'Book Condition', 'custom' ),
 'singular_name' => __( 'Book Condition', 'custom' ),
 'search_items' => __( 'Search Book Condition', 'custom' ),
 'all_items' => __( 'All Book Conditions', 'custom' ),
 'parent_item' => __( 'Parent Book Condition', 'custom' ),
 'parent_item_colon' => __( 'Parent Book Condition:', 'custom' ),
 'edit_item' => __( 'Edit Book Condition', 'custom' ),
 'update_item' => __( 'Update Book Condition', 'custom' ),
 'add_new_item' => __( 'Add New Book Condition', 'custom' ),
 'new_item_name' => __( 'New Book Condition', 'custom' )
 );

 return $args;
}

 *  Allows you to customize the text before brand links in single product page
 
add_filter('pwb_text_before_brands_links', function( $text ) {
	return __( 'Book Condition', 'entry-meta' );
} );
*/
/*
 * Show Custom field Subject in single product Page
 * */
add_action('woocommerce_single_product_summary','show_product_subject',13);

function show_product_subject(){
      global $product;

        if ( empty( $product ) ) {
            return;
        }
$board_field = get_post_meta( $product->get_id(), 'board', true );
	$school_field = get_post_meta( $product->get_id(), 'school', true );
$new_field = get_post_meta( $product->get_id(), 'subject', true );
$Grade_field = get_post_meta( $product->get_id(), 'grade', true );
$ISBN_field = get_post_meta( $product->get_id(), 'isbn', true );
$Author_field = get_post_meta( $product->get_id(), 'author', true );
$Publisher_field = get_post_meta( $product->get_id(), 'publisher', true );
$volume_field = get_post_meta( $product->get_id(), 'volume', true );
$condition_field = get_post_meta( $product->get_id(), 'book_condition', true );
$wt_field = get_post_meta( $product->get_id(), 'weight_of_book_in_grams', true );
	if ( ! empty( $board_field ) ) {
            ?>
                  <span class="details"><?php echo esc_attr__( 'Board / Curriculum :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $board_field ); ?></strong></span><br>
<?php
		}
	if ( ! empty( $school_field ) ) {
            ?>
                  <span class="details"><?php echo esc_attr__( 'School :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $school_field ); ?></strong></span><br>
<?php
		}
	if ( ! empty( $Grade_field ) ) {
            ?>
                  <span class="details"><?php echo esc_attr__( 'Grade :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $Grade_field ); ?></strong></span><br>
<?php
		}
        if ( ! empty( $new_field ) ) {
            ?>
                  <span class="details"><?php echo esc_attr__( 'Subject :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $new_field ); ?></strong></span><br>
<?php
		}
	if ( ! empty( $volume_field ) ) {
            ?>
                  <span class="details"><?php echo esc_attr__( 'Volume :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $volume_field ); ?></strong></span><br>
<?php
		}
		if ( ! empty( $ISBN_field ) ) {
            ?>
					<span class="details"><?php echo esc_attr__( 'ISBN :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $ISBN_field ); ?></strong></span><br>
            <?php
        }
	if ( ! empty( $Author_field ) ) {
            ?>
					<span class="details"><?php echo esc_attr__( 'Author :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $Author_field ); ?></strong></span><br>
            <?php
        }
	if ( ! empty( $Publisher_field ) ) {
            ?>
					<span class="details"><?php echo esc_attr__( 'Publisher :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $Publisher_field ); ?></strong></span><br>
            <?php
        }
	if ( ! empty( $condition_field ) ) {
            ?>
					<span class="details"><?php echo esc_attr__( 'Book Condition :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $condition_field ); ?></strong></span><br>
            <?php
        }
	if ( ! empty( $wt_field ) ) {
            ?>
					<span class="details"><?php echo esc_attr__( 'Weight Of Book in grams :', 'dokan-lite' ); ?> <strong><?php echo esc_attr( $wt_field ); ?></strong></span><br>
            <?php
        }
	?>
<hr><?php
	
}

/* 
 * Code to add emirates to woocommerce shipping module
 * */

add_filter( 'woocommerce_states', 'fs_add_uae_emirates' );

function fs_add_uae_emirates( $states ) {
 $states['AE'] = array(
  'AZ' => __( 'Abu Dhabi', 'woocommerce' ),
  'AJ' => __( 'Ajman', 'woocommerce' ),
  'FU' => __( 'Fujairah', 'woocommerce' ),
  'SH' => __( 'Sharjah', 'woocommerce' ),
  'DU' => __( 'Dubai', 'woocommerce' ),
  'RK' => __( 'Ras Al Khaimah','woocommerce' ),
  'UQ' => __( 'Umm Al Quwain', 'woocommerce' ),
 );
 return $states;
}

/*
 * send below information in email to the customer after order table
 */
add_action( 'woocommerce_email_after_order_table', 'mm_email_after_order_table', 10, 4 );
function mm_email_after_order_table( $order, $sent_to_admin, $plain_text, $email ) { 
		       echo "<p> Hey! Thanks for shopping with us.</p>";
}

/*
 * add vendor information to order If the order is local pickup  from seller
 */ 
add_action( 'woocommerce_checkout_create_order_line_item', 'dp_add_vendor_to_order_item_meta', 10, 2);
function dp_add_vendor_to_order_item_meta( $item_id, $cart_item) {      
        $vendor_id = $cart_item[ 'data' ]->post->post_author;
// build up address 
        $address1           = get_user_meta( $vendor_id , 'billing_address_1', true );
        $address2           = get_user_meta( $vendor_id , 'billing_address_2', true );
        $city               = get_user_meta( $vendor_id , 'billing_city', true ); 
        $store_postcode     = get_user_meta( $vendor_id , 'billing_postcode', true ); 
        $state              = get_user_meta( $vendor_id , 'billing_state', true ); 
        $address            = ( $address1 != '') ? $address1 .', ' . $city .', ' . $state.', '. $store_postcode :''; 
    
    wc_add_order_item_meta( $item_id, apply_filters('vendors_sold_by_in_email', __('Recoger en', 'vendors')), $address);
}
add_action( 'woocommerce_checkout_create_order_line_item', 'email_add_vendor_to_order_item_meta', 10, 3);
function email_add_vendor_to_order_item_meta( $item_id, $cart_item) {       
       $vendor_id       = $cart_item[ 'data' ]->post->post_author;
       $email_vendor    = get_userdata( $vendor_id )->user_email;
    
    wc_add_order_item_meta( $item_id, apply_filters('vendors_sold_by_in_email', __('Email', 'vendors')), $email_vendor);
}

/*
 * Enable stock management for new products added
 */

$postType = "product";

add_action("save_post_" . $postType, function ($post_ID, \WP_Post $post, $update) {

    if (!$update) {

        // default values for new products

        update_post_meta($post->ID, "_manage_stock", "yes");
        update_post_meta($post->ID, "_stock", 1);


        return;

    }


    // here, operations for updated products


}, 10, 3);

remove_filter( 'woocommerce_cart_shipping_packages', 
'dokan_custom_split_shipping_packages' );
