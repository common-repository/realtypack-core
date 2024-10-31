<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agent;

use RTPC\controllers\RTPC_Controllers_Public as controller;
/**
 * Elementor button widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agent_Button extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agent-button';
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
        return __('Button', 'realty-pack-core');
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
        return ['RTPC_Agent_Builder'];
    }

    /**
     * Get button sizes.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return array An array containing button sizes.
     */
    public static function get_button_sizes() {
        return [
            'xs' => __('Small', 'realty-pack-core'),
            'md' => __('Medium', 'realty-pack-core'),
            'lg' => __('Large', 'realty-pack-core'),
        ];
    }

    /**
     * Register button widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'rtp_section_button',
            [
                'label' => __('Button', 'realty-pack-core'),
            ]
        );


        $this->add_control(
            'rtp_button_text',
            [
                'label' => __('Text', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Click here', 'realty-pack-core'),
                'placeholder' => __('Click here', 'realty-pack-core'),
            ]
        );

        $this->add_control(
            'rtp_button_link',
            [
                'label' => __('Link', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'realty-pack-core'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_responsive_control(
            'rtp_button_align',
            [
                'label' => __('Alignment', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'realty-pack-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'realty-pack-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'realty-pack-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'realty-pack-core'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
        	'rtp_button_size',
        	array(
        		'label'          => __( 'Choose Size Of Button', 'realty-pack-core' ),
        		'type'           => \Elementor\Controls_Manager::SELECT,
        		'default'        => 'normal',
        		'options' => array(
        			'small' => 'Small', 
        			'normal' => 'Normal', // 3 column
        		),
        		'frontend_available' => true,
        	)
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'rtp_button_section_style',
            [
                'label' => __('Button', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'rtp_button_tab_button_normal',
            [
                'label' => __('Normal', 'realty-pack-core'),
            ]
        );

        $this->add_control(
            'rtp_button_button_text_color',
            [
                'label' => __('Text Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rtp_button_background_type',
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
            'rtp_button_background_color',
            [
                'label' => __('Background Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'rtp_button_background_color_second',
            [
                'label' => __('Second Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2295b',
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' =>
                    ' background: linear-gradient({{rtp_button_background_color_angle.SIZE}}{{UNIT}},{{rtp_button_background_color.VALUE}},{{rtp_button_background_color_second.VALUE}})',
                ],
                'condition' => [
                    'rtp_button_background_type' => ['gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );
        $this->add_control(
            'rtp_button_background_color_angle',
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
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' =>
                    ' background: linear-gradient({{rtp_button_background_color_angle.SIZE}}{{UNIT}},{{rtp_button_background_color.VALUE}},{{rtp_button_background_color_second.VALUE}})',
                ],
                'condition' => [
                    'rtp_button_background_type' => ['gradient'],
                ],
                'of_type' => 'gradient',

            ]
        );

        $this->add_control(
            'rtp_button_shape',
            [
                'label' => __('Shape', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'dafault' => '#6A11CB',
                'selectors' => [
                    '{{WRAPPER}} elementor-button::after' => '
                    background: -webkit-gradient(linear, left top, right top, color-stop(50%, {{rtp_button_shape.VALUE}}), color-stop(50%, {{rtp_button_shape_second.VALUE}}));
                    background: linear-gradient(90deg, {{rtp_button_shape.VALUE}} 50%, {{rtp_button_shape_second.VALUE}} 50%);',

                    '{{WRAPPER}} .elementor-button:hover > .elementor-button:after, {{WRAPPER}} .elementor-button:hover > .elementor-button:after' => '
                    background: -webkit-gradient(linear, left top, right top, color-stop(50%, {{rtp_button_shape.VALUE}}), color-stop(50%, {{rtp_button_shape_second.VALUE}}));
                    background: linear-gradient(90deg, {{rtp_button_shape.VALUE}} 50%, {{rtp_button_shape_second.VALUE}} 50%);',

                ],
            ]
        );


        $this->add_control(
            'rtp_button_shape_second',
            [
                'label' => __('Shape second', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'dafault' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} elementor-button::after' => '
                    background: -webkit-gradient(linear, left top, right top, color-stop(50%, {{rtp_button_shape.VALUE}}), color-stop(50%, {{rtp_button_shape_second.VALUE}}));
                    background: linear-gradient(90deg, {{rtp_button_shape.VALUE}} 50%, {{rtp_button_shape_second.VALUE}} 50%);',

                    '{{WRAPPER}} .elementor-button:hover > .elementor-button:after, {{WRAPPER}} .elementor-button:hover > .elementor-button:after' => '
                    background: -webkit-gradient(linear, left top, right top, color-stop(50%, {{rtp_button_shape.VALUE}}), color-stop(50%, {{rtp_button_shape_second.VALUE}}));
                    background: linear-gradient(90deg, {{rtp_button_shape.VALUE}} 50%, {{rtp_button_shape_second.VALUE}} 50%);',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'rtp_button_boxshadow',
                'selector' =>  '{{WRAPPER}} .rtp-button .elementor-button',           
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'rtp_button_tab_button_hover',
            [
                'label' => __('Hover', 'realty-pack-core'),
            ]
        );

        $this->add_control(
            'rtp_button_hover_color',
            [
                'label' => __('Text Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} a.elementor-button:hover .elementor-button:after, {{WRAPPER}} .elementor-button:hover .elementor-button:after' => 
                    'background: -webkit-gradient(linear, left top, right top, color-stop(50%, #6A11CB), color-stop(50%, red));
                    background: linear-gradient(90deg, #6A11CB 50%, red 50%);',
                ],
            ]
        );

        $this->add_control(
            'rtp_button_hover_background_type',
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
            'rtp_button_background_hover_color',
            [
                'label' => __('Background Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:before' => 
                    ' background: linear-gradient({{rtp_button_background_hover_color_angle.SIZE}}deg,{{VALUE}},{{VALUE}})',

                    '{{WRAPPER}} .elementor-button:hover.elementor-button:before' => 
                    'opacity:1;',

                ],
            ]
        );

        $this->add_control(
            'rtp_button_background_hover_color_second',
            [
                'label' => __('Second Color', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2295b',
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:before' => 
                    ' background: linear-gradient({{rtp_button_background_hover_color_angle.SIZE}}{{UNIT}},{{rtp_button_background_hover_color.VALUE}},{{rtp_button_background_hover_color_second.VALUE}})',

                    '{{WRAPPER}} .elementor-button:hover.elementor-button:before' => 
                    'opacity:1;',

                    '{{WRAPPER}} .elementor-button:hover.elementor-button:after' => 
                    'background: -webkit-gradient(linear, left top, right top, color-stop(50%, {{rtp_button_background_hover_color.VALUE}}), color-stop(50%, #fff));
                    background: linear-gradient(90deg, {{rtp_button_background_hover_color.VALUE}} 50%, #fff 50%);',
                ],
                'condition' => [
                    'rtp_button_hover_background_type' => ['gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );
        $this->add_control(
            'rtp_button_background_hover_color_angle',
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
                    '{{WRAPPER}} .elementor-button:before' => 
                    ' background: linear-gradient({{rtp_button_background_hover_color_angle.SIZE}}{{UNIT}},{{rtp_button_background_hover_color.VALUE}},{{rtp_button_background_hover_color_second.VALUE}})',
                ],
                'condition' => [
                    'rtp_button_hover_background_type' => ['gradient'],
                ],
                'of_type' => 'gradient',

            ]
        );

        $this->add_control(
            'rtp_button_hover_animation',
            [
                'label' => __('Hover Animation', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );


        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'rtp_button_hover_boxshadow',
                'selector' =>  '{{WRAPPER}} .rtp-button .elementor-button:hover',           
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();




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
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'rtp-button elementor-button-wrapper');

        if (!empty($settings['rtp_button_link']['url'])) {
            $this->add_render_attribute('button', 'href', $settings['rtp_button_link']['url']);
            $this->add_render_attribute('button', 'class', 'elementor-button-link');

            if ($settings['rtp_button_link']['is_external']) {
                $this->add_render_attribute('button', 'target', '_blank');
            }

            if ($settings['rtp_button_link']['nofollow']) {
                $this->add_render_attribute('button', 'rel', 'nofollow');
            }
        }

        $this->add_render_attribute('button', 'class', 'elementor-button');
        $this->add_render_attribute('button', 'role', 'button');

        
        if (!empty($settings['rtp_button_size'])) {
            $this->add_render_attribute('button', 'class', ' ' . $settings['rtp_button_size'] );
        }


        if ($settings['rtp_button_hover_animation']) {
            $this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['rtp_button_hover_animation']);
        }

        ?>
		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
			<a <?php echo $this->get_render_attribute_string('button'); ?>>
				<?php $this->render_text();?>
			</a>
		</div>
		<?php
    }

    /**
     * Render button widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
		<#
		view.addRenderAttribute( 'rtp_button_text', 'class', 'elementor-button-text' );

		view.addInlineEditingAttributes( 'rtp_button_text', 'none' );
		#>
		<div class="rtp-button elementor-button-wrapper">
			<a id="{{ settings.rtp_button_button_css_id }}" class="elementor-button elementor-size-{{ settings.rtp_button_size }} elementor-animation-{{ settings.rtp_button_hover_animation }}" href="{{ settings.rtp_button_link.url }}" role="button">
				<span class="elementor-button-content-wrapper">
					<span {{{ view.getRenderAttributeString( 'rtp_button_text' ) }}}>{{{ settings.rtp_button_text }}}</span>
				</span>
			</a>
		</div>
		<?php
    }

    /**
     * Render button text.
     *
     * Render button widget text.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render_text() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute([
            'content-wrapper' => [
                'class' => 'elementor-button-content-wrapper',
            ],
            'rtp_button_text' => [
                'class' => 'elementor-button-text',
            ],
        ]);

        $this->add_inline_editing_attributes('rtp_button_text', 'none');
        ?>
		<span <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
			<span <?php echo $this->get_render_attribute_string('rtp_button_text'); ?>><?php echo $settings['rtp_button_text']; ?></span>
		</span>
		<?php
    }
}
