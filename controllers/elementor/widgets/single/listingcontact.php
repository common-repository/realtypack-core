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
 * Elementor single property listing contact widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_ListingContact extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-listing-contact';
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
        return __( 'Listing Contact', 'realty-pack-core' );
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
        return 'eicon-mail realtypack-flag';
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
     * Register single property listing contact controls.
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
                'enable_title',
                array(
                    'label'        => __( 'Display Title', 'realty-pack-core' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );			

            $this->add_control(
				'title_text',
				array(
					'label'        => __( 'Title: ', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::TEXT,
					'label_on'     => __( 'Show', 'realty-pack-core' ),
					'label_off'    => __( 'Hide', 'realty-pack-core' ),
					'return_value' => '',
					'default'      => '',
				)
			);

        $this->end_controls_section();
    }

    /**
     * Render single property listing contact output on the frontend.
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

        $pid = \wpl_request::getVar( 'pid', 0 );
        $params = '';
        $wpl_properties = array();
        if ( $pid ) {
            $wpl_properties['current']['data']['id'] = $pid;
            $params = $wpl_properties;
            $is_edit_mode = false;
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $is_edit_mode = true;
        }

        echo controller::render_template(
            'widgets/single/listing-contact.php',
            array(
                'settings'      =>  $settings,
                'is_edit_mode'  =>  $is_edit_mode,
                'params'        =>  $params,
            ),
            'always'
        );

    }

}