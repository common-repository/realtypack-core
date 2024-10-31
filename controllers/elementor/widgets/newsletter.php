<?php

/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

/**
 * Elementor Mailchimp widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Newsletter extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'RTPC_newsletter';
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
		return __( 'Mail Chimp', 'realty-pack-core' );
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
    	return 'eicon-mailchimp realtypack-flag';
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
     * Register mailchimp widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

    	$this->start_controls_section(
    		'section_input',
    		[
    			'label' => __('Configuration', 'realty-pack-core'),
    		]
    	);         

	    	$this->add_control(
	    		'input_button_label',
	    		[
	    			'label' => __('Button Label', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::TEXT,
	    			'dynamic' => [
	    				'active' => true,
	    			],
	    			'default' => __('Click here', 'realty-pack-core'),
	    			'placeholder' => __('Click here', 'realty-pack-core'),

	    		]
	    	);

	    	$this->add_control(
	    		'input_placeholder',
	    		[
	    			'label' => __('Input Placeholder', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::TEXT,
	    			'dynamic' => [
	    				'active' => true,
	    			],
	    			'default' => __('Enter Your Email Address', 'realty-pack-core'),
	    		]
	    	);

	    	$this->add_responsive_control(
	    		'input_align',
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
	    			],
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-newsletter-container' => 'text-align: {{VALUE}};',
	    			],
	    		]
	    	);

    	$this->end_controls_section();

    	$this->start_controls_section(
    		'input_section_style',
    		[
    			'label' => __('Input', 'realty-pack-core'),
    			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    		]
    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label' => 'Input Typography',
	    			'name' => 'input_typography',
	    			'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form input',
	    		]
	    	);
	    	$this->add_control(
	    		'input_placeholder_color',
	    		[
	    			'label' => __('Placeholder Color', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::COLOR,
	    			'default' => '',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-newsletter-container form input::placeholder' => 'color: {{VALUE}};',
	    			],
	    		]
	    	);

	    	$this->add_responsive_control(
	    		'input_size',
	    		[
	    			'label' => __('Input width', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::NUMBER,
	    			'dynamic' => [
	    				'active' => true,
	    			],
	    			'default' => '450',
	    			'placeholder' => __('Click here', 'realty-pack-core'),
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-newsletter-container form' => 'width: {{VALUE}}px;',
	    			],

	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Background::get_type(),
	    		[
	    			'label' => __('Background', 'realty-pack-core'),
	    			'name' => 'input_background',
	    			'types' => ['classic', 'gradient'],
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form input',
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Box_Shadow::get_type(),
	    		[
	    			'name' => 'boxshadow',
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form input',
	    		]
	    	);

    	$this->end_controls_section();

    	$this->start_controls_section(
    		'button_section_style',
    		[
    			'label' => __('Button', 'realty-pack-core'),
    			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    		]
    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label' => 'Button Typography',
	    			'name' => 'button_label_typography',
	    			'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form button',
	    		]
	    	);

	    	$this->start_controls_tabs('tabs_button_style');

	    	$this->start_controls_tab(
	    		'button_normal',
	    		[
	    			'label' => __('Normal', 'realty-pack-core'),
	    		]
	    	);

	    	$this->add_control(
	    		'button_label_color',
	    		[
	    			'label' => __('Label Color', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::COLOR,
	    			'default' => '',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-newsletter-container form button' => 'color: {{VALUE}};',
	    			],
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Background::get_type(),
	    		[
	    			'label' => __('Background', 'realty-pack-core'),
	    			'name' => 'button_normal_background',
	    			'types' => ['classic', 'gradient'],
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form button',
	    		]
	    	);

    	$this->end_controls_tab();

    	$this->start_controls_tab(
    		'RTPC_button_tab_button_hover',
    		[
    			'label' => __('Hover', 'realty-pack-core'),
    		]
    	);

	    	$this->add_control(
	    		'button_label_hover_color',
	    		[
	    			'label' => __('Label Color', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::COLOR,
	    			'default' => '',
	    			'selectors' => [
	    				'selector' => '{{WRAPPER}} .rtpc-newsletter-container form button:hover',
	    			],
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Background::get_type(),
	    		[
	    			'label' => __('Background', 'realty-pack-core'),
	    			'name' => 'button_hover_background',
	    			'types' => ['classic', 'gradient'],
	    			'selector' => '{{WRAPPER}} .rtpc-newsletter-container form button:hover',
	    		]
	    	);

	    	$this->add_control(
	    		'button_hover_animation',
	    		[
	    			'label' => __('Hover Animation', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
	    		]
	    	);

    	$this->end_controls_tab();

    	$this->end_controls_tabs();

    	$this->end_controls_section();

    }

    /**
     * Render button widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
    	$settings = $this->get_settings_for_display();

    	if ( $settings['button_hover_animation'] ) {
    		$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
    	}

		ob_start();
    	?>
    	<div class="rtpc-newsletter-container">
    		<form>
    			<input type="text" placeholder="<?php echo esc_attr( $settings['input_placeholder'] ); ?>">
    			<button class="rtpc-newsletter-submit" data-nounce="<?php echo wp_create_nonce( 'rtpc_newsletter' ); ?>" <?php echo $this->get_render_attribute_string('button'); ?>>
    				<?php echo esc_attr( $settings['input_button_label'] ); ?>
    			</button>
    			<span class="rtpc-message"></span>
    		</form>
    	</div>
    	<?php
    	ob_end_flush();
    }

}
