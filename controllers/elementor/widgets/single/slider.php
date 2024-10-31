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
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_Slider extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'single-slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve image carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Single Slider', 'realty-pack-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve image carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-device realtypack-flag';
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
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'swiper' ];
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
        return array('RTPC_single_Builder');
    }

    /**
     * Register image carousel widget controls.
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
                'label' => __('Slider Configuration', 'realty-pack-core'),
            )
        );

            $this->add_control(
                'enable_image',
                array(
                    'label'        => __( 'Enable Image Crop', 'realty-pack-core' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'realty-pack-core' ),
                    'label_off'    => __( 'Off', 'realty-pack-core' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );			

            $this->add_control(
                'image_width',
                array(
                    'label'        => __( 'Image Width (PX)', 'realty-pack-core' ),
                    'type'         => \Elementor\Controls_Manager::TEXT,
                    'label_on'     => __( 'Show', 'realty-pack-core' ),
                    'label_off'    => __( 'Hide', 'realty-pack-core' ),
                    'return_value' => '1390',
                    'default'      => '1390',
                )
            );            

            $this->add_control(
				'image_height',
				array(
					'label'        => __( 'Image Height (PX)', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::TEXT,
					'return_value' => '624',
					'default'      => '624',
				)
			);

        $this->end_controls_section();
    }

    /**
     * Render image carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
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
            $array_image = \wpl_items::get_gallery( $pid );
            // slider
            if( isset( $array_image[0] ) ) {

                $images = array();

                foreach ( $array_image as $gallery ) {
                    if( isset( $gallery['raw']['item_cat'] ) && $gallery['raw']['item_cat'] != 'external' ) {
                        if ( $settings['enable_image'] == 'yes' ) {
                            $image_url = \RTP_Image::edit_attachment_media( null, $gallery['url'], array( $settings['image_width'], $settings['image_height'] ) );
                        } else {
                            $image_url = $gallery['url'];
                        }
                    } else {
                        if( $gallery['raw']['item_extra1'] != NULL ) {
                            $image_url = $gallery['raw']['item_extra1'];
                        } else if ( $gallery['raw']['item_extra2'] != NULL) {
                            $image_url = $gallery['raw']['item_extra2'];
                        } else if ( $gallery['raw']['item_extra3'] != NULL) {
                            $image_url = $gallery['raw']['item_extra3'];
                        } else if ( $gallery['raw']['item_extra4'] != NULL) {
                            $image_url = $gallery['raw']['item_extra4'];
                        } else if ( $gallery['raw']['item_extra5'] != NULL) {
                            $image_url = $gallery['raw']['item_extra5'];
                        }
                    }

                    $images[] = $image_url;
                }
            }
        } 

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $images[0] =  RTPC_ASSETS_URL . 'assets/admin/img/property_builder/13711975_l@2x.png';
        }

        if ( !isset( $images ) ) {
            return;
        }

        echo controller::render_template(
            'widgets/single/slider.php',
            array(
                'settings'  => $settings,
                'images'    => $images,
            ),
            'always'
        );

    }

}