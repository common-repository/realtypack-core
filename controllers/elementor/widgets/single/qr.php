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
 * Elementor single property qr code widget.
 *
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_QR extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-qr';
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
        return __( 'QR Code', 'realty-pack-core' );
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
        return 'eicon-handle realtypack-flag';
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
     * Register single property qr code widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __( 'QR Code Configuration', 'realty-pack-core' ),
            )
        );

            $this->add_control(
                'width',
                array(
                    'label'       => __( 'QR Code Width ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 50,
                    'max'         => 250,
                    'step'        => 1,
                    'default'     => 202,
                )
            );

            $this->add_control(
                'height',
                array(
                    'label'       => __( 'QR Code Height ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 50,
                    'max'         => 250,
                    'step'        => 1,
                    'default'     => 202,
                )
            );        

        $this->end_controls_section();
    }

    /**
     * Render single property qr code widget output on the frontend.
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
        $image = $params = array();

    	if ( $pid ) {
    		// Set id
    		$wpl_properties['current']['data']['id'] = $pid;
            $wpl_properties['current']['property_link'] = RTPC_Models_WPL_Wpl::get_property_link( $pid );
    		$params = array(
    			'wpl_properties'    =>  $wpl_properties,
    			'picture_width'     =>  '202',
    			'picture_height'    =>  '202',
    			'outer_margin'      =>  '2',
    			'qrfile_prefix'     =>  'rtpc_',
    			'size'     			=>  4, //1,2,3,4,5,6,7,8,9,10
    		);

            $edit_mode = false;
    	}

    	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $image = RTPC_ASSETS_URL . 'assets/admin/img/property_builder/qr.png';

            $edit_mode = true;
    	}

    	echo controller::render_template(
    		'widgets/single/qr.php',
    		array(
    			'settings'   => $settings,
    			'params'     => $params,
                'image'      => $image,
                'edit_mode'  => $edit_mode,
    		),
    		'always'
    	);

    }

}