<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\PostType\RTPC_Controllers_Admin_PostType_Property;
use RTPC\Controllers\Admin\PostType\RTPC_Controllers_Admin_PostType_Agency;
use RTPC\Controllers\Admin\PostType\RTPC_Controllers_Admin_PostType_Agent;
use RTPC\Controllers\Admin\PostType\RTPC_Controllers_Admin_PostType_Footer;
use RTPC\Controllers\Admin\PostType\RTPC_Controllers_Admin_PostType_Pricing;

class RTPC_Controllers_Admin_Post extends RTPC_Controllers_Admin_Admin {

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

        $this->init_posttype();
        add_filter( 'post_type_link', array( $this, 'remove_single_builder_slug' ), 10, 2 );
        add_action( 'pre_get_posts', array( $this, 'main_query' ) );
        add_action( 'admin_menu', array( $this, 'remove_post_menu' ) );

    }

    /**
     * Init custom post types
     */
    function init_posttype() {

        RTPC_Controllers_Admin_PostType_Property::get_instance();

        RTPC_Controllers_Admin_PostType_Agency::get_instance();

        RTPC_Controllers_Admin_PostType_Agent::get_instance();

        RTPC_Controllers_Admin_PostType_Footer::get_instance();

        RTPC_Controllers_Admin_PostType_Pricing::get_instance();

    }

    function remove_post_menu() {
        global $submenu;

        unset($submenu['edit.php?post_type=property_builder']);
        unset($submenu['edit.php?post_type=agency_builder']);
        unset($submenu['edit.php?post_type=footer_builder']);
    }

    /**
     * Remove the slug from published post permalinks. Only affect our custom post type, though.
     */
    function remove_single_builder_slug( $post_link, $post ) {

        if ( 'property_builder' === $post->post_type && 'publish' === $post->post_status ) {
            $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        }

        if ( 'agency_builder' === $post->post_type && 'publish' === $post->post_status ) {
            $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        }

        if ( 'agent_builder' === $post->post_type && 'publish' === $post->post_status ) {
            $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        }

        if ( 'footer_builder' === $post->post_type && 'publish' === $post->post_status ) {
            $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        }

        return $post_link;
    }

    /**
     * Have WordPress match postname to any of our public post types (post, page, race).
     *
     * @param $query The current query.
     */
    function main_query( $query ) {

        // Bail if this is not the main query.
        if ( ! $query->is_main_query() ) {
            return;
        }

        // Bail if this query doesn't match our very specific rewrite rule.
        if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
            return;
        }
        // Bail if we're not querying based on the post name.
        if ( empty( $query->query['name'] ) ) {
            return;
        }
        // Add single builder.
        $query->set( 'post_type', array( 'post', 'page', 'property_builder', 'agency_builder', 'footer_builder', 'agent_builder' ) );
    }

}