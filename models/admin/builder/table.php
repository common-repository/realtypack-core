<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Admin\Builder;

use RTPC\Models\RTPC_Models_Model;
use RTPC\Models\Admin\Builder\RTPC_Models_Admin_Builder_WPTable;


class RTPC_Models_Admin_Builder_Table extends RTPC_Models_Admin_Builder_WPTable {


    public function __construct() {

        parent::__construct( 
            array(
            'singular' => __( 'single_template_builder', 'realty-pack-core' ), 
            'plural'   => __( 'single_template_builders', 'realty-pack-core' ), 
            'ajax'     => false
        ) 
        );

    }

    public function register_hook_callbacks() {}

    /**
     * Retrieve posts data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public static function get_posts( $per_page = 5, $page_number = 1 ) {

        $args = array(
            'post_status' => 'published',
            'post_type' => array( 'property_builder', 'footer_builder', 'agency_builder', 'agent_builder' ),
            'posts_per_page' => $per_page,
            'paged' => $page_number
        );

        $the_query = new \WP_Query( $args );

        if ( $the_query->have_posts() ) {
            $posts = $the_query;
            wp_reset_postdata();
        } else {
            $posts = array();
        }

        return $posts;
    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public static function post_count() {

        $args = array(
            'post_status' => 'published',
            'post_type' => array( 'property_builder', 'footer_builder', 'agency_builder', 'agent_builder' ),
        );

        $post_count = new \WP_Query( $args );
        
        return $post_count->found_posts;
    }

    /**
     * Delete a template.
     *
     * @param int $id customer ID
     */
    public static function delete_post( $id ) {
        wp_delete_post( $id );
    }

    /** Text displayed when no customer data is available */
    public function no_items() {
        _e( 'No Template Available', 'realty-pack-core' );
    }

    /**
     * Render a column when no column specific method exist.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default( $item, $column_name ) {

        $item = get_object_vars( $item );

        switch ( $column_name ) {
            case 'name':

            return $item[ $column_name ];

            case 'format':

            case 'id':

            default:
                return print_r( $item, true ); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb( $item ) {

        $item = get_object_vars($item);

        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
        );

    }


    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_name( $item ) {

        $item = get_object_vars( $item );

        $delete_nonce = wp_create_nonce( 'RTPC_delete_template' );

        $url_elementor = get_edit_post_link( $item['ID'], 'url' );
        $url_elementor = rtrim( $url_elementor, 'edit' );
        $url_elementor = $url_elementor . 'elementor';

        $content          = '<strong><a class="row-title" href="' . get_edit_post_link( $item['ID'], 'url' ) .'" aria-label=" '. $item['post_title'] .' (Edit)">'. $item['post_title'] .'</a> </strong>';

        $content .='<div class="row-actions">';

        $content .= '<span class="edit"><a href="' . get_edit_post_link( $item['ID'], 'url' ) . '" aria-label="Edit “'. $item['post_title'] .'”">Edit</a> | </span>';

        $actions = [
        	'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
        ];

        $content .= '<span class="edit_with_elementor"><a href="'. esc_url( $url_elementor ).'" aria-label="Edit “'. $item['post_title'] .'”">' . esc_html__( 'Edit with Elementor', 'realty-pack-core' ). '</a> | </span>';

        $content .= '<span class="view"><a href="'. get_post_permalink( $item['ID'] ) .'" rel="bookmark" aria-label="View “'. $item['post_title'] .'”">'. esc_html__( 'View', 'realty-pack-core' ) . '</a></span>';

        $content .= '</div>';

        return $content . $this->row_actions( $actions );
    }   

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_template_format( $item ) {

        $item = get_object_vars( $item );

        if ( $item['post_type'] === 'property_builder' ) {
            $title = __( 'Property Single Template', 'realty-pack-core' );
        }

        if ( $item['post_type'] === 'footer_builder' ) {
            $title = __( 'Footer Template', 'realty-pack-core' );
        }

        if ( $item['post_type'] === 'agency_builder' ) {
            $title = __( 'Agency Single Template ', 'realty-pack-core' );
        }

        if ( $item['post_type'] === 'agent_builder' ) {
            $title = __( 'Agent Single Template', 'realty-pack-core' );
        }

        return $title;
    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_id( $item ) {

        $item = get_object_vars( $item );

        $id =  $item['ID'] ;

        return $id;
    }

    /**
     *  Associative array of columns
     *
     * @return array
     */
    function get_columns() {

        $columns = array(
            'cb'         => '<input type="checkbox" />',
            'name'        => __( 'Template Name', 'realty-pack-core' ),
            'template_format'      => __( 'Template Format', 'realty-pack-core' ),
            'id'          => __( 'ID', 'realty-pack-core' )
        );

        return $columns;
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions() {

        $actions = array(
            'bulk-delete' => __( 'Move template to trash', 'realty-pack-core' ),
        );

        return $actions;
    }

    function get_sortable_columns() {

    	$sortable_columns = array(
    		'name'  => array('name',false),
    		'template_format' => array('template_format',false),
    	);

    	return $sortable_columns;
    }

    public function prepare_items() {

        $current_page = $this->get_pagenum();

        $query = self::get_posts( 5, $current_page );

        $args = array(
            'total_items' => $query->found_posts,
            'total_pages' => $query->   max_num_pages,
            'per_page'    => 5,
        );

        $this->set_pagination_args($args);
        // $this->pagination('bottom');

        $this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        $total_items  = self::post_count();

        $this->items  = $query->posts;
    }

    public function process_bulk_action() {

        //Detect when a bulk action is being triggered...
        if ( 'delete' === $this->current_action() ) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );
            if ( ! wp_verify_nonce( $nonce, 'RTPC_delete_template' ) ) {

                die( 'Go get a life script kiddies' );

            } else {

                self::delete_post( absint( $_GET['customer'] ) );

                ob_end_clean();

                wp_redirect( esc_url_raw( get_admin_url('admin.php?page=realtypack_builder') ) );

                exit;
            }
        }

        // If the delete bulk action is triggered
        if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' ) ) {

            $delete_ids = esc_sql( $_POST['bulk-delete'] );

            // loop over the array of record IDs and delete them
            foreach ( $delete_ids as $id ) {
                self::delete_post( $id );
            }
                ob_end_clean();

                wp_redirect( esc_url_raw( get_admin_url('admin.php?page=realtypack_builder') ) );
            exit;

        }

    }
}