<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Listing;

/**
 * Elementor button widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_RecentProperty extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rtp_recent_viewed';
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
		return __( 'Recent Property', 'realty-pack-core' );
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
		return 'eicon-button realtypack-flag';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['RTPC_catergory'];
    }

	/**
	 * Register button widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Kind Options
		$kinds = \wpl_flex::get_kinds('wpl_properties');
		$kinds_options = array();
		foreach($kinds as $kind) $kinds_options[$kind['id']] = esc_html__($kind['name'], 'realty-pack-core');

		$this->start_controls_section(
			'rtp_section_button',
			[
				'label' => __( 'Recent Property Configuration', 'realty-pack-core' ),
			]
		);

			$this->add_control(
				'layout_type',
				[
					'label' => __( 'Layout', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'carousel'  =>  __( 'Carousel View', 'realty-pack-core' ),
						'list'      =>  __( 'List View', 'realty-pack-core' ),
					],
					'default' => 'carousel',
				]
			);

            $this->add_control(
                'image_width',
                array(
                    'label'       => __( 'Image Width', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 400,
                )
            );

            $this->add_control(
                'image_height',
                array(
                    'label'       => __( 'Image Height ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 266,
                )
            );

			$this->add_control( 
				'kind', 
				array(
					'label' => esc_html__('Kind', 'realty-pack-core'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $kinds_options,
					'default' => 0,
				)
			);

			$this->add_control(
				'num',
				array(
					'label'       => __('Number of properties to show', 'realty-pack-core'),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'     => '6',
					'min'         => 1,
					'step'        => 1
				)
			);

        	// Order By Options
			$this->add_control(
				'order', 
				array(
					'label' => esc_html__('Order', 'realty-pack-core'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'ASC' => esc_html__('Ascending', 'realty-pack-core'),
						'DESC' => esc_html__('Descending', 'realty-pack-core'),
					),
					'default'     => 'ASC',
				)
			);

		$this->end_controls_section();

	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
	    // Get settings
		$settings = $this->get_settings_for_display();

		if ( 'carousel' === $settings['layout_type'] ) {
			$path = 'recent-property-carousel.php';
		} elseif ( 'list' === $settings['layout_type'] ) {
			$path = 'recent-property-list.php';
		}

		$instance = array (
			'kind'                       =>  (string) $settings['kind'],
			'limit'                      =>  (string) $settings['num'],
			'wplorder'                   =>  $settings['order'],
		);

		$listing = new RTPC_WPL_Listing;
		$properties = $listing->property_data( $instance );

		echo controller::render_template(
			'widgets/'. $path ,
			array(
				'settings'  	=>	$settings,
				'properties'	=>	$properties,
			),
			'always'
		);
	}

}
