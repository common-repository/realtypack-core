<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Builder;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Admin;
use RTPC\Models\Admin\Builder\RTPC_Models_Admin_Builder_Init;
use RTPC\Controllers\Admin\Builder\RTPC_Controllers_Admin_Builder_Table;

class RTPC_Controllers_Admin_Builder_Boot extends RTPC_Controllers_Admin_Admin {

    public $ajax_action  = 'RTPC_template';
    private static $nounce  = 'RTPC_template';

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {

        $this->model = RTPC_Models_Admin_Builder_Init::get_instance();

        $this->register_hook_callbacks();

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    protected function register_hook_callbacks() {

        Actions::add_action( 'admin_head', $this, 'light_box_content' );

        if( is_admin() ){
            RTPC_Controllers_Admin_Builder_Table::get_instance();
        }

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function light_box_content() {
        // Check if its not ajax
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }

        $page = isset( $_GET['page'] ) ? $_GET['page'] : '';

        // Check if its single page
        if ( 'realtypack_builder' !== $page ) {
            return;
        }

        echo parent::render_template(
            'admin/builder-template.php',
            array(

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
                jQuery(".featherlight #rtpc-template-submit").RTPC_Template({
                    selector: ".featherlight #rtpc-template-submit",
                    nounce : "'. $nounce .'",
                    action_hook: "RTPC_template",
                });
            });';

        return $javascript;

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function render() {

        check_ajax_referer( self::$nounce, 'security' );

        $type = sanitize_text_field( $_POST['post_type'] );
        $title = sanitize_title( $_POST['post_title'] );

        // Simple check for type
        if ( '' == $type ) {
            wp_send_json( array( 'error' => true , 'url' => false, 'message' => 'Choose template type.' ) );
        }

        $template_id = $this->model->save_item( $type, $title );

        if ( is_numeric( $template_id ) ) {

            $url = get_edit_post_link( $template_id, 'url' );
            $url = rtrim( $url, 'edit' );
            $url = $url . 'elementor';
            
            wp_send_json( array( 'error' => false , 'url' => $url ) );
        }

        wp_send_json( array( 'error' => true , 'url' => false, 'message' => 'Try it again!' ) );

    }

}