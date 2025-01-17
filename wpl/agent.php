<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\models\wpl\RTPC_Models_WPL_Wpl;
_wpl_import('views.frontend.profile_listing.wpl_abstract');

class RTPC_WPL_Agent extends \wpl_profile_listing_controller_abstract {

	public function display( $instance = array() ) {
		/** profile listing model **/
		$this->model = new \wpl_users;
		
		/** global settings **/
		$this->settings = wpl_settings::get_settings();
		
		/** listing settings **/
		$this->page_number = wpl_request::getVar('wplpage', 1, '', true);
		$this->limit = wpl_request::getVar('limit', $this->settings['default_profile_page_size'], '', true);
		$this->start = wpl_request::getVar('start', (($this->page_number-1)*$this->limit), '', true);
		$this->orderby = wpl_request::getVar('wplorderby', $this->settings['default_profile_orderby'], '', true);
		$this->order = wpl_request::getVar('wplorder', $this->settings['default_profile_order'], '', true);
		
        /** Set Property CSS class **/
        $this->property_css_class = wpl_request::getVar('wplpcc', NULL);
        if(!$this->property_css_class) $this->property_css_class = wpl_request::getVar('wplpcc', 'grid_box', 'COOKIE');
        
        $this->property_css_class_switcher = wpl_request::getVar('wplpcc_switcher', '1');
        $this->property_listview = wpl_request::getVar('wplplv', '1'); #Show listview or not
        
		/** set page if start var passed **/
		$this->page_number = ($this->start/$this->limit)+1;
		wpl_request::setVar('wplpage', $this->page_number);
		
        /** User Type **/
        $this->user_type = wpl_request::getVar('sf_select_membership_type', NULL);
        
		/** detect kind **/
		$this->kind = wpl_request::getVar('kind', 2);
		if(!in_array($this->kind, wpl_flex::get_valid_kinds()))
		{
			/** import message tpl **/
			$this->message = __('Invalid Request!', 'realty-pack-core');
			return parent::render($this->tpl_path, 'message', false, true);
		}
		
        /** pagination types **/
        $this->wplpagination = wpl_request::getVar('wplpagination', 'normal', '', true);
        wpl_request::setVar('wplpagination', $this->wplpagination);
        
		$where = array('sf_tmin_id'=>1, 'sf_select_access_public_profile'=>1, 'sf_select_expired'=>0);
		
		/** Add search conditions to the where **/
        $vars = array_merge(wpl_request::get('POST'), wpl_request::get('GET'));
		$where = array_merge($vars, $where);
		
		/** start search **/
		$this->model->start($this->start, $this->limit, $this->orderby, $this->order, $where);
		
		/** run the search **/
		$this->model->query();
		$profiles = $this->model->search();
        
        /** finish search **/
		$this->model->finish();
        
        /** validation for page_number **/
		$this->total_pages = ceil($this->model->total / $this->limit);
		if($this->page_number <= 0 or ($this->page_number > $this->total_pages)) $this->model->start = 0;
		
		/** Profile Listing Columns Count **/
		$profile_columns = wpl_global::get_setting('wpl_ui_customizer_profile_listing_columns');
		$profile_columns_default = trim($profile_columns) ? $profile_columns : '3';
		$this->profile_columns = wpl_request::getVar('wplcolumns', $profile_columns_default); 
        
		$plisting_fields = $this->model->get_plisting_fields();
		
		$wpl_profiles = array();
		foreach($profiles as $profile)
		{
            // User is not exists in WordPress
            if(!wpl_users::is_wp_user($profile->id)) continue;
            
			$wpl_profiles[$profile->id] = $this->model->full_render($profile->id, $plisting_fields);
		}
		
		/** define current index **/
		$wpl_profiles['current'] = array();
		
		/** apply filters (This filter must place after all proccess) **/
		_wpl_import('libraries.filters');
		@extract(wpl_filters::apply('profile_listing_after_render', array('wpl_profiles'=>$wpl_profiles)));
		
		$this->pagination = wpl_pagination::get_pagination($this->model->total, $this->limit, true, $this->wplraw);
		$this->wpl_profiles = $wpl_profiles;
		
        /** import tpl **/
        $this->tpl = wpl_users::get_user_type_tpl($this->tpl_path, $this->tpl, $this->user_type);
        
		/** import tpl **/
		return parent::render($this->tpl_path, $this->tpl, false, true);
	}
}