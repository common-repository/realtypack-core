<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Search;

/**
 * Elementor Listing Search widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_ListingSearch extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
    	return 'listing_search';
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
    	return __( 'Listing Search', 'realty-pack-core' );
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
    	return 'eicon-search realtypack-flag';
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
    	return ['search'];
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
    	return array('RTPC_catergory');
    }

	/**
	 * Register image carousel widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
	    
	    $this->start_controls_section(
	        'wpl_widget_content',
	        [
	            'label' => __( 'Content', 'plugin-name' ),
	            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	        ]
	    );

	        $this->add_control(
	            'wpl_widget_load',
	            [
	                'label' => __( 'Choose widgets too show', 'realty-pack-core' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'default' => '',
	                'options' => $this->existing_wpl_widgets(),
	            ]
	        );

	        $this->add_control(
	        	'wpl_show_tabs',
	        	array(
	        		'label'        => __('Display Search Tabs', 'realty-pack-core' ),
	        		'type'         => \Elementor\Controls_Manager::SWITCHER,
	        		'label_on'     => __( 'Show', 'realty-pack-core' ),
	        		'label_off'    => __( 'Hide', 'realty-pack-core' ),
	        		'return_value' => 'yes',
	        		'default'      => 'yes'
	        	)
	        );

	    $this->end_controls_section();

	    $this->start_controls_section(
			'rtp_section_style',
			[
				'label' => __( 'Box', 'realty-pack-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	        ]
	        
	    );

	        $this->add_responsive_control(
	            'rtp_box_padding',
	            [
	                'label' => __('Padding', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', '%'],
	                'selectors' => ['{{WRAPPER}} .rtpc-search-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'rtp_box_border_radius',
	            [
	                'label' => __('Border Radius', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', '%'],
	                'selectors' => ['{{WRAPPER}} .rtpc-search-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            \Elementor\Group_Control_Box_Shadow::get_type(),
	            [
	                'name' => 'rtp_box_shadow',
	                'selector' =>  '{{WRAPPER}} .rtpc-search-widget .rtpc-search-box',
	       
	            ]
	        );

	    $this->end_controls_section();

	}

	/**
	 * Render listing search widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

	    $settings = $this->get_settings_for_display();

	    $widget_id = $settings['wpl_widget_load'];

	    $instance = controller::widget_instance( $widget_id, new RTPC_WPL_Search, $settings );

	}

	protected function _content_template() {
		?>
		<p>{{{ settings.item_description }}}</p>
		<?php
	}    

	/**
	 * [existing_wpl_widgets description]
	 * @return [type] [description]
	 */
	public function existing_wpl_widgets() {

		$widget_array = array();

		$widgets_list = \wpl_widget::get_existing_widgets();

		foreach( $widgets_list as $sidebar => $widgets ) {

			if( $sidebar == 'wp_inactive_widgets' ) continue; 

			foreach( $widgets as $widget ) {
				if( strpos($widget['id'], 'wpl_' ) === false ) {
					continue;
				}
				if ( strpos($widget['id'], 'search' ) === false ) {
					continue;
				}
				$widget_array[ $widget['id'] ] = ucwords( str_replace( '_', ' ', $widget['id'] ) );
			}

		}

		return $widget_array;
	}

}