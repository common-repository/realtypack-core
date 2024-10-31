<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_PropertyDetails;
use RTPC\WPL\RTPC_WPL_Property;

/**
 * Elementor single details widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Details extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve single details widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-details';
    }

    /**
     * Get widget title.
     *
     * Retrieve single details widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Details', 'realty-pack-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve single details widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-checkbox realtypack-flag';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
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
     * Retrieve 'RecentPostsGridCarousel' widget icon.
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
     * Register single details widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {}

    /**
     * Render single details widget output on the frontend.
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

        //Settings
        $settings = $this->get_settings_for_display();

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $edit_mode = true;
            $wpl_properties = '';
        } else {
            $property_show = new RTPC_WPL_PropertyDetails;
            $wpl_properties = $property_show->get_details();
            $edit_mode = false;
        }

        echo controller::render_template(
         'widgets/single/details.php',
         array(
             'wpl_properties'   => $wpl_properties,
             'edit_mode'        => $edit_mode,
         ),
         'always'
        );
    
    }

}