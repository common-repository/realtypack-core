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
 * Elementor single property describtion widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agent_Description extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agent-description';
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
        return array( 'RTPC_Agent_Builder' );
    }

    /**
     * Register single property describtion widget controls.
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
     * Render single property describtion widget output on the frontend.
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
            $query = "SELECT `about` FROM `#__wpl_users` WHERE `id` = $id";
            $result = \wpl_db::select( $query, 'loadAssocList' );

            $description = isset( $result[0]['about'] ) ? $result[0]['about'] : '';
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $description = __( 'Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur blandit tempus porttitor. Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam quis risus eget urna mollis ornare vel eu leo. Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor.', 'realty-pack-core' );
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