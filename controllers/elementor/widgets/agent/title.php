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
 * Elementor single agent profile widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agent_Title extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agent-title-info';
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
        return __( 'Title Info', 'realty-pack-core' );
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
        return 'eicon-post-title realtypack-flag';
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
     * Register single agent profile widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

		$this->start_controls_section(
			'section_image_carousel',
			array(
				'label' => __( 'Title Info', 'realty-pack-core' ),
			)
		);

            $this->add_control(
                'name',
                array(
                    'label'        => __('Show Name', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );            

            $this->add_control(
                'role',
                array(
                    'label'        => __('Show Role', 'realty-pack-core'),
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
     * Render single agent profile widget output on the frontend.
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
            $query = "SELECT `first_name`, `last_name` FROM `#__wpl_users` WHERE `id` = $id";
            $result = \wpl_db::select( $query, 'loadAssocList' );

            // Sanitize
            $name      = isset( $result[0]['first_name'] ) ? esc_html( $result[0]['first_name'] ) : '';
            $last_name = isset( $result[0]['last_name'] ) ? esc_html( $result[0]['last_name'] ) : '';

        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $name      =  esc_html( 'Janet', 'realty-pack-core' );
            $last_name =  esc_html( 'Richmond', 'realty-pack-core' );
        }

        echo controller::render_template(
           'widgets/agent/title.php',
           array(
               'settings'   =>  $settings,
               'name'       =>  $name,
               'last_name'  =>  $last_name,
           ),
           'always'
        );
    
    }

}