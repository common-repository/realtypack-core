<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Agency;

use RTPC\Models\RTPC_Models_Model;
use RTPC\RTPC_Lib_Actions as Actions;

class RTPC_Models_Agency_Agent extends RTPC_Models_Model {

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {
        add_filter( 'rewrite_rules_array', array( $this, 'insert_rewrite_rules' ) );
        add_filter( 'query_vars', array( $this, 'my_insert_query_vars' ) );
    }


    /**
     * Adds WPL rewrite rukes
     * @param array $rules
     * @return array
     */
    public function insert_rewrite_rules( $rules ) {

        if ( ! class_exists( 'wpl_sef' ) ) {
            return;
        }

        $permalink = get_theme_mod( 'agent_permalink' );

        $permalink = \wpl_sef::get_post_slug( $permalink );

        $newrules = array();

        $newrules['('.$permalink.')/(\d*)$'] = 'index.php?post_type=agent_builder&$matches[1]&agent_id=$matches[2]';

        $finalrules = $newrules + $rules;

        return $finalrules;
    }

    // Adding the id var so that WP recognizes it
    function my_insert_query_vars( $vars ) {
        array_push( $vars, 'agent_id' );

        return $vars;
    }

    // Adding the id var so that WP recognizes it
    public static function get_permalink( $user_id ) {

        $permalink = get_theme_mod( 'agent_permalink' );

        $permalink = \wpl_sef::get_post_slug( $permalink );

        $permalink = get_site_url() .'/'. $permalink .'/'. $user_id ;

        return $permalink;
    }

}