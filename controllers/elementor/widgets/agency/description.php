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
 * Elementor describtion for agency single widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Description extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-description';
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
        return __( 'Description', 'realty-pack-core' );
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
     * Register describtion for agency single widget controls.
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
     * Render describtion for agency single widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        //Settings
        $settings = $this->get_settings_for_display();
        
        $id          = get_query_var( 'agency_id' );
        $description = '';

        if ( $id ) {
            $description = RTPC_WPL_User::get_agency_describtion( $id );
            $description = isset( $description['about'] ) ? $description['about'] : '';
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            // Sanitize
            $description = __( 'Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus. ullamcorper nulla non metus auctor fringilla. dolor auctor. Morbi leo risus, porta ac consectetur ac. sagittis lacus vel augue laoreet rutrum.', 'realty-pack-core' );
        }

        echo controller::render_template(
           'widgets/agency/description.php',
           array(
               'settings'    => $settings,
               'description' => $description,
           ),
           'always'
        );
    
    }

}