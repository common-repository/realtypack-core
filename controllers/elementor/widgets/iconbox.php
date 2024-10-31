<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_IconBox extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rtp-icon-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'rtp-Icon Box', 'realty-pack-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box realtypack-flag';
	}

	
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'RTPC_catergory' ];
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
		return [ 'icon box', 'icon' ];
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'rtp_iconbox_section_icon',
			[
				'label' => __( 'rtp-Icon Box', 'realty-pack-core' ),
			]
		);

			$this->add_control(
				'rtp_iconbox_icon',
				[
					'label' => __( 'Icon', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::ICON,
					'default' => 'fa fa-star',
				]
			);

			$this->add_control(
				'rtp_iconbox_view',
				[
					'label' => __( 'View', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'default' => __( 'Default', 'realty-pack-core' ),
						'stacked' => __( 'Stacked', 'realty-pack-core' ),
						'framed' => __( 'Framed', 'realty-pack-core' ),
					],
					'default' => 'default',
					'prefix_class' => 'elementor-view-',
					'condition' => [
						'rtp_iconbox_icon!' => '',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_shape',
				[
					'label' => __( 'Shape', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'circle' => __( 'Circle', 'realty-pack-core' ),
						'square' => __( 'Square', 'realty-pack-core' ),
					],
					'default' => 'circle',
					'condition' => [
						'rtp_iconbox_view!' => 'default',
						'rtp_iconbox_icon!' => '',
					],
					'prefix_class' => 'elementor-shape-',
				]
			);

			$this->add_control(
				'rtp_iconbox_title_text',
				[
					'label' => __( 'Title & Description', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => __( 'This is the heading', 'realty-pack-core' ),
					'placeholder' => __( 'Enter your title', 'realty-pack-core' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'rtp_iconbox_description_text',
				[
					'label' => '',
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'realty-pack-core' ),
					'placeholder' => __( 'Enter your description', 'realty-pack-core' ),
					'rows' => 10,
					'show_label' => false,
				]
			);

			$this->add_control(
				'rtp_iconbox_link',
				[
					'label' => __( 'Link to', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'realty-pack-core' ),
					'separator' => 'before',
				]
			);

			$this->add_control(
				'rtp_iconbox_position',
				[
					'label' => __( 'Icon Position', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'top',
					'options' => [
						'left' => [
							'title' => __( 'Left', 'realty-pack-core' ),
							'icon' => 'fa fa-align-left',
						],
						'top' => [
							'title' => __( 'Top', 'realty-pack-core' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'realty-pack-core' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'prefix_class' => 'elementor-position-',
					'toggle' => false,
					'condition' => [
						'rtp_iconbox_icon!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-icon' => 'float: {{VALUE}};'
		
					],
				]
			);

		$this->end_controls_section();

			$this->start_controls_section(
				'rtp_iconbox_section_style_icon',
				[
					'label' => __( 'Icon', 'realty-pack-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'rtp_iconbox_icon!' => '',
					],
				]
			);

		$this->start_controls_tabs( 'rtp_iconbox_icon_colors' );

		$this->start_controls_tab(
			'rtp_iconbox_icon_colors_normal',
			[
				'label' => __( 'Normal', 'realty-pack-core' ),
			]
		);

			$this->add_control(
	            'rtp_iconbox_icon_color_type',
	            [
	                'label' => __('Background Type', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::CHOOSE,
	                'label_block' => false,
	                'options' => [
	                    'classic' => [
	                        'title' => __('classic', 'realty-pack-core'),
	                        'icon' => 'fa fa-paint-brush',
	                    ],
	                    'gradient' => [
	                        'title' => __('gradient', 'realty-pack-core'),
	                        'icon' => 'fa fa-barcode',
	                    ],
	                ],
	                'default' => 'classic',
	            ]
	        );

			$this->add_control(
				'rtp_iconbox_primary_color',
				[
					'label' => __( 'Primary Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_icon_gradient_color',
				[
					'label' => __( 'Gradient Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'rtp_iconbox_icon_color_type' => ['gradient'],
					],
	                'selectors' => [
						'{{WRAPPER}} .elementor-icon i' =>
						'background-color: transparent; background: -webkit-gradient(linear, left top, left bottom,from({{rtp_iconbox_primary_color.VALUE}}),to({{rtp_iconbox_icon_gradient_color.VALUE}}));					
						-webkit-background-clip: text;
						-webkit-text-fill-color: transparent;
						width:100%;
						height:100%;',
						'{{WRAPPER}} .elementor-icon i:before' =>'position: static !important'

	                ],
				]
			);

			$this->add_control(
				'rtp_iconbox_secondary_color',
				[
					'label' => __( 'Secondary Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'rtp_iconbox_view!' => 'default',
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'rtp_iconbox_icon_colors_hover',
			[
				'label' => __( 'Hover', 'realty-pack-core' ),
			]
		);

			$this->add_control(
				'rtp_iconbox_hover_primary_color',
				[
					'label' => __( 'Primary Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_hover_secondary_color',
				[
					'label' => __( 'Secondary Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'rtp_iconbox_view!' => 'default',
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_hover_animation',
				[
					'label' => __( 'Hover Animation', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				]
			);

		$this->end_controls_tab();

		$this->end_controls_tabs();

			$this->add_responsive_control(
				'rtp_iconbox_icon_space',
				[
					'label' => __( 'Spacing', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 15,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'rtp_iconbox_icon_size',
				[
					'label' => __( 'Size', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_icon_padding',
				[
					'label' => __( 'Padding', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'range' => [
						'em' => [
							'min' => 0,
							'max' => 5,
						],
					],
					'condition' => [
						'rtp_iconbox_view!' => 'default',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_rotate',
				[
					'label' => __( 'Rotate', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 0,
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_border_width',
				[
					'label' => __( 'Border Width', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'rtp_iconbox_view' => 'framed',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_border_radius',
				[
					'label' => __( 'Border Radius', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'rtp_iconbox_view!' => 'default',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rtp_iconbox_section_style_content',
			[
				'label' => __( 'Content', 'realty-pack-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'rtp_iconbox_text_align',
				[
					'label' => __( 'Alignment', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'realty-pack-core' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'realty-pack-core' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'realty-pack-core' ),
							'icon' => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'realty-pack-core' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_content_vertical_alignment',
				[
					'label' => __( 'Vertical Alignment', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'top' => __( 'Top', 'realty-pack-core' ),
						'middle' => __( 'Middle', 'realty-pack-core' ),
						'bottom' => __( 'Bottom', 'realty-pack-core' ),
					],
					'default' => 'top',
					'prefix_class' => 'elementor-vertical-align-',
				]
			);

			$this->add_control(
				'rtp_iconbox_heading_title',
				[
					'label' => __( 'Title', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'rtp_iconbox_title_bottom_space',
				[
					'label' => __( 'Spacing', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'rtp_iconbox_title_color',
				[
					'label' => __( 'Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				]
			);

			$this->add_control(
				'rtp_iconbox_heading_description',
				[
					'label' => __( 'Description', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'rtp_iconbox_description_color',
				[
					'label' => __( 'Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'rtp_iconbox_description_typography',
					'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rtp_iconbox_section_style_boxhover',
			[
				'label' => __( 'Box Hover', 'realty-pack-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'show_hover',
				[
					'label' => __( 'Show Title', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'realty-pack-core' ),
					'label_off' => __( 'Hide', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

	        $this->add_control(
	            'rtp_iconbox_boxhover_background_type',
	            [
	                'label' => __('Background Type', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::CHOOSE,
	                'label_block' => false,
	                'options' => [
	                    'classic' => [
	                        'title' => __('classic', 'realty-pack-core'),
	                        'icon' => 'fa fa-paint-brush',
	                    ],
	                    'gradient' => [
	                        'title' => __('gradient', 'realty-pack-core'),
	                        'icon' => 'fa fa-barcode',
	                    ],
	                ],
					'default' => 'classic',
					'condition' => [
						'show_hover' => 'yes',
					],
	            ]
	        );
		
			$this->add_control(
				'rtp_iconbox_boxhover_background_color',
				[
					'label' => __( 'Background Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
	                    '{{WRAPPER}} .elementor-widget-container:before' => 
	                    'background: linear-gradient({{rtp_iconbox_boxhover_background_color_angle.SIZE}}{{UNIT}},{{rtp_iconbox_boxhover_background_color.VALUE}},{{rtp_iconbox_boxhover_background_color_second.VALUE}});border-radius:inherit',

	                    '{{WRAPPER}} .elementor-widget-container:hover.elementor-widget-container:before' => 
	                    'opacity:1;',
	                ],
					'condition' => [
						'show_hover' => 'yes',
					],
				]
			);
		
			$this->add_control(
	            'rtp_iconbox_boxhover_background_color_second',
	            [
	                'label' => __('Second Color', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::COLOR,
	                'default' => '',
	                'render_type' => 'ui',
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-widget-container:before' => 
	                    'background: linear-gradient({{rtp_iconbox_boxhover_background_color_angle.SIZE}}{{UNIT}},{{rtp_iconbox_boxhover_background_color.VALUE}},{{rtp_iconbox_boxhover_background_color_second.VALUE}});border-radius:inherit',

	                    '{{WRAPPER}} .elementor-widget-container:hover.elementor-widget-container:before' => 
	                    'opacity:1;',
	                
	                ],
	                'condition' => [
						'rtp_iconbox_boxhover_background_type' => ['gradient'],
						'show_hover' => 'yes',
	                ],
					'of_type' => 'gradient',

	            ]
	        );

	        $this->add_control(
	            'rtp_iconbox_boxhover_background_color_angle',
	            [
	                'label' => __('Angle', 'realty-pack-core'),
	                'type' => \Elementor\Controls_Manager::SLIDER,
	                'size_units' => ['deg'],
	                'default' => [
	                    'unit' => 'deg',
	                    'size' => 180,
	                ],
	                'range' => [
	                    'deg' => [
	                        'step' => 1,
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-widget-container:before' => 
	                    'background: linear-gradient({{rtp_iconbox_boxhover_background_color_angle.SIZE}}{{UNIT}},{{rtp_iconbox_boxhover_background_color.VALUE}},{{rtp_iconbox_boxhover_background_color_second.VALUE}});border-radius:inherit',

	                    '{{WRAPPER}} .elementor-widget-container:hover.elementor-widget-container:before' => 
	                    'opacity:1;',
	                ],
	                'condition' => [
						'rtp_iconbox_boxhover_background_type' => ['gradient'],
						'show_hover' => 'yes',

	                ],
	                'of_type' => 'gradient',
	            ]
			);
		
			$this->add_control(
				'rtp_iconbox_boxhover_icon_color',
				[
					'label' => __( 'Icon Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}  .elementor-widget-container:hover .elementor-icon' => 'color: {{VALUE}};',
						'{{WRAPPER}}  .elementor-widget-container:hover .elementor-icon i' => '-webkit-text-fill-color: unset;',

					],
					'separator'=> 'before',
					'condition' => [
						'show_hover' => 'yes',
	                ],
				]
			);

			$this->add_control(
				'rtp_iconbox_boxhover_title_color',
				[
					'label' => __( 'Title Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}  .elementor-widget-container:hover .elementor-icon-box-title' => 'color: {{VALUE}}!important;',
					],
					'separator'=> 'before',
					'condition' => [
						'show_hover' => 'yes',
	                ],
				]
			);

			$this->add_control(
				'rtp_iconbox_boxhover_subtitle_color',
				[
					'label' => __( 'Subtitle Color', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}  .elementor-widget-container:hover .elementor-icon-box-description' => 'color: {{VALUE}}!important;',
					],
					'separator'=> 'before',
					'condition' => [
						'show_hover' => 'yes',
	                ],
				]
			);

	        $this->add_group_control(
	            \Elementor\Group_Control_Box_Shadow::get_type(),
	            [
	                'name' => 'rtp_iconbox_boxhover_boxshadow',
					'selector' =>  '{{WRAPPER}} .elementor-widget-container:hover ',   
					'condition' => [
						'show_hover' => 'yes',
	                ],        
	            ]
	        );

		$this->end_controls_section();

	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'rtp_iconbox_icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['rtp_iconbox_hover_animation'] ] );

		$icon_tag = 'span';
		$has_icon = ! empty( $settings['rtp_iconbox_icon'] );

		if ( ! empty( $settings['rtp_iconbox_link']['url'] ) ) {
			$this->add_render_attribute( 'rtp_iconbox_link', 'href', $settings['rtp_iconbox_link']['url'] );
			$icon_tag = 'a';

			if ( $settings['rtp_iconbox_link']['is_external'] ) {
				$this->add_render_attribute( 'rtp_iconbox_link', 'target', '_blank' );
			}

			if ( $settings['rtp_iconbox_link']['nofollow'] ) {
				$this->add_render_attribute( 'rtp_iconbox_link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['rtp_iconbox_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'rtp_iconbox_icon' );
		$link_attributes = $this->get_render_attribute_string( 'rtp_iconbox_link' );

		$this->add_render_attribute( 'rtp_iconbox_description_text', 'class', 'elementor-icon-box-description' );

		$this->add_inline_editing_attributes( 'rtp_iconbox_title_text', 'none' );
		$this->add_inline_editing_attributes( 'rtp_iconbox_description_text' );

		ob_start();
		?>
		<div class="elementor-icon-box-wrapper">
		<?php if ( $has_icon ) : ?>

			<?php endif; ?>
			<div class="elementor-icon-box-content">
				<div class="elementor-icon-box-title">
					<div class="elementor-icon-box-icon">
						<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
						<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
						</<?php echo $icon_tag; ?>>
					</div>
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'rtp_iconbox_title_text' ); ?>><?php echo $settings['rtp_iconbox_title_text']; ?></<?php echo $icon_tag; ?>>
				</div>
				<p <?php echo $this->get_render_attribute_string( 'rtp_iconbox_description_text' ); ?>><?php echo $settings['rtp_iconbox_description_text']; ?></p>
			</div>
		</div>
		<?php
		ob_end_flush();
	}

}
