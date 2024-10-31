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
 * Elementor property single walk score widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_WalkScore extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-walkscore';
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
        return __( 'Walk Score', 'realty-pack-core' );
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
        return 'eicon-dashboard realtypack-flag';
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
     * Register property single walk score widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __('WalkScore Configuration', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'walkscore_license_key',
                array(
                    'label'       => __( 'License Key ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => NULL,
                )
            );

            $this->add_control(
                'walkscore_width',
                array(
                    'label'       => __( 'Walkscore Width', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 317,
                )
            );

            $this->add_control(
                'walkscore_height',
                array(
                    'label'       => __( 'Walkscore Height ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 460,
                )
            );

            $this->add_control(
                'walkscore_layout',
                array(
                    'label' => __( 'Layout', 'reatify-core' ),
                    'type' =>  \Elementor\Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'options' => array(
                        'vertical' => __( 'Vertical', 'reatify-core' ),
                        'horizontal' => __( 'Horizontal', 'reatify-core' ),
                    )
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render property single walk score widget output on the frontend.
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

        $pid = \wpl_request::getVar( 'pid', 0 );
        $wpl_properties = array();

        if ( $pid ) { 
            $query = "SELECT `show_address`, `location_text`, `googlemap_lt`, `googlemap_ln` FROM `#__wpl_properties` WHERE `id`='$pid'";
            $properties = \wpl_db::select( $query, 'loadAssocList' );

            $wpl_properties['current']['data']['show_address'] = $properties[0]['show_address'];
            $wpl_properties['current']['location_text']        = $properties[0]['location_text'];
            $wpl_properties['current']['data']['googlemap_lt'] = $properties[0]['googlemap_lt'];
            $wpl_properties['current']['data']['googlemap_ln'] = $properties[0]['googlemap_ln'];

            $params = array(
                'walkscore_license_key' =>     $settings['walkscore_license_key'],
                'walkscore_width'       =>     $settings['walkscore_width'],
                'walkscore_height'      =>     $settings['walkscore_height'],
                'walkscore_layout'      =>     $settings['walkscore_layout'],
                'wpl_properties'        =>     $wpl_properties,
            );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $url = esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/walkscore.jpg');
            echo '<img src="'.$url.'" />';
            return;
        }

        echo controller::render_template(
           'widgets/single/walkscore.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}