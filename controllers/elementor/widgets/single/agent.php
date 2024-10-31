<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Property;

/**
 * Elementor single property agent widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Agent extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-agent_info';
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
        return __( 'Agent Info', 'realty-pack-core' );
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
        return 'eicon-person realtypack-flag';
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
        return array( 'RTPC_single_Builder' );
    }

    /**
     * Register single property agent widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __('Agent Configuration', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'image_width',
                array(
                    'label'       => __( 'Image Width', 'realty-pack-core'),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 10,
                    'default'     => 328,
                )
            );

            $this->add_control(
                'image_height',
                array(
                    'label'       => __( 'Image Height ', 'realty-pack-core' ),
                    'type'        => \Elementor\Controls_Manager::NUMBER,
                    'min'         => 1,
                    'step'        => 1,
                    'default'     => 319,
                )
            );

        $this->end_controls_section();
    }

    /**
     * Render single property agent widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        // Check if it dose not any access return
        $property_show = new RTPC_WPL_Property;
        $property_show = $property_show->display();
        if ( is_array( $property_show ) ) {
            return;
        }
        
        //Settings
        $settings = $this->get_settings_for_display();

        $pid = \wpl_request::getVar( 'pid', 0 );

        if ( $pid ) {
            $query = "SELECT `user_id` FROM `#__wpl_properties` WHERE `id`='$pid'";
            $user_id = \wpl_db::select( $query, 'loadAssoc' );
            $user_id = $user_id['user_id'];

            $wpl_user = \wpl_users::full_render( $user_id, \wpl_users::get_pshow_fields(), NULL, array(), true );
            // Name
            $agent_name = isset( $wpl_user['materials']['first_name']['value'] ) ? $wpl_user['materials']['first_name']['value'] : '';
            $agent_l_name = isset($wpl_user['materials']['last_name']['value']) ? $wpl_user['materials']['last_name']['value'] : '';
            $display_name = $agent_name .' '. $agent_l_name;

            // Tel
            $tel = isset( $wpl_user['materials']['tel']['value'] ) ? $wpl_user['materials']['tel']['value'] : '';

            // $email
            $email = isset( $wpl_user['data']['secondary_email'] ) ? $wpl_user['data']['secondary_email'] : '';

            /** resizing profile image **/
            $params['image_parentid'] = $user_id;
            $params['image_name']     = isset( $wpl_user['profile_picture']['name'] ) ? $wpl_user['profile_picture']['name'] : '';
            $profile_path             = isset( $wpl_user['profile_picture']['path'] ) ? $wpl_user['profile_picture']['path'] : '';
            $profile_image            = \wpl_images::create_profile_images( $profile_path, $settings['image_width'], $settings['image_height'], $params );


            $website = '';
            if(isset($wpl_user['materials']['website']['value']))
            {
                $website = $wpl_user['materials']['website']['value'];
                if(stripos($website, 'http://') === false and stripos($website, 'https://') === false)
                {
                    $website = 'http://'.$website;
                }
            }

            $wpl_user['data']['r_facebook'] = isset( $wpl_user['data']['r_facebook'] ) ? $wpl_user['data']['r_facebook'] : false;

            $wpl_user['data']['r_twitter'] = isset( $wpl_user['data']['r_twitter'] ) ? $wpl_user['data']['r_twitter'] : false;

            $wpl_user['data']['r_pinterest'] = isset( $wpl_user['data']['r_pinterest'] ) ? $wpl_user['data']['r_pinterest'] : false;

            $socials = array(
                'website' => array(
                    'url'  => $website,
                    'icon' => 'rtpf-link',
                ),                  
                'facebook' => array(
                    'url'  => $wpl_user['data']['r_facebook'],
                    'icon' => 'rtpf-facebook',
                ),                
                'twitter' => array(
                    'url'  => $wpl_user['data']['r_twitter'],
                    'icon' => 'rtpf-twitter',
                ),                
                'pinterest' => array(
                    'url'  => $wpl_user['data']['r_pinterest'],
                    'icon' => 'rtpf-pinterest',
                ),
            );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $display_name   =   __( 'Janet Richmond', 'realty-pack-core' );
            $tel            =   __( '1 - 234 - 654 - 98 74', 'realty-pack-core' );
            $email          =   __( 'janet@Realtynateam.net', 'realty-pack-core' );
            $profile_image  =   RTPC_ASSETS_URL . 'assets/admin/img/property_builder/agent.png';
            $socials = array(
                'website' => array(
                    'url'  => '#',
                    'icon' => 'rtpf-link',
                ),                  
                'facebook' => array(
                    'url'  => '#',
                    'icon' => 'rtpf-facebook',
                ),                
                'twitter' => array(
                    'url'  => '#',
                    'icon' => 'rtpf-twitter',
                ),                
                'pinterest' => array(
                    'url'  => '#',
                    'icon' => 'rtpf-pinterest',
                ),
            );
        }

        echo controller::render_template(
           'widgets/single/agent.php',
           array(
               'display_name'   =>   $display_name,
               'tel'            =>   $tel,
               'profile_image'  =>   $profile_image,
               'email'          =>   $email,
               'socials'        =>   $socials,
               // 'count'          =>   $count,
           ),
           'always'
        );
    
    }

}