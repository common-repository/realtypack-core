<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

use RTPC\controllers\RTPC_Controllers_Public as controller;

/**
 * Elementor recent posts widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Recentposts extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'our-blog';
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
		return __( 'Recent Posts', 'realty-pack-core' );
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
		return 'eicon-post-list realtypack-flag';
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
		return ['image', 'photo', 'blogs'];
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
	 * Register recent posts widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => __('recent posts', 'realty-pack-core'),
			]
		);

			$slides_to_show = range(1, 10);
			$slides_to_show = array_combine($slides_to_show, $slides_to_show);

			$this->add_responsive_control(
				'column_number',
				[
					'label'              => __('Columns to View', 'realty-pack-core'),
					'type'               => \Elementor\Controls_Manager::SELECT,
					'options'            => [
						'100'   => __('1', 'realty-pack-core'),
						'50'    => __('2', 'realty-pack-core'),
						'33.33' => __('3', 'realty-pack-core'),
						'25'    => __('4', 'realty-pack-core'),

					],
					'frontend_available' => true,
					'selectors'          => [
						'{{WRAPPER}} .rtpc-our-blog-post' => 'width: {{VALUE}}%;',
					],

				]
			);

			$this->add_control(
				'post_count',
				[
					'label'       => __('Property ', 'realty-pack-core'),
					'description' => __('Number of posts to show ', 'realty-pack-core'),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'min'         => 1,
					'max'         => 12,
					'step'        => 1,
					'default'     => 3,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __('Additional Options', 'realty-pack-core'),
			]
		);

			$this->add_control(
				'show_date',
				[
					'label'        => __('Show Date', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'show_category',
				[
					'label'        => __('Show Category', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'show_author',
				[
					'label'        => __('Show Author', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'show_shape',
				[
					'label'        => __('Show Shape', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __('Content', 'realty-pack-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label'    => __('Header typography', 'realty-pack-core'),
					'name'     => 'header_typography',
					'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .rtpc-our-blog-post-details-header',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label'    => __('Title Typography', 'realty-pack-core'),
					'name'     => 'title_typography',
					'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .rtpc-our-blog-post-title',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label'     => __('Caption', 'realty-pack-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

			$this->add_control(
				'caption_align',
				[
					'label'     => __('Alignment', 'realty-pack-core'),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __('Left', 'realty-pack-core'),
							'icon'  => 'fa fa-align-left',
						],
						'center'  => [
							'title' => __('Center', 'realty-pack-core'),
							'icon'  => 'fa fa-align-center',
						],
						'right'   => [
							'title' => __('Right', 'realty-pack-core'),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __('Justified', 'realty-pack-core'),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'default'   => 'center',
					'selectors' => [
						'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

	}

	/**
	 * Render recent posts widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$query = array(
			'posts_per_page'      => $settings['post_count'],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'order'               => 'DESC',

		);

		$recent_posts = new \WP_Query( $query );

		if ( ! $recent_posts->have_posts() ) {
			return;
		}

		echo controller::render_template(
			'widgets/recent-posts.php',
			array(
				'settings' 		=> $settings,
				'recent_posts'  => $recent_posts,
			),
			'always'
		);

	}

}