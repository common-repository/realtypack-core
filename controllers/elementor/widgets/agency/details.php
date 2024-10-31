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
 * Elementor agency single details widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Details extends \Elementor\Widget_Base {

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
        return array( 'RTPC_Agency_Builder' );
    }

    /**
     * Register agency single details widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
		
        $this->start_controls_section(
			'section_contact',
			array(
				'label' => __( 'Contact Info', 'realty-pack-core' ),
			)
		);

            $this->add_control(
                'phone',
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
                'mobile',
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
                'fax',
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
                'email',
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
                'address',
                array(
                    'label'        => __('Show Address', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );            

		$this->end_controls_section();


        $this->start_controls_section(
            'section_social',
            array(
                'label' => __( 'Social Info', 'realty-pack-core' ),
            )
        );

            $this->add_control(
                'website',
                array(
                    'label'        => __('Show Website', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'skype',
                array(
                    'label'        => __('Show Skype', 'realty-pack-core'),
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
     * Render agency single details widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
    	$settings = $this->get_settings_for_display();

    	$id = get_query_var( 'agency_id' );
        // Contact
        $phone     = '';
        $mobile    = '';
        $fax       = '';
        $email     = '';
        $address   = '';
        // Social
        $website   = '';
        $skype     = '';

    	if ( $id ) {
            // Get data
    		$result   = RTPC_WPL_User::get_agency_details( $id );

            // Contact
    		$phone     = isset( $result[0]['tel'] ) ? $result[0]['tel'] : '';
    		$mobile    = isset( $result[0]['mobile'] ) ? $result[0]['mobile'] : '';
    		$fax       = isset( $result[0]['fax'] ) ? $result[0]['fax'] : '';
    		$email     = isset( $result[0]['secondary_email'] ) ? $result[0]['secondary_email'] : '';
    		$address   = isset( $result[0]['company_address'] ) ? $result[0]['company_address'] : '';

            // Social
    		$website   = isset( $result[0]['website'] ) ? $result[0]['website'] : '';
    		$skype     = isset( $result[0]['r_skype'] ) ? $result[0]['r_skype'] : '';  

    	}

    	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            // Sanitize
    		$phone       = __( '+14 658 09 60', 'realty-pack-core' );
    		$mobile      = __( '087 555 6647', 'realty-pack-core' );
    		$fax         = __( '023 555 6647', 'realty-pack-core' );
    		$email       = __( 'Sample@gmail.com', 'realty-pack-core' );
    		$address     = __( '231 Fenimore St, Brooklyn, NY 11225, USA', 'realty-pack-core' );
            // Social
    		$website     = __( 'http://Modernhouse.com', 'realty-pack-core' );
    		$skype       = __( '@moder_house', 'realty-pack-core' );
    	}

    	echo controller::render_template(
    		'widgets/agency/details.php',
    		array(
    			'settings'    => $settings,
    			'phone'       => $phone,
    			'mobile'      => $mobile,
    			'fax'         => $fax,
    			'email'       => $email,
    			'address'     => $address,
    			'website'     => $website,
    			'skype'       => $skype,
    		),
    		'always'
    	);

    }

}