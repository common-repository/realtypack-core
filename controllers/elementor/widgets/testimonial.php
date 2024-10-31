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
 * Elementor testimonial widget.
 *
 * Elementor widget that displays customer testimonials that show social proof.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Testimonial extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'RTPC_testimonial';
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
		return __( 'RealtyPack Testimonial', 'realty-pack-core' );
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
		return 'eicon-testimonial realtypack-flag';
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
		return [ 'testimonial', 'blockquote' ];
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
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonial', 'realty-pack-core' ),
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'content',
				[
					'label' => __( 'Content', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'rows' => '10',
					'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
				]
			);

			$repeater->add_control(
				'client_image',
				[
					'label' => __( 'Choose client Image', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'client_name',
				[
					'label' => __( 'Name', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => 'John Doe',
				]
			);

			$repeater->add_control(
				'client_job',
				[
					'label' => __( 'Job title', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => 'Designer',
				]
			);

			$repeater->add_control(
				'client_link',
				[
					'label' => __( 'Link to', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'realty-pack-core' ),
				]
			);

			$this->add_control(
				'list',
				[
					'label' => __( 'Repeater List', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'content' => __( 'Item content. Click the edit button to change this text.', 'realty-pack-core' ),
						],
						[
							'content' => __( 'Item content. Click the edit button to change this text.', 'realty-pack-core' ),
						],
					],
					'title_field' => '{{{ content }}}',
				]
			);

		$this->end_controls_section();

		// Content.
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Content', 'realty-pack-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'prev_next_button_style',
				[
					'label' => __( 'Previus/Next Button', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
					'allowed_dimensions' =>[ 'top', 'right', 'left' ], 
					'default'=>[
						'top' => '50',
						'right' => '10',
						'left' => '10',
						],
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-swiper-container .swiper-button-next' => 'top:{{TOP}}%; right:  {{RIGHT}}%;',
						'{{WRAPPER}} .rtpc-testimonial-swiper-container .swiper-button-prev' => 'top:{{TOP}}%;left: {{LEFT}}%;',

					],
				]
			);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __( 'Margin Right/Left', 'realty-pack-core' ),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'allowed_dimensions' =>['right', 'left' ], 
				'default'=>[
					'right' => '22',
					'left' => '22',
					'linked' => true,
					],
				'selectors' => [
					'{{WRAPPER}} .rtpc-testimonial-comment' => 'margin:0 {{RIGHT}}% 0 {{LEFT}}%;',

				],
				'separator'=>'after',
			]
		);

			$this->add_control(
				'RTPC_testimonial_content_color',
				[
					'label' => __( 'Text Color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_3,
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-comment' => 'color: {{VALUE}};',
					],
				]
			);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'RTPC_testimonial_content_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rtpc-testimonial-comment',
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'RTPC_testimonial_section_style_testimonial_image',
			[
				'label' => __( 'Image', 'realty-pack-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'image_size',
				[
					'label' => __( 'Image Size', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 200,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-comment-author img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .rtpc-testimonial-comment-author img',
				'separator' => 'before',
			]
		);

			$this->add_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-comment-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_client_name',
			[
				'label' => __( 'Name', 'realty-pack-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'client_name_text_color',
				[
					'label' => __( 'Text Color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-comment-author-name' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'client_name_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .rtpc-testimonial-comment-author-name',
				]
			);

		$this->end_controls_section();

		// Job.
		$this->start_controls_section(
			'style_client_job',
			[
				'label' => __( 'Job', 'realty-pack-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'client_job_text_color',
				[
					'label' => __( 'Text Color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_2,
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .rtpc-testimonial-comment-author-job' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'client_job_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_2,
					'selector' => '{{WRAPPER}} .rtpc-testimonial-comment-author-job',
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		echo controller::render_template(
			'widgets/testimonial.php',
			array(
				'settings'  => $settings,
			),
			'always'
		);

	}

}
