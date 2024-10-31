<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agency;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Agent;
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor single agency logo widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_Logo extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-logo';
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
        return __( 'Agency Logo', 'realty-pack-core' );
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
        return 'eicon-featured-image realtypack-flag';
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
     * Register single agency logo widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
		$this->start_controls_section(
			'section_agency_log',
			array(
				'label' => __( 'Agency Logo', 'realty-pack-core' ),
			)
		);

			$this->add_control(
				'width',
				array(
					'label'       => __( 'Width (PX)', 'realty-pack-core' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'     => 328,
					'min'         => 100,
					'step'        => 100,
				)
			);

			$this->add_control(
				'height',
				array(
					'label'       => __( 'Height (PX)', 'realty-pack-core' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'     => 361,
					'min'         => 100,
					'max'         => 1500,
					'step'        => 100,
				)
			);

		$this->end_controls_section();
    }

    /**
     * Render single agency logo widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        //Settings
    	$settings = $this->get_settings_for_display();

    	$id = get_query_var( 'agency_id' );
        $image  = '';
        $alt    = '';

    	if ( $id ) {
            // get Images
            $user_info = RTPC_WPL_User::get_agency_logo( $id );

            // Simple check
            if ( ! isset( $user_info->company_logo ) ) { 
                return;
            }

            $image = \RTP_Image::edit_attachment_media( null, $user_info->company_logo['url'], array( $settings['width'] , $settings['height'] ) );
            $alt = $user_info->company_logo['name'];
    	}

    	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    		$image =  RTPC_ASSETS_URL . 'assets/admin/img/agency_builder/logo.jpg';
    	}

    	echo controller::render_template(
    		'widgets/agency/logo.php',
    		array(
    			'settings'    =>	$settings,
    			'image'       =>	$image,
                'alt'         =>    $alt
    		),
    		'always'
    	);

    }

}