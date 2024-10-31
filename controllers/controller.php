<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers;

abstract class RTPC_Controllers_Controller {

	private static $instances = array();
	protected $model;
	protected $user_setting;

	/**
	 * Provides access to a single instance of a module using the singleton pattern
	 *
	 * @since    1.0.0
	 */
	public static function get_instance() {

		$classname = get_called_class();

		if ( ! isset( self::$instances[ $classname ] ) ) {
			self::$instances[ $classname ] = new $classname();
		}
		return self::$instances[ $classname ];

	}

	/**
	 * Get model
	 *
	 * @since    1.0.0
	 */
	protected static function get_model() {

		return static::get_instance()->model;

	}

	/**
	 * Render a template
	 *
	 * @since    1.0.0
	 */
	public static function render_template( $default_template_path = false, $variables = array(), $require = 'once' ) {

		if ( ! $template_path = locate_template( basename( $default_template_path ) ) ) {
			$template_path =  RTPC_TPL_PATH . $default_template_path;
		}

		if ( is_file( $template_path ) ) {
			extract( $variables );
			ob_start();
			if ( 'always' == $require ) {
				require( $template_path );
			} else {
				require_once( $template_path );
			}
			$template_content = apply_filters( 'RTPC_template_content', ob_get_clean(), $default_template_path, $template_path, $variables );
		} else {
			$template_content = '';
		}

		return $template_content;
	}

    /**
	 * Search widget of WPL
	 *
	 * @since    1.0.0
     */
    public static function widget_instance( $widget_id, $class, $settings ) {

    	$wp_registered_widgets = self::get_registered_widgets();

	    // validation
    	if( !array_key_exists( $widget_id, $wp_registered_widgets) ) {
    		return false;
    	}

    	$params = array_merge(array(array_merge(array('widget_id'=>$widget_id, 'widget_name'=>$wp_registered_widgets[$widget_id]['name']))), (array) $wp_registered_widgets[$widget_id]['params']);

    	$callback = $wp_registered_widgets[$widget_id]['callback'];

    	$class->number = $callback[0]->number;
    	$class->id = $callback[0]->id;
    	$class->elementor_settings = $settings;
    	$class = array( 0 => $class, 1 => 'display_callback' );

    	if( is_callable( $class ) ) {
    		call_user_func_array( $class, $params );
    	}
    }

    /**
     * Get registered widgets
     * @return array
     */
    public static function get_registered_widgets()
    {
    	global $wp_registered_widgets;
    	return $wp_registered_widgets;
    }

	/**
	 * Clears caches of content generated by caching plugins like WP Super Cache
	 *
	 * @since    1.0.0
	 */
	protected static function clear_caching_plugins() {

		// WP Super Cache
		if ( function_exists( 'wp_cache_clear_cache' ) ) {
			wp_cache_clear_cache();
		}

		// W3 Total Cache
		if ( class_exists( 'W3_Plugin_TotalCacheAdmin' ) ) {
			$w3_total_cache = w3_instance( 'W3_Plugin_TotalCacheAdmin' );
			if ( method_exists( $w3_total_cache, 'flush_all' ) ) {
				$w3_total_cache->flush_all();
			}
		}
		
	}

    /**
     * Remote get a url using wordpress functions.
     *
     * @since 1.0.0
     *
     * @param string $url url
     * @return bool True when a plugin needs to be updated, otherwise false.
     */
    public static function remote_get( $url ) {
     	// Request
    	$request = wp_remote_get( $url );

    	if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) != 200 ) {
    		return false;
    	}

    	$response = array(
    		'headers' 		=> wp_remote_retrieve_headers( $request ),
    		'body' 			=> wp_remote_retrieve_body( $request ),
    		'status_code' 	=> wp_remote_retrieve_response_code( $request ),
    	);

    	return $response;

    }

	/**
	 * Constructor
	 *
	 */
	abstract protected function __construct();

	/**
	 * Register callbacks for actions and filters
	 * 
	 */
	abstract protected function register_hook_callbacks();

}
