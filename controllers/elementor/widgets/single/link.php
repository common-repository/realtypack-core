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
 * Elementor single property social link widget.
 *
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Link extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-link';
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
        return __( 'Social Link', 'realty-pack-core' );
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
     * Register single property social link widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __( 'Social Links Configuration', 'realty-pack-core' ),
            )
        );

            $this->add_control(
                'show_facebook',
                array(
                    'label'        => __( 'Show Facebook', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );    

            $this->add_control(
                'show_twitter',
                array(
                    'label'        => __( 'Show Twitter', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );     

            $this->add_control(
                'show_pinterest',
                array(
                    'label'        => __( 'Show Pintrest', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );     

            $this->add_control(
                'show_linkedin',
                array(
                    'label'        => __( 'Show Linkedin', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render single property social link widget output on the frontend.
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
            $property_link = RTPC_Models_WPL_Wpl::get_property_link( $pid );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $pid = 0;
            $property_link = '';
        }

        echo controller::render_template(
            'widgets/single/link.php',
            array(
                'settings'       => $settings,
                'property_link'  => $property_link,
                'property_id'    => $pid,
            ),
            'always'
        );

    }

}