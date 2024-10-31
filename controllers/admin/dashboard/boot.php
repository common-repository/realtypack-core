<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Dashboard;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Admin;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin;

class RTPC_Controllers_Admin_Dashboard_Boot extends RTPC_Controllers_Admin_Admin {

    /**
     * Registered menu.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $menu = NULL;

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
    public function register_hook_callbacks() {

        add_action( 'admin_menu', array( $this, 'realtypack_menu' ) );
        // Callback for adding page custom classes
        add_filter( 'admin_body_class', array( $this, 'admin_body_class' ), 999 );

    }

    /**
     * Loads all menu fields
     *
     * @return mixed|null|void
     */
    public static function register_menu_field() {

        if ( ! is_null( self::$menu ) ) {
            return self::$menu;
        }

        return self::$menu = apply_filters( 'rtpc/add/admin/menu', array() );
    }

    /**
     * [realtypack_menu description]
     * @return [type] [description]
     */
    function realtypack_menu() {
                    
        require_once RTPC_PATH . 'config/menu.php';

        // Admin menu
        $admin_menus = self::register_menu_field();

        foreach ( $admin_menus as $admin_menu ) {

            $this->register_menu( $admin_menu );

        }

    }

    /**
     * Adds menu page or sub page to WordPress
     *
     * @since 1.0
     *
     * @param bool|array $menu
     */
    public function register_menu( $menu ) {

        // Page title
        $menu['parent_slug'] = isset( $menu['parent_slug'] ) ? $menu['parent_slug'] : NULL;

        // Page title
        $menu['page_title'] = isset( $menu['page_title'] ) ? $menu['page_title'] : NULL;

        // Menu title
        $menu['menu_title'] = isset( $menu['menu_title'] ) ? $menu['menu_title'] : $name;

        // Menu view capabilitt
        $menu['capability'] = isset( $menu['capability'] ) ? $menu['capability'] : 'manage_options';

        // Menu slug
        $menu['menu_slug'] = isset( $menu['menu_slug'] ) ? $menu['menu_slug'] : NULL;

        // Callback function
        $menu['function'] = isset( $menu['function'] ) ? $menu['function'] : NULL;

        // Menu icon
        $menu['icon_url'] = isset( $menu['icon_url'] ) ? $menu['icon_url'] : NULL;

        // Menu pos
        $menu['position'] = isset( $menu['position'] ) ? $menu['position'] : 10;

        // Check page title
        if ( NULL === $menu['page_title'] ) {
            return;
        }

        // Check menu slug
        if ( NULL === $menu['menu_slug'] ) {
            return;
        }

        // Check menu slug
        if ( NULL === $menu['function'] ) {
            return;
        }

        // Check function statys
        if ( is_array( $menu['function'] ) ) {
            // Class name
            $class = $menu['function'][0];
            // Check if its exist
            if ( method_exists( $class, 'get_instance' ) ) {
                $class = $class::get_instance();
                $menu['function'] = array($class, $menu['function'][1] );
            }
        }

        if ( NULL === $menu['parent_slug']) {

            call_user_func_array( 
                'add_menu_page', 
                array(
                    $menu['page_title'],
                    $menu['menu_title'],
                    $menu['capability'],
                    $menu['menu_slug'],
                    $menu['function'],
                    $menu['icon_url'],
                    $menu['position']
                )
            );

        } else {

            call_user_func_array(
                'add_submenu_page', 
                array(
                    $menu['parent_slug'],
                    $menu['page_title'],
                    $menu['menu_title'],
                    $menu['capability'],
                    $menu['menu_slug'],
                    $menu['function'],
                )
            );

        }

    }

    /**
     * [RealtyPack_plugins description]
     * @return [type] [description]
     */
    function realtypack_toturials() {

        echo parent::render_template(
            'admin/toturials.php',
            array(
                'header' => $this->header(),
                'footer' => $this->footer(),
            ),
            'always'
        );

    }

    /**
     * [RealtyPack_plugins description]
     * @return [type] [description]
     */
    function realtypack_system_status() {
        global $wpdb;

        echo parent::render_template(
            'admin/system-status.php',
            array(
                'header' => $this->header(),
                'db_version' => $wpdb->db_version(),
                'footer' => $this->footer(),
            ),
            'always'
        );

    }

    /**
     * [RealtyPack_dashboard description]
     * @return [type] [description]
     */
    public function header() {

        return parent::render_template(
            'admin/dashboard-header.php',
            array(
                'logo' => RTPC_ASSETS_URL . 'assets/admin/img/logo.png',
                'page' => $_GET['page'],
            ),
            'always'
        );

    }    

    /**
     * [RealtyPack_dashboard description]
     * @return [type] [description]
     */
    public function footer() {

        return parent::render_template(
            'admin/dashboard-footer.php',
            array(
            ),
            'always'
        );

    }

    /**
     * [admin_body_class description]
     * @param  [type] $classes [description]
     * @return [type]          [description]
     */
    function admin_body_class( $classes ) {

        if ( isset( $_GET['page'] ) && $_GET['page'] == strpos( $_GET['page'], 'realty-pack-core') ) {
   
            $classes = explode( ' ', $classes );

            $classes = array_flip( $classes );

            $classes['rtpc-admin-panel'] = 'rtpc-admin-panel';
            $classes['hide-notices']   = 'hide-notices';

            return implode( ' ', $classes );
        }
        
        return $classes;

    }

}