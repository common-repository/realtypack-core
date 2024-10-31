<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\models\wpl\RTPC_Models_WPL_Wpl;
use RTPC\WPL\RTPC_WPL_Property;

/**
 * Elementor single property refresh widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_refresh extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
    	return 'single-refresh';
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
    	return __( 'Refresh Button', 'realty-pack-core' );
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
    	return 'eicon-social-icons realtypack-flag';
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
     * Register single property refresh widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
    	$this->start_controls_section(
    		'style',
    		[
    			'label' => __('Style', 'realty-pack-core'),
    			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    		]
    	);

    	$this->end_controls_section();
    }

    /**
     * Render single property refresh widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
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
    	$compare_link = \wpl_addon_pro::compare_get_url();;

    	echo controller::render_template(
    		'widgets/single/refresh.php',
    		array(
    			'settings'       => $settings,
    			'compare_link'   => $compare_link,
    		),
    		'always'
    	);

    }

}