<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Property;
use RTPC\WPL\RTPC_WPL_WPL;

/**
 * Elementor single property title widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Title extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'single-proprty-title';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Property Title', 'realty-pack-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-title realtypack-flag';
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return '';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories() {
		return array( 'RTPC_single_Builder' );
	}

	/**
	 * Register single property title widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {}

	/**
	 * Render single property title widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
	    // Check if it dose not any access return
		$property_show = new RTPC_WPL_Property;
		$property_show = $property_show->display();
		if ( is_array( $property_show ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$pid = \wpl_request::getVar('pid', 0);

		if ( $pid ) {
			$data = RTPC_WPL_WPL::get_property_fields( array( 'listing', 'property_type', 'field_313', 'location_text', 'price', 'price_unit', 'visit_time', 'lot_area', 'kind' ) , $pid );

			$cookie_unit = \wpl_request::getVar('wpl_unit4', 0, 'COOKIE');

            if( $cookie_unit and $cookie_unit != $data->price_unit ) {
                $price = \wpl_units::convert( $data->price, $data->price_unit, $cookie_unit );
                $price_unit          = \wpl_units::get_unit( $cookie_unit );
            } else { 
            	$price = \wpl_units::convert( $data->price, $data->price_unit, $data->price_unit);
            	$price_unit          = \wpl_units::get_unit( $data->price_unit );
            }

			$listing_type = \wpl_global::get_listings($data->listing);

			$prp_title           = isset( $data->field_313 ) ? $data->field_313 : '';
			$listing_type        = is_object($listing_type) ? $listing_type->name : NULL;
	        // Location visibility
			$location_visibility = \wpl_property::location_visibility( $pid, $data->kind, \wpl_users::get_user_membership() );
			$location_string     = ( isset( $data->location_text ) and $location_visibility === true) ? $data->location_text : $location_visibility;
			$price               = isset( $price ) ? number_format( $price ) : '';

			$visits              = isset( $data->visit_time ) ? $data->visit_time : '0';
			$sqft                = esc_html__( round( $data->price / $data->lot_area , 2 ) . $price_unit['name'] . ' /sqft', 'realty-pack-core' );
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$prp_title			=	esc_html__( 'Home in Sherman', 'realty-pack-core' );
			$location_string  	=	esc_html__( '1490 Magnolia Rd, Los Angeles, California', 'realty-pack-core' );
			$price 				=	esc_html__( '948570', 'realty-pack-core' );
			$price_unit['name'] =	esc_html__( '$', 'realty-pack-core' );
			$visits 			=	esc_html__( '100', 'realty-pack-core' );
			$listing_type 		=	esc_html__( 'Sales', 'realty-pack-core' );
			$sqft               = 	esc_html__( '3$/sqft', 'realty-pack-core' );
		}

		echo controller::render_template(
			'widgets/single/title.php',
			array(
				'prp_title'         => $prp_title,
				'location_string'   => $location_string,
				'price'             => $price,
				'price_unit'        => $price_unit,
				'visits'            => $visits,
				'listing_type'      => $listing_type,
				'sqft'      		=> $sqft,
			),
			'always'
		);

	}
}