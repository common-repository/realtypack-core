<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\models\wpl\RTPC_Models_WPL_Wpl;
use RTPC\WPL\RTPC_WPL_Pagination;
_wpl_import( 'views.frontend.property_listing.wpl_abstract' );

/**
 * WPL listing class
 *
 * @since 1.0.0
 */
class RTPC_WPL_Listing extends \wpl_property_listing_controller_abstract {

    public $elementor_settings;
    public $edit_mod = false;
    public $tags_setting;

    public function display( $instance = array() ) {
        // Check Access
        if( !\wpl_users::check_access( 'propertylisting' ) ) {
            // Import Message tpl
            if( \wpl_users::is_administrator() ) {
                $this->message = sprintf( __("You don't have access to this menu! %s KB article might be helpful.", 'realty-pack-core'), '<a href="https://support.eightqueens.pro/index.php?/Default/Knowledgebase/Article/View/618/">'. __('this', 'realty-pack-core').'</a>' );
            } else {
                $this->message = __("You don't have access to see properties! Please login or register first.", 'realty-pack-core');
            }

            // Render TPL
            echo controller::render_template(
                'errors/property-access.php',
                array(
                    'message'  => $this->message,
                ),
                'always'
            );
        }
        
        $this->method = \wpl_request::getVar('wplmethod', NULL);
        
        // Global Settings
        $this->settings = \wpl_settings::get_settings();
        
        // Listing Settings
        $this->page_number = \wpl_request::getVar('wplpage', 1, '', true);
        $this->limit = \wpl_request::getVar('limit', 6);
        $this->start = \wpl_request::getVar('start', (($this->page_number-1)*$this->limit), '', true);
        $this->orderby = \wpl_request::getVar('wplorderby', $this->settings['default_orderby'], '', true);
        $this->order = \wpl_request::getVar('wplorder', $this->settings['default_order'], '', true);
        
        // list view
        $this->property_listview = \wpl_request::getVar('wplplv', '1'); #Show listview or not
        
        // only icon or icon+text
        $this->switcher_type = isset($this->settings['wpl_listing_switcher_type']) ? $this->settings['wpl_listing_switcher_type'] : 'icon';
        
        // listing Columns Count
        $listing_columns = \wpl_global::get_setting('wpl_ui_customizer_property_listing_columns');
        $listing_columns_default = trim($listing_columns) ? $listing_columns : '3';
        $this->listing_columns = \wpl_request::getVar('wplcolumns', $listing_columns_default); 

        // Disable or Enable Mouseover effect
        $this->listing_picture_mouseover = isset($this->settings['wpl_listing_picture_mouseover']) ? $this->settings['wpl_listing_picture_mouseover'] : 1;
        
        // Sort Option Type
        $this->wpl_listing_sort_type = isset($this->settings['wpl_listing_sort_type']) ? $this->settings['wpl_listing_sort_type'] : 'list';
        
        // RSS Feed Setting
        $this->listings_rss_enabled = isset($this->settings['listings_rss_enabled']) ? $this->settings['listings_rss_enabled'] : 0;
        
        // Print Results Page
        $this->print_results_page = isset($this->settings['pdf_results_page_status']) ? $this->settings['pdf_results_page_status'] : 0;

        // Is Map Activity Enabled or Not
        $this->map_activity = \wpl_activity::get_activities('plisting_position1', 1, '', 'loadObject', 'googlemap');

        // Agent and office name for mls compliance
        $this->show_agent_name = isset($this->settings['show_agent_name']) ? $this->settings['show_agent_name'] : 0;
        $this->show_office_name = isset($this->settings['show_listing_brokerage']) ? $this->settings['show_listing_brokerage'] : 0;

        $this->label_agent_name = isset($this->settings['label_agent_name']) ? $this->settings['label_agent_name'] : "";
        $this->label_office_name = isset($this->settings['label_listing_brokerage']) ? $this->settings['label_listing_brokerage'] : "";

        // Favorite btn show or hide
        $this->favorite_btn = isset($this->settings['wpl_ui_customizer_property_listing_favorite_btn']) ? $this->settings['wpl_ui_customizer_property_listing_favorite_btn'] : 1;

        // Detect Kind
        $this->kind = \wpl_request::getVar('kind', 0);
        if( ! $this->kind ) { 
            $this->kind = \wpl_request::getVar('sf_select_kind', 0);
        }

        if ( ! $this->kind ) {
            $this->kind = $instance['kind'];
        }


        if(!in_array($this->kind, \wpl_flex::get_valid_kinds()))
        {
            // Import Message TPL
            $this->message = __('Invalid Request!', 'realty-pack-core');

            // Render TPL
            echo controller::render_template(
                'errors/property-access.php',
                array(
                    'message'  => $this->message,
                ),
                'always'
            );
        }
        
        // Pagination Types
        $this->wplpagination = \wpl_request::getVar('wplpagination', 'normal', '', true);
        \wpl_request::setVar('wplpagination', $this->wplpagination);
        
        // Property Listing Model
        $this->model = new \wpl_property;
        
        // Set page if start var passed
        $this->page_number = ($this->start/$this->limit)+1;
        \wpl_request::setVar('wplpage', $this->page_number);
        
        $where = array('sf_select_confirmed'=>1, 'sf_select_finalized'=>1, 'sf_select_deleted'=>0, 'sf_select_expired'=>0, 'sf_select_kind'=>$this->kind);

        // Add search conditions to the where
        $vars = array_merge(\wpl_request::get('POST'), \wpl_request::get('GET'));
        $vars['sf_select_listing'] = isset( $vars['sf_select_listing'] ) ? $vars['sf_select_listing'] :  $instance['sf_select_listing'];
        $vars['sf_select_property_type'] = isset( $vars['sf_select_property_type'] ) ? $vars['sf_select_property_type'] :  $instance['sf_select_property_type'];
        $vars['sf_locationtextsearch'] = isset( $vars['sf_locationtextsearch'] ) ? $vars['sf_locationtextsearch'] :  $instance['sf_locationtextsearch'];
        $vars['sf_min_price'] = isset( $vars['sf_min_price'] ) ? (int) $vars['sf_min_price'] : (int) $instance['sf_min_price'];
        $vars['sf_max_price'] = isset( $vars['sf_max_price'] ) ? (int) $vars['sf_max_price'] :  (int) $instance['sf_max_price'];
        $vars['sf_unit_price'] = isset( $vars['sf_unit_price'] ) ? $vars['sf_unit_price'] :  $instance['sf_unit_price'];
        $vars['sf_select_user_id'] = isset( $vars['sf_select_user_id'] ) ? $vars['sf_select_user_id'] :  $instance['sf_select_user_id'];
        $vars['limit'] = isset( $vars['limit'] ) ? $vars['limit'] :  $instance['limit'];
        $vars['wplorderby'] = isset( $vars['wplorderby'] ) ? $vars['wplorderby'] :  $instance['wplorderby'];
        $vars['wplorder'] = isset( $vars['wplorder'] ) ? $vars['wplorder'] :  $instance['wplorder'];
        $where = array_merge($vars, $where);

        // View Restrictions
        $current_user = \wpl_users::get_wpl_user();
        
        $lrestrict = isset($current_user->maccess_lrestrict_plisting) ? $current_user->maccess_lrestrict_plisting : '';
        $ptrestrict = isset($current_user->maccess_ptrestrict_plisting) ? $current_user->maccess_ptrestrict_plisting : '';

        if($lrestrict)
        {
            $rlistings = trim($current_user->maccess_listings_plisting, ',');
            $where['sf_restrict_listing'] = $rlistings;
        }

        if($ptrestrict)
        {
            $rproperty_types = trim($current_user->maccess_property_types_plisting, ',');
            $where['sf_restrict_property_type'] = $rproperty_types;
        }
        
        // Start Search
        $this->model->start($this->start, $this->limit, $this->orderby, $this->order, $where, $this->kind);
        
        // Run the Search
        $this->model->query();
        $properties = $this->model->search();
        
        // Finish Search
        $this->model->finish();
        
        
        // validation for page_number
        $this->total_pages = ceil($this->model->total / $this->limit);
        if($this->page_number <= 0 or ($this->page_number > $this->total_pages)) $this->model->start = 0;
        
        // Update WPL Session
        if(!$this->return_listings)
        {
            // Save Search in SESSION
            \wpl_session::set('wpl_listing_criteria', $this->model->where);
            \wpl_session::set('wpl_listing_orderby', $this->orderby);
            \wpl_session::set('wpl_listing_order', $this->order);
            \wpl_session::set('wpl_listing_total', $this->model->total);
        
            // Search URL
            $search_url = \wpl_global::remove_qs_var('wpl_format', \wpl_global::get_full_url());
            \wpl_session::set('wpl_last_search_url', $search_url);

            // Market Reports Addon
            if( \wpl_global::check_addon('market_reports') ) {
                // Include Library
                _wpl_import('libraries.addon_market_reports');

                // Log the Search
                $mr = new \wpl_addon_market_reports();
                $mr->search($where);
            }
        }
        
        // We have to disable the cache if some of units changed by unit switcher feature or something else
        $force = false;
        $cookies = \wpl_request::get('COOKIE');
        if(isset($cookies['wpl_unit1']) or isset($cookies['wpl_unit2']) or isset($cookies['wpl_unit3']) or isset($cookies['wpl_unit4'])) $force = true;

        $wpl_properties = array();
        foreach($properties as $property)
        {
            $wpl_properties[$property->id] = $this->model->full_render($property->id, $this->model->listing_fields, $property, array(), $force);
            $wpl_properties[$property->id]['link'] = RTPC_Models_WPL_Wpl::get_property_link($property->id);

            // Add Include In Listings Stat
            if($this->method != 'get_markers') \wpl_property::add_property_stats_item($property->id, 'inc_in_listings_numb');
        }
        
        // Define Current Index
        $wpl_properties['current'] = array();
        
        $this->pagination = RTPC_WPL_Pagination::get_pagination($this->model->total, $this->limit, true, $this->wplraw);
        $this->wpl_properties = $wpl_properties;
        
        if($this->wplraw and $this->method == 'get_markers') {
            $markers = array('markers'=>$this->model->render_markers($wpl_properties), 'total'=>$this->model->total);
            echo json_encode($markers);
            exit;
        }
        elseif($this->wplraw and $this->method == 'get_listings' )
        {
            if($this->return_listings) return $wpl_properties;
            else
            {
                echo json_encode($wpl_properties);
                exit;
            }
        }

        $description_column = 'field_308';
        if( \wpl_global::check_multilingual_status() and \wpl_addon_pro::get_multiligual_status_by_column($description_column, $this->kind)) $description_column = \wpl_addon_pro::get_column_lang_name($description_column, \wpl_global::get_current_language(), false);

        // Membership ID of current user
        $current_user_membership_id = \wpl_users::get_user_membership();

        // Microdata
        $this->microdata = isset($this->settings['microdata']) ? $this->settings['microdata'] : 0;
        $this->itemscope = ($this->microdata) ? 'itemscope' : '';

        $this->itemprop_name = ($this->microdata) ? 'itemprop="name"' : '';
        $this->itemtype_offer = ($this->microdata) ? 'itemtype="http://schema.org/offer"' : '';
        $this->itemprop_address = ($this->microdata) ? 'itemprop="address"' : '';
        $this->itemtype_PostalAddress = ($this->microdata) ? 'itemtype="http://schema.org/PostalAddress"' : '';
        $this->itemprop_addressLocality = ($this->microdata) ? 'itemprop="addressLocality"' : '';

        // Render TPL
        echo controller::render_template(
            'widgets/property-listing.php',
            array(
                'kind'  => $this->kind,
                'wpl_properties'  => $wpl_properties,
                'description_column'  => $description_column,
                'current_user_membership_id'  => $current_user_membership_id,
                'elementor_settings'  => $this->elementor_settings,
                'itemprop_name'  => $this->itemprop_name,
                'itemscope'  => $this->itemscope,
                'itemtype_offer'  => $this->itemtype_offer,
                'itemprop_address'  => $this->itemprop_address,
                'itemtype_PostalAddress'  => $this->itemtype_PostalAddress,
                'itemprop_addressLocality'  => $this->itemprop_addressLocality,
                'edit_mod'  => $this->edit_mod,
                'pagination'  => $this->pagination,
                'wplpagination'  => $this->wplpagination,
                'model'  => $this->model,
            ),
            'always'
        );
    }    

    public function property_data( $instance = array() ) {
        
        $this->method = \wpl_request::getVar('wplmethod', NULL);
        
        // Global Settings
        $this->settings = \wpl_settings::get_settings();
        
        // Listing Settings
        $this->page_number = \wpl_request::getVar('wplpage', 1, '', true);
        $this->limit = \wpl_request::getVar('limit', 6);
        $this->start = \wpl_request::getVar('start', (($this->page_number-1)*$this->limit), '', true);
        $this->orderby = \wpl_request::getVar('wplorderby', $this->settings['default_orderby'], '', true);
        $this->order = \wpl_request::getVar('wplorder', $this->settings['default_order'], '', true);

        // Detect Kind
        $this->kind = \wpl_request::getVar('kind', 0);
        if( ! $this->kind ) { 
            $this->kind = \wpl_request::getVar('sf_select_kind', 0);
        }

        if ( ! $this->kind ) {
            $this->kind = $instance['kind'];
        }
        
        // Property Listing Model
        $this->model = new \wpl_property;
        
        $where = array('sf_select_confirmed'=>1, 'sf_select_finalized'=>1, 'sf_select_deleted'=>0, 'sf_select_expired'=>0, 'sf_select_kind'=>$this->kind);

        // Add search conditions to the where
        $vars = array_merge(\wpl_request::get('POST'), \wpl_request::get('GET'));
        $vars['limit'] = isset( $vars['limit'] ) ? $vars['limit'] :  $instance['limit'];
        $vars['wplorder'] = isset( $vars['wplorder'] ) ? $vars['wplorder'] :  $instance['wplorder'];
        $where = array_merge($vars, $where);

        // View Restrictions
        $current_user = \wpl_users::get_wpl_user();
        
        $lrestrict = isset($current_user->maccess_lrestrict_plisting) ? $current_user->maccess_lrestrict_plisting : '';
        $ptrestrict = isset($current_user->maccess_ptrestrict_plisting) ? $current_user->maccess_ptrestrict_plisting : '';

        if($lrestrict)
        {
            $rlistings = trim($current_user->maccess_listings_plisting, ',');
            $where['sf_restrict_listing'] = $rlistings;
        }

        if($ptrestrict)
        {
            $rproperty_types = trim($current_user->maccess_property_types_plisting, ',');
            $where['sf_restrict_property_type'] = $rproperty_types;
        }
        
        // Start Search
        $this->model->start($this->start, $this->limit, $this->orderby, $this->order, $where, $this->kind);
        
        // Run the Search
        $this->model->query();
        $properties = $this->model->search();
        
        // Finish Search
        $this->model->finish();

        // We have to disable the cache if some of units changed by unit switcher feature or something else
        $force = false;
        $cookies = \wpl_request::get('COOKIE');
        if(isset($cookies['wpl_unit1']) or isset($cookies['wpl_unit2']) or isset($cookies['wpl_unit3']) or isset($cookies['wpl_unit4'])) $force = true;

        $wpl_properties = array();
        foreach($properties as $property)
        {
            $wpl_properties[$property->id] = $this->model->full_render($property->id, $this->model->listing_fields, $property, array(), $force);
            $wpl_properties[$property->id]['link'] = RTPC_Models_WPL_Wpl::get_property_link($property->id);

            // Add Include In Listings Stat
            if($this->method != 'get_markers') \wpl_property::add_property_stats_item($property->id, 'inc_in_listings_numb');
        }
        
        // Define Current Index
        $wpl_properties['current'] = array();

        return $wpl_properties;
    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_info( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->profile_picture ) != '') {
            $data->profile_picture = array(
                'url' => \wpl_items::get_folder($user_id, 2).$data->wpl_data->profile_picture,
                'path' => \wpl_items::get_path($user_id, 2).$data->wpl_data->profile_picture,
                'name' => $data->wpl_data->profile_picture
            );
        } else {
            $data->profile_picture = array(
                'url' => RTPC_ASSETS_URL . 'assets/img/male.jpg',
                'path' => RTPC_ASSETS_PATH . 'assets/img/male.jpg',
                'name' => ''
            );
        }

        return $data;
    }

    public static function time_elapsed_string( $datetime, $full = false ) {

        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => __( 'year', 'realty-pack-core' ),
            'm' => __( 'month', 'realty-pack-core' ),
            'w' => __( 'week', 'realty-pack-core' ),
            'd' => __( 'day', 'realty-pack-core' ),
            'h' => __( 'hour', 'realty-pack-core' ),
            'i' => __( 'minute', 'realty-pack-core' ),
            's' => __( 'second', 'realty-pack-core' ),
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if ( !$full ) $string = array_slice( $string, 0, 1 );
        return $string ? implode(', ', $string) . __( ' ago', 'realty-pack-core' ) : 'just now';
    }



}