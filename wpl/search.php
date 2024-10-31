<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\Controllers\Wpl\RTPC_Controllers_WPL_Wpl;

/**
 * WPL carusel trait.
 *
 * @since 1.0.0
 */
class RTPC_WPL_Search extends \wpl_search_widget {

	public $elementor_settings;

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

    	$this->widget_id = $this->number;
    	if($this->widget_id < 0) $this->widget_id = abs($this->widget_id)+1000;

    	$this->widget_uq_name = 'wpls'.$this->widget_id;
    	$widget_id = $this->widget_id;
    	$this->target_id = isset($instance['wpltarget']) ? $instance['wpltarget'] : 0;

    	$this->kind                =   isset($instance['kind'])                ?   $instance['kind']                   : 0;
    	$this->ajax                =   isset($instance['ajax'])                ?   $instance['ajax']                   : 0;
    	$this->show_total_results  =   isset($instance['total_results'])       ?   $instance['total_results']          : 0;
    	$this->css_class           =   isset($instance['css_class'])           ?   $instance['css_class']              : '';
    	$this->more_options_type   =   isset($instance['more_options_type'])   ?   $instance['more_options_type']      : '0';
    	$this->show_reset_button   =   isset($instance['show_reset_button'])   ?   $instance['show_reset_button']      : '0';
    	$this->style               =   isset($instance['style'])               ?   $instance['style']                  : '0';
    	$this->show_saved_searches =   isset($instance['show_saved_searches']) ?   $instance['show_saved_searches']    : '0';
    	$this->show_favorites      =   isset($instance['show_favorites'])      ?   $instance['show_favorites']         : '0';

        /** add main scripts **/
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui-datepicker');

    	/** add Layout js **/
    	$js[] = (object) array('param1'=>'jquery.checkbox', 'param2'=>'packages/jquery.ui/checkbox/jquery.checkbox.min.js');
    	foreach($js as $javascript) \wpl_extensions::import_javascript($javascript);

    	echo isset($args['before_widget']) ? $args['before_widget'] : '';

    	$title = apply_filters('widget_title', (isset($instance['title']) ? $instance['title'] : ''));
    	if(trim($title) != '') echo (isset($args['before_title']) ? $args['before_title'] : '') .$title. (isset($args['after_title']) ? $args['after_title'] : '');

    	$find_files = array();

    	/** render search fields **/
    	$this->rendered = $this->render_search_fields($instance, $widget_id, $find_files);

    	/** generate stats **/
    	$current_user_id = \wpl_users::get_cur_user_id();

    	$this->favorites_count = 0;
    	$this->saved_searches_count = 0;

    	if( \wpl_global::check_addon('pro') )
    	{
    		_wpl_import('libraries.addon_pro');

    		if($current_user_id) $favorites = \wpl_addon_pro::favorite_get_pids(false, $current_user_id);
    		else $favorites = \wpl_addon_pro::favorite_get_pids(true);

    		$this->favorites_count = count($favorites);
    	}

    	if( \wpl_global::check_addon('save_searches') and $current_user_id )
    	{
    		_wpl_import('libraries.addon_save_searches');

    		$save_searches = new \wpl_addon_save_searches();
    		$this->saved_searches_count = count($save_searches->get('', $current_user_id));
    	}

    	echo isset($args['after_widget']) ? $args['after_widget'] : '';

    	$membership = '';
    	if( \wpl_global::check_addon('membership') ) {
    		$membership = new \wpl_addon_membership();
    	} 

    	echo controller::render_template(
    		'widgets/listing-search.php',
    		array(
    			'widget_id' => $this->widget_id,
    			'widget_uq_name' => $this->widget_uq_name,
    			'target_id' =>$this->target_id,
    			'kind' => $this->kind,
    			'ajax' => $this->ajax,
    			'show_total_results' => $this->show_total_results,
    			'css_class' => $this->css_class,
    			'more_options_type' => $this->more_options_type,
    			'show_reset_button' => $this->show_reset_button,
    			'style' => $this->style,
    			'show_saved_searches' => $this->show_saved_searches,
    			'show_favorites' => $this->show_favorites,
    			'args' => $args,
    			'rendered' => $this->rendered,
    			'current_user_id' => $current_user_id,
    			'favorites_count' => $this->favorites_count,
    			'saved_searches_count' => $this->saved_searches_count,
                'membership' => $membership,
                'wpl_show_tabs' => $this->elementor_settings['wpl_show_tabs'],
                'listing_link' => RTPC_Controllers_WPL_Wpl::get_properties_permalink(),
    		),
    		'always'
    	);

        // Import JS Codes
        $this->_wpl_import('widgets.search.scripts.js', true, true);
    }

}