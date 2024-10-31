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
 * Elementor property single description widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Description extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-description';
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
        return __( 'Description', 'realty-pack-core' );
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
        return 'eicon-post-content realtypack-flag';
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
     * Register property single description widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __( 'Description Configuration', 'realty-pack-core' ),
            )
        );

            $this->add_control(
                'enable_title',
                array(
                    'label'        => __( 'Enable Title', 'realty-pack-core' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'realty-pack-core' ),
                    'label_off'    => __( 'Off', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );           

        $this->end_controls_section();
    }

    /**
     * Render property single description widget output on the frontend.
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

        // Get ID 
        $pid = \wpl_request::getVar('pid', 0);

        if ( $pid ) {
            // Description col name
            $description_column = 'field_308';
            $multi = null;

            // Field 
            $wpl_data = RTPC_WPL_WPL::get_property_fields( array( 'field_308', 'kind') , $pid );

            // If multi lang is set
            if( \wpl_global::check_multilingual_status() and \wpl_addon_pro::get_multiligual_status_by_column( $description_column, $wpl_data->kind ) ) {

                $multi = \wpl_addon_pro::get_column_lang_name( $description_column, \wpl_global::get_current_language(), false );
            }

            if ( $multi != null ) {
                $wpl_data->field_308 = \wpl_property::get_property_field( $multi , $pid );
            }

            $data['title'] = esc_html__( \wpl_flex::get_dbst_key( 'name', \wpl_flex::get_dbst_id( 'field_308', $wpl_data->kind ) ), 'realty-pack-core');

            $data['field_308'] = stripslashes( $wpl_data->field_308 );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $data['title'] = esc_html__( 'Sample Title', 'realty-pack-core');

            $data['field_308'] = 'Sample description';
        }

        if( ! isset( $data ) and !$data ) {
            return;
        } 

        echo controller::render_template(
            'widgets/single/description.php',
            array(
                'settings'  => $settings,
                'data'      => $data,
            ),
            'always'
        );

    }

}