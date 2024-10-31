<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Customizer;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Admin;

final class RTPC_Controllers_Admin_Customizer_Init extends RTPC_Controllers_Admin_Admin{
	
	/**
	 * Registered panels.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public static $panels = NULL;

	/**
	 * Registered sections.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public static $sections = NULL;

	/**
	 * Registered settings.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public static $fields = NULL;

	/**
	 * Configuration ID.
	 *
	 * Defined for Kirki.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $config_id = 'rtp';

	/**
	 * Construct the class.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {
		$this->register_hook_callbacks();
	}

	/**
	 * Construct the class.
	 *
	 * @since 1.0.0
	 */
	public function register_hook_callbacks() {
		// Action hook
		Actions::add_action( 'customize_controls_enqueue_scripts', $this, 'enqueue_scripts' );
		Actions::add_action( 'init', $this, 'customizer_init' );
	}

	/**
	 * Construct the class.
	 *
	 * @since 1.0.0
	 */
	public function customizer_init() {

		// Include files
		if ( ! is_customize_preview() ) {
			return;
		}

		// Include files
		require_once RTPC_PATH . 'app/kirki/kirki.php';
		require_once RTPC_PATH . 'config/customizer.php';

		self::add_config();
		self::add_panels();
		self::add_sections();
		self::add_fields();
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'RTP-Customizer', RTPC_ASSETS_URL . 'assets/admin/css/customizer.css', array() , RTPC_VERSION );
	}

	/**
	 * Loads all tabpane and return
	 *
	 * @return mixed|null|void
	 */
	public static function register_panels() {

		if ( ! is_null( self::$panels ) ) {
			return self::$panels;
		}

		return self::$panels = apply_filters( 'rtp/customizer/add/panels', array() );
	}

	/**
	 * Loads all tabpane and return
	 *
	 * @return mixed|null|void
	 */
	public static function register_sections() {

		if ( ! is_null( self::$sections ) ) {
			return self::$sections;
		}

		return self::$sections = apply_filters( 'rtp/customizer/add/sections', array() );
	}

	/**
	 * Loads all tabpane and return
	 *
	 * @return mixed|null|void
	 */
	public static function register_fields() {

		if ( ! is_null( self::$fields ) ) {
			return self::$fields;
		}

		return self::$fields = apply_filters( 'rtp/customizer/add/fields', array() );
	}

	/**
	 * Add panels
	 *
	 * @return mixed|null|void
	 */
	public static function add_config() {
		\Kirki::add_config(self::$config_id, 
			array(
				'capability'  => 'edit_theme_options',
				'option_type' => 'theme_mod',
			)
		);
	}

	/**
	 * Add panels
	 *
	 * @return mixed|null|void
	 */
	public static function add_panels() {
		$panels = self::register_panels();
		foreach ($panels as $panel) {
			\kirki::add_panel($panel['id'], $panel);
		}
	}

	/**
	 * Add sections
	 *
	 * @return mixed|null|void
	 */
	public static function add_sections() {
		$sections = self::register_sections();
		foreach ($sections as $section) {
			\Kirki::add_section($section['name'], $section);
		}
	}

	/**
	 * Add fields
	 *
	 * @return mixed|null|void
	 */
	public static function add_fields() {
		$fields = self::register_fields();
		foreach ($fields as $field) {
			\Kirki::add_field(self::$config_id, $field);
		}
	}
}
