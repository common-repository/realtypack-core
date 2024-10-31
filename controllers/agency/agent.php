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

class RTPC_Controllers_Agency_Agent extends RTPC_Controllers_Controller {

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        $this->model = RTPC_Models_Agency_Agent::get_instance();
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {
        add_shortcode( 'Agent_Single', array( $this, 'agent_single' ) );
    }

    public function agent_single( $atts )  {
        extract( 
            shortcode_atts( 
                array(
                    'message' => ''
                ), $atts 
            ) 
        );

    }

    public static function agent_role()  {

        add_role(
            'agent',
            __( 'Agent' ),
            array()
        );

    }

    public static function get_agent_link( $user_id )  {
        return static::get_model()->get_permalink( $user_id );
    }

}