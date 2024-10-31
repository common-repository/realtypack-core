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
 * Elementor single agency social widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Socials extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-socials';
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
        return __( 'Socials', 'realty-pack-core' );
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
        return 'eicon-post-content realtypack-flag';
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
     * Register single agency social widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_social',
            array(
                'label' => __( 'Social Info', 'realty-pack-core' ),
            )
        );
            
            $this->add_control(
                'facebook',
                array(
                    'label'        => __('Show Facebook', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );
                   
            $this->add_control(
                'twitter',
                array(
                    'label'        => __('Show Twitter', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'pinterest',
                array(
                    'label'        => __('Show Pinterest', 'realty-pack-core'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __('Show', 'realty-pack-core'),
                    'label_off'    => __('Hide', 'realty-pack-core'),
                    'return_value' => 'yes',
                    'default'      => 'yes',
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
     * Render single agency social widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
        $settings = $this->get_settings_for_display();

        $id        = get_query_var( 'agency_id' );
        $result    = '';
        $facebook  = '';
        $twitter   = '';
        $pinterest = '';
        $website   = '';
        $skype     = '';

        if ( $id ) {
            // Get social
            $result    = RTPC_WPL_User::get_agency_social( $id );

            $facebook  = isset( $result['r_facebook'] )   ?   $result['r_facebook']  : '';
            $twitter   = isset( $result['r_twitter'] )    ?   $result['r_twitter']   : '';
            $pinterest = isset( $result['r_pinterest'] )  ?   $result['r_pinterest'] : '';
            $website   = isset( $result['website'] )      ?   $result['website']     : '';
            $skype     = isset( $result['r_skype'] )      ?   $result['r_skype']     : '';  

        }

        // For edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $facebook  = 'https://www.facebook.com/'; 
            $twitter   = 'https://twitter.com/'; 
            $pinterest = 'https://www.pinterest.com/'; 
            $website   = 'https://www.sample.com/'; 
            $skype     = '@sample'; 
        }

        echo controller::render_template(
           'widgets/agency/socials.php',
           array(
               'settings'  => $settings,
               'website'   => $website,
               'facebook'  => $facebook,
               'twitter'   => $twitter,
               'pinterest' => $pinterest,
               'skype'     => $skype,
           ),
           'always'
        );
    
    }

}