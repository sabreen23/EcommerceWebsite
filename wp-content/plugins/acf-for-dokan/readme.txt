=== ACF For Dokan ===
Plugin Name: ACF For Dokan
Plugin URI: https://wordpress.org/plugins/acf-for-dokan/
Author: krazyplugins
Author URI: http://krazyplugins.com/
Contributors: krazyplugins
Tags: acf, advanced custom fields, dokan, multivendor, marketplace
Donate link: https://krazyplugins.com/plugin-support/
Requires at least: 5.1
Tested up to: 5.8
Stable tag: 1.3.3
Copyright: (c) 2021 KrazyPlugins (krazyplugins@gmail.com)
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Allows admin to create new custom field for vendor add/edit product in vendor dashboard.

== Description ==
Admin can easily create custom fields for vendors while he is creating new products. While creating a custom field using Advance Custom Field, admin needs to select 'Vendor Edits Allowed' so that vendor can use that custom field. Right now the supported field types of ACF are text, textarea, number, url, select, checkbox, radio, file, email, WYSIWYG editor. 
The WYSIWYG editor will only work in edit product pages. 
The file ACF field type will only work in edit product pages.

<iframe width="560" height="315" src="https://www.youtube.com/embed/h_Bd0CcAgvM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

You can use ACF functions like the_field, get_field to display the custom field value for the product.

The plugin will work with ACF and Dokan free as well as PRO versions.

[ACF For Dokan PRO](https://krazyplugins.com/product/acf-for-dokan-pro/?utm_source=readme&utm_medium=wporg&utm_campaign=free)
• Supported multiple ACF Field groups
• Conditional logic for product add/edit custom fields
• Ajax search for select field in product add/edit form
• Gallery field for product
• Create custom fields for vendor registration form as well as order post type
• Vendor can update it from edit account page
• Vendor can update order meta from edit order page in vendor dashboard
• Supported field types are text, textarea, number, url, select, email, checkbox, radio

Pro Plugin Demo : <a href ="https://krazyplugins.com/demo/" target="_blank">View</a>

== 👉 Premium WooCommerce Plugin ==
* [ACF For WooCommerce](https://krazyplugins.com/product/acf-for-woocommerce/?utm_source=readme&utm_medium=wporg&utm_campaign=free)

== Installation ==

1. Copy the `acf-for-dokan` folder into your 'wp-content/plugins' folder.
2. Activate the ACF For Dokan plugin via the plugins admin page.
3. Create a new field via ACF and select the 'Vendor Edits Allowed'.

== Frequently Asked Questions ==

= How to use =
Admin can easily create custom fields for product. Admin will have an extra setting to allow Vendor to Edit option. If this is enabled, vendor can add/update the custom field from vendor dashboard.

= How do I display the field on the Product Page? =

You can add the below code in the active theme’s functions.php file:

`add_action( 'woocommerce_product_meta_end', 'acf_dokan_display_product_fields' );
function acf_dokan_display_product_fields(){
	echo '<div class="custom_fields"><span class="meta_title"> Product Code: '; // change Product Code label to the field label
		the_field( 'product_code' ); // change product_code to field slug
	echo '</div>';
}`

== Screenshots ==

1. It shows how you can enable custom field for add/edit product in vendor dashboard.
2. It shows list of all the fields enabled for vendor to add/edit.
3. It shows fields enabled from ACF in vendor dashboard add product popup.
4. It shows fields enabled from ACF in vendor dashboard edit product page.

== Changelog ==

= 1.3 =
* Added support of custom field require validation in edit product form

= 1.2 =
* Added support of radio and file ACF field type

= 1.1 =
* Added support of checkbox ACF field type

= 1.0.2 =
* Fixed foreach error

= 1.0 =
* Initial Release.
