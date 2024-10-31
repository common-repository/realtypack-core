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
use RTPC\WPL\RTPC_WPL_User;

/**
 * Elementor single agency contact widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Single_AgencyContact extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'single-agency-contact';
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
		return __( 'Agency Contact', 'realty-pack-core' );
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
		return 'eicon-home-heart realtypack-flag';
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
	 * Register single agency contact widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Description Configuration', 'realty-pack-core' ),
			)
		);

			$this->add_control(
				'show_name',
				array(
					'label'        => __( 'Show Name', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);              

			$this->add_control(
				'show_phone',
				array(
					'label'        => __( 'Show Phone', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);           

			$this->add_control(
				'show_desc',
				array(
					'label'        => __( 'Show Descriptions', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			); 

			$this->add_control(
				'show_email',
				array(
					'label'        => __( 'Show Email', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'show_socials',
				array(
					'label'        => __( 'Show Socials', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);    

			$this->add_control(
				'show_skype',
				array(
					'label'        => __( 'Show Skype Id', 'realty-pack-core' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'realty-pack-core' ),
					'label_off'    => __( 'Off', 'realty-pack-core' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

		$this->end_controls_section();
	}

	/**
	 * Render single agency contact widget output on the frontend.
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

			$user_id 	= RTPC_WPL_User::get_properties_user_id( $pid, 'loadAssoc' );
			$user_id 	= $user_id['user_id'];

			$query 		 = "SELECT `id` FROM `#__wpl_users` WHERE rtp_agent_list LIKE '$user_id,%' OR rtp_agent_list LIKE '%,$user_id,%' OR rtp_agent_list LIKE '%,$user_id'";

			$agency_id 	 = \wpl_db::select( $query, 'loadResult' );

			// Check if listing has not agency return it
			if ( '' == $agency_id || is_null( $agency_id ) ) {
				return;
			}

			$agency_data = RTPC_WPL_User::get_user_info_agency( $agency_id );

			// Image
			$image	=	\RTP_Image::edit_attachment_media( null, $agency_data->company_logo['url'], array( 105 , 105 ) );
            // Company name
			$company_name = ( isset( $agency_data->wpl_data->company_name ) && $agency_data->wpl_data->company_name !== '' ) ? $agency_data->wpl_data->company_name : $agency_data->data->meta->company_name;
            // About
			$about = ( isset( $agency_data->wpl_data->about ) && $agency_data->wpl_data->about !== '' ) ? $agency_data->wpl_data->about : $agency_data->data->meta->about;
            // Email
			$secondary_email = ( isset( $agency_data->wpl_data->secondary_email ) && $agency_data->wpl_data->secondary_email !== '' ) ? $agency_data->wpl_data->secondary_email : '';
            // Facebook
			$r_facebook = ( isset( $agency_data->wpl_data->r_facebook ) && $agency_data->wpl_data->r_facebook !== '' ) ? $agency_data->wpl_data->r_facebook : '';
            // Twitter
			$r_twitter  = ( isset( $agency_data->wpl_data->r_twitter ) && $agency_data->wpl_data->r_twitter !== '' ) ? $agency_data->wpl_data->r_twitter : '';
            // Pinterest
			$r_pinterest = ( isset( $agency_data->wpl_data->r_pinterest ) && $agency_data->wpl_data->r_pinterest !== '' ) ? $agency_data->wpl_data->r_pinterest : '';
            // r_skype
			$r_skype = ( isset( $agency_data->wpl_data->r_skype ) && $agency_data->wpl_data->r_skype !== '' ) ? $agency_data->wpl_data->r_skype : '';
            // tel
			$tel = ( isset( $agency_data->wpl_data->tel ) && $agency_data->wpl_data->tel !== '' ) ? $agency_data->wpl_data->tel : '';
			// Listing link
			$link = ( isset( $agency_data->link ) && $agency_data->link !== '' ) ? $agency_data->link : '';
			// Listing link
			$listing_link = ( isset( $agency_data->listing_link ) && $agency_data->listing_link !== '' ) ? $agency_data->listing_link : '';
			// Lisiting contact
			$listing_count = ( isset( $agency_data->listing_count ) && $agency_data->listing_count !== '' ) ? $agency_data->listing_count : '';
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {

			$pid 	 	 		=	0;
			$agency_id 	 		=	0;
			$image				=	\RTP_Image::edit_attachment_media( null, RTPC_ASSETS_URL . 'assets/admin/img/agency_builder/logo.jpg', array( 105 , 105 ) );
			$company_name 		=	esc_html( 'Awesome Homes Real Estate', 'realty-pack-core' );
			$about 				=	esc_html( 'Modern House Real Estate was founded in 2014 by a small group of dedicated and enthusiastic real estate experts', 'realty-pack-core' );
			$secondary_email 	=	esc_html( 'AwesomeHomesRE@eightqueens.pro' , 'realty-pack-core' );
			$r_facebook 		=	esc_html( 'facebook.com/facebook' , 'realty-pack-core' );
			$r_twitter  		=	esc_html( 'twitter.com/twitter' , 'realty-pack-core' );
			$r_pinterest 		=	esc_html( 'pintrest.com/pintrest' , 'realty-pack-core' );
			$r_skype 			=	esc_html( '@skype' , 'realty-pack-core' );
			$tel 				=	esc_html( '(123) 555-3456' , 'realty-pack-core' );
			$link 				=	'#';
			$listing_link 		=	'#';
			$listing_count 		=	'0';

		}

		echo controller::render_template(
			'widgets/single/agency-contact.php',
			array(
				'settings'      	=>	$settings,
				'pid'     			=>	$pid,
				'agency_id'     	=>	$agency_id,
				'image'    			=>	$image,
				'company_name'  	=>	$company_name,
				'about'    			=>	$about,
				'secondary_email'	=>	$secondary_email,
				'r_facebook'    	=>	$r_facebook,
				'r_twitter'    		=>	$r_twitter,
				'r_pinterest'    	=>	$r_pinterest,
				'r_skype'    		=>	$r_skype,
				'tel'    			=>	$tel,
				'link'    			=>	$link,
				'listing_link'    	=>	$listing_link,
				'listing_count'    	=>	$listing_count,
			),
			'always'
		);

	}

}