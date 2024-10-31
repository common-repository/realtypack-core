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
 * Elementor property single video widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Videos extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve property single video widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-videos';
    }

    /**
     * Get widget title.
     *
     * Retrieve property single video widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Video', 'realty-pack-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve property single video widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-play-o realtypack-flag';
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
     * Register property single video widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __('Videmo Embed Configuration', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'video_width',
                array(
                    'label'       => __( 'Video Width', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 50,
                    'default'     => 1136,
                )
            );

            $this->add_control(
                'video_height',
                array(
                    'label'       => __( 'Video Hieght', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 50,
                    'default'     => 661,
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render property single video widget output on the frontend.
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

        if ( $pid ) {
            $att_items = \wpl_items::get_items( $pid, 'video', 0, '', '' );

            $wpl_properties = array();
            $wpl_properties['current']['data']['id'] = $pid;
            $wpl_properties['current']['items']['video'] = $att_items;

            $params = array(
                'video_width'       =>     $settings['video_width'],
                'video_height'      =>     $settings['video_height'],
                'wpl_properties'    =>     $wpl_properties,
            );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $url = esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/video.jpg');
            echo '<video width="400" controls poster="'. $url .'"></video>';
            return;
        }

        echo controller::render_template(
           'widgets/single/videos.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}