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
 * Elementor iconbox carousel widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Iconboxcarousel extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rtpc-iconbox-carousel';
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
        return __('Iconbox Carousel', 'realty-pack-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve iconbox carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
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
        return ['iconbox', 'ixon', 'visual', 'carousel', 'slider'];
    }

    /**
     * Retrieve the list of scripts the iconbox carousel widget depended on.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-slick', 'swiper'];
    }

    /**
     * Register iconbox carousel widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_image_carousel',
            [
                'label' => __('Iconbox Carousel', 'realty-pack-core'),
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'iconbox_icon',
                [
                    'label' => __('Icon', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::ICON,
                    'default' => 'fa fa-star',
                ]
            );

            $repeater->add_control(
                'iconbox_title',
                [
                    'label' => __('Title', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('Iconbox Title', 'realty-pack-core'),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'iconbox_content',
                [
                    'label' => __('Content', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => __('Iconbox Content', 'realty-pack-core'),
                    'show_label' => false,
                ]
            );


            $this->add_control(
                'iconbox_list',
                [
                    'label' => __('Iconbox List', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'iconbox_icon' => 'fa fa-star',
                            'iconbox_title' => __('Iconbox Title', 'realty-pack-core'),
                            'iconbox_content' => __('Iconbox Content. Click the edit button to change this text.', 'realty-pack-core'),
                        ],
                        [
                            'iconbox_icon' => 'fa fa-star',
                            'iconbox_title' => __('Iconbox Title #2', 'realty-pack-core'),
                            'iconbox_content' => __('Iconbox Content. Click the edit button to change this text.', 'realty-pack-core'),
                        ]
                    ],
                    'title_field' => '{{{ iconbox_title }}}',
                ]
            );

            $iconboxes_to_show = range(1, 10);
            $iconboxes_to_show = array_combine($iconboxes_to_show, $iconboxes_to_show);

            $this->add_responsive_control(
                'iconboxes_to_show',
                [
                    'label' => __('Iconboxes to Show', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Default', 'realty-pack-core'),
                    ] + $iconboxes_to_show,
                    'frontend_available' => true,
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_iconbox',
            [
                'label' => __('Iconbox', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'iconbox_border',
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'iconbox_border_radius',
                [
                    'label' => __('Border Radius', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'boxshadow',
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper',
                ]
            );

            $this->add_responsive_control(
                'iconbox_padding',
                [
                    'label' => __('Iconbox Padding', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->start_controls_tabs('rtp_iconbox_icon_colors');

        $this->start_controls_tab(
            'rtp_iconbox_icon_colors_normal',
            [
                'label' => __('Normal', 'realty-pack-core'),
            ]
        );

            $this->add_responsive_control(
                'iconbox_margin',
                [
                    'label' => __('Iconbox Margin', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                    ],
                    'selectors' => ['{{WRAPPER}} .rtpc-carousel-icon-box-wrapper' => 'transition:0.6s;margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'iconbox_background',
                    'label' => __('Background', 'realty-pack-core'),
                    'types' => ['classic', 'gradient', 'image'],
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper',
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'rtp_iconbox_icon_colors_hover',
            [
                'label' => __('Hover', 'realty-pack-core'),
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'iconbox_background_hover',
                    'label' => __('Background', 'realty-pack-core'),
                    'types' => ['classic', 'gradient', 'image'],
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper:hover',
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs('rtp_iconbox_icon_colors');

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Icon', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'icon_color',
                [
                    'label' => __('Icon Color', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_color_gradient',
                [
                    'label' => __('Gradient Color', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon' =>
                            'background: -webkit-linear-gradient(180deg, {{icon_color.VALUE}}, {{icon_color_gradient.VALUE}});					
    					-webkit-background-clip: text;
    					-webkit-text-fill-color: transparent;
    					width:100%;
    					height:100%;',
                        '{{WRAPPER}} .elementor-icon i:before' => 'position: static !important'

                    ],
                ]
            );

            $this->add_control(
                'icon_responsive_margin',
                [
                    'label' => __('Icon Margin', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_responsive_size',
                [
                    'label' => __('Size', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 16,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'overflow: hidden;',
                        '{{WRAPPER}}  .rtpc-carousel-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_control(
                'icon_color_hover',
                [
                    'label' => __('Icon Color Hover', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper:hover  .rtpc-carousel-icon' => 'color: {{VALUE}};-webkit-text-fill-color:unset;',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_text_color',
                [
                    'label' => __('Title Color', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-title',
                ]
            );

            $this->add_responsive_control(
                'title_responsive_margin',
                [
                    'label' => __('Title Margin', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => ['{{WRAPPER}} .rtpc-carousel-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'title_text_color_hover',
                [
                    'label' => __('Title Color Hover', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper:hover .rtpc-carousel-icon-box-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_content_color',
                [
                    'label' => __('Content Color', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .rtpc-carousel-icon-box-description',
                ]
            );

            $this->add_responsive_control(
                'content_responsive_margin',
                [
                    'label' => __('Content Margin', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => ['{{WRAPPER}} .rtpc-carousel-icon-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'title_content_color_hover',
                [
                    'label' => __('Content Color Hover', 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rtpc-carousel-icon-box-wrapper:hover .rtpc-carousel-icon-box-description' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    /**
     * Render iconbox carousel widget output on the frontend.
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
            'widgets/iconbox-carousel.php',
            array(
                'settings' => $settings,
            ),
            'always'
        );
    }
}
