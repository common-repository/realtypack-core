<?php

/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Elementor;

use RTPC\Models\RTPC_Models_Model;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Elementor\Controls\RTPC_Controllers_Elementor_Controls_Search as Controls_Search;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Title;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Testimonial;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_PropertyListing;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Agents;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_IconBox;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Button;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_PropertyListingCarousal;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Newsletter;
use RTPC\Controllers\Elementor\Modules\RTPC_Controllers_Elementor_Modules_Advance;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Recentposts;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_ListingSearch;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_agencylist;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Agentlist;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_CitiesMasonry;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Iconboxcarousel;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_Pricing;
use RTPC\Controllers\Elementor\Widgets\RTPC_Controllers_Elementor_Widgets_RecentProperty;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_ListingContact;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_UnitSwitcher;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Slider;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Description;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_QR;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Title;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Link;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Refresh;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Favorite;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Print;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Details;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Energy;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_WalkScore;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Attachments;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Videos;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_GoogleMap;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_Agent;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_SimilarProperties;
use RTPC\Controllers\Elementor\Widgets\Single\RTPC_Controllers_Elementor_Widgets_Single_AgencyContact;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Cover;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Logo;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Title;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Details;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Description;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Contact;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Socials;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Statistics;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Button;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_GoogleMap;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_PropertyListing;
use RTPC\Controllers\Elementor\Widgets\Agency\RTPC_Controllers_Elementor_Widgets_Agency_Agentlist;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Cover;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Profilepicture;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Title;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Socials;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Details;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Button;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Description;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_Contact;
use RTPC\Controllers\Elementor\Widgets\Agent\RTPC_Controllers_Elementor_Widgets_Agent_PropertyListing;

/**
 * Main Elementor init Class
 *
 * @since 1.0.0
 */
final class RTPC_Models_Elementor_Core extends RTPC_Models_Model {

    /**
     * Registered icons.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $icons = NULL;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {

    	add_action('plugins_loaded', [$this, 'register_hook_callbacks']);

    }

    /**
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function register_hook_callbacks() {

        // Load includes
    	$this->includes();

        // Register categories, widgets, controls 
    	add_action( 'elementor/elements/categories_registered', array( $this, 'init_widget_category' ) );
    	add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
    	add_action( 'elementor/controls/controls_registered', array( $this, 'add_custom_icons' ) );

    }

    /**
     * Loads all icons
     *
     * @return mixed|null|void
     */
    public static function register_icons() {

        if ( ! is_null( self::$icons ) ) {
            return self::$icons;
        }

        return self::$icons = apply_filters( 'rtpc/elementor/add/icon', array() );
    }

    /**
     * Includes all nessecry assets
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function includes() {
        // Add Post types support
    	add_post_type_support( 'RTPC_footer', 'elementor' );

    	RTPC_Controllers_Elementor_Modules_Advance::get_instance();
    }

    /**
     * Add Rtp Widgets Category
     *
     * @since 1.0
     */
    function init_widget_category($elements_manager) {

    	$elements_manager->add_category(
    		'RTPC_catergory',
    		array(
    			'title' => __( 'RealtyPack', 'realty-pack-core' ),
    			'icon' => 'fa fa-plug',
    		)
    	);

    	$elements_manager->add_category(
    		'RTPC_single_Builder',
    		array(
    			'title' => __( 'RealtyPack Single Builder', 'realty-pack-core' ),
    			'icon' => 'fa fa-plug',
    		)
    	);

    	$elements_manager->add_category(
    		'RTPC_Agency_Builder',
    		array(
    			'title' => __( 'RealtyPack Agency Builder', 'realty-pack-core' ),
    			'icon' => 'fa fa-plug',
    		)
    	);        

    	$elements_manager->add_category(
    		'RTPC_Agent_Builder',
    		array(
    			'title' => __( 'RealtyPack Agent Builder', 'realty-pack-core' ),
    			'icon' => 'fa fa-plug',
    		)
    	);        

    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets() {
    	global $post;

        // Register widget
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Title());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Button());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_PropertyListing());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_PropertyListingCarousal());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_IconBox());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Testimonial());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agents());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Recentposts());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Newsletter());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_ListingSearch());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_AgencyList());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agentlist());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_CitiesMasonry());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Iconboxcarousel());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Pricing());
    	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_RecentProperty());

    	if ( isset( $post->post_type ) && 'property_builder' == $post->post_type && defined( '_WPLEXEC' ) ) {

    		/** import library **/
    		_wpl_import('libraries.activities');

    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_ListingContact());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_UnitSwitcher());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Slider());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Description());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_QR());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Title());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Link());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Refresh());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Favorite());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Print());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Details());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Energy());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_WalkScore());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Attachments());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Videos());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_GoogleMap());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_Agent());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_SimilarProperties());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Single_AgencyContact());

    	}        

    	if ( isset( $post->post_type ) && 'agency_builder' == $post->post_type && defined( '_WPLEXEC' ) ) {

    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Cover());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Logo());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Title());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Details());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Description());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Contact());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Socials());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Statistics());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Button());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_GoogleMap());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_PropertyListing());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agency_Agentlist());

    	}

    	if ( isset( $post->post_type ) && 'agent_builder' == $post->post_type && defined( '_WPLEXEC' ) ) {

    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Cover());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Profilepicture());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Title());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Socials());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Details());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Button());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Description());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_Contact());
    		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new RTPC_Controllers_Elementor_Widgets_Agent_PropertyListing());

    	}

    }

    /**
     * Adding custom icon to icon control in Elementor
     */
    public function add_custom_icons( $controls_registry ) {
        // Get existing icons
    	$icons = $controls_registry->get_control('icon')->get_settings('options');

    	// Include icons
    	require_once RTPC_PATH . 'config/icons.php';

        // Append new icons
    	$new_icons = self::register_icons();

		$controls_registry->get_control('icon')->set_settings( 'options', $new_icons );

	}

}
