<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\controllers\RTPC_Controllers_Public as controller;
_wpl_import('views.frontend.property_show.wpl_abstract');

/**
 * WPL property single
 *
 * @since 1.0.0
 */
class RTPC_WPL_PropertyDetails extends \wpl_property_show_controller_abstract {

    /**
     * @param array $args
     * @param array $instance
     */
    public function get_details() {

        // property listing model
        $this->model = new \wpl_property();

        $this->pid = \wpl_request::getVar('pid', 0);

        $listing_id = \wpl_request::getVar('mls_id', 0);
        if( trim( $listing_id ) ) {

            $this->pid = \wpl_property::pid($listing_id);
            \wpl_request::setVar('pid', $this->pid);

        }

        $property = $this->model->get_property_raw_data( $this->pid );
        
        $this->pshow_fields = $this->model->get_pshow_fields( '', $property['kind'] );
        $this->pshow_categories = \wpl_flex::get_categories( '', '', " AND `enabled`>='1' AND `kind`='".$property['kind']."' AND `pshow`='1'" );
        $wpl_properties = array();

        /** define current index **/
        $wpl_properties['current']['data'] = (array) $property;
        $wpl_properties['current']['raw'] = (array) $property;
        
        $find_files = array();
        $rendered_fields = $this->model->render_property( $property, $this->pshow_fields, $find_files, true );
        
        $wpl_properties['current']['rendered_raw'] = $rendered_fields['ids'];
        $wpl_properties['current']['materials'] = $rendered_fields['columns'];
        
        foreach( $this->pshow_categories as $pshow_category ) {

            if( trim( $pshow_category->listing_specific ) != '' ) {
                if( substr( $pshow_category->listing_specific, 0, 5 ) == 'type=' ) {
                    $specified_listings = \wpl_global::get_listing_types_by_parent( substr( $pshow_category->listing_specific, 5 ) );

                    $array_specified_listing = array();
                    foreach( $specified_listings as $specified_listing ) $array_specified_listing[] = $specified_listing['id'];

                    if( ! in_array( $wpl_properties['current']['data']['listing'], $array_specified_listing ) ) continue;
                }
            } elseif ( trim( $pshow_category->property_type_specific ) != '' ) {
                if( substr( $pshow_category->property_type_specific, 0, 5 ) == 'type=' ) {
                    $specified_property_types = \wpl_global::get_property_types_by_parent( substr( $pshow_category->property_type_specific, 5 ) );

                    $array_specified_property_types = array();
                    foreach( $specified_property_types as $specified_property_type ) $array_specified_property_types[] = $specified_property_type['id'];

                    if( ! in_array( $wpl_properties['current']['data']['property_type'], $array_specified_property_types ) ) continue;
                }
            }

            $pshow_cat_fields = $this->model->get_pshow_fields( $pshow_category->id, $property['kind'] );
            $wpl_properties['current']['rendered'][$pshow_category->id]['self'] = (array) $pshow_category;
            $wpl_properties['current']['rendered'][$pshow_category->id]['data'] = $this->model->render_property($property, $pshow_cat_fields);
        }
        
        $wpl_properties['current']['items'] = \wpl_items::get_items($this->pid, '', $property['kind'], '', 1);
                
        $this->wpl_properties = $wpl_properties;
        $this->kind = $property['kind'];
        $this->property = $wpl_properties['current'];
        
        /** updating the visited times and etc **/
        \wpl_property::property_visited( $this->pid );
        
        // Location visibility
        $this->location_visibility = \wpl_property::location_visibility( $this->pid, $this->kind, \wpl_users::get_user_membership() );
        
        return $this->wpl_properties;

    }

}
