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

/**
 * Elementor unit swithcer widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_UnitSwitcher extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-unit-switcher';
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
        return __( 'Unit Switcher', 'realty-pack-core' );
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
        return 'eicon-dual-button realtypack-flag';
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
        return array('RTPC_single_Builder');
    }

    /**
     * Register image carousel widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __('Listing Contact', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'unit_type',
                array(
                    'label' => __( 'Unit Types', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '4',
                    'options' => $this->unit_type(),
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render image carousel widget output on the frontend.
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

        echo controller::render_template(
            'widgets/single/unit-switcher.php',
            array(
                'settings'  => $settings,
            ),
            'always'
        );

    }

    /**
     * Get unit types of wpl.
     *
     * @since 1.0.0
     * @access public
     */
    public function unit_type() {

        $unit_types = \wpl_units::get_unit_types();

        $unit_types_options = array();

        foreach( $unit_types as $unit_type ) {
            $unit_types_options[ $unit_type['id'] ] = esc_html__( $unit_type['name'], 'realty-pack-core' );
        }

        return $unit_types_options;
    }

}