<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Single;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\models\wpl\RTPC_Models_WPL_Wpl;
use RTPC\WPL\RTPC_WPL_Property;

/**
 * Elementor single property refresh widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Favorite extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-favorite';
    }

    /**
     * Get widget title.
     *
     * Retrieve single property refresh widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Favorite Button', 'realty-pack-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve single property refresh widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-home-heart realtypack-flag';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
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
     * Retrieve 'RecentPostsGridCarousel' widget icon.
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
     * Register single property refresh widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {}

    /**
     * Render single property refresh widget output on the frontend.
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
        
        $settings = $this->get_settings_for_display();

        $pid = \wpl_request::getVar('pid', 0);

        if ( $pid ) {
            // Favorites
            if( \wpl_global::check_addon('PRO') ) {
               $favorites          = \wpl_addon_pro::favorite_get_pids();
               $find_favorite_item = in_array( $pid, $favorites );
            } else {
                return;
            }
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $pid                = 0;
            $find_favorite_item = 0;
        }

        echo controller::render_template(
            'widgets/single/favorite.php',
            array(
                'settings'              =>  $settings,
                'pid'                   =>  $pid,
                'find_favorite_item'    =>  $find_favorite_item,
            ),
            'always'
        );

    }

}