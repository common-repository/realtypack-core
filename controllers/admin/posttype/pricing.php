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

class RTPC_Controllers_Admin_PostType_Pricing extends RTPC_Controllers_Admin_Post {

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

        Actions::add_action('init', $this, 'pricing');

    }

    public function pricing() {

        $labels = array(
            'name'               => _x('Pricing', 'post type general name', 'realty-pack-core'),
            'singular_name'      => _x('Pricing', 'post type singular name', 'realty-pack-core'),
            'menu_name'          => _x('Pricing Packages', 'admin menu', 'realty-pack-core'),
            'name_admin_bar'     => _x('Pricing', 'add new on admin bar', 'realty-pack-core'),
            'add_new'            => _x('Add New Package', 'package', 'realty-pack-core'),
            'add_new_item'       => __('Add New Package', 'realty-pack-core'),
            'new_item'           => __('New Package', 'realty-pack-core'),
            'edit_item'          => __('Edit Package', 'realty-pack-core'),
            'view_item'          => __('View Package', 'realty-pack-core'),
            'all_items'          => __('All Packages', 'realty-pack-core'),
            'search_items'       => __('Search Packages', 'realty-pack-core'),
            'parent_item_colon'  => __('Parent Packages:', 'realty-pack-core'),
            'not_found'          => __('No Package found.', 'realty-pack-core'),
            'not_found_in_trash' => __('No Package found in Trash.', 'realty-pack-core'),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __('Description.', 'realty-pack-core'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'rtfc_pricing'),
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 4,
            'menu_icon'          => 'dashicons-cart',
            'supports'           => array('title','editor'),
        );

        register_post_type('rtfc_pricing', $args);

        $cpt_support = get_option('elementor_cpt_support');

        //check if option DOESN'T exist in db
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'rtfc_pricing']; //create array of our default supported post types
            update_option('elementor_cpt_support', $cpt_support); //write it to the database
        }

        //if it DOES exist, but portfolio is NOT defined
        else if (!in_array('rtfc_pricing', $cpt_support)) {
            $cpt_support[] = 'rtfc_pricing'; //append to array
            update_option('elementor_cpt_support', $cpt_support); //update database
        }

    }

}