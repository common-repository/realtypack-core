<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC;
use RTPC\controllers\RTPC_Controllers_Controller;
use RTPC\controllers\admin\RTPC_Controllers_Admin_Enqueue;
use RTPC\controllers\admin\RTPC_Controllers_Admin_Rating;
use RTPC\controllers\RTPC_Controllers_Public;
use RTPC\models\elementor\RTPC_Models_Elementor_Core;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\RTPC_Lib_i18n as i18n;
use RTPC\Models\RTPC_Models_Model;
use RTPC\Models\RTPC_Models_DB;
use RTPC\Models\RTPC_Models_Ajax;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Boot;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Agent;
use RTPC\Controllers\Wpl\RTPC_Controllers_WPL_Wpl;
use RTPC\Controllers\Admin\Builder\RTPC_Controllers_Admin_Builder_Boot;
use RTPC\controllers\admin\RTPC_Controllers_Admin_Post;
use RTPC\controllers\register\RTPC_Controllers_Register_Boot;
use RTPC\Controllers\Admin\Customizer\RTPC_Controllers_Admin_Customizer_Init;
use RTPC\Controllers\Admin\Widgets\RTPC_Controllers_Admin_Widgets_Boot;

final class RTPC_Lib_Loader {

    /**
     * RTPC Instance
     */
    private static $instance;

    /**
     * RTPC Instance
     */
    public $name;

    /**
     * Provides access to a single instance of a module using the singleton pattern
     */
    public static function get_instance() {

    	if (null === self::$instance) {
    		self::$instance = new self();
    	}
    	return self::$instance;

    }

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {

    	spl_autoload_register(array($this, 'load'));

    	$this->set_locale();

    	$this->register_hook_callbacks();

    }

    /**
     * Loads all Plugin dependencies
     *
     * @since    1.0.0
     */
    private function load($class) {

    	$class_ex = explode('_', strtolower($class));

        // It's not a RTPC Class
    	if (strpos($class_ex[0], strtolower(RTPC_PREFIX)) === false) {
    		return;
    	}

        // Drop 'RTPC'
    	$class_path = array_slice($class_ex, 1);

        // Create Class File Path
    	$file_path = RTPC_PATH . implode('/', $class_path) . '.php';
        // Include it!
    	require_once $file_path;

    }

    /**
     * Define the locale for depc for internationalization.
     *
     * @since    1.0.0
     */
    private function set_locale() {

    	$i18n = new i18n;

    	$i18n->set_domain(RTPC_PREFIX);

    	Actions::add_action('plugins_loaded', $i18n, 'textdomain');

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {

    	register_activation_hook( RTPC_PATH . '/realty-pack-core.php', array( $this, 'activate' ) );

    	register_deactivation_hook( RTPC_PATH . '/realty-pack-core.php', array( $this, 'deactivate' ) );
        // In case if plugin installed sliently 
    	add_action( 'admin_init', array( $this, 'activate' ), 10, 2 );

    	add_action( 'activated_plugin', array( $this, 'detect_core_activation' ), 10, 2 );

    	add_action( 'activated_plugin', array( $this, 'detect_wpl_activation' ), 999 );

    	add_filter( 'plugin_action_links_' . REALTYPACK_CORE_BASENAME , array( $this, 'realtypack_core_links' ), 10, 4 );

        // Check if wpl defined then check for version
        if ( defined( 'WPL_VERSION' ) ) {
            if ( version_compare( WPL_VERSION, '4.4.0', '<' ) ) {
                add_action( 'admin_notices', array( $this, 'render_wpl_error_notice' ) );
            }
        }

    	$this->load_plugins();
    	$this->init_component();
    }

    /**
     * Initiate components of core.
     *
     * @since 1..0.0
     * @access private
     */
    private function init_component() {

    	RTPC_Controllers_Public::get_instance();

    	RTPC_Controllers_Admin_Enqueue::get_instance();

    	RTPC_Models_Elementor_Core::get_instance();

    	RTPC_Controllers_Admin_Post::get_instance();

    	RTPC_Controllers_Admin_Rating::get_instance();

    	RTPC_Controllers_Admin_Dashboard_Boot::get_instance();

    	RTPC_Controllers_Admin_Widgets_Boot::get_instance();

    	RTPC_Controllers_Agency_Boot::get_instance();

    	RTPC_Controllers_Agency_Agent::get_instance();

    	if ( defined( '_WPLEXEC' ) ) {
    		RTPC_Controllers_WPL_Wpl::get_instance();
    	}

    	RTPC_Controllers_Admin_Builder_Boot::get_instance();

    	RTPC_Models_Ajax::get_instance();

    	RTPC_Controllers_Register_Boot::get_instance();

    	RTPC_Controllers_Admin_Customizer_Init::get_instance();

    	Actions::init_actions_filters();
    }

    /**
     * Initiate components of core.
     *
     * @since 1..0.0
     * @access private
     */
    private function load_plugins() {
        /**
         * include Reader files
         */
        $readers_files = array(
        	RTPC_ACF_PATH . 'acf.php',
        	RTPC_PATH . '/app/tgmpa/class-tgm-plugin-activation.php',
        	RTPC_PATH . 'config/plugins.php',
        	RTPC_PATH . 'config/demos.php',
        );

        foreach ( $readers_files as $file ) {
        	require_once $file;
        }

        add_filter( 'acf/settings/url', array( $this ,'acf_config' ) );

    }

    public function acf_config( $url ) {
    	return RTPC_ACF_URL;
    }

    /**
     * Prepares sites to use the plugin during single or network-wide activation
     *
     * @since    1.0.0
     * @param bool $network_wide
     */
    public function activate() {}

    /**
     * Check if wpl is installed process rest of the import
     *
     * @since    1.0.0
     * @param bool $network_wide
     */
    public function detect_wpl_activation() {

    	if ( ! defined( '_WPLEXEC' ) ) {
    		return;
    	}

    	_wpl_import('libraries.db');

    	$db_version = get_option( 'realtypack_wpl_installed', false );

    	if ( false === $db_version ) {
            // include SQL
    		$agent_path =  RTPC_PATH . 'config/agent.sql';
    		RTPC_Models_DB::process_sql( $agent_path );

            // Create agency role
    		RTPC_Controllers_Agency_Boot::agency_role();

    		RTPC_Controllers_Agency_Agent::agent_role();

    		update_option( 'realtypack_wpl_installed', true );
    	}

    }

    function render_wpl_error_notice() {

        echo RTPC_Controllers_Controller::render_template(
            'errors/upgrade-wpl.php',
            array(),
            'always'
        );

    }

    public function detect_core_activation( $plugin ) {

    	if( $plugin !== REALTYPACK_CORE_BASENAME ) {
    		return;
    	}

        // Redirect to Welcome Page.
    	if ( wp_safe_redirect( add_query_arg( array( 'page' => 'realty-pack-core' ), admin_url( 'admin.php' ) ) ) ) {
    		exit();
    	}

    }

    public function realtypack_core_links( $links ) {

    	if ( ! defined( 'RTP_API' ) ) {
    		return $links;
    	}

    	$links = array();

    	$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=realty-pack-core') ) .'">'. esc_html__( 'Dashboard' ) .'</a>';
    	$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=realty-pack-core-importer') ) .'">'. esc_html__( 'Demo Importer' ) .'</a>';
    	$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=realtypack_builder') ) .'">'. esc_html__( 'Single Builder' ) .'</a>';

    	return $links;
    }

    /**
     * Rolls back activation procedures when de-activating the plugin
     *
     * @since    1.0.0
     */
    public function deactivate() {}

}