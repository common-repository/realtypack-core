<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agent;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Agent;
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor single agent cover widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agent_Cover extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agent-cover';
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
        return __( 'Cover Image', 'realty-pack-core' );
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
        return 'eicon-image realtypack-flag';
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
     * Register single agent cover widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
		$this->start_controls_section(
			'section_agent_cover',
			array(
				'label' => __( 'Agent Cover Image', 'realty-pack-core' ),
			)
		);

			$this->add_control(
				'width',
				array(
					'label'       => __( 'Width (PX)', 'realty-pack-core' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'     => 1920,
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
					'default'     => 465,
					'min'         => 100,
					'max'         => 1500,
					'step'        => 100,
				)
			);

		$this->end_controls_section();
    }

    /**
     * Render single agent cover widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        //Settings
    	$settings = $this->get_settings_for_display();

    	$id = get_query_var( 'agent_id' );
        $image  = '';
        $alt    = '';

    	if ( $id ) {
            // get Images
            $user_info = RTPC_WPL_User::get_user_cover_image( $id );

            // Simple check
            if ( ! isset( $user_info->agent_cover ) ) { 
                return;
            }

            $image = \RTP_Image::edit_attachment_media( null, $user_info->agent_cover['url'], array( $settings['width'] , $settings['height'] ) );
            $alt = $user_info->agent_cover['name'];
    	}

    	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    		$image =  RTPC_ASSETS_URL . 'assets/admin/img/agent_builder/cover.jpg';
    	}

    	echo controller::render_template(
    		'widgets/agent/cover.php',
    		array(
    			'settings'    =>	$settings,
    			'image'       =>	$image,
                'alt'         =>    $alt
    		),
    		'always'
    	);
    }

}