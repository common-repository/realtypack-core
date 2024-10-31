<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC;

final class RTPC_Lib_Core {

	/**
	 * The modules variable holds all modules of the DEPC.
	 */
	private static $modules = array();

	/**
	 * DEPC Instance
	 */
	private static $instance;

	/**
	 * Disable class cloning and throw an error on object clone.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'realty-pack-core' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'realty-pack-core' ), '1.0.0' );
	}

	/**
	 * 
	 */
	public function __construct() {
		
		$this->register_autoloader();

	}

	/**
	 * Provides access to a single instance of a module using the singleton pattern
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	/**
	 * Register autoloader.
	 *
	 * Elementor autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	private function register_autoloader() {

		require_once RTPC_PATH . 'lib/loader.php';

		RTPC_Lib_Loader::get_instance();

	}

}

RTPC_Lib_Core::get_instance();