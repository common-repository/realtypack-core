<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor agency list widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_AgencyList extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rtpc-agency-list';
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
        return __( 'Agency List', 'realty-pack-core' );
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
        return 'eicon-sitemap realtypack-flag';
    }

    /**
     * Get widget keywords.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['agency', 'photo', 'blogs'];
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
        return array('RTPC_catergory');
    }

    /**
     * Register agency list widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

    	$this->start_controls_section(
    		'section_image_carousel',
    		[
    			'label' => __( 'Agency List', 'realty-pack-core' ),
    		]
    	);

	    	$this->add_control(
	    		'show_agency_with_image',
	    		array(
	    			'label'        => __( 'Show Agency With Images', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		)
	    	);

	    	$this->add_control(
	    		'show_agents',
	    		[
	    			'label'        => __( 'Show Agents', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'items_number',
	    		array(
	    			'label'       => __( 'Number of agency per page', 'realty-pack-core' ),
	    			'label_block' => true,
	    			'type'        => \Elementor\Controls_Manager::NUMBER,
	    			'default'     => '4',
	    			'min'         => 1,
	    			'max'         => 12,
	    			'step'        => 1
	    		)
	    	);

	    	$this->add_control(
	    		'show_address',
	    		[
	    			'label'        => __( 'Show Address', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'show_social',
	    		[
	    			'label'        => __( 'Show Social', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'show_phone',
	    		[
	    			'label'        => __( 'Show Phone', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'show_fax',
	    		[
	    			'label'        => __( 'Show Fax', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'show_email',
	    		[
	    			'label'        => __( 'Show Email', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

	    	$this->add_control(
	    		'show_website',
	    		[
	    			'label'        => __( 'Show Website', 'realty-pack-core' ),
	    			'type'         => \Elementor\Controls_Manager::SWITCHER,
	    			'label_on'     => __('Show', 'realty-pack-core'),
	    			'label_off'    => __('Hide', 'realty-pack-core'),
	    			'return_value' => 'yes',
	    			'default'      => 'yes',
	    		]
	    	);

    	$this->end_controls_section();

    	$this->start_controls_section(
    		'section_style_content',
    		[
    			'label' => __( 'Header', 'realty-pack-core' ),
    			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    		]
    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label'    => __( 'Header typography', 'realty-pack-core' ),
	    			'name'     => 'header_typography',
	    			'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector' => '{{WRAPPER}} .rtpc-agency-title a',
	    		]
	    	);

	    	$this->add_control(
	    		'header_color',
	    		[
	    			'label'     => __( 'Header Color', 'realty-pack-core' ),
	    			'type'      => \Elementor\Controls_Manager::COLOR,
	    			'default'   => '#6A11CB',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-agency-title a'             => 'color: {{VALUE}};',
	    				'{{WRAPPER}} .rtpc-agency-listed-properties a' => 'color: {{VALUE}};',
	    			],
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label'    => __( 'Address Typography', 'realty-pack-core' ),
	    			'name'     => 'address_typography',
	    			'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector' => '{{WRAPPER}} .rtpc-agency-address',
	    		]
	    	);

	    	$this->add_control(
	    		'address_color',
	    		[
	    			'label'     => __( 'Address Color', 'realty-pack-core' ),
	    			'type'      => \Elementor\Controls_Manager::COLOR,
	    			'default'   => '#828282',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-agency-address' => 'color: {{VALUE}};',

	    			],
	    		]
	    	);

	    	$this->add_control(
	    		'hr',
	    		[
	    			'type'  => \Elementor\Controls_Manager::DIVIDER,
	    			'style' => 'thick',
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label'          => __( 'Labels Typography', 'realty-pack-core' ),
	    			'name'           => 'labels_typography',
	    			'scheme'         => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector'       => '{{WRAPPER}} .rtpc-agency-contact-title',
	    			'fields_options' => [
	                    // Inner control name
	    				'font_weight' => [
	                        // Inner control settings
	    					'default' => '400',
	    				],
	    				'font_family' => [
	    					'default' => 'Poppins',
	    				],
	    				'font_size'   => [
	    					'default' => ['unit' => 'px', 'size' => 16],
	    				],
	    			],
	    		]
	    	);

	    	$this->add_control(
	    		'labels_color',
	    		[
	    			'label'     => __( 'Labels Color', 'realty-pack-core' ),
	    			'type'      => \Elementor\Controls_Manager::COLOR,
	    			'default'   => 'rgba(70,70,70,0.7)',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-agency-contact-title' => 'color: {{VALUE}};',
	    			],
	    		]
	    	);

	    	$this->add_group_control(
	    		\Elementor\Group_Control_Typography::get_type(),
	    		[
	    			'label'    => __( 'Contents Typography', 'realty-pack-core' ),
	    			'name'     => 'Contents_typography',
	    			'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	    			'selector' => '{{WRAPPER}} .rtpc-agency-contact-content , {{WRAPPER}} .rtpc-agency-details i',

	    		]
	    	);

	    	$this->add_control(
	    		'contents_color',
	    		[
	    			'label'     => __( 'Contents Color', 'realty-pack-core' ),
	    			'type'      => \Elementor\Controls_Manager::COLOR,
	    			'default'   => '#000000',
	    			'selectors' => [
	    				'{{WRAPPER}} .rtpc-agency-contact-content' => 'color: {{VALUE}};',
	    				'{{WRAPPER}} .rtpc-agency-details i'       => 'color: {{VALUE}};',

	    			],
	    		]
	    	);

    	$this->end_controls_section();

    }

    /**
     * Render agency list widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
    	global $wpdb;

    	$settings  = $this->get_settings_for_display();
    	$user_info = array();

    	$pagination_link    =   "";
    	$query              =   "SELECT * FROM {$wpdb->prefix}wpl_users WHERE `id` > 0 AND membership_type = '4' AND company_logo > ''";
    	$total_query        =   "SELECT COUNT(1) FROM (${query}) AS combined_table";
    	$total              =   $wpdb->get_var( $total_query );
    	$items_per_page     =   $settings['items_number'];
    	$page               =   isset( $_GET['agencylist'] ) ? abs( (int) $_GET['agencylist'] ) : 1;
    	$offset             =   ( $page * $items_per_page ) - $items_per_page;
    	$wpl_users          =   $wpdb->get_results( $query . " ORDER BY id ASC LIMIT ${offset}, ${items_per_page}" );
    	$totalPage          =   ceil($total / $items_per_page);

    	for ( $i=0; $i < $settings['items_number']; $i++ ) {
    		if ( isset( $wpl_users[$i]->id ) ) {
    			$user_info[] = RTPC_WPL_User::get_user_info_agency( $wpl_users[$i]->id );
    		} else {
    			break;
    		}
    	}

    	if( $totalPage > 1 ) {

    		$pagination_link     =  paginate_links( 
    			array(
    				'base' => add_query_arg( 'agencylist', '%#%' ),
    				'format' => '',
    				'prev_text' => __( 'Previous' ,  'realty-pack-core' ),
    				'next_text' => __( 'Next' ,  'realty-pack-core' ),
    				'total' => $totalPage,
    				'current' => $page,
    				'type'    => 'list'
    			)
    		);

    	}

    	echo controller::render_template(
    		'widgets/agencylist.php',
    		array(
    			'settings'          => $settings,
    			'user_info'         => $user_info,
    			'pagination_link'   => $pagination_link,
    		),
    		'always'
    	);

    }

}