<?php
/**
 *
 * @link   		https://eightqueens.pro
 * @since  		1.0.0
 * @package		EightQueens Theme Core Plugin
 *
 * Plugin Name: RealtyPack Core
 * Description: RealtyPack real estate theme core plugin, Elementor widgets, Demo Importer, Live Customizer options and many useful settings will be added to RealtyPack via this plugin.
 * Plugin URI:  https://www.eightqueens.pro/realtypack/landing
 * Version:     1.0.5
 * Author:      EightQueens
 * Author URI:  https://www.eightqueens.pro
 * Text Domain: RTPC
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
/**
*  Run main class
*/
class RTPC {

	/**
	 *  Php version required
	 */
	const  RTPC_PHP_VERSION = '5.4';

	/**
	 * Wp Version required
	 */
	const  RTPC_REQUIRED_WP_VERSION = '4.5';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Activation Cunstructor
	 */
	public function __construct() {
		//Check requirements and load main class
		if ( $this->requirements_needs() ) {

			$this->define_constants();

			require_once RTPC_PATH . 'lib/core.php';

		} else {

			add_action( 'admin_notices', array( &$this, 'requirements_error' ) );

			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			deactivate_plugins( plugin_basename( __FILE__ ) );

		}
	}

    /**
     * Define constants.
     *
     * @since 1.0.0
     * @return void
     */
    public function define_constants() {

        // Define version.
        define( 'RTPC_VERSION', '1.0.5' );
        define( 'REALTYPACK_CORE_BASENAME', plugin_basename( __FILE__ ) );

        // Define paths.
        if ( ! defined( 'RTPC_PATH' ) ) {
            define( 'RTPC_PATH', wp_normalize_path( plugin_dir_path( __FILE__ ) ) );
            define( 'RTPC_ACF_PATH', RTPC_PATH . '/app/acf/' );
        }

        // Define url.
        if ( ! defined( 'RTPC_URL' ) ) {
            define('RTPC_URL', trailingslashit( plugins_url( '' , __FILE__ ) ) );
            define( 'RTPC_ACF_URL', RTPC_URL . '/app/acf/' );
        }

        // Define prefix and assets
        define('RTPC_PREFIX', 'RTPC' );
        define('RTPC_ASSETS_PATH', RTPC_PATH . 'views/');
        define('RTPC_ASSETS_URL', RTPC_URL . 'views/');
        define('RTPC_TPL_PATH', RTPC_PATH . 'views/tpl/');

        // Mode.
		if ( ! defined( 'SCRIPT_DEBUG' ) ) {
			define( 'SCRIPT_DEBUG', false ); // Valid use case as we need it defined.
		}

		// Assets.
		define( 'RTPC_MIN_CSS', SCRIPT_DEBUG ? '' : '.min' );
		define( 'RTPC_MIN_JS', SCRIPT_DEBUG ? '' : '.min' );

    }

	/**
	 * Checks if the system requirements are met
	 *
	 * @since    1.0.0
	 * @return bool True if system requirements are met, false if not
	 */
	public function requirements_needs() {

		global $wp_version;

		if ( version_compare( self::RTPC_PHP_VERSION ,  PHP_VERSION, '>' ) ) {
			return false;
		}

		if ( version_compare( $wp_version, self::RTPC_REQUIRED_WP_VERSION, '<' ) ) {
			return false;
		}

		return true;

	}

	/**
	 * Prints an error that the system requirements weren't met.
	 *
	 * @since    1.0.0
	 */
	public function requirements_error() {

		global $wp_version;
		require_once( dirname( __FILE__ ) . '/views/tpl/errors/requirements-error.php' );

	}
}

new RTPC;
