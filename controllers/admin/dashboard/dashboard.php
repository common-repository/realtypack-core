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
use RTPC\Models\Admin\Dashboard\RTPC_Models_Admin_Dashboard_Dashboard as model;

class RTPC_Controllers_Admin_Dashboard_Dashboard extends RTPC_Controllers_Admin_Dashboard_Boot {

    public $ajax_action  = 'RTPC_dashboard';
    public $api  = 'https://eightqueens.pro/v1/api/realtypack/';
    private static $nounce  = 'RTPC_dashboard';

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        $this->model = model::get_instance();
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {}

    /**
     * [render description]
     * @return [type] [description]
     */
    function render() {

        echo parent::render_template(
            'admin/dashboard.php',
            array(
                'header' => parent::header(),
                'footer' => parent::footer(),
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
                jQuery(".rtpc-admin-activation-form-submit").RTPC_dashboard({
                    selector: ".rtpc-admin-activation-form-submit",
                    nounce : "'. $nounce .'",
                    type : "submit_data",
                    action_hook: "RTPC_dashboard",
                });
            });';

        return $javascript;
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function ajax_handler() {

        check_ajax_referer( self::$nounce, 'security' );

        $email      = isset( $_POST['email'] ) ? $_POST['email'] : '';
        $purchase   = isset( $_POST['purchase'] ) ? $_POST['purchase'] : '';
        $error = false;
        update_option( 'realtypack_activation', false);

        // Check email
        if ( '' === $email || !is_email( $email ) ) {
            $error = true;
            $message = esc_html__( 'Email is invalid please enter your email.', 'realty-pack' );
        }
        // Check purchase code
        if ( '' === $purchase ) {
            $error = true;
            $message = esc_html__( 'Purchase code is invalid please enter your purchase code.', 'realty-pack' );
        }
        // Send error
        if ( $error ) {
            wp_send_json( array( 'error' => $error, 'message' => $message ) );
        }
        
        // Update email and purchase code
        update_option( 'realtypack_activate_email', $email );
        update_option( 'realtypack_activate_purchase', $purchase );

        $url = $this->api . $email .'/'. $purchase; 

        // get remote api
        $remote = parent::remote_get( $url );

        // Check remote api
        if ( isset( $remote['body'] ) ) {
            $remote = json_decode( $remote['body'], true );
        }

        // Send request result
        if ( isset( $remote['error'] ) ) {
            if ( isset( $remote['error'] ) && '1' != $remote['error'] ) {
                update_option( 'realtypack_activation', 'activated' );
            }
            
            wp_send_json( array( 'error' => $remote['error'], 'message' => $remote['message'] ) );
        }

        // If it coudnt connect we will send error
        wp_send_json( array( 'error' => true, 'message' => 'Can not connect to api please try later.' ) );
    }

}