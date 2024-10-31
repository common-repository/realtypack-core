<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

trait RTPC_WPL_WPL {

    /**
     * Returns WPL users
     *
     * @return array
     */
    public static function get_property_fields( $cols, $pid ) {

        if ( is_array( $cols ) ) {
            $query = "SELECT " .implode(",", $cols) . " FROM `#__wpl_properties` WHERE id = '$pid'";
        } else {
            $query = "SELECT $cols FROM `#__wpl_properties` WHERE id = '$pid'";
        }
        
        return \wpl_db::select($query,'loadObject');

    }
    
}