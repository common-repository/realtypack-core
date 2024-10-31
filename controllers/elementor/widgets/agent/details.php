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
 * Elementor single agent details widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agent_Details extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-details';
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
        return __( 'Details Info', 'realty-pack-core' );
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
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return '';
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
        return array( 'RTPC_Agent_Builder' );
    }

    /**
     * Register single agent details widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
		
        $this->start_controls_section(
			'section_contact',
			array(
				'label' => __( 'Display Details', 'realty-pack-core' ),
			)
		);

            $this->add_control(
                'agent_phone',
                array(
                    'label'        => __('Show Phone', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'agent_mobile',
                array(
                    'label'        => __('Show Mobile', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'agent_fax',
                array(
                    'label'        => __('Show Fax', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'agent_email',
                array(
                    'label'        => __('Show Email', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'agent_address',
                array(
                    'label'        => __('Show Address', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );   
            
            $this->add_control(
                'listed_properties',
                array(
                    'label'        => __('Show Listed Properties', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );  

		$this->end_controls_section();

    }

    /**
     * Render single agent details widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
    	$settings = $this->get_settings_for_display();

    	$id = get_query_var( 'agent_id' );

    	if ( $id ) {

            // Get data
    		$query = "SELECT `tel`, `mobile`, `fax`, `main_email`, `location3_name` FROM `#__wpl_users` WHERE `id` = $id";
    		$result = \wpl_db::select( $query, 'loadAssocList' );
    		$listed_properties = \wpl_db::num("SELECT COUNT(*) FROM `#__wpl_properties` WHERE `user_id` = " . $id );
    		$result = $result[0];
            // Contact
    		$agent_phone       = isset( $result['tel'] ) 			 ?  $result['tel'] : '';
    		$agent_mobile      = isset( $result['mobile'] ) 		 ?  $result['mobile'] : '';
    		$agent_fax         = isset( $result['fax'] ) 			 ?  $result['fax'] : '';
    		$agent_email       = isset( $result['main_email'] ) 	 ?  $result['main_email'] : '';
    		$agent_address     = isset( $result['location3_name'] )  ?  $result['location3_name'] : '';
    		$listed_properties = isset( $listed_properties ) 		 ?  $listed_properties : '';
    	}

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            // Contact
            $agent_phone       = __( '1 - 234 - 654 - 98 74', 'realty-pack-core' );
            $agent_mobile      = __( '1 - 234 - 654 - 98 74', 'realty-pack-core' );
            $agent_fax         = __( '1 - 234 - 654 - 98 74', 'realty-pack-core' );
            $agent_email       = __( 'janet@Realtynateam.net', 'realty-pack-core' );
            $agent_address     = __( 'janet@Realtynateam.net', 'realty-pack-core' );
            $listed_properties = __( '6', 'realty-pack-core' );
        }

    	echo controller::render_template(
    		'widgets/agent/details.php',
    		array(
    			'settings'          => $settings,
    			'agent_phone'       => $agent_phone,
    			'agent_mobile'      => $agent_mobile,
    			'agent_fax'         => $agent_fax,
    			'agent_email'       => $agent_email,
    			'agent_address'     => $agent_address,
    			'listed_properties' => $listed_properties,
    		),
    		'always'
    	);

    }

}