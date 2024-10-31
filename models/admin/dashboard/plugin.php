<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Admin\Dashboard;

use RTPC\Models\RTPC_Models_Model;

class RTPC_Models_Admin_Dashboard_Plugin extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {
		$this->register_hook_callbacks();
	}

	public function register_hook_callbacks() {}

	public function activate_plugin( $path ) {
		// First try to activation
		$activate = activate_plugin( $path );

		if ( ! is_wp_error( $activate ) ) {
			return true;
		}

		// // Get all plugins
		// $current = get_option( 'active_plugins' );
		// // RealtyPack core address
		// $plugin_main_filename  = plugin_basename( trim( $path ) );

		// if ( ! in_array( $plugin_main_filename, $current ) ) {

		// 	// Add RealtyPack 
		// 	$current[] = $plugin_main_filename;
		// 	sort( $current );

		// 	// Acticate our core
		// 	do_action( 'activate_plugin', trim( $plugin_main_filename ) , '' , false );
		// 	update_option( 'active_plugins', $current );
		// 	do_action( 'activate_' . trim( $plugin_main_filename ) );
		// 	do_action( 'activated_plugin', trim( $plugin_main_filename ) );
			
		// 	return true;
		// }

		return false;
	}
}