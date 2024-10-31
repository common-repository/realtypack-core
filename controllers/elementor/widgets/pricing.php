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

/**
 * Elementor image carousel widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Pricing extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rtpc-pricing';
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
		return __( 'Pricing Package', 'realty-pack-core' );
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
		return 'eicon-cart realtypack-flag';
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'package', 'pricing' ];
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
        return array( 'RTPC_catergory' );
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
			'section_package',
			[
				'label' => __( 'Package', 'realty-pack-core' ),
			]
		);

			$this->add_control(
				'pricing_package',
				[
					'label' => __( 'Choose Package to Show', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => $this->package_list(),
				]
			);

		$this->end_controls_section();

	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( class_exists( 'acf' ) ) {
			$fields = get_fields( $settings['pricing_package'], 'rtfc_pricing' );
		}

		$args = array_merge( $settings, $fields );

		echo controller::render_template(
			'widgets/pricing.php',
			array(
				'args'  => $args,
			),
			'always'
		);
	}
    
    /**
     * Get package custom post type list
     *
     * @since 1.0
     */
    function package_list() {

    	$args = array(
    		'post_type' => 'rtfc_pricing',
    	);

    	$posts        = get_posts( $args );
    	$package_list = array();

    	foreach ( $posts as $post ) {

    		$package_list[$post->ID] = $post->post_title;

    	}

    	return $package_list;
    }

}