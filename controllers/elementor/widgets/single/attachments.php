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
 * Elementor single property attachment widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Attachments extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-attachment';
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
        return __( 'Attachment', 'realty-pack-core' );
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
        return 'eicon-library-download realtypack-flag';
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
     * Register single property attachment widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {}

    /**
     * Render single property attachment widget output on the frontend.
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
        
        $pid = \wpl_request::getVar( 'pid', 0 );

        if ( $pid ) {
            $att_items = \wpl_items::get_items( $pid, 'attachment', 0, '', '' );

            $wpl_properties = array();
            $wpl_properties['current']['data']['id'] = $pid;
            $wpl_properties['current']['items']['attachment'] = $att_items;

            $params = array(
                'wpl_properties'    =>  $wpl_properties,
            );
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $url = esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/pdf.png');
            ?>
            <div class="rtpc-sp-attachments rtpc-details-container">
                <div class="rtpc-sp-details">
                    <div class="rtpc-sp-details-box-title">
                        <span>
                            <?php _e("Property Attachments", 'realty-pack-core' ) ?>
                        </span> 
                    </div>
                    <?php 
                echo '<img src="'.$url.'" />';?>
                </div>
            </div>
            <?php
            return;
        }

        echo controller::render_template(
           'widgets/single/attachments.php',
           array(
               'params' => $params,
           ),
           'always'
        );
    
    }

}