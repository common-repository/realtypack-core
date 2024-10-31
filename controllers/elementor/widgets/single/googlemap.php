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
class RTPC_Controllers_Elementor_Widgets_Single_GoogleMap extends \Elementor\Widget_Base {

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
        return 'single-google-map';
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
        return __( 'Google Map', 'realty-pack-core' );
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
        return 'eicon-google-maps realtypack-flag';
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
                'label' => __( 'Google Map', 'realty-pack-core' ),
            )
        );

		    $this->add_control(
		    	'googlemap_hits',
		    	array(
		    		'label'       => __( 'Map hits per day', 'realty-pack-core'),
		    		'type'        => \Elementor\Controls_Manager::NUMBER,
		    		'min'         => 1,
		    		'step'        => 1000,
		    		'default'     => 1000000,
		    	)
		    );

		    $this->add_control(
		    	'googlemap_type',
		    	array(
		    		'label'     => __( 'Map Type', 'realty-pack-core' ),
		    		'type'      => \Elementor\Controls_Manager::CHOOSE,
		    		'options'   => array(
		    			'0'    => array(
		    				'title' => __( 'Typical', 'realty-pack-core'),
		    			),		    			
		    			'1'    => array(
		    				'title' => __( 'Street View', 'realty-pack-core'),
		    			),
		    		),
		    		'default'   => '0',
		    	)
		    );

		    $this->add_control(
		    	'googlemap_view',
		    	array(
		    		'label'     => __( 'Map Type', 'realty-pack-core' ),
		    		'type'      => \Elementor\Controls_Manager::CHOOSE,
		    		'options'   => array(
		    			'ROADMAP'    => array(
		    				'title' => __( 'Roadmap', 'realty-pack-core'),
		    			),		    			
		    			'SATELLITE'    => array(
		    				'title' => __( 'Satellite', 'realty-pack-core'),
		    			),
		    			'HYBRID'    => array(
		    				'title' => __( 'Hybrid', 'realty-pack-core'),
		    			),	
		    			'TERRAIN'    => array(
		    				'title' => __( 'Terrain', 'realty-pack-core'),
		    			),		 
		    			'WPL'    => array(
		    				'title' => __( 'WPL Style', 'realty-pack-core'),
		    			),
		    		),
		    		'default'   => 'ROADMAP',
		    	)
		    );

            $this->add_control(
                'map_width',
                array(
                    'label'       => __( 'Map Width ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 100,
                    'default'     => 1136,
                )
            );

            $this->add_control(
                'map_height',
                array(
                    'label'       => __( 'Map Height ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 100,
                    'default'     => 661,
                )
            );

            $this->add_control(
                'default_lt',
                array(
                    'label'       => __( 'Default latitude ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 38.685516,
                )
            );

            $this->add_control(
                'default_ln',
                array(
                    'label'       => __( 'Default longitude ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => -101.073324,
                )
            );

            $this->add_control(
                'default_zoom',
                array(
                    'label'       => __( 'Default zoom level ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 4,
                )
            );

            $this->add_control(
                'infowindow_event',
                array(
                    'label' => __( 'Infowindow Event', 'reatify-core' ),
                    'type' =>  \Elementor\Controls_Manager::SELECT,
                    'default' => 'click',
                    'options' => array(
                        'click' => __( 'Click', 'reatify-core' ),
                        'mouseover' => __( 'Mouse Over', 'reatify-core' ),
                    )
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

        if ( $pid == '' ) {
            return;
        }

        $query = "SELECT `kind`, `property_type`, `show_marker`, `listing`, `price`, `price_unit`, `googlemap_lt`, `googlemap_ln` FROM `#__wpl_properties` WHERE `id`='$pid'";
        $properties = \wpl_db::select( $query, 'loadAssocList' );

        $wpl_properties = array();
        $wpl_properties['current']['raw']['id']                 =   $pid;
        $wpl_properties['current']['raw']['kind']               =   $properties[0]['kind'];
        $wpl_properties['current']['data']['id']                =   $pid;
        $wpl_properties['current']['data']['kind']              =   $properties[0]['kind'];
        $wpl_properties['current']['data']['property_type']     =   $properties[0]['property_type'];
        $wpl_properties['current']['data']['show_marker']       =   $properties[0]['show_marker'];
        $wpl_properties['current']['raw']['googlemap_lt']       =   $properties[0]['googlemap_lt'];
        $wpl_properties['current']['raw']['googlemap_ln']       =   $properties[0]['googlemap_ln'];
        $wpl_properties['current']['raw']['price_unit']         =   $properties[0]['price_unit'];
        $wpl_properties['current']['raw']['price']              =   $properties[0]['price'];
        $wpl_properties['current']['raw']['property_type']      =   $properties[0]['property_type'];
        $wpl_properties['current']['raw']['listing']            =   $properties[0]['listing'];

		$params = array(
			'googlemap_hits'                        =>     $settings['googlemap_hits'],
			'googlemap_view'                        =>     $settings['googlemap_view'],
			'map_width'                             =>     $settings['map_width'],
			'map_height'                            =>     $settings['map_height'],
			'default_lt'                            =>     $settings['default_lt'],
			'default_ln'                            =>     $settings['default_ln'],
			'default_zoom'                          =>     $settings['default_zoom'],
			'infowindow_event'                      =>     $settings['infowindow_event'],
			// 'get_direction'                         =>     $settings['get_direction'],
			// 'scroll_wheel'                          =>     $settings['scroll_wheel'],
			// 'spatial'                               =>     $settings['spatial'],
			// 'clustering'                            =>     $settings['clustering'],
			// 'map_property_preview'                  =>     $settings['map_property_preview'],
			// 'map_property_preview_show_marker_icon' =>     $settings['map_property_preview_show_marker_icon'],
			// 'map_search'                            =>     $settings['map_search'],
			// 'demographic'                           =>     $settings['demographic'],
			// 'clustering'                            =>     $settings['clustering'],
			'wpl_properties'                        =>     $wpl_properties,
		);

        echo controller::render_template(
           'widgets/single/googlemap.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}