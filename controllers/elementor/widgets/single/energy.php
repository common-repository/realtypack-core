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
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Energy extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-energy-tag';
    }

    /**
     * Get widget title.
     *
     * Retrieve image carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Energy Tag', 'realty-pack-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve image carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-plug realtypack-flag';
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
     * Register image carousel widget controls.
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
                'label' => __('Energy tag Configuration', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'image_width',
                array(
                    'label'       => __('Image Width ', 'realty-pack-core'),
                    'description' => __('Set energy tag image width ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 210,
                )
            );

            $this->add_control(
                'image_height',
                array(
                    'label'       => __('Image Height ', 'realty-pack-core'),
                    'description' => __('Set energy tag image height ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 240,
                )
            );

            $this->add_control(
                'bar_width',
                array(
                    'label'       => __('Bar Width ', 'realty-pack-core'),
                    'description' => __('Set energy tag bar width ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 20,
                )
            );

            $this->add_control(
                'first_bar_length',
                array(
                    'label'       => __('First Bar Lenght ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 70,
                )
            );

            $this->add_control(
                'length_increment',
                array(
                    'label'       => __('Bar Length Increment ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 10,
                )
            );

            $this->add_control(
                'vertical_distance',
                array(
                    'label'       => __('Vertical Distance Between Bars ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 3,
                )
            );

            $this->add_control(
                'peak',
                array(
                    'label'       => __('Peak of Bars ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 10,
                )
            );

            $this->add_control(
                'energy_font_size',
                array(
                    'label'       => __('Font Size for Energy Value ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 10,
                )
            );

	        $this->add_control(
	        	'font_size',
	        	array(
                    'label'       => __('Font Size ', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 10,
	        	)
	        );

            $this->add_control(
                'reverse_levels',
                array(
                    'label' => __( 'Text', 'realty-pack-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( '50,90,150,230,330,450', 'realty-pack-core' ),
                    'placeholder' => __( '50,90,150,230,330,450', 'realty-pack-core' ),
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render image carousel widget output on the frontend.
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
            $query = "SELECT `energy_tag` FROM `#__wpl_properties` WHERE `id`='$pid'";
            $energy = \wpl_db::select( $query, 'loadResult' );
            if ( ! $energy && $energy == '' ) {
                return;
                $message = esc_html__( 'Property energy tag is not set!' );
                echo controller::render_template(
                    'errors/property-access.php',
                    array(
                        'message'  => $message,
                    ),
                    'always'
                );

            }

            $wpl_properties['current']['data']['energy_tag'] = $energy;
            $wpl_properties['current']['data']['id'] = $pid;

            $params = array(
                'image_width'        =>     $settings['image_width'],
                'image_height'       =>     $settings['image_height'],
                'bar_width'          =>     $settings['bar_width'],
                'first_bar_length'   =>     $settings['first_bar_length'],
                'length_increment'   =>     $settings['length_increment'],
                'vertical_distance'  =>     $settings['vertical_distance'],
                'peak'               =>     $settings['peak'],
                'energy_font_size'   =>     $settings['energy_font_size'],
                'font_size'          =>     $settings['font_size'],
                'show_energy_value'  =>     1,
                'reverse_levels'     =>     $settings['reverse_levels'],
                'wpl_properties'     =>     $wpl_properties,
            );

        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {

            $wpl_properties['current']['data']['energy_tag'] = 1;
            $wpl_properties['current']['data']['id'] = 0;

            $params = array(
                'image_width'        =>     $settings['image_width'],
                'image_height'       =>     $settings['image_height'],
                'bar_width'          =>     $settings['bar_width'],
                'first_bar_length'   =>     $settings['first_bar_length'],
                'length_increment'   =>     $settings['length_increment'],
                'vertical_distance'  =>     $settings['vertical_distance'],
                'peak'               =>     $settings['peak'],
                'energy_font_size'   =>     $settings['energy_font_size'],
                'font_size'          =>     $settings['font_size'],
                'show_energy_value'  =>     1,
                'reverse_levels'     =>     $settings['reverse_levels'],
                'wpl_properties'     =>     $wpl_properties,
            );
        }

        echo controller::render_template(
           'widgets/single/energy.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}