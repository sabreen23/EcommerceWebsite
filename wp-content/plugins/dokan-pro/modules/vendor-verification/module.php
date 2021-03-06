<?php

namespace WeDevs\DokanPro\Modules\VendorVerification;

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use WeDevs\DokanPro\Storage\Session;
use WeDevs\DokanPro\Modules\Germanized\Helper;

/**
 * Dokan_Seller_Verification class
 *
 * @class Dokan_Seller_Verification The class that holds the entire Dokan_Seller_Verification plugin
 */
class Module {

    /**
     * Module version
     *
     * @since 3.1.3
     *
     * @var string
     */
    public $version = null;

    public static $plugin_prefix;
    public static $plugin_url;
    public static $plugin_path;
    public static $plugin_basename;
    private $config;
    private $base_url;

    public $e_msg = false;

    /**
     * Constructor for the Dokan_Seller_Verification class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct() {
        $this->version = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? time() : DOKAN_PRO_PLUGIN_VERSION;

        self::$plugin_prefix   = 'Dokan_verification_';
        self::$plugin_basename = plugin_basename( __FILE__ );
        self::$plugin_url      = plugin_dir_url( self::$plugin_basename );
        self::$plugin_path     = trailingslashit( dirname( __FILE__ ) );

        $this->init_hooks();
        $this->define_constants();
        $this->includes_file();

        // plugin activation hook
        add_action( 'dokan_activated_module_vendor_verification', array( $this, 'activate' ) );
        add_action( 'init', [ $this, 'init_config' ] );
    }

    /**
     * @since 3.3.1
     *
     * @return void
     */
    public function init_config() {
        $this->base_url = dokan_get_navigation_url( 'settings/verification' );
        $this->config = $this->get_provider_config();
    }

    public function init_hooks() {
        $installed_version = get_option( 'dokan_theme_version' );

        add_action( 'template_redirect', array( $this, 'monitor_autheticate_requests' ), 99 );

        // Overriding templating system for vendor-verification
        add_filter( 'dokan_set_template_path', [ $this, 'load_verification_templates' ], 30, 3 );

        // widget
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );

        // Loads frontend scripts and styles
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        //filters
        add_filter( 'dokan_get_all_cap', array( $this, 'add_capabilities' ), 10 );
        add_filter( 'dokan_get_dashboard_settings_nav', array( $this, 'register_dashboard_menu' ) );
        add_filter( 'dokan_query_var_filter', array( $this, 'dokan_verification_template_endpoint' ) );

        //ajax hooks
        add_action( 'wp_ajax_dokan_update_verify_info', array( $this, 'dokan_update_verify_info' ) );
        add_action( 'wp_ajax_dokan_id_verification_cancel', array( $this, 'dokan_id_verification_cancel' ) );
        add_action( 'wp_ajax_dokan_address_verification_cancel', array( $this, 'dokan_address_verification_cancel' ) );
        add_action( 'wp_ajax_dokan_sv_form_action', array( $this, 'dokan_sv_form_action' ) );
        add_action( 'wp_ajax_dokan_v_load_state_by_country', array( $this, 'dokan_v_load_state_by_country' ) );
        add_action( 'wp_ajax_dokan_update_verify_info_insert_address', array( $this, 'dokan_update_verify_info_insert_address' ) );
        add_action( 'wp_ajax_dokan_v_send_sms', array( $this, 'dokan_v_send_sms' ) );
        add_action( 'wp_ajax_dokan_v_verify_sms_code', array( $this, 'dokan_v_verify_sms_code' ) );
        add_action( 'wp_ajax_dokan_update_verify_info_insert_company', array( $this, 'dokan_update_verify_info_insert_company' ) );
        add_action( 'wp_ajax_dokan_company_verification_cancel', array( $this, 'dokan_company_verification_cancel' ) );

        if ( $installed_version >= 2.4 ) {
            add_filter( 'dokan_dashboard_settings_heading_title', array( $this, 'load_verification_template_header' ), 15, 2 );
            add_action( 'dokan_render_settings_content', array( $this, 'load_verification_content' ) );
        } else {
            add_action( 'dokan_settings_template', array( $this, 'dokan_verification_set_templates' ), 10, 2 );
        }

        add_action( 'dokan_admin_menu', array( $this, 'load_verfication_admin_template' ), 15 );

        // usermeta update hook
        add_action( 'updated_user_meta', array( $this, 'dokan_v_recheck_verification_status_meta' ), 10, 4 );

        // Custom dir for vendor uploaded file
        add_filter( 'upload_dir', array( $this, 'dokan_customize_upload_dir' ), 10 );

        // flush rewrite rules
        add_action( 'woocommerce_flush_rewrite_rules', [ $this, 'flush_rewrite_rules' ] );
    }

    /**
     * Get plugin path
     *
     * @since 1.5.1
     *
     * @return void
     **/
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    public function get_provider_config() {
        $config = array(
            'callback'   => $this->base_url,
            'debug_mode' => false,

            'providers' => array(
                'Facebook' => array(
                    'enabled' => true,
                    'keys'    => array(
                        'id' => '',
                        'secret' => '',
                    ),
                    'scope'   => 'email, public_profile',
                ),
                'Google'   => array(
                    'enabled'         => true,
                    'keys'            => array(
                        'id' => '',
                        'secret' => '',
                    ),
                    // @codingStandardsIgnoreLine
                    'scope'           => 'https://www.googleapis.com/auth/userinfo.profile ' . 'https://www.googleapis.com/auth/userinfo.email', // optional
                    'access_type'     => 'offline',
                    'approval_prompt' => 'force',
                    'hd'              => home_url(),
                ),
                'LinkedIn' => array(
                    'enabled' => true,
                    'keys'    => array(
                        'id' => '',
                        'secret' => '',
                    ),
                ),
                'Twitter'  => array(
                    'enabled' => true,
                    'keys'    => array(
                        'key' => '',
                        'secret' => '',
                    ),
                ),
            ),
        );

        //facebook config from admin
        $fb_id     = dokan_get_option( 'fb_app_id', 'dokan_verification' );
        $fb_secret = dokan_get_option( 'fb_app_secret', 'dokan_verification' );
        if ( ! empty( $fb_id ) && ! empty( $fb_secret ) ) {
            $config['providers']['Facebook']['keys']['id']     = $fb_id;
            $config['providers']['Facebook']['keys']['secret'] = $fb_secret;
        }
        //google config from admin
        $g_id     = dokan_get_option( 'google_app_id', 'dokan_verification' );
        $g_secret = dokan_get_option( 'google_app_secret', 'dokan_verification' );
        if ( ! empty( $g_id ) && ! empty( $g_secret ) ) {
            $config['providers']['Google']['keys']['id']     = $g_id;
            $config['providers']['Google']['keys']['secret'] = $g_secret;
        }
        //linkedin config from admin
        $l_id     = dokan_get_option( 'linkedin_app_id', 'dokan_verification' );
        $l_secret = dokan_get_option( 'linkedin_app_secret', 'dokan_verification' );
        if ( ! empty( $l_id ) && ! empty( $l_secret ) ) {
            $config['providers']['LinkedIn']['keys']['id']     = $l_id;
            $config['providers']['LinkedIn']['keys']['secret'] = $l_secret;
        }
        //Twitter config from admin
        $twitter_id     = dokan_get_option( 'twitter_app_id', 'dokan_verification' );
        $twitter_secret = dokan_get_option( 'twitter_app_secret', 'dokan_verification' );
        if ( ! empty( $twitter_id ) && ! empty( $twitter_secret ) ) {
            $config['providers']['Twitter']['keys']['key']    = $twitter_id;
            $config['providers']['Twitter']['keys']['secret'] = $twitter_secret;
        }

        /**
         * Filter the Config array of Hybridauth
         *
         * @since 1.0.0
         *
         * @param array $config
         */
        $config = apply_filters( 'dokan_verify_providers_config', $config );

        return $config;
    }

    public function load_verification_template_header( $heading, $query_vars ) {
        if ( isset( $query_vars ) && (string) $query_vars === 'verification' ) {
            $heading = __( 'Verification', 'dokan' );
        }

        return $heading;
    }

    public function load_verification_content( $query_vars ) {
        if ( isset( $query_vars['settings'] ) && (string) $query_vars['settings'] === 'verification' ) {
            if ( current_user_can( 'dokan_view_store_verification_menu' ) ) {
                dokan_get_template_part(
                    'vendor-verification/verification-new', '', array(
                        'is_vendor_verification'   => true,
                    )
                );
            } else {
                dokan_get_template_part(
                    'global/dokan-error', '', array(
                        'deleted' => false,
                        'message' => __( 'You have no permission to view this verification page', 'dokan' ),
                    )
                );
            }

            return;
        }
    }

    public function load_verfication_admin_template() {
        add_submenu_page( 'dokan', __( 'Vendor Verifications', 'dokan' ), __( 'Verifications', 'dokan' ), 'manage_options', 'dokan-seller-verifications', array( $this, 'seller_verfications_page' ) );
    }

    public function seller_verfications_page() {
        require_once dirname( __FILE__ ) . '/templates/admin-verifications.php';
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public function activate() {
        global $wp_roles;

        if ( class_exists( 'WP_Roles' ) && ! isset( $wp_roles ) ) {
            // @codingStandardsIgnoreLine
            $wp_roles = new \WP_Roles();
        }

        $wp_roles->add_cap( 'seller', 'dokan_view_store_verification_menu' );
        $wp_roles->add_cap( 'administrator', 'dokan_view_store_verification_menu' );
        $wp_roles->add_cap( 'shop_manager', 'dokan_view_store_verification_menu' );

        // flash rewrite rules
        $this->flush_rewrite_rules();
    }

    /**
     * Flush rewrite rules
     *
     * @since 3.3.1
     *
     * @return void
     */
    public function flush_rewrite_rules() {
        dokan()->rewrite->register_rule();
        flush_rewrite_rules();
    }

    /**
     * Define module constants
     *
     * @since 3.0.0
     *
     * @return void
     */
    public function define_constants() {
        define( 'DOKAN_VERIFICATION_PLUGIN_VERSION', '1.2.0' );
        define( 'DOKAN_VERFICATION_DIR', dirname( __FILE__ ) );
        define( 'DOKAN_VERFICATION_INC_DIR', dirname( __FILE__ ) . '/includes/' );
        define( 'DOKAN_VERFICATION_LIB_DIR', dirname( __FILE__ ) . '/lib/' );
        define( 'DOKAN_VERFICATION_PLUGIN_ASSEST', plugins_url( 'assets', __FILE__ ) );
        // give a way to turn off loading styles and scripts from parent theme

        if ( ! defined( 'DOKAN_VERFICATION_LOAD_STYLE' ) ) {
            define( 'DOKAN_VERFICATION_LOAD_STYLE', true );
        }

        if ( ! defined( 'DOKAN_VERFICATION_LOAD_SCRIPTS' ) ) {
            define( 'DOKAN_VERFICATION_LOAD_SCRIPTS', true );
        }
    }

    /**
     * Include all the required files
     *@since 1.0.0
     *
     * @return void
     */
    public function includes_file() {
        $inc_dir = DOKAN_VERFICATION_INC_DIR;
        $lib_dir = DOKAN_VERFICATION_LIB_DIR;

        require_once $lib_dir . 'sms-verification/gateways.php';
        require_once $inc_dir . 'theme-functions.php';

        //widgets
        require_once $inc_dir . '/widgets/verifications-list.php';

        if ( is_admin() ) {
            require_once $inc_dir . 'admin/admin.php';
        }

        // Init Vendor Verification Cache
        require_once $inc_dir . 'DokanVendorVerificationCache.php';
        new \DokanVendorVerificationCache();
    }

    /**
     * Register widgets
     *
     * @since 2.8
     *
     * @return void
     */
    public function register_widgets() {
        register_widget( 'Dokan_Store_Verification_list' );
    }

    /**
     * Monitors Url for Hauth Request and process Hauth for authentication
     *
     * @global type $current_user
     *
     * @return void
     */
    public function monitor_autheticate_requests() {
        $vendor_id = dokan_get_current_user_id();

        if ( ! $vendor_id ) {
            return;
        }

        if ( isset( $_GET['dokan_auth_dc'] ) ) { // phpcs:ignore
            $seller_profile = dokan_get_store_info( $vendor_id );
            $provider_dc    = sanitize_text_field( wp_unslash( $_GET['dokan_auth_dc'] ) ); //phpcs:ignore

            $seller_profile['dokan_verification'][ $provider_dc ] = '';

            update_user_meta( $vendor_id, 'dokan_profile_settings', $seller_profile );
            return;
        }

        try {
            /**
             * Feed the config array to Hybridauth
             *
             * @var Hybridauth
             */
            $hybridauth = new Hybridauth( $this->config );

            /**
             * Initialize session storage.
             *
             * @var Session
             */
            $storage = new Session( 'vendor_verify', 5 * 60 );

            /**
             * Hold information about provider when user clicks on Sign In.
             */
            $provider = ! empty( $_GET['dokan_auth'] ) ? sanitize_text_field( wp_unslash( $_GET['dokan_auth'] ) ) : ''; // phpcs:ignore

            if ( $provider ) {
                $storage->set( 'provider', $provider );
            }

            if ( $provider = $storage->get( 'provider' ) ) { //phpcs:ignore
                $adapter = $hybridauth->getAdapter( $provider );
                $adapter->setStorage( $storage );
                $adapter->authenticate();
            }

            if ( ! isset( $adapter ) ) {
                return;
            }

            $user_profile = $adapter->getUserProfile();

            if ( ! $user_profile ) {
                $storage->clear();
                wc_add_notice( __( 'Something went wrong! please try again', 'dokan' ), 'success' );
                wp_safe_redirect( $this->callback );
            }

            $seller_profile = dokan_get_store_info( $vendor_id );
            $seller_profile['dokan_verification'][ $provider ] = (array) $user_profile;

            update_user_meta( $vendor_id, 'dokan_profile_settings', $seller_profile );
            $storage->clear();
        } catch ( Exception $e ) {
            $this->e_msg = $e->getMessage();
        }
    }

    /**
     * Load rma templates. so that it can overide from theme
     *
     * Just create `rma` folder inside dokan folder then
     * override your necessary template.
     *
     * @since 1.0.0
     *
     * @return void
     **/
    public function load_verification_templates( $template_path, $template, $args ) {
        if ( isset( $args['is_vendor_verification'] ) && $args['is_vendor_verification'] ) {
            return $this->plugin_path() . '/templates';
        }

        return $template_path;
    }

    /**
     * Enqueue admin scripts
     *
     * Allows plugin assets to be loaded.
     *
     * @uses wp_enqueue_script()
     * @uses wp_localize_script()
     * @uses wp_enqueue_style
     */
    public function enqueue_scripts() {
        global $wp;

        wp_enqueue_style( 'dokan-verification-styles', plugins_url( 'assets/css/style.css', __FILE__ ), true, gmdate( 'Ymd' ) );
        wp_enqueue_script( 'dokan-verification-scripts', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ), $this->version, true );

        // @codingStandardsIgnoreLine
        if ( isset( $wp->query_vars['settings'] ) == 'verification' ) {
            wp_enqueue_script( 'wc-country-select' );
        }
    }

    /**
     * Add capabilities
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_capabilities( $capabilities ) {
        $capabilities['menu']['dokan_view_store_verification_menu'] = __( 'View verification settings menu', 'dokan' );

        return $capabilities;
    }

    /**
     * Adds Verification menu on Dokan Seller Dashboard
     *
     * @since 1.0.0
     * @param array() $urls
     * @return array() $urls
     */
    public function register_dashboard_menu( $urls ) {
        $urls['verification'] = array(
            'title'      => __( 'Verification', 'dokan' ),
            'icon'       => '<i class="fa fa-check"></i>',
            'url'        => dokan_get_navigation_url( 'settings/verification' ),
            'pos'        => 55,
            'permission' => 'dokan_view_store_verification_menu',
        );

        return $urls;
    }

    public function dokan_verification_set_templates( $path, $part ) {
        if ( 'verification' === (string) $part ) {
            dokan_get_template_part(
                'vendor-verification/verification', '', array(
                    'is_vendor_verification' => true,
                )
            );
            // return DOKAN_VERFICATION_DIR . '/templates/verification.php';
        }

        return $path;
    }

    public function dokan_verification_template_endpoint( $query_var ) {
        $query_var[] = 'verification';
        return $query_var;
    }

    /** Updates photo Id for verification
     *
     * @since 1.0.0
     * @return void
     */
    public function dokan_update_verify_info() {
        // @codingStandardsIgnoreLine
        parse_str( $_POST['data'], $postdata );

        if ( ! wp_verify_nonce( $postdata['dokan_verify_action_nonce'], 'dokan_verify_action' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }

        $user_id        = get_current_user_id();
        $seller_profile = dokan_get_store_info( $user_id );

        if ( isset( $postdata['dokan_v_id_type'] ) && isset( $postdata['dokan_gravatar'] ) ) {
            $seller_profile['dokan_verification']['info']['photo_id']          = $postdata['dokan_gravatar'];
            $seller_profile['dokan_verification']['info']['dokan_v_id_type']   = $postdata['dokan_v_id_type'];
            $seller_profile['dokan_verification']['info']['dokan_v_id_status'] = 'pending';

            update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

            do_action( 'dokan_verification_updated', $user_id );

            dokan_verification_request_submit_email();

            $msg = sprintf( __( 'Your ID verification request is Sent and %s approval', 'dokan' ), $seller_profile['dokan_verification']['info']['dokan_v_id_status'] );
            wp_send_json_success( $msg );
        }
    }

    /*
     * Clears Verify Info value for ID verification via AJAX
     *
     * @since 1.0.0
     *
     * @return AJAX Success/fail
     */

    public function dokan_id_verification_cancel() {
        $user_id        = get_current_user_id();
        $seller_profile = dokan_get_store_info( $user_id );

        unset( $seller_profile['dokan_verification']['info']['photo_id'] );
        unset( $seller_profile['dokan_verification']['info']['dokan_v_id_type'] );
        unset( $seller_profile['dokan_verification']['info']['dokan_v_id_status'] );
        //update user meta pending here
        update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

        do_action( 'dokan_id_verification_cancelled', $user_id );

        $msg = __( 'Your ID Verification request is cancelled', 'dokan' );

        wp_send_json_success( $msg );
    }

    /*
     * Clears Verify Info value for Address verification via AJAX
     *
     * @since 1.0.0
     *
     * @return AJAX Success/fail
     */

    public function dokan_address_verification_cancel() {
        $user_id        = get_current_user_id();
        $seller_profile = dokan_get_store_info( $user_id );

        unset( $seller_profile['dokan_verification']['info']['store_address'] );
        //update user meta pending here
        update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

        $msg = __( 'Your Address Verification request is cancelled', 'dokan' );

        do_action( 'dokan_address_verification_cancel', $user_id );

        wp_send_json_success( $msg );
    }

    /* Admin panel verification actions managed here
     * @since 1.0.0
     *
     * @return Ajax Success/fail
     */

    public function dokan_sv_form_action() {
        // @codingStandardsIgnoreStart
        parse_str( $_POST['formData'], $postdata );
        if ( ! wp_verify_nonce( $postdata['dokan_sv_nonce'], 'dokan_sv_nonce_action' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }
        $postdata['status']    = sanitize_text_field( wp_unslash( $_POST['status'] ) );
        $postdata['seller_id'] = absint( $_POST['seller_id'] );
        $postdata['type']      = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // @codingStandardsIgnoreEnd

        $user_id        = $postdata['seller_id'];
        $seller_profile = dokan_get_store_info( $user_id );

        switch ( $postdata['status'] ) {
            case 'approved':
                if ( 'id' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['verified_info']['photo'] = array(
                        'photo_id'        => $postdata['dokan_gravatar'],
                        'dokan_v_id_type' => $postdata['dokan_v_id_type'],
                    );

                    $seller_profile['dokan_verification']['info']['dokan_v_id_status'] = 'approved';
                } elseif ( 'address' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['verified_info']['store_address'] = array(
                        'street_1' => $postdata['street_1'],
                        'street_2' => $postdata['street_2'],
                        'city'     => $postdata['store_city'],
                        'zip'      => $postdata['store_zip'],
                        'country'  => $postdata['store_country'],
                        'state'    => $postdata['store_state'],
                    );
                    $seller_profile['address'] = array(
                        'street_1' => $postdata['street_1'],
                        'street_2' => $postdata['street_2'],
                        'city'     => $postdata['store_city'],
                        'zip'      => $postdata['store_zip'],
                        'country'  => $postdata['store_country'],
                        'state'    => $postdata['store_state'],
                    );

                    $seller_profile['dokan_verification']['info']['store_address']['v_status'] = 'approved';
                } elseif ( 'company_verification_files' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['company_v_status'] = 'approved';
                }

                update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

                break;

            case 'pending':
                if ( 'id' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['dokan_v_id_status'] = 'pending';
                } elseif ( 'address' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['store_address']['v_status'] = 'pending';
                } elseif ( 'company_verification_files' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['company_v_status'] = 'pending';
                }

                update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

                break;

            case 'rejected':
                if ( 'id' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['dokan_v_id_status'] = 'rejected';
                } elseif ( 'address' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['store_address']['v_status'] = 'rejected';
                } elseif ( 'company_verification_files' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['company_v_status'] = 'rejected';
                }

                update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

                break;

            case 'disapproved':
                if ( 'id' === $postdata['type'] ) {
                    unset( $seller_profile['dokan_verification']['verified_info']['photo'] );
                    $seller_profile['dokan_verification']['info']['dokan_v_id_status'] = 'pending';
                } elseif ( 'address' === $postdata['type'] ) {
                    unset( $seller_profile['dokan_verification']['verified_info']['store_address'] );

                    $seller_profile['dokan_verification']['info']['store_address']['v_status'] = 'pending';
                } elseif ( 'company_verification_files' === $postdata['type'] ) {
                    $seller_profile['dokan_verification']['info']['company_v_status'] = 'pending';
                }

                update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

                break;
        }

        do_action( 'dokan_verification_status_change', $user_id, $seller_profile, $postdata );

        dokan_verification_request_changed_by_admin_email( $seller_profile, $postdata );

        $msg = __( 'Information updated', 'dokan' );
        wp_send_json_success( $msg );
    }

    /*
     * Insert Verification page Address fields into Verify info via AJAX
     *
     * @since 1.0.0
     *
     * @return Ajax Success/fail
     */

    public function dokan_update_verify_info_insert_address() {
        // @codingStandardsIgnoreLine
        $address_field = $_POST['dokan_address'];

        // @codingStandardsIgnoreLine
        if ( ! wp_verify_nonce( $_POST['dokan_verify_action_address_form_nonce'], 'dokan_verify_action_address_form' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }

        $current_user   = get_current_user_id();
        $seller_profile = dokan_get_store_info( $current_user );

        $default = array(
            'street_1' => '',
            'street_2' => '',
            'city'     => '',
            'zip'      => '',
            'country'  => '',
            'state'    => '',
            'v_status' => 'pending',
        );

        if ( $address_field['state'] === 'N/A' ) {
            $address_field['state'] = '';
        }

        $store_address = wp_parse_args( $address_field, $default );

        $msg = __( 'Please fill all the required fields', 'dokan' );

        $seller_profile['dokan_verification']['info']['store_address'] = $store_address;

        update_user_meta( $current_user, 'dokan_profile_settings', $seller_profile );

        do_action( 'dokan_after_address_verification_added', $current_user );

        $msg = __( 'Your Address verification request is Sent and Pending approval', 'dokan' );

        dokan_verification_request_submit_email();
        wp_send_json_success( $msg );
    }

    /**
     * Sets the value of main verification status meta automatically
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function dokan_v_recheck_verification_status_meta( $meta_id, $object_id, $meta_key, $_meta_value ) {
        if ( 'dokan_profile_settings' !== (string) $meta_key ) {
            return;
        }
        $current_user   = $object_id;
        $seller_profile = dokan_get_store_info( $current_user );

        if ( ! isset( $seller_profile['dokan_verification']['info'] ) ) {
            return;
        }

        $id_status        = isset( $seller_profile['dokan_verification']['info']['dokan_v_id_status'] ) ? $seller_profile['dokan_verification']['info']['dokan_v_id_status'] : '';
        $address_status   = isset( $seller_profile['dokan_verification']['info']['store_address']['v_status'] ) ? $seller_profile['dokan_verification']['info']['store_address']['v_status'] : '';
        $company_v_status = isset( $seller_profile['dokan_verification']['info']['company_v_status'] ) ? $seller_profile['dokan_verification']['info']['company_v_status'] : '';

        $get_status = array_map(
            function( $status ) {
                if ( in_array( $status, array( 'approved', 'rejected', 'pending' ), true ) ) {
                    return $status;
                }
            }, array_unique( [ $id_status, $address_status, $company_v_status ] )
        );

        $get_status = implode( ',', array_filter( $get_status, 'strlen' ) );
        update_user_meta( $current_user, 'dokan_verification_status', $get_status );

        //clear info meta if empty
        if ( empty( $seller_profile['dokan_verification']['info'] ) ) {
            unset( $seller_profile['dokan_verification']['info'] );
            update_user_meta( $current_user, 'dokan_profile_settings', $seller_profile );
        }
    }

    /*
     * Sends SMS from verification template
     *
     * @since 1.0.0
     *
     * @return Ajax Success/fail
     *
     */

    public function dokan_v_send_sms() {
        // @codingStandardsIgnoreLine
        parse_str( $_POST['data'], $postdata );

        if ( ! wp_verify_nonce( $postdata['dokan_verify_action_nonce'], 'dokan_verify_action' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }
        $info['success'] = false;

        $sms  = \WeDevs_dokan_SMS_Gateways::instance();
        $info = $sms->send( $postdata['phone'] );

        // @codingStandardsIgnoreLine
        if ( $info['success'] == true ) {
            $current_user   = get_current_user_id();
            $seller_profile = dokan_get_store_info( $current_user );

            $seller_profile['dokan_verification']['info']['phone_no']        = $postdata['phone'];
            $seller_profile['dokan_verification']['info']['phone_code']   = $info['code'];
            $seller_profile['dokan_verification']['info']['phone_status'] = 'pending';

            update_user_meta( $current_user, 'dokan_profile_settings', $seller_profile );
        }
        wp_send_json_success( $info );
    }

    /*
     * Verify sent SMS code and update corresponding meta
     *
     * @since 1.0.0
     *
     * @return Ajax Success/fail
     *
     */
    public function dokan_v_verify_sms_code() {
        // @codingStandardsIgnoreLine
        parse_str( $_POST['data'], $postdata );

        if ( ! wp_verify_nonce( $postdata['dokan_verify_action_nonce'], 'dokan_verify_action' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }

        $current_user   = get_current_user_id();
        $seller_profile = dokan_get_store_info( $current_user );

        $saved_code = $seller_profile['dokan_verification']['info']['phone_code'];

        // @codingStandardsIgnoreLine
        if ( $saved_code == $postdata['sms_code'] ) {
            $seller_profile['dokan_verification']['info']['phone_status'] = 'verified';
            $seller_profile['dokan_verification']['info']['phone_no'] = $seller_profile['dokan_verification']['info']['phone_no'];
            update_user_meta( $current_user, 'dokan_profile_settings', $seller_profile );

            $resp = array(
                'success' => true,
                'message' => 'Your Phone is verified now',
            );
            wp_send_json_success( $resp );
        } else {
            $resp = array(
                'success' => false,
                'message' => 'Your SMS code is not valid, please try again',
            );
            wp_send_json_success( $resp );
        }
    }

    /*
     * Custom dir for vendor uploaded file
     *
     * @since 2.9.0
     *
     * @return array
     *
     */
    public function dokan_customize_upload_dir( $upload ) {
        global $wp;

        if ( ! isset( $_SERVER['HTTP_REFERER'] ) ) {
            return $upload;
        }

        // @codingStandardsIgnoreLine
        if ( strpos( $_SERVER['HTTP_REFERER'], 'settings/verification' ) != false ) {

            remove_filter( 'upload_dir', array( $this, 'dokan_customize_upload_dir' ), 10 );
            // apply security patch
            $this->disallow_direct_access();
            add_filter( 'upload_dir', array( $this, 'dokan_customize_upload_dir' ), 10 );

            $user_id = get_current_user_id();
            $user = get_user_by( 'id', $user_id );

            $vendor_verification_hash = get_user_meta( $user_id, 'dokan_vendor_verification_folder_hash', true );

            if ( empty( $vendor_verification_hash ) ) {
                $vendor_verification_hash = $this->generate_random_string();
                update_user_meta( $user_id, 'dokan_vendor_verification_folder_hash', $vendor_verification_hash );
            }

            $dirname = $user_id . '-' . $user->user_login . '/' . $vendor_verification_hash;
            $upload['subdir'] = '/verification/' . $dirname;
            $upload['path']   = $upload['basedir'] . $upload['subdir'];
            $upload['url']    = $upload['baseurl'] . $upload['subdir'];
        }

        return $upload;
    }

    /**
     * @since 3.1.3
     * Creates .htaccess & index.html files if not exists that prevent direct folder access
     */
    public function disallow_direct_access() {
        $uploads_dir   = trailingslashit( wp_upload_dir()['basedir'] ) . 'verification';
        $file_htaccess = $uploads_dir . '/.htaccess';
        $file_html     = $uploads_dir . '/index.html';
        $rule = <<<EOD
Options -Indexes
deny from all
<FilesMatch '\.(jpg|jpeg|png|gif|pdf|doc|docx|odt)$'>
    Order Allow,Deny
    Allow from all
</FilesMatch>
EOD;
        if ( get_transient( 'dokan_vendor_verification_access_check' ) ) {
            return;
        }

        if ( ! is_dir( $uploads_dir ) ) {
            wp_mkdir_p( $uploads_dir );
        }

        global $wp_filesystem;

        // protect if the the global filesystem isn't setup yet
        if ( is_null( $wp_filesystem ) ) { // phpcs:ignore
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );// phpcs:ignore
            WP_Filesystem();
        }

        // phpcs:ignore
        if ( ( file_exists( $file_htaccess ) && $wp_filesystem->get_contents( $file_htaccess ) !== $rule ) || ! file_exists( $file_htaccess ) )  {

            $ret = $wp_filesystem->put_contents(
                $file_htaccess,
                '',
                FS_CHMOD_FILE
            ); // returns a status of success or failure

            $wp_filesystem->put_contents(
                $file_htaccess,
                $rule,
                FS_CHMOD_FILE
            ); // returns a status of success or failure

            $wp_filesystem->put_contents(
                $file_html,
                '',
                FS_CHMOD_FILE
            ); // returns a status of success or failure

            if ( $ret ) {
                // Sets transient for 7 days
                set_transient( 'dokan_vendor_verification_access_check', true, DAY_IN_SECONDS * 7 );
            }
        }
    }

    /**
     * @param int $length
     *
     * @return string
     * @since 3.1.3
     * Generates a random string
     */
    public function generate_random_string( $length = 20 ) {
        $characters        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen( $characters );
        $random_string     = '';
        for ( $i = 0; $i < $length; $i ++ ) {
            $random_string .= $characters[ wp_rand( 0, $characters_length - 1 ) ];
        }

        return $random_string;
    }

    /*
     * Insert Verification page Company fields into Verify info via AJAX
     *
     * @since 1.0.0
     *
     * @return Ajax Success/fail
     */
    public function dokan_update_verify_info_insert_company() {
        if ( ! isset( $_POST['dokan_verify_action_company_form_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dokan_verify_action_company_form_nonce'] ), 'dokan_verify_action_company_form' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }

        $current_user   = dokan_get_current_user_id();

        if ( ! dokan_is_user_seller( $current_user ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'dokan' ) );
        }

        $seller_profile = dokan_get_store_info( $current_user );

        $msg = __( 'Please upload minimum one document.', 'dokan' );

        if ( ! isset( $_POST['vendor_verification_files_ids'] ) || ! is_array( $_POST['vendor_verification_files_ids'] ) || count( $_POST['vendor_verification_files_ids'] ) < 1 ) {
            wp_send_json_error( $msg );
        }

        $seller_profile['company_verification_files'] = wp_unslash( $_POST['vendor_verification_files_ids'] );

        $seller_profile['dokan_verification']['info']['company_v_status'] = 'pending';

        update_user_meta( $current_user, 'dokan_profile_settings', $seller_profile );

        do_action( 'dokan_company_verification_submitted', $current_user, $seller_profile );

        $msg = __( 'Your company verification request is sent and pending approval', 'dokan' );

        dokan_verification_request_submit_email();
        wp_send_json_success( $msg );
    }

    /*
     * Clears Verify Info value for Company verification via AJAX
     *
     * @since 1.0.0
     *
     * @return String Ajax string message.
     */
    public function dokan_company_verification_cancel() {
        $user_id        = get_current_user_id();
        $seller_profile = dokan_get_store_info( $user_id );

        unset( $seller_profile['dokan_verification']['info']['company_v_status'] );
        //update user meta pending here
        update_user_meta( $user_id, 'dokan_profile_settings', $seller_profile );

        do_action( 'dokan_company_verification_cancelled', $user_id, $seller_profile );

        $msg = __( 'Your company verification request is cancelled', 'dokan' );

        wp_send_json_success( $msg );
    }
}
