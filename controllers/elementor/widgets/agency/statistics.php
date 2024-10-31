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
 * Elementor agency statistics in single widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Statistics extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-statistics';
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
        return __( 'Statistics', 'realty-pack-core' );
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
     * Register agency statistics in single widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'style',
            [
                'label' => __('Style', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render agency statistics in single widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
        $settings = $this->get_settings_for_display();
        
        $id = get_query_var( 'agency_id' );
        $listing_count = '';
        $agency_count  = '';

        if ( $id ) {
            $listing_count = \wpl_users::get_users_properties_count($id);
            $agency_count  = RTPC_WPL_User::get_user_data( $id, 'rtp_agent_list' );
            $agency_count  = isset( $agency_count['rtp_agent_list'] ) ? count( explode(',', $agency_count['rtp_agent_list'] ) ) : 0;
        }

        // For edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $listing_count = 14;
            $agency_count  = 8;
        }

        echo controller::render_template(
           'widgets/agency/statistics.php',
           array(
               'settings'      => $settings,
               'listing_count' => $listing_count,
               'agency_count'  => $agency_count,
           ),
           'always'
        );
    
    }

}