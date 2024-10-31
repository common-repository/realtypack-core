<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agency;

use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\Models\RTPC_Models_DB;
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor Agent List for agency single builder.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Agentlist extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'agency-agent-list';
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
		return __( 'Agency Agent', 'realty-pack-core' );
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
		return 'eicon-gallery-grid realtypack-flag';
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
		return [ 'image', 'grid', 'agent', 'list' ];
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
        return array( 'RTPC_Agency_Builder' );
    }



	/**
	 * Register image carousel widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_image_carousel',
			array(
				'label' => __( 'Agent Configuration', 'realty-pack-core' ),
			)
		);


			$this->add_control(
				'default_view',
				[
					'label' => __( 'Default View', 'realty-pack-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'grid',
					'options' => [
						'column' => __( 'List View', 'realty-pack-core' ),
						'grid'   => __( 'Grid View', 'realty-pack-core' ),
					]
				]
			);

			$this->add_control(
				'show_agents_with_image',
				array(
					'label'        => __('Show Agents With Images', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);        

			$this->add_control(
				'show_phone',
				array(
					'label'        => __('Show Agents Phone', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);        

			$this->add_control(
				'show_secondary_email',
				array(
					'label'        => __('Show Secondary Email', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'show_socials',
				array(
					'label'        => __('Show Socials', 'realty-pack-core'),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __('Show', 'realty-pack-core'),
					'label_off'    => __('Hide', 'realty-pack-core'),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'items_number',
				array(
					'label'       => __('Number Of Items', 'realty-pack-core'),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'     => '6',
					'min'         => 1,
					'max'         => 12,
					'step'        => 1
				)
			);

			$this->add_control(
				'agent_name_color',
				[
					'label' => __( 'Agent name color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .our-agents-name' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => __( 'Agent name', 'realty-pack-core' ),
					'name' => 'agent_name_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .our-agents-name',
				]
			);

			$this->add_control(
				'agent_role_color',
				[
					'label' => __( 'Agent role color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .our-agents-title' => 'color: {{VALUE}};',
					],
					'separator' => 'before'

				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => __( 'Agent role text', 'realty-pack-core' ),
					'name' => 'agent_role_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .our-agents-title',
				]
			);

			$this->add_control(
				'agent_detail_labels',
				[
					'label' => __( 'Agent labels color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .our-agents-phone-label' => 'color: {{VALUE}};',
						'{{WRAPPER}} .our-agents-email-label' => 'color: {{VALUE}};',
						'{{WRAPPER}} .our-agents-social-label' => 'color: {{VALUE}};',

					],
					'separator' => 'before'


				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => __( 'Agent phone label', 'realty-pack-core' ),
					'name' => 'agent_phone_label_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .our-agents-phone-label, {{WRAPPER}} .our-agents-email-label , {{WRAPPER}} .our-agents-social-label',
				]
			);

			$this->add_control(
				'agent_detail_content',
				[
					'label' => __( 'Agent contents color', 'realty-pack-core' ),
					'type' =>  \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .our-agents-phone-number' => 'color: {{VALUE}};',
						'{{WRAPPER}} .our-agents-email-address' => 'color: {{VALUE}};',
						'{{WRAPPER}} .our-agents-social-icons' => 'color: {{VALUE}};',

					],


				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => __( 'Agent property listed text', 'realty-pack-core' ),
					'name' => 'agent_property_listed_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .our-agents-property-listed',
					'separator' => 'before'

				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'slide_background',
					'label' => __( 'Slide Background', 'realty-pack-core' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .our-agents-details-container',
					'separator' => 'before'

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

        $id = get_query_var( 'agency_id' );
        $user_info = array();

        if ( $id ) {
        	$result = RTPC_WPL_User::get_user_data( $id , 'rtp_agent_list' );
        	$result = isset( $result['rtp_agent_list'] ) ? $result['rtp_agent_list'] : false;
        	// Check if agency has not any agent
        	if ( ! $result ) {
        		return;
        	}

        	$result = explode( ',', $result);

        	for ( $i = 0; $i < $settings['items_number']; $i++ ) {
        		if ( isset( $result[$i] ) ) {
        			$user_info[] = RTPC_WPL_User::get_user_info_agent( $result[$i] );
        		} else {
        			break;
        		}
        	}

        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
        	$wpl_users = RTPC_WPL_User::get_wpl_users(1);

        	$wpl_users = array_values( $wpl_users );
        	
        	for ( $i=0; $i < $settings['items_number']; $i++ ) {
        		if ( isset( $wpl_users[$i]->id ) ) {
        			$user_info[] = RTPC_WPL_User::get_user_info_agent( $wpl_users[$i]->id );
        		} else {
        			break;
        		}
        	}
        }

		echo controller::render_template(
			'widgets/agent-list.php',
			array(
				'settings' 	=> $settings,
				'user_info'	=> $user_info,

			),
			'always'
		);
	}

}