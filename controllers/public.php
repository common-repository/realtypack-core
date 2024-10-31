<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Register\RTPC_Controllers_Register_Boot;

class RTPC_Controllers_Public extends RTPC_Controllers_Controller {

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

		// Enqueue front end styles and scriptes
		Actions::add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles', 9999 );
		Actions::add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );
		// Enqueue front end js
		Actions::add_action( 'elementor/frontend/after_enqueue_styles', $this, 'enqueue_elementor_styles' );
		Actions::add_action( 'elementor/frontend/after_register_scripts', $this, 'enqueue_elementor_scripts' );
		// Check for lazy laod option
		$lazyload = get_theme_mod( 'lazy_load_activation', true );
		if ( $lazyload ) {
			Actions::add_filter( 'the_content', $this, 'lazy_load' );
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style(
			RTPC_PREFIX,
			RTPC_ASSETS_URL . 'assets/css/agancy.css',
			array(),
			RTPC_VERSION,
			'all'
		);

		wp_enqueue_style(
			RTPC_PREFIX . '_featherlight',
			RTPC_ASSETS_URL . 'assets/admin/css/featherlight.min.css',
			array(),
			RTPC_VERSION,
			'all'
        );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			RTPC_PREFIX . '_featherlight',
			RTPC_ASSETS_URL . 'assets/admin/js/featherlight.min.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		wp_enqueue_script(
			RTPC_PREFIX . '_lazy',
			RTPC_ASSETS_URL . 'assets/js/plugins/jquery.lazy.min.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		wp_enqueue_script(
			RTPC_PREFIX,
			RTPC_ASSETS_URL . 'assets/js/realty-pack-core' . RTPC_MIN_JS . '.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		$this->inline();
		$this->loclize();

	}

	/**
	 * Register the stylesheets for the admin side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_elementor_styles() {

		wp_enqueue_style(
			RTPC_PREFIX . '_Elementor_Plugins',
			RTPC_ASSETS_URL . 'assets/css/plugins/plugins.min.css',
			array(),
			RTPC_VERSION,
			'all'
		);

		wp_enqueue_style(
			RTPC_PREFIX . '_Elementor',
			RTPC_ASSETS_URL . 'assets/css/realty-pack-core' . RTPC_MIN_CSS . '.css',
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
	public function enqueue_elementor_scripts() {

		wp_enqueue_script(
			RTPC_PREFIX . '_Elementor_Plugins',
			RTPC_ASSETS_URL . 'assets/js/plugins/plugins.min.js',
			array( 'jquery' ),
			RTPC_VERSION,
			false
		);

		wp_enqueue_script(
			RTPC_PREFIX . '_Elementor',
			RTPC_ASSETS_URL . 'assets/js/realty-pack-core-elementor' . RTPC_MIN_JS . '.js',
			array( 'jquery' ),
			RTPC_VERSION,
			true
		);

	}

	/**
	 * Define some loclization to js.
	 *
	 * @since    1.0.0
	 */
	public function loclize(){

		wp_localize_script( 
			RTPC_PREFIX, 
			'rtpc',
			array(
				'adminajax'		=> admin_url( 'admin-ajax.php' ),
			)
		);

	}	

	/**
	 * Add inline styles.
	 *
	 * @since    1.0.0
	 */
	private function inline(){

		$javascript = RTPC_Controllers_Register_Boot::scripts();

		// make filter for inline script
		apply_filters( 'RTPC_front_inline_script', $javascript );

		// add scripts
		wp_add_inline_script( RTPC_PREFIX , $javascript, 'after' );

	}

	public function lazy_load( $content ) {

		return preg_replace_callback( '/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', array( $this, 'preg_lazyload' ), $content );

	}

	public function preg_lazyload( $img_match ) {

		$img_replace = $img_match[1] . $img_match[2] . ' data-src' . substr($img_match[2], 3) . $img_match[3];

		$img_replace = preg_replace( '/class\s*=\s*"/i', 'class="rtp-lazy ', $img_replace );

		$img_replace .= '<noscript>' . $img_match[0] . '</noscript>';

		return $img_replace;

	}

}