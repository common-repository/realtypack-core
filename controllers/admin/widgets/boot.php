<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Widgets;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Admin;
use RTPC\Controllers\Admin\Widgets\RTPC_Controllers_Admin_Widgets_Posts;
use RTPC\Controllers\Admin\Widgets\RTPC_Controllers_Admin_Widgets_Social;

class RTPC_Controllers_Admin_Widgets_Boot extends RTPC_Controllers_Admin_Admin {

    protected function __construct() {

        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    protected function register_hook_callbacks() {
        $this->_rtp_load_widgets();
    }

    /**
     * Fires the options form actions.
     *
     * @since 1.0.0
     * @ignore
     * @access private
     *
     * @return void
     */
    public function _rtp_load_widgets() {

        // Init
        Actions::add_action( 'widgets_init', $this, 'register_widget' );

    }

    public function register_widget() {
        register_widget( 'RTPC\Controllers\Admin\Widgets\RTPC_Controllers_Admin_Widgets_Posts' );
        register_widget( 'RTPC\Controllers\Admin\Widgets\RTPC_Controllers_Admin_Widgets_Social' );
    }

}