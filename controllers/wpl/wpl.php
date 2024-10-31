<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Wpl;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Models\Wpl\RTPC_Models_WPL_Wpl;
use RTPC\WPL\RTPC_WPL_Property;
use RTPC\WPL\RTPC_WPL_Listing;

class RTPC_Controllers_WPL_Wpl extends RTPC_Controllers_Controller {

	public $message;
	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->model = RTPC_Models_WPL_Wpl::get_instance();
		$this->register_hook_callbacks();
		Actions::add_filter( 'search_widget_search_page', $this, 'change_search_permalink' );

	}

	public function register_hook_callbacks() {
		// Add single property shortcode
		add_shortcode( 'RTP_Property_Show', array( $this, 'property_show' ) );

		$main_permalink = get_theme_mod( 'wpl_main_permalink', 'wpl' );

		if ( $main_permalink !== 'wpl' ) {
			add_filter( 'wpl_change_permalink', array($this, 'change_wpl_listing_permalink') );
		}
	}

	function change_wpl_listing_permalink() {
		return $this->get_model()->get_wpl_permalink();
	}

	public function property_show( $atts ) {
		extract( 
			shortcode_atts( 
				array(
					'message' => ''
				), $atts 
			) 
		);

		$property_show = new RTPC_WPL_Property;
		$property_show = $property_show->display();

		if ( isset( $_REQUEST['elementor-preview'] ) ) {
			return;
		}

		if ( isset( $property_show['error'] ) && true === $property_show['error'] && 401 === $property_show['error_code'] ) {

			$this->message = $property_show['message'];
			add_filter( 'the_content', array( $this, 'edit_acces_content' ), 999 );

			return;
		} else if ( isset( $property_show['error'] ) && true === $property_show['error'] && 404 === $property_show['error_code'] ) {

			add_filter( 'the_content', array( $this, 'run_property_archive' ), 999 );

			return;
		}
	}

	function edit_acces_content( $content ) {
		// Render TPL
		return controller::render_template(
			'errors/property-access.php',
			array(
				'message'  => $this->message,
			),
			'always'
		);
	}

	function run_property_archive( $content ) {
		// So we are in properties page
		$instance = array (
			'kind' 						=>	(string) '0',
			'sf_select_listing'		 	=>	'',
			'sf_select_property_type' 	=>	'',
			'sf_locationtextsearch'		=>	'',
			'sf_min_price' 				=>	'',
			'sf_max_price' 				=>	'',
			'sf_unit_price' 			=>	'260',
			'sf_select_user_id' 		=>	'',
			'limit' 					=>	'6',
			'wplorderby' 				=>	'',
			'wplorder' 					=>	'',
		);

		$settings = array();
		$settings['preview_mode'] 			=	get_theme_mod( 'prp_archive_preview_mode', 'grid' );
		$settings['wplcolumns'] 			=	get_theme_mod( 'prp_archive_columns', '4' );
		$settings['limit'] 					=	get_theme_mod( 'prp_archive_limit', '6' );
		$settings['display_tabs'] 			=	get_theme_mod( 'prp_archive_display_tabs', true );
		$settings['display_views'] 			=	get_theme_mod( 'prp_archive_display_views', true );
		$settings['display_sort_options'] 	=	get_theme_mod( 'prp_archive_display_sort_options', true );
		$settings['display_media'] 			=	get_theme_mod( 'prp_archive_display_media', true );
		$settings['display_tags'] 			=	get_theme_mod( 'prp_archive_display_tags', true );
		$settings['display_title'] 			=	get_theme_mod( 'prp_archive_display_title', true );
		$settings['display_address'] 		=	get_theme_mod( 'prp_archive_display_address', true );
		$settings['display_features'] 		=	get_theme_mod( 'prp_archive_display_features', true );
		$settings['display_more_details'] 	=	get_theme_mod( 'prp_archive_display_more_details', true );
		$settings['display_author'] 		=	get_theme_mod( 'prp_archive_display_property_authors', true );
		$settings['display_date'] 			=	get_theme_mod( 'prp_archive_display_dates', true );
		$settings['image_height'] 			=	get_theme_mod( 'prp_archive_image_height_px', '300' );
		$settings['image_width'] 			=	get_theme_mod( 'prp_archive_image_width_px', '477' );
		$settings['display_pagination'] 	=	true;
		$settings['archive_class'] 			=	' rtpc-property-archive-page';

		$listing = new RTPC_WPL_Listing;
		$listing->elementor_settings = $settings;
		$listing->display( $instance );

	}

	public static function get_needed_properties_permalink( $value, $search )  {
		return static::get_model()->get_needed_properties_permalink( $value, $search );
	}

	public static function get_properties_permalink()  {
		return static::get_model()->get_properties_permalink();
	}

    function change_search_permalink( $args ) {

        $args = self::get_properties_permalink();

        return $args;
    }

}