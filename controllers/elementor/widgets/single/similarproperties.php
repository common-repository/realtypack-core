<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Carousel;
use RTPC\WPL\RTPC_WPL_Property;

/**
 * Elementor single property similar properties widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_SimilarProperties extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-similar-properties';
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
        return __( 'Similar Propeties', 'realty-pack-core' );
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
        return 'eicon-post-slider realtypack-flag';
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
	 * Retrieve the list of scripts the single property similar properties widget depended on.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'swiper' ];
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
        return array('RTPC_single_Builder');
    }

    /**
     * Register single property similar properties widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {}

    /**
     * Render single property similar properties widget output on the frontend.
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

        $wpl_properties= '';

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $edit_mod = true;
        } else {
            // @temprory
            $arr = array( 
                'title' =>  'Featured Properties',
                'layout' =>  'default',
                'wpltarget' =>  '',
                'data' => 
                array (
                    'css_class' =>  '',
                    'image_width' =>  '',
                    'image_height' =>  '',
                    'tablet_image_height' =>  '',
                    'phone_image_height' =>  '',
                    'thumbnail_width' =>  '',
                    'thumbnail_height' =>  '',
                    'slide_interval' =>  '',
                    'images_per_page' =>  '',
                    'slide_fillmode' =>  '',
                    'kind' =>  '',
                    'listing' =>  '',
                    'property_type' =>  '',
                    'location2_name' =>  '',
                    'location3_name' =>  '',
                    'location4_name' =>  '',
                    'zip_name' =>  '',
                    'build_year' =>  '',
                    'living_area' =>  '',
                    'price' =>  '',
                    'listing_ids' =>  '',
                    'only_featured' =>  '',
                    'only_hot' =>  '',
                    'only_openhouse' =>  '',
                    'only_forclosure' =>  '',
                    'tag_group_join_type' =>  '',
                    'sml_only_similars' =>  '1',
                    'sml_inc_listing' =>  '',
                    'sml_inc_property_type' =>  '',
                    'sml_inc_price' =>  '',
                    'sml_price_down_rate' =>  '',
                    'sml_price_up_rate' =>  '',
                    'sml_inc_radius' =>  '',
                    'sml_radius' =>  '',
                    'sml_radius_unit' =>  '',
                    'data_sml_zip_code' =>  '',
                    'sml_override_listing_new' =>  '',
                    'sml_override_listing_old' =>  '',
                    'orderby' =>  '',
                    'order' =>  '',
                    'limit' =>  '2'      
                )
            );

            $prop = new RTPC_WPL_Carousel;
            $wpl_properties = $prop->widget( '' ,$arr );

            $edit_mod = false;
        }

        echo controller::render_template(
            'widgets/single/similarproperties.php',
            array(
                'edit_mod'        => $edit_mod,
                'wpl_properties'  => $wpl_properties,
            ),
            'always'
        );

    }

}