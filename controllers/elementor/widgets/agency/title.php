<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agency;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor Title info in agency single builder.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Title extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-title-info';
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
        return array( 'RTPC_Agency_Builder' );
    }

    /**
     * Register Title info in agency single builder controls.
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
                'agency_title',
                array(
                    'label'        => __('Show Title', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );            

            $this->add_control(
                'agency_address',
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
                'agency_phone',
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
                'agency_mobile',
                array(
                    'label'        => __('Show Mobile', 'realty-pack-core'),
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
     * Render Title info in agency single builder output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
        $settings = $this->get_settings_for_display();
        
        $id             = get_query_var( 'agency_id' );
        $agency_title   = '';
        $agency_address = '';
        $agency_phone   = '';
        $agency_mobile  = '';

        if ( $id ) {
            // Get data
            $result   = RTPC_WPL_User::get_agency_title( $id );
            $agency_title   = isset( $result[0]['company_name'] ) ? $result[0]['company_name'] : '';
            $agency_address = isset( $result[0]['company_address'] ) ? $result[0]['company_address'] : '';
            $agency_phone   = isset( $result[0]['tel'] ) ? $result[0]['tel'] : '';
            $agency_mobile  = isset( $result[0]['mobile'] ) ? $result[0]['mobile'] : '';
        }

        // For elementor preview
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            // Sanitize
            $agency_title   =  __( 'Modern House Real Estate', 'realty-pack-core' );
            $agency_address =  __( '231 Fenimore St, Brooklyn, NY 11225, USA', 'realty-pack-core' );
            $agency_phone   =  __( '+14 658 09 60', 'realty-pack-core' );
            $agency_mobile  =  __( '087 555 6647', 'realty-pack-core' );
        }

        echo controller::render_template(
           'widgets/agency/title.php',
           array(
               'settings'       => $settings,
               'agency_title'   => $agency_title,
               'agency_address' => $agency_address,
               'agency_phone'   => $agency_phone,
               'agency_mobile' 	=> $agency_mobile,
           ),
           'always'
        );
    
    }

}