<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Agency;

use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Models\Agency\RTPC_Models_Agency_Agency;

class RTPC_Controllers_Agency_Boot extends RTPC_Controllers_Controller {

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        $this->register_hook_callbacks();
        $this->model = RTPC_Models_Agency_Agency::get_instance();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {

        add_shortcode( 'agency_dashboard', array( $this, 'agency_dashboard' ) );
        add_shortcode( 'Agency_Single', array( $this, 'agency_single' ) );

    }

    public function agency_dashboard( $atts )  {

        extract( 
            shortcode_atts( 
                array(
                    'message' => ''
                ), $atts 
            ) 
        );

        echo parent::render_template(
            'agancy/agancy-dashboard.php',
            array(
                'message' => $message
            ),
            'always'
        );   
    }

    public function agency_single( $atts )  {

        extract( 
        	shortcode_atts( 
        		array(
        			'message' => ''
        		), $atts 
        	) 
        );

    }

    public static function agency_role()  {

        add_role(
            'agency',
            __( 'Agency' ),
            array()
        );

    }

    public static function get_agency_link( $post_id )  {
        return static::get_model()->get_permalink( $post_id );
    }


}