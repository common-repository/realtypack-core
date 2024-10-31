<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Dashboard;

use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot as dashboard_parent;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Models\Admin\Dashboard\RTPC_Models_Admin_Dashboard_Plugin as model;

class RTPC_Controllers_Admin_Dashboard_Plugin extends RTPC_Controllers_Admin_Dashboard_Boot {

    public $ajax_action  = 'RTPC_plugins';
    private static $nounce  = 'RTPC_plugins';

    /**
     * Registered plugins.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $plugins = NULL;

    /**
     * Registered plugins.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $api_base = 'https://eightqueens.pro/v1/api/';

    /**
     * TGMPA instance.
     *
     * @since 2.5.0
     *
     * @var object
     */
    protected static $tgmpa;

    /**
     * TGMPA instance.
     *
     * @since 2.5.0
     *
     * @var object
     */
    private $remoteData;

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        self::$tgmpa = \TGM_Plugin_Activation::get_instance();
        $this->model = model::get_instance();
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {
        $purchase_code = get_option( 'realtypack_activate_purchase' );
        // Get remote plugin data
    	$remote = parent::remote_get( self::$api_base . 'plugins/' . $purchase_code );
        // Set data
        $this->remoteData = $remote;

        $remote = json_decode( $remote['body'], true );

        if ( isset( $remote ) && ! isset( $remote['error'] ) ) {
    		add_filter( 'rtpc/add/plugins', array( $this, 'rtpc_register_plugins' ) );
    	}

        // Register Tgmpa
        add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10 );
        add_action( 'tgmpa_register', array( $this, 'register_plugins_field' ) );

    }

    public function tgmpa_load( $load ) {
        return true;
    }

    /**
     * With this function all of the remote and local options will be joind
     * @param [type] $plugins
     */
    public function rtpc_register_plugins( $plugins ) {

        $remote = $this->remoteData;
        $remote = json_decode( $remote['body'], true );;

        if ( !$remote ) {
            return;
        }

        $new_plugins = array();

        foreach ( $remote as $plugin ) {

            if ( ! preg_match( '/^http(s)?:\\/\\//i', $plugin['logo_src'] ) ) {
                $plugin['logo_src'] = RTPC_ASSETS_URL . 'assets/admin/img/' . $plugin['logo_src'];
            }

            $new_plugins[] = $plugin;
        }

        return $new_plugins;
    }

    /**
     * Loads all required plugins
     *
     * @return mixed|null|void
     */
    public static function register_plugins_field() {

        if ( ! is_null( self::$plugins ) ) {
            return self::$plugins;
        }

        $config = array(
            'id'           => 'realty-pack-core',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'parent_slug'  => 'themes.php',
            'capability'   => 'manage_options',
            'has_notices'  => false,
            'dismissable'  => false,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',
        );

        tgmpa(  self::$plugins = apply_filters( 'rtpc/add/plugins', array() ) , $config );

        return self::$plugins;
    }

    /**
     * Determine the plugin status message.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return string
     */
    public static function render() {

        $plugins_list = self::register_plugins_field();

        $new_list = array();

        foreach ( $plugins_list as $plugin ) {

        	$new_list[$plugin['slug']] =  $plugin;
        }

        add_thickbox();

        echo parent::render_template(
            'admin/plugins.php',
            array(
                'header'         =>  parent::header(),
                'plugins_list'   =>  $new_list,
                'footer'         =>  parent::footer(),
                'tgmpaurl'       =>  self::$tgmpa->get_tgmpa_url(),
            ),
            'always'
        );
    }

    /**
     * Determine the plugin status message.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return string
     */
    public static function get_plugin_status( $plugin ) {

        $slug = $plugin['slug'];

        $have_update = self::does_plugin_have_update( $plugin );
        $is_activated = self::$tgmpa->is_plugin_active( $slug );
        $is_installed = self::$tgmpa->is_plugin_installed( $slug );

        if ( false === $is_installed ) {
            $action['text'] = __( 'Install', 'realty-pack-core' );
            $action['status'] = __( 'Plugin not installed.', 'realty-pack-core' );
            $action['action'] = 'install';
        } elseif ( true === $is_installed && $is_activated && false === $have_update ) {
            $action['text'] = __( 'Activated', 'realty-pack-core' );
            $action['status'] = __( 'Plugin is activated.', 'realty-pack-core' );
            $action['action'] = 'activated';
        } elseif ( true === $have_update ) {
            $action['text']   = __( 'Update', 'realty-pack-core' );
            $action['status'] = __( 'Plugin needs update.', 'realty-pack-core' );
            $action['action'] = 'update';
        } elseif ( true === $is_installed && ! $is_activated ) {
            $action['text'] = __( 'Activate', 'realty-pack-core' );
            $action['status'] = __( 'Plugin is deactivate.', 'realty-pack-core' );
            $action['action'] = 'activate';
        }

        return $action;
    }

    /**
     * Retrieve a link to a plugin information Modified TGMPA's
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return string Fully formed html link to a plugin information page if available
     *                or the plugin name if not.
     */
    public static function get_info_link( $plugin ) {

        if ( 'repo' === $plugin['source'] ) {
            $url = add_query_arg(
                array(
                    'tab'       => 'plugin-information',
                    'plugin'    => urlencode( $plugin['slug'] ),
                    'TB_iframe' => 'true',
                    'width'     => '772',
                    'height'    => '550',
                ),
                self_admin_url( 'plugin-install.php' )
            );

            $link = sprintf(
                '<a href="%1$s" class="thickbox open-plugin-details-modal">%2$s</a>',
                esc_url( $url ),
                esc_html( $plugin['name'] )
            );

        }

        return $link;
    }

    /**
     * Retrieve the version number of an installed plugin.
     *
     * @since 1.0.0
     *
     * @param string $slug Plugin slug.
     * @return string Version number as string or an empty string if the plugin is not installed
     *                or version unknown (plugins which don't comply with the plugin header standard).
     */
    public static function get_installed_version( $slug ) {

        $installed_plugins = self::$tgmpa->get_plugins();

        $plugin_paths = array_keys( $installed_plugins );

        foreach ( $plugin_paths as $plugin_path ) {

            if ( $slug ==  trim( basename( $plugin_path ) , '.php' ) ) {
                return $installed_plugins[$plugin_path]['Version'];
            }

            if ( strpos(trim( basename( $plugin_path ) , '.php' ) , $slug ) ) {
                return $installed_plugins[$plugin_path]['Version'];
            }
        }

        return false;
    }

    /**
     * Check whether a plugin complies with the minimum version requirements.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return bool True when a plugin needs to be updated, otherwise false.
     */
    public static function does_plugin_have_update( $plugin ) {

        if ( 'repo' == $plugin['source'] ) {

            wp_update_plugins();

            $repo_updates = function_exists('get_site_transient') ? get_site_transient("update_plugins") : get_transient("update_plugins");

            $installed_plugins = self::$tgmpa->get_plugins();

            $plugin_paths = array_keys( $installed_plugins );

            foreach ( $plugin_paths as $plugin_path ) {

                if ( $plugin['slug'] == trim( basename( $plugin_path ) , '.php' ) || strpos(trim( basename( $plugin_path ) , '.php' ) , $plugin['slug'] ) ) {
                    if ( isset( $repo_updates->response[ $plugin_path ]->new_version ) ) {
                        return true;
                    }
                }

            }

        } else {

        	// Get remote plugin data
        	$remote = parent::remote_get( self::$api_base . 'plugins/version/' . $plugin['slug'] );

        	// Get installed version
        	$installed = self::get_installed_plugin_version( $plugin['slug'] );
        	if ( false === $remote['body'] || false === $installed || '' === $remote['body'] || '' === $installed ) {
        		return false;
        	}

            $remote_version = json_decode( $remote['body'], true );
            $remote_version = isset( $remote_version[0] ) ? $remote_version[0]['version'] : false;

        	if ( version_compare( $remote_version, $installed, '>' ) ) {
        		return true;
        	}

        }

        return false;
    }    

    /**
     * Check whether a plugin complies with the minimum version requirements.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return bool True when a plugin needs to be updated, otherwise false.
     */
    protected static function get_installed_plugin_version( $slug ) {
        // Get plugin data
        $plugin_data = self::get_plugin_data_by_slug($slug);

        if ( isset( $plugin_data['Version'] ) && trim( $plugin_data['Version'] ) ) {
            return $plugin_data['Version'];
        }

        return false;
    }

    /**
     * Check whether a plugin complies with the minimum version requirements.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return bool True when a plugin needs to be updated, otherwise false.
     */
    public static function get_installed_plugin_path( $slug ) {
        // clear cach
        wp_clean_plugins_cache();

        $installed_plugins = self::$tgmpa->get_plugins();

        $plugin_paths = array_keys( $installed_plugins );

        foreach ( $plugin_paths as $plugin_path ) {

            if ( $slug ==  trim( basename( $plugin_path ) , '.php' ) ) {
                return $plugin_path;
            }
            if ( strpos(trim( basename( $plugin_path ) , '.php' ) , $slug ) ) {
                return $plugin_path;
            }
        }

        return false;
    }

    /**
     * Check whether a plugin complies with the minimum version requirements.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return bool True when a plugin needs to be updated, otherwise false.
     */
    public static function get_plugin_data_by_slug( $slug ) {

        if ( ! function_exists( 'get_plugin_data' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugin_path = static::get_installed_plugin_path( $slug );

        // Simple check
        if ( $plugin_path === false ) {
            return false;
        }

        $plugin_full_path = ABSPATH . 'wp-content/plugins/' . $plugin_path ;

        if ( file_exists( $plugin_full_path ) == false ) {
            return false;
        }

        return get_plugin_data( $plugin_full_path );

    }

    /**
     * @return js scripts
     */
    public static function scripts() {

        $nounce = wp_create_nonce( self::$nounce );

        // Generating javascript code tpl
        $javascript = '
            jQuery(document).ready(function() {
                jQuery(".rtpc-admin-box-plugins a, .rtpc-admin-form-plugin-list a").RTPC_plugins({
                    selector: ".rtpc-admin-box-plugins a, .rtpc-admin-form-plugin-list a",
                    nounce : "'. $nounce .'",
                    action_hook: "RTPC_plugins",
                });
            });';

        return $javascript;

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function ajax_handler() {

        check_ajax_referer( self::$nounce, 'security' );

        $type   = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '';
        $slug   = isset( $_POST['slug'] ) ? sanitize_text_field( $_POST['slug'] ) : '';
        $source = isset( $_POST['source'] ) ? sanitize_text_field( $_POST['source'] ) : '';

        // Simple check
        if ( '' === $type || '' === $slug  || '' === $source ) {
            wp_send_json( array( 'error' => true, 'message' => esc_html__( 'Invalid request', 'realty-pack-core' ) ) );
        }

        if ( 'update' === $type ) {
            $type = 'activate';
        }

        if ( 'install' === $type ) {
            $update_info = self::does_plugin_have_update( array( 'slug' => $slug, 'source' => $source ) );
            if ( $update_info ) {
                $type = 'update';
            } else {
                $type = 'activate';

            }
        }

        $nonce_url = wp_nonce_url(
            add_query_arg(
                array(
                    'plugin'   => urlencode( $slug ),
                    'tgmpa-' . $type => $type . '-plugin',
                ),
                self::$tgmpa->get_tgmpa_url()
            ),
            'tgmpa-' . $type,
            'tgmpa-nonce'
        );

        $nonce_url = str_replace(array("&#038;","&amp;"), "&", esc_url( $nonce_url ) );
        wp_send_json( array( 'error' => false, 'action' => $type, 'source' => $nonce_url ) );

    }

    /**
     * Inject information into the 'update_plugins' site transient as WP checks that before running an update.
     *
     * @since 2.5.0
     *
     * @param array $plugins The plugin information for the plugins which are to be updated.
     */
    public function inject_update_info( $slug, $file_path, $download_url, $url = '' ) {

    	wp_update_plugins();

    	$repo_updates = get_site_transient( 'update_plugins' );

    	if ( ! is_object( $repo_updates ) ) {
    		$repo_updates = new stdClass;
    	}

    	if ( empty( $repo_updates->response[ $file_path ] ) ) {
    		$repo_updates->response[ $file_path ] = new stdClass;
    	}

        // We only really need to set package, but let's do all we can in case WP changes something.
    	$repo_updates->response[ $file_path ]->slug        = $slug;
    	$repo_updates->response[ $file_path ]->plugin      = $file_path;
    	$repo_updates->response[ $file_path ]->package     = $download_url;
    	if ( $url ) {
    		$repo_updates->response[ $file_path ]->url = $url;
    	}

    	set_site_transient( 'update_plugins', $repo_updates );
    }

    /**
     * Retrieve the download URL for a WP repo package.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return string Plugin download URL.
     */
    public function get_wp_repo_download_url( $slug ) {
        $source = '';
        $api    = $this->get_plugins_api( $slug );

        if ( false !== $api && isset( $api->download_link ) ) {
            $source = $api->download_link;
        }

        return $source;
    }

    /**
     * Try to grab information from WordPress API.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return object Plugins_api response object on success, WP_Error on failure.
     */
    public function get_plugins_api( $slug ) {

        // Check cache
        $update = get_transient( 'RTPC_update_plugin_' . $slug );

        if ( ! $update ) {

            $update = $this->plugins_api( $slug );

            if ( is_wp_error( $update ) ) {
                return false;
            }

            set_transient( 'RTPC_update_plugin_' . $slug , $update, 1 * DAY_IN_SECONDS );
        }

        return $update;
    }

    /**
     * Try to grab information from WordPress API.
     *
     * @since 2.5.0
     *
     * @param string $slug Plugin slug.
     * @return object Plugins_api response object on success, WP_Error on failure.
     */
    public function plugins_api( $slug ) {

        if ( ! function_exists( 'plugins_api' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        }

        $response = plugins_api( 'plugin_information', array( 'slug' => $slug, 'fields' => array( 'sections' => false ) ) );

        return $response;
    }

}