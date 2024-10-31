<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

_wpl_import('views.frontend.property_show.wpl_abstract');

/**
 * WPL property single
 *
 * @since 1.0.0
 */
class RTPC_WPL_Property extends \wpl_property_show_controller_abstract {

	public $elementor_settings;

    /**
     * @param array $args
     * @param array $instance
     */
    public function display( $instance = array() ) {
        // Check if we are in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            return;
        }
        
        // Global Settings
        $this->settings = \wpl_settings::get_settings();
        
        // Do Cronjobs
        if( isset( $this->settings['wpl_cronjobs'] ) and $this->settings['wpl_cronjobs'] ) {
            _wpl_import('libraries.events');
            \wpl_events::do_cronjobs();
        }
        
        // Check Access
        if( ! \wpl_users::check_access( 'propertyshow' ) ) {
            // Import Message tpl
            if( \wpl_users::is_administrator() ) {

                $this->message = sprintf(__("You don't have access to this menu! %s KB article might be helpful.", 'realty-pack-core'), '<a href="https://support.eightqueens.pro/index.php?/Default/Knowledgebase/Article/View/618/">'.__('this', 'realty-pack-core').'</a>');

            } else {

                $this->message = __( "You don't have access to see properties! Please login or register first.", 'realty-pack-core' );
            }

            return array(
                'error' => true,
                'error_code' => 401,
                'message' => $this->message
            );
        }

        // property listing model
        $this->model = new \wpl_property();

        $this->pid = \wpl_request::getVar('pid', 0);

        if ( 0 === $this->pid ) {
            return array(
                'error' => true,
                'error_code' => 404,
                'message' => $this->message
            );
        }

        $listing_id = \wpl_request::getVar('mls_id', 0);
        if( trim( $listing_id ) ) {

            $this->pid = \wpl_property::pid($listing_id);
            \wpl_request::setVar('pid', $this->pid);

        }

        $property = $this->model->get_property_raw_data( $this->pid );

        /** no property found **/
        if ( ! $property or $property['finalized'] == 0 or $property['confirmed'] == 0 or $property['deleted'] == 1 or $property['expired'] >= 1 ) {
            /** import message tpl **/
            if( isset( $property['confirmed'] ) and !$property['confirmed'] ) { 
                $this->message = __("Sorry! The property is not visible until it is confirmed by someone.", 'realty-pack-core');
            } else {
                $this->message = __("Sorry! Either the url is incorrect or the listing is no longer available.", 'realty-pack-core');
            }

            return array(
                'error' => true,
                'error_code' => 401,
                'message' => $this->message
            );
        }
        
        $current_user = \wpl_users::get_wpl_user();
        $lrestrict = $current_user->maccess_lrestrict_pshow;
        $rlistings = explode( ',', $current_user->maccess_listings_pshow );
        $ptrestrict = $current_user->maccess_ptrestrict_pshow;
        $rproperty_types = explode( ',', $current_user->maccess_property_types_pshow );

        if ( ( $lrestrict and !in_array( $property['listing'], $rlistings ) ) or ( $ptrestrict and !in_array( $property['property_type'], $rproperty_types ) ) ) {

            $this->message = __( "Sorry! You don't have access to view this property.", 'realty-pack-core' );
            return array(
                'error' => true,
                'error_code' => 401,
                'message' => $this->message
            );
        }

        /** updating the visited times and etc **/
        \wpl_property::property_visited( $this->pid );
                
        /** trigger event **/
        \wpl_global::event_handler( 'property_show', array( 'id'=>$this->pid ) );
        
        return true;
    }

}
