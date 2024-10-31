<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\Builder\RTPC_Controllers_Admin_Builder_Boot;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Importer;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Dashboard;

class RTPC_Controllers_Admin_Enqueue extends RTPC_Controllers_Admin_Admin {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->register_hook_callbacks();

	}

	/**
	 * Register callbacks for actions and filters
	 *
	 * @since    1.0.0
	 */
	protected function register_hook_callbacks() {

		Actions::add_action( 'admin_enqueue_scripts', $this, 'enqueue_styles' );
		Actions::add_action( 'admin_enqueue_scripts', $this, 'enqueue_scripts' );
		Actions::add_action( 'customize_save_after', $this, 'flush_after_save_customizer' );

	}

	/**
	 * Register the stylesheets for the admin side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		$realty_core_admin_pages = array(
			'toplevel_page_realty-pack-core',
			'realtypack_page_realty-pack-core-importer',
			'realtypack_page_realty-pack-core-plugins',
			'realtypack_page_realty-pack-core-tutorials',
			'realtypack_page_realty-pack-core-system-status',
			'realtypack_page_realtypack_builder',
		);
		// Avoid affecting other admin pages.
		if ( ! in_array( $hook, $realty_core_admin_pages, true ) ) {
			return;
		}

		if ( defined( 'RTP_ASSETS_URL' ) ) {
			wp_enqueue_style('rtp-grid', RTP_ASSETS_URL . 'css/rtp-grid.min.css');
		}

		wp_enqueue_style(
			RTPC_PREFIX . '_featherlight',
			RTPC_ASSETS_URL . 'assets/admin/css/featherlight.min.css',
			array(),
			RTPC_VERSION,
			'all'
        );

        wp_enqueue_style(
			RTPC_PREFIX . '_Admin',
			RTPC_ASSETS_URL . 'assets/admin/css/admin.css',
			array(),
			RTPC_VERSION,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {


		wp_enqueue_script(
			RTPC_PREFIX,
			RTPC_ASSETS_URL . 'assets/admin/js/admin.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		wp_enqueue_script(
			RTPC_PREFIX . '_featherlight',
			RTPC_ASSETS_URL . 'assets/admin/js/featherlight.min.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		wp_enqueue_script('jquery-ui-progressbar');

		$this->inline();
		$this->loclize();

	}


	/**
	 * Define some loclization to js.
	 *
	 * @since    1.0.0
	 */
	public function loclize(){

		wp_localize_script( RTPC_PREFIX , 'rtpc' , array(
			'adminajax'       => admin_url( 'admin-ajax.php' ),
			'activated'       => esc_html__( 'Activated', 'realty-pack-core' ),
			'activate'        => esc_html__( 'Activate', 'realty-pack-core' ),
		));

	}

	/**
	 * Add inline styles.
	 *
	 * @since    1.0.0
	 */
	private function inline(){
		$javascript = '';

		$javascript .= RTPC_Controllers_Admin_Builder_Boot::scripts();

		$javascript .= RTPC_Controllers_Admin_Dashboard_Plugin::scripts();

		$javascript .= RTPC_Controllers_Admin_Dashboard_Importer::scripts();

		$javascript .= RTPC_Controllers_Admin_Dashboard_Dashboard::scripts();

		// make filter for inline script
		apply_filters( 'RTPC_admin_inline_script', $javascript );

		// add scripts
		wp_add_inline_script( RTPC_PREFIX , $javascript, 'after' );

	}

	public function flush_after_save_customizer(){
		flush_rewrite_rules();
	}

}