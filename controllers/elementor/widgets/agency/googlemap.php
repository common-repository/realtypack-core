<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agency;

use RTPC\controllers\RTPC_Controllers_Public as controller;

/**
 * Elementor google map for agency location in single widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_GoogleMap extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve google map for agency location in single widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-google-map';
    }

    /**
     * Get widget title.
     *
     * Retrieve google map for agency location in single widget title.
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
     * Retrieve google map for agency location in single widget icon.
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
        return array( 'RTPC_Agency_Builder' );
    }

    /**
     * Register google map for agency location in single widget controls.
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
     * Render google map for agency location in single widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
        $settings = $this->get_settings_for_display();

        $id = get_query_var( 'agency_id' );
        return;
        // Google map for agency location
        if ( $id ) {

        }

        // For edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            
        }

        echo controller::render_template(
           'widgets/single/googlemap.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}