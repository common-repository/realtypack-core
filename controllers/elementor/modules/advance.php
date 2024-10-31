<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Modules;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use RTPC\controllers\RTPC_Controllers_Public;


class RTPC_Controllers_Elementor_Modules_Advance extends RTPC_Controllers_Public {


    function __construct() {
    	$this->register_hook_callbacks();
    }

   	/**
	 * Register callbacks for actions and filters
	 *
	 * @since    1.0.0
	 */
   	protected function register_hook_callbacks() {

        // Add custom css control
   		add_action( "elementor/element/after_section_end", array( $this, 'add_custom_css_controls_section'), 25, 3 );

        // Render the custom CSS
   		if ( defined('ELEMENTOR_PRO_VERSION') ) {
   			return;
   		}

   		add_action( 'elementor/element/parse_css', array( $this, 'add_post_css' ), 10, 2 );

   	}

    /**
     * Add custom css control to all elements
     *
     * @return void
     */
    public function add_custom_css_controls_section( $widget, $section_id, $args ) {

        if( 'section_custom_css_pro' !== $section_id ) {
            return;
        }

        if( ! defined('ELEMENTOR_PRO_VERSION') ) {

            $widget->start_controls_section(
                'aux_core_common_custom_css_section',
                array(
                    'label'     => __( 'Custom CSS',  'realty-pack-core' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_ADVANCED
                )
            );

            $widget->add_control(
                'custom_css',
                array(
                    'type'        => \Elementor\Controls_Manager::CODE,
                    'label'       => __( 'Custom CSS',  'realty-pack-core' ),
                    'label_block' => true,
                    'language'    => 'css'
                )
            );
            //Start ob
            ob_start();?>
            <pre>
                Examples:
                // To target main element
                selector { color: red; }
                // For child element
                selector .child-element{ margin: 10px; }
            </pre>
            <?php
            $data = ob_get_contents();

            $widget->add_control(
                'custom_css_description',
                array(
                    'raw'             => __( 'Use "selector" keyword to target wrapper element.',  'realty-pack-core' ). $data,
                    'type'            => \Elementor\Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                    'separator'       => 'none'
                )
            );

            $widget->end_controls_section();
            // clean buffer
            ob_clean();
        }

    }

    /**
     * Render Custom CSS for an Elementor Element
     *
     * @param $post_css Post_CSS_File
     * @param $element Element_Base
     */
    public function add_post_css( $post_css, $element ) {
        $element_settings = $element->get_settings();

        if ( empty( $element_settings['custom_css'] ) ) {
            return;
        }

        $css = trim( $element_settings['custom_css'] );

        if ( empty( $css ) ) {
            return;
        }
        $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );

        // Add a css comment
        $css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

        $post_css->get_stylesheet()->add_raw_css( $css );
    }

}
