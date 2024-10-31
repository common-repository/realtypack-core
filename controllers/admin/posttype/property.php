<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\PostType;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Post;

class RTPC_Controllers_Admin_PostType_Property extends RTPC_Controllers_Admin_Post {

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

        Actions::add_action('init', $this, 'property');
        Actions::add_filter('the_content', $this, 'preset_content');

    }

    public function property() {

        $labels = array(
            'name'               => _x('Property Builder', 'post type general name', 'realty-pack-core'),
            'singular_name'      => _x('Property', 'post type singular name', 'realty-pack-core'),
            'menu_name'          => _x('Property Builder', 'admin menu', 'realty-pack-core'),
            'name_admin_bar'     => _x('Property Builder', 'add new on admin bar', 'realty-pack-core'),
            'add_new'            => _x('Add New Property', 'Property', 'realty-pack-core'),
            'add_new_item'       => __('Add New Property', 'realty-pack-core'),
            'new_item'           => __('New Property', 'realty-pack-core'),
            'edit_item'          => __('Edit Property', 'realty-pack-core'),
            'view_item'          => __('View Property', 'realty-pack-core'),
            'all_items'          => __('All Propertys', 'realty-pack-core'),
            'search_items'       => __('Search Propertys', 'realty-pack-core'),
            'parent_item_colon'  => __('Parent Propertys:', 'realty-pack-core'),
            'not_found'          => __('No Property found.', 'realty-pack-core'),
            'not_found_in_trash' => __('No Property found in Trash.', 'realty-pack-core'),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __('Description.', 'realty-pack-core'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'property_builder'),
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 28,
            'menu_icon'          => 'dashicons-menu',
            'supports'           => array('title', 'editor'),
        );

        register_post_type('property_builder', $args);

        $cpt_support = get_option('elementor_cpt_support');

        //check if option DOESN'T exist in db
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'property_builder']; //create array of our default supported post types
            update_option('elementor_cpt_support', $cpt_support); //write it to the database
        }

        //if it DOES exist, but portfolio is NOT defined
        else if (!in_array('property_builder', $cpt_support)) {
            $cpt_support[] = 'property_builder'; //append to array
            update_option('elementor_cpt_support', $cpt_support); //update database
        }

    }

    function preset_content( $content ) {
        global $post;

        // Get template Type
        if( 'property_builder' == $post->post_type  ) {
            $new_content = '[RTP_Property_Show]';
            $content .= $new_content;
        }

        remove_filter( 'the_content',array( $this, 'preset_content' ) );

        return $content;
    }
}