<?php
/**
 * Class for ACF Field support for Dokan.
 *
 * @package WordPress
 * @subpackage Dokan
 */

// If check class exists.
if ( ! class_exists( 'ACF_For_Dokan' ) ) {

	/**
	 * Declare class.
	 */
	class ACF_For_Dokan {

		/**
		 * ACF Settings.
		 *
		 * @var settings
		 */
		var $settings;

		/**
		 * Admin notice message.
		 *
		 * @var message
		 */
		var $message;

		/**
		 * Calling construct.
		 */
		public function __construct() {
			// Setting.
			$this->settings = array(
				'version' => '1.0',
				'url' => plugin_dir_url( __FILE__ ),
				'path' => plugin_dir_path( __FILE__ ),
			);
			// ACF For Dokan plugin error message.
			$this->message = esc_attr__( '"%s" needs "%s" to run. Please download and activate it', 'acf-for-dokan' );

			// Admin notice.
			add_action( 'admin_notices', array( $this, 'acf_dokan_check_acf_is_activate' ) );

			// PRO version link
			add_filter( 'plugin_action_links_' . ACF_FOR_DOKAN_BASENAME, array( $this, 'acf_dokan_plugin_action_links' ) );

			// Review and Donate link
			add_filter( 'plugin_row_meta', array( $this, 'acf_dokan_plugin_meta_links' ), 10, 4 );
			
			// If check required plugin working OR not.
			if ( ! class_exists( 'acf' ) || ! class_exists( 'WeDevs_Dokan' ) ) {
				return;
			}

			// Add support of allow vendor field in custom field panel.
			add_action( 'acf/render_field_settings', array( $this, 'acf_dokan_vendor_only_render_field_settings' ) );
			
			// Register custom fields for add product form.
			add_action( 'dokan_new_product_after_product_tags', array( $this, 'acf_dokan_product_field' ), 10 );
			
			// show data in vendor product edit form.
			add_action( 'dokan_product_edit_after_product_tags', array( $this, 'acf_dokan_show_on_edit_page' ), 99, 2 );
			
			// save custom field data in product meta.
			add_action( 'dokan_new_product_added', array( $this, 'acf_dokan_save_add_product_meta' ), 10, 2 );
			add_action( 'dokan_product_updated', array( $this, 'acf_dokan_save_add_product_meta' ), 10, 2 );
			
			// register css and js.
			add_action( 'wp_enqueue_scripts', array( $this, 'acf_dokan_register_styles' ) );

		}

		/**
		 * Check if ACF and Dokan plugins active or not.
		 */
		public function acf_dokan_check_acf_is_activate() {
			if ( ! class_exists( 'acf' ) ) {
				echo '<div class="notice notice-error is-dismissible"><p>' . wp_sprintf( $this->message, esc_attr__( 'ACF For Dokan', 'acf-for-dokan' ), esc_attr__( 'Advanced Custom Fields', 'acf-for-dokan' ) ) . '</p></div>';
			} else if ( ! class_exists( 'WeDevs_Dokan' ) ) {
				echo '<div class="notice notice-error is-dismissible"><p>' . wp_sprintf( $this->message, esc_attr__( 'ACF For Dokan', 'acf-for-dokan' ), esc_attr__( 'Dokan Multivendor Marketplace', 'acf-for-dokan' ) ) . '</p></div>';
			}
		}

		/**
	     * Plugin action links
	     *
	     * @param array $links
	     */
	    public function acf_dokan_plugin_action_links( $links ) {
            $links[] = '<a href="https://krazyplugins.com/product/acf-for-dokan-pro/" style="color: #389e38;font-weight: bold;" target="_blank">' . __( 'Get Pro', 'acf-for-dokan' ) . '</a>';
	        return $links;
	    }

	    /**
		 * Add plugin_row_meta links
		 * @param array $plugin_meta links
		 * @param string $plugin_file plugin file name
		 * @param array $plugin_data plugin data
		 * @param string $status plugin status
		 */
		function acf_dokan_plugin_meta_links( $plugin_meta, $plugin_file, $plugin_data, $status ) {
			if ( strpos( $plugin_file, 'acf-for-dokan.php' ) ) {
		        $new_links = array(
                	'donate' => '<a href="https://wordpress.org/support/plugin/acf-for-dokan/reviews/#new-post" target="_blank">' . __( 'Leave a Review','acf-for-dokan' ). '</a>',
                	'doc' => '<a href="https://krazyplugins.com/plugin-support/" target="_blank">' . __( 'Donate to author', 'acf-for-dokan' ) . '</a>'
                );
		        $plugin_meta = array_merge( $plugin_meta, $new_links );
		    }
		    return $plugin_meta;
		}

		/**
		 * Add field for Vendor edits.
		 *
		 * @param array $field ACF Field.
		 */
		public function acf_dokan_vendor_only_render_field_settings( $field ) {
			acf_render_field_setting( $field,
				array(
					'label'         => esc_attr__( 'Vendor Edits Allowed?', 'acf-for-dokan' ),
					'instructions'  => '',
					'name'          => 'vendor_edit',
					'type'          => 'true_false',
					'ui'            => 1,
			), true );
		}

		/**
		 * Get custom fields for product post type.
		 *
		 * @return string
		 */
		public function acf_dokan_get_custom_fields(){
			$fields = acf_get_raw_field_groups();
			$products_fields = array();
			foreach ( $fields as $key => $value ) {
				foreach ( $value['location'] as $locations ) {
					foreach ( $locations as $location ) {
						if( $location['param'] == 'post_type' && $location['value'] == 'product' && $location['operator'] == '==' ) {
							$products_fields[] = $value;
						}
					}
				}
			}
			$acfs = array();
			foreach ( $products_fields as $key => $value ) {
				$acfs[] = acf_get_raw_fields( $value['ID'] );
			}
			return $acfs;
		}

		/**
		 * Adding extra field on New product popup/without popup form.
		 */
		public function acf_dokan_product_field(){ 
			$acfs = $this->acf_dokan_get_custom_fields();
			if ( is_array ($acfs) ) {
				foreach ( $acfs as $key => $acf ) {
					foreach ( $acf as $key => $value ) {
						// Check Vendor edit allowed from custom field settings.
						if( $value['vendor_edit'] ) {
							$label = sanitize_text_field( $value['label'] );
							$type = sanitize_text_field( $value['type'] );
							$name = sanitize_text_field( $value['name'] );
							$default_value = sanitize_text_field( $value['default_value'] );

							echo '<div class="dokan-form-group"><label>'. $label .'</label>';
							if( $type == "text" || $type == "number" ||  $type == "url" || $type == "textarea" || $type == "email" ){
								acf_render_field(
									array( 
										'type' => $type, 
										'name' => $name, 
										'value' => '', 
										'readonly' => false
									) 
								);
							} elseif ( $type == "select" ) {
								$choices = $value['choices'];
								array_unshift( $choices, esc_attr__( 'Select', 'acf-for-dokan' ) );
								acf_render_field(
									array( 
										'type' => 'select', 
										'name' => $name, 
										'value' => $default_value, 
										'choices' => $choices, 
										'class' => 'select-' . $name
									) 
								);
							} elseif ( $type == "checkbox" ) {
								$choices = $value['choices'];
								acf_render_field(
									array( 
										'type' => 'checkbox', 
										'prefix' => false,
										'name' => $name,
										'value' => $custom_field,
										'choices' => $choices, 
										'class' => 'checkbox-' . $name
									) 
								);
							} elseif ( $type == "radio" ) {
								$choices = $value['choices'];
								acf_render_field(
									array( 
										'type' => 'radio', 
										'prefix' => false,
										'name' => $name,
										'value' => $custom_field,
										'choices' => $choices, 
										'class' => 'checkbox-' . $name
									) 
								);
							}
							echo '</div>';
						}
					}
				}
			}
		}

		/**
		 * Showing field data on product edit page.
		 *
		 * @param object $post Post Object.
		 * @param int    $post_id Post ID.
		 */
		public function acf_dokan_show_on_edit_page( $post, $post_id ){
			$acfs = $this->acf_dokan_get_custom_fields();
			foreach ( $acfs as $key => $acf ) {
				foreach ( $acf as $key => $value ) {
					// Check Vendor edit allowed from custom field settings.
					if($value['vendor_edit']){
						$custom_field = get_post_meta( $post_id, $value['name'], true ); 
						$label = sanitize_text_field( $value['label'] ); 
						$name = sanitize_text_field( $value['name'] );
						$type = sanitize_text_field( $value['type'] );
						$required = $value['required']; ?>	
						<div class="dokan-form-group">
							<div class="acf-label">
								<label for="<?php echo $name; ?>" class="form-label"><?php echo $label; ?></label>
							</div>
							<div class="acf-input">
								<?php if( $type == "text" || $type == "number" ||  $type == "url" || $type == "textarea" || $type == "email" ) {
									acf_render_field(
										array(
											'type' => $type, 
											'name' => $name, 
											'value' => sanitize_text_field( $custom_field ), 
											'placeholder' => $label,
											'class' => ( $required ) ? 'require' : ''
										) 
									);
								} elseif ( $type == "select" ) {
									$choices = $value['choices'];
									array_unshift( $choices, "Select" );
									acf_render_field(
										array( 
											'type' => 'select',
											'class' => ( $required ) ? 'require' : '',
											'name' => $name, 
											'value' => sanitize_text_field( $custom_field ), 
											'choices' => $choices
										) 
									);
								} elseif ( $type == "wysiwyg" ) {
									$id = $name;
									$name = $name;
									$media_upload = sanitize_text_field( $value['media_upload'] );
									$content = esc_textarea( stripslashes( $custom_field ) );
									$settings = array(
										'tinymce' => true, 
										'textarea_name' => $name, 
										'media_buttons' => $media_upload,
										'editor_class'	=> ( $required ) ? 'require' : ''
									);
									wp_editor( $content, $id, $settings );
								} elseif ( $type == "checkbox" ) {
									$choices = $value['choices'];
									acf_render_field(
										array( 
											'type' => 'checkbox', 
											'prefix' => false,
											'class' => 'checkbox-' . $name .' '. ( $required ) ? 'require' : '',
											'name' => $name,
											'value' => $custom_field,
											'choices' => $choices
										) 
									);
								} elseif ( $type == "radio" ) {
									$choices = $value['choices'];
									acf_render_field(
										array( 
											'type' => 'radio', 
											'prefix' => false,
											'class' => 'radio-' . $name,
											'name' => $name,
											'value' => $custom_field,
											'choices' => $choices
										) 
									);
								} elseif ( $type == "file" ) {
									acf_render_field_wrap(array(
										'label'		=> __('Select File', 'acf-for-dokan'),
										'type'		=> 'file',
										'name'		=> $name,
										'value'		=> $custom_field,
									));
								}
								?>
							</div>
						</div>
					<?php }
				}
			}
		}

		/**
		 * Saving product field data for edit and update.
		 *
		 * @param int  $product_id Product ID.
		 * @param array $postdata Postdat
		 */
		public function acf_dokan_save_add_product_meta( $product_id, $postdata ){
			if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
				return;
			}
			$acfs = $this->acf_dokan_get_custom_fields();
			foreach ( $acfs as $key => $acf ) {
				foreach ( $acf as $key => $value ) {
					if ( ! empty( $postdata[ $value['name'] ] ) ) {
						$field_value = sanitize_text_field( $postdata[ $value['name'] ] );
						$name = sanitize_text_field( $value['name'] );
						if( $value['type'] == 'checkbox' ){
							update_field( $name, $postdata[ $name ], $product_id );
						}else{
							update_field( $name, $field_value, $product_id );
						}
					}
				}
			}
		}

		/**
		 * Enqueue scripts.
		 */
		public function acf_dokan_register_styles(){
			// Enqueue acf css.
			wp_enqueue_style( 'acf-global' );
			wp_enqueue_style( 'acf-input' );

			// Enqueue acf js
			wp_enqueue_script( 'acf' );
			wp_enqueue_script( 'acf-input' );
			wp_enqueue_script( 'acf-for-dokan-validate',ACF_FOR_DOKAN_PLUGIN_URL.'assets/js/valid.js',array('dokan-form-validate'),'', true );
		}
	}
}