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
 * Elementor title widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Title extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'title-builder';
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
        return __( 'Title Builder', 'realty-pack-core' );
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
        return 'fa fa-header realtypack-flag';
    }

    /**
     * Get widget categories.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['RTPC_catergory'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'titlebuilder_content_section',
            [
                'label' => __('Content', 'realty-pack-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'titlebuilder_title',
                [
                    'label'       => __('Title', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::TEXTAREA,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'default'     => 'Title text',
                    'placeholder' => __("World is a beatiful place", 'realty-pack-core'),
                ]
            );

            $this->add_control(
                'titlebuilder_subtitle',
                [
                    'label'       => __('Subtitle', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::TEXTAREA,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'default'     => 'Subtitle text',
                    'placeholder' => __("Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis, amet!", 'realty-pack-core'),
                ]
            );

            $this->add_control(
                'titlebuilder_shape_one',
                [
                    'label'     => __('Shape', 'realty-pack-core'),
                    'type'      => \Elementor\Controls_Manager::SWITCHER,
                    'label_off' => __('Off', 'realty-pack-core'),
                    'label_on'  => __('On', 'realty-pack-core'),
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        /**
         * styles Title styles
         *
         * @sinc 1.0
         */
        $this->start_controls_section(
            'titlebuilder_title_style',
            [
                'label' => __('Title ', 'realty-pack-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'titlebuilder_titleـcolor',
                [
                    'label'     => __('Text Color', 'realty-pack-core'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => 'black',
                    'selectors' => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'titlebuilder_title_typography',
                    'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .rtp-elementor-titlebuilder-title',
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_title_margin',
                [
                    'label'      => __('Margin', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-title' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_title_padding',
                [
                    'label'      => __('Padding', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-title' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_title_align',
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
                    'default'   => 'left',
                    'toggle'    => false,
                    'selectors' => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-title-container' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /**
         * Subtitle styles
         *
         * @since 1.0
         *
         */
        $this->start_controls_section(
            'titlebuilder_subtitle_style',
            [
                'label' => __('Subtitle ', 'realty-pack-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'titlebuilder_subtitleـcolor',
                [
                    'label'     => __('Text Color', 'realty-pack-core'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => 'black',
                    'selectors' => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-subtitle' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'titlebuilder_subtitle_typography',
                    'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .rtp-elementor-titlebuilder-subtitle',
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_subtitle_margin',
                [
                    'label'      => __('Margin', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-subtitle' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_subtitle_padding',
                [
                    'label'      => __('Padding', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-subtitle' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_subtitle_align',
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
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-subtitle' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /**
         * Shape Styles
         *
         * @since 1.0
         *
         */
        $this->start_controls_section(
            'titlebuilder_shape_style',
            [
                'label'     => __('Shape ', 'realty-pack-core'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'titlebuilder_shape_one' => 'yes',
                ],
            ]
        );

            $this->add_control(
                'titlebuilder_shape_color',
                [
                    'label'     => __('Color', 'realty-pack-core'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => 'gray',
                    'selectors' => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-shape' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_shape_width',
                [
                    'label'      => __('Width', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'default'    => [
                        'size' => '30',
                    ],
                    'size_units' => ['px', '%', 'em'],
                    'range'      => [
                        '%'  => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 500,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                    'separator'  => 'before',
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-shape' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_shape_height',
                [
                    'label'      => __('Height', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'default'    => [
                        'size' => '3',
                    ],
                    'size_units' => ['px', '%', 'em'],
                    'range'      => [
                        '%'  => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-shape' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'titlebuilder_shape_boxshadow',
                    'selector' => '{{WRAPPER}} .rtp-elementor-titlebuilder-shape',
                ]
            );

            $this->add_responsive_control(
                'titlebuilder_shape_margin',
                [
                    'label'      => __('Margin', 'realty-pack-core'),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'default'    => [
                        'top'    => '',
                        'right'  => '',
                        'left'   => '40',
                        'bottom' => '',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .rtp-elementor-titlebuilder-shape' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		// Get widget settings
		$settings = $this->get_settings_for_display();

		echo controller::render_template(
			'widgets/title-builder.php',
			array(
				'settings'  => $settings,
			),
			'always'
		);

	}

}