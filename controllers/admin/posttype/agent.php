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

class RTPC_Controllers_Admin_PostType_Agent extends RTPC_Controllers_Admin_Post {

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

        Actions::add_action('init', $this, 'agent_builder');
        Actions::add_filter('the_content', $this, 'preset_content');

    }

    public function agent_builder() {

        $labels = array(
            'name'               => _x('agent Builder ', 'post type general name', 'realty-pack-core'),
            'singular_name'      => _x('agent Builder', 'post type singular name', 'realty-pack-core'),
            'menu_name'          => _x('agent Builder ', 'admin menu', 'realty-pack-core'),
            'name_admin_bar'     => _x('agent Builder ', 'add new on admin bar', 'realty-pack-core'),
            'add_new'            => _x('Add New agent', 'agent', 'realty-pack-core'),
            'add_new_item'       => __('Add New agent', 'realty-pack-core'),
            'new_item'           => __('New agent', 'realty-pack-core'),
            'edit_item'          => __('Edit agent', 'realty-pack-core'),
            'view_item'          => __('View agent', 'realty-pack-core'),
            'all_items'          => __('All agents', 'realty-pack-core'),
            'search_items'       => __('Search agent', 'realty-pack-core'),
            'parent_item_colon'  => __('Parent agent:', 'realty-pack-core'),
            'not_found'          => __('No agent found.', 'realty-pack-core'),
            'not_found_in_trash' => __('No agent found in Trash.', 'realty-pack-core'),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __('Description.', 'realty-pack-core'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'agent_builder'),
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 28,
            'menu_icon'          => 'dashicons-networking',
            'supports'           => array('title'),
        );

        register_post_type( 'agent_builder', $args );

        $cpt_support = get_option('elementor_cpt_support');

        //check if option DOESN'T exist in db
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'agent_builder']; //create array of our default supported post types
            update_option('elementor_cpt_support', $cpt_support); //write it to the database
        }

        //if it DOES exist, but portfolio is NOT defined
        else if (!in_array('agent_builder', $cpt_support)) {
            $cpt_support[] = 'agent_builder'; //append to array
            update_option('elementor_cpt_support', $cpt_support); //update database
        }

    }


    function preset_content( $content ) {
        global $post;

        // Get template Type
        if( 'agent_builder' == $post->post_type ) {
            $new_content = '[Agent_Single]';
            $content .= $new_content;   
        }

        remove_filter( 'the_content',array( $this, 'preset_content' ) );

        return $content;
    }

}