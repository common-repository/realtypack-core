<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Dashboard;

use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot as dashboard_parent;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Models\Admin\Dashboard\RTPC_Models_Admin_Dashboard_Importer as model;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin as Plugin;

class RTPC_Controllers_Admin_Dashboard_Importer extends RTPC_Controllers_Admin_Dashboard_Boot {

    public $ajax_action  = 'RTPC_demos';
    private static $nounce  = 'RTPC_demos';


    /**
     * TGMPA instance.
     *
     * @since 2.5.0
     *
     * @var object
     */
    protected static $tgmpa;

    /**
     * Registered demos.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $demos = NULL;

    /**
     * Registered demos.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $api_base = 'https://eightqueens.pro/v1/api/';

    /**
     * Demo data.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $remoteData;

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        self::$tgmpa = \TGM_Plugin_Activation::get_instance();
        $this->model = model::get_instance();
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {
        $purchase_code = get_option( 'realtypack_activate_purchase' );
        // Get remote plugin data
        $remote = self::remote_get( self::$api_base . 'demos/' . $purchase_code );
        // Set data
        $this->remoteData = $remote;

        $remote = json_decode( $remote['body'], true );

        if ( !isset( $remote['error'] ) ) {
    		add_filter( 'rtpc/add/demos', array( $this, 'rtpc_register_demo' ) );
    	}

    }

    function rtpc_register_demo( $plugins ) {
        // get active theme
        $remote = $this->remoteData;
    	$remote = json_decode( $remote['body'], true );

    	foreach ( $remote as $demo ) {

    		if ( !preg_match( '/^http(s)?:\\/\\//i', $demo['logo_src'] ) ) {
    			$demo['logo_src'] = RTPC_ASSETS_URL . $demo['logo_src'];
    		}

    		$demos[] = $demo;
    	}

    	return $demos;
    }

    /**
     * Loads all required plugins
     *
     * @return mixed|null|void
     */
    public static function register_plugins_field() {

        if ( ! is_null( self::$demos ) ) {
            return self::$demos;
        }

        return self::$demos = apply_filters( 'rtpc/add/demos', array() );
    }

    /**
     * Determine the plugin status message.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return string
     */
    public static function render() {

        $demos_list = self::register_plugins_field();

        $new_list = array();

        foreach ( $demos_list as $plugin ) {

        	$new_list[$plugin['slug']] =  $plugin;

        }

        $imported_demo = get_option( 'RTPC_imported_demo', false );

        echo parent::render_template(
            'admin/importer.php',
            array(
                'header'         =>  parent::header(),
                'demos_list'     =>  $new_list,
                'imported_demo'  =>  $imported_demo,
                'footer'         =>  parent::footer(),
                'tgmpaurl'       =>  self::$tgmpa->get_tgmpa_url(),
            ),
            'always'
        );
    }


    /**
     * @return js scripts
     */
    public static function scripts() {

        $nounce = wp_create_nonce( self::$nounce );

        // Generating javascript code tpl
        $javascript = '
            jQuery(document).ready(function() {
                jQuery(".rtpc-activate-all-plugins").RTPC_demos({
                    selector: ".rtpc-activate-all-plugins",
                    nounce : "'. $nounce .'",
                    type : "activate_all",
                    action_hook: "RTPC_demos",
                });                
                jQuery(".rtpc-admin-check-all").RTPC_demos({
                    selector: ".rtpc-admin-check-all",
                    nounce : "",
                    type : "all_options",
                    action_hook: "",
                });                
                jQuery(".rtpc-admin-form-checkbox-list li:not(:first-child) input").RTPC_demos({
                    selector: ".rtpc-admin-form-checkbox-list li:not(:first-child) input",
                    nounce : "",
                    type : "check_boxes",
                    action_hook: "",
                });                
                jQuery(".rtpc-admin-import-button").RTPC_demos({
                    selector: ".rtpc-admin-import-button",
                    nounce : "'. $nounce .'",
                    type : "import_demo",
                    action_hook: "RTPC_demos",
                });
            });';

        return $javascript;
    }


    public function ajax_handler() {

        check_ajax_referer( self::$nounce, 'security' );

        $action_type   = isset( $_POST['action_type'] ) ? $_POST['action_type'] : '';

        if ( 'activate_all' === $action_type ) {

            $this->plugins_installer();

        } elseif ( 'import_demo' === $action_type ) {

            $this->demo_importer();

        }

        wp_send_json( array( 'error' => true, 'message' => esc_html__( 'Invalid request', 'realty-pack-core' ) ) );

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function plugins_installer() {

    	$type   = isset( $_POST['type'] )   ?   $_POST['type']   : '';
    	$slug   = isset( $_POST['slug'] )   ?   $_POST['slug']   : '';

        // Simple check
    	if ( '' === $type || '' === $slug ) {
    		wp_send_json( array( 'error' => true, 'message' => esc_html__( 'Invalid request', 'realty-pack-core' ) ) );
    	}

    	$nonce_url = wp_nonce_url(
    		add_query_arg(
    			array(
    				'plugin'   => urlencode( $slug ),
    				'tgmpa-' . $type => $type . '-plugin',
    			),
    			self::$tgmpa->get_tgmpa_url()
    		),
    		'tgmpa-' . $type,
    		'tgmpa-nonce'
    	);
    	$nonce_url = str_replace( array( "&#038;","&amp;" ), "&", esc_url( $nonce_url ) );

    	// post it
    	if ( $nonce_url ) {

    		$cookies	=	array();

    		foreach ( $_COOKIE as $name => $value ) {
    			$cookies[] = new \WP_Http_Cookie( array( 'name' => $name, 'value' => $value ) );
    		}

    		// Create wordpress post
    		$result = wp_remote_post( $nonce_url, 
    			array( 
    				'method'  => 'POST',
    				'cookies' => $cookies,	
    				'timeout' => 100,
    				'sslverify' => false,
    				'headers' => array('Content-Type' => 'application/json; charset=utf-8','Expect' => ''),
    			)
    		);


    		// Check for error
    		if ( is_wp_error( $result ) ) {
    			wp_send_json( array( 'error' => true, 'message' => __( 'Error on plugin ' . $type, 'realty-pack-core' ), 'action' => $type ) );
    		}

    		if ( 'install' == $type ) {
    			$type = 'activate';
    		} else if( 'activate' == $type ) {
    			$type = 'activated';
    		}

    		// Send success message
    		wp_send_json( array( 'error' => false, 'message' => __( 'Plugin '. $type .' successfully.', 'realty-pack-core' ), 'action' => $type ) );

    	}

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function demo_importer() {

        $fields     = isset( $_POST['fields'] ) ? $_POST['fields'] : '';
        $slug       = isset( $_POST['slug'] ) ? $_POST['slug'] : '';
        $progress   = isset( $_POST['progress'] ) ? $_POST['progress'] : '';
        $fetch_attachment = false;

        // Simple check
        if ( '' === $fields ) {
            wp_send_json( array( 'error' => true, 'message' => esc_html__( 'Invalid request', 'realty-pack-core' ) ) );
        }

        $fields = json_decode( json_encode( array_filter( $fields ) ), true );

        $progress = 100 / $progress;
        $progress = floor( $progress );
        // Second check for importing all of data
        foreach ( $fields as $field ) {
            if ( isset( $field['action'] ) && 'ready' === $field['action'] ) {

                // Download file
                if ( strpos( $field['type'], 'xml' ) ) {
                    $download_file = $this->get_model()->general_download_start( $field['source'], 'xml' );
                } else if ( strpos( $field['type'], 'dat' ) ) {
                    $download_file = $this->get_model()->general_download_start( $field['source'] , 'dat' );
                } else if ( strpos( $field['type'], 'wie' ) ) {
                    $download_file = $this->get_model()->general_download_start( $field['source'] , 'wie' );
                } else if ( strpos( $field['type'], 'rev' ) ) {
                    $download_file = $this->get_model()->general_download_start( $field['source'], 'zip' );
                } else if ( strpos( $field['type'], 'media' ) ) {
                    $download_file = $this->get_model()->start_download_zip( $field['source'], $slug );
                } else if ( strpos( $field['type'], 'properties' ) ) {
                    $download_file = $this->get_model()->start_download_zip( $field['source'], 'WPL' );
                } else if ( strpos( $field['type'], 'agent' ) ) {
                    $download_file = $this->get_model()->start_download_zip( $field['source'], 'WPL' );
                }
                
                // Check status of download
                if ( true === $download_file['error'] ) {
                    // Send message
                    wp_send_json( array( 'error' => $download_file['error'], 'message' => esc_html__( $download_file['message'] ), 'action' => false, 'progress' => $progress ) );

                } else {
                    // save xml file path
                    update_option( 'realty_pack_importer_' . $field['type'], $download_file['message'] );


                    $fieldname = substr( $field['type'], 0, strpos( $field['type'], '_' ) );

                    // Send message
                    wp_send_json( array( 'error' => $download_file['error'], 'message' => esc_html__( 'Download ' . $fieldname . ' finished successfully. We are still working to install it.', 'realty-pack' ), 'action' => 'downloaded', 'element' => $field['element'], 'progress' => $progress ) );
                }

            } elseif ( isset( $field['action'] ) && 'downloaded' === $field['action'] ) {

                $downloaded_url = get_option( 'realty_pack_importer_' . $field['type'] );
                $attachment = false;

                if ( strpos( $field['type'], 'media' ) ) {
                	$downloaded_url = trailingslashit( $downloaded_url ) .'media/'. 'media.xml'; 
                	$attachment = true;
                }

                if ( strpos( $field['type'], 'xml' ) || strpos( $field['type'], 'media' ) ) {
                    $result = $this->get_model()->start_import_xml( $downloaded_url, $attachment );
                } else if ( strpos( $field['type'], 'dat' ) ) {
                    $result = $this->get_model()->start_import_customizer( $downloaded_url );
                } else if ( strpos( $field['type'], 'wie' ) ) {
                    $result = $this->get_model()->process_widget_import_file( $downloaded_url );
                } else if ( strpos( $field['type'], 'rev' ) ) {
                    $result = $this->get_model()->import_revslider( $downloaded_url );
                } else if ( strpos( $field['type'], 'properties' ) ) {
                    $result = $this->get_model()->import_wpl_properties();
                } else if ( strpos( $field['type'], 'agent' ) ) {
                    $result = $this->get_model()->import_wpl_agents_profile();
                }

                // Check status of download
                if ( isset( $result['error'] ) && true === $result['error'] ) {
                    // Send message
                    wp_send_json( array( 'error' => $result['error'], 'message' => esc_html__( $result['message'] ), 'action' => false, 'progress' => $progress ) );

                } else {

                    $fieldname = substr( $field['type'], 0, strpos( $field['type'], '_' ) );

                    // Send message
                    wp_send_json( array( 'error' => false, 'message' => esc_html__( $fieldname . ' already imported. We are still working on next step...' , 'realty-pack' ), 'action' => 'imported', 'element' => $field['element'], 'progress' => $progress ) );
                }

            } elseif ( 'yes' === $field['laststep'] ) {
                // Do last import actions
                $result = $this->get_model()->last_steps( $field ); 

                // Send message
                wp_send_json( array( 'error' => 'laststep', 'message' => esc_html__( 'Demo imported successfully.' , 'realty-pack' ), 'progress' => $progress ) );

            }
        }

        exit();
    }

}