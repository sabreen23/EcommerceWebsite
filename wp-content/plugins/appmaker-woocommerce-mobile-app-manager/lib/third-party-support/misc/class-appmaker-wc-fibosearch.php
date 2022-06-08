<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class APPMAKER_WC_FIBOSEARCH extends APPMAKER_WC_REST_Posts_Abstract_Controller
{
    protected $namespace = 'appmaker-wc/v1';
    protected $rest_base = 'products/suggestions';
    public function __construct()
    {        
        parent::__construct();
        register_rest_route($this->namespace, '/' . $this->rest_base , array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'product_query_result' ),
                'permission_callback' => array( $this, 'api_permissions_check' ),
                'args'                => $this->get_collection_params(),
            ),
            'schema' => array( $this, 'get_public_item_schema' ),
        ) ); 
        add_filter('appmaker_wc_rest_product_query',array($this,'add_search'),2,2);

    }

    public function add_search( $args, $request ) {
        if(isset($request['search'])) {           
            $args['s'] =  $_REQUEST['dgwt_wcas_keyword'] = $request['search'];
        }
        return $args;
    }

    public function product_query_result( $request )
    {       
        
        $posts = array();
        $response = array();        
        $response['suggestions'] = array();
        if ( isset( $_REQUEST['search'] ) ) {
            $_REQUEST['dgwt_wcas_keyword'] =  $_REQUEST['search'];  
            add_filter('exit_fibo_search_results' ,  '__return_false',999 ); 
            ob_start();         
            $instance = DGWT_WC_Ajax_Search::getInstance();            
            $instance->nativeSearch->getSearchResults();   
            $search_result = ob_get_clean();  
           
            $search_result = json_decode($search_result);
            $data = $search_result->suggestions;//print_r($data);

            foreach ($data as $key) {
                if( isset( $key->type ) ) {
                    switch( $key->type ) {
                        case 'no-results' : $posts = array();break;
                        case 'product'    : $thumbnail = APPMAKER_WC::$api->APPMAKER_WC_REST_Products_Controller->get_thumbnail( wc_get_product($key->post_id) );

                                $posts[] = array(   
                                    'type'  => 'product',                                                     
                                    'title' => strip_tags( html_entity_decode( $key->value)),   
                                    'thumbnail'               => $thumbnail['url'],
                                    'thumbnail_meta'          => $thumbnail['size'],                                         
                                    'action' => array(
                                        'type'   => 'OPEN_PRODUCT',                                        
                                        'params' => array(
                                            'id' => $key->post_id,
                                            'title' => strip_tags( html_entity_decode( $key->value )),
                                        ),
                                    )
                                );break;
                        case 'headline'    : if( $key->value == 'tax_product_cat'){
                                $posts[] = array(                                                    
                                    'title' => __( 'Category', 'woocommerce' ),                                            
                                    'type' => 'title',
                                );
                            }
                            if( $key->value == 'tax_product_cat_plu'){
                                $posts[] = array(                                                    
                                    'title' => __( 'Categories', 'woocommerce' ),                                           
                                    'type' => 'title',
                                );
                            }
                            if( $key->value == 'tax_product_tag_plu'){
                                $posts[] = array(                                                    
                                    'title' => __( 'Tags' ),                                           
                                    'type' => 'title',
                                );
                            }
                            if( $key->value == 'tax_product_tag'){
                                $posts[] = array(                                                    
                                    'title' =>  __( 'Tag' ),                                       
                                    'type' => 'title',
                                );
                            }
                            if( $key->value == 'product'){
                                $posts[] = array(                                                    
                                    'title' =>  __( 'Products', 'woocommerce' ),                                       
                                    'type' => 'title',
                                );
                            }
                            break;
                    }
                }
                if( isset( $key->taxonomy ) ){
                    switch( $key->taxonomy  ) {
                        case 'product_cat' : $posts[] = array(                           
                                'type'  => 'category',                         
                                'title' => strip_tags( html_entity_decode( $key->value)),     
                                'subtitle' => !empty( $key->breadcrumbs )? _x( 'in', 'in categories fe. in Books > Crime stories', 'ajax-search-for-woocommerce' ).' '.$key->breadcrumbs : '',                                     
                                'action' => array(
                                    'type'   => 'LIST_PRODUCT',
                                    'params' => array(
                                        'category' => $key->term_id,
                                        'title' => strip_tags( html_entity_decode( $key->value )),
                                    ),
                                )
                            );break;
                        case 'product_tag'  :    $posts[] = array(                           
                            'type'  => 'tag',                         
                            'title' => strip_tags( html_entity_decode( $key->value)),     
                            'subtitle' => !empty( $key->breadcrumbs )? _x( 'in', 'in categories fe. in Books > Crime stories', 'ajax-search-for-woocommerce' ).' '.$key->breadcrumbs : '',                                     
                            'action' => array(
                                'type'   => 'LIST_PRODUCT',
                                'params' => array(
                                    'tag' => $key->term_id,
                                    'title' => strip_tags( html_entity_decode( $key->value )),
                                ),
                            )
                        );break;                    
                    }
                }
            }
            $response['suggestions'] = $posts;
            return $response;

        }else
            return $response;

    }
}
new  APPMAKER_WC_FIBOSEARCH();