<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Admin\Builder;

use RTPC\Models\RTPC_Models_Model;

class RTPC_Models_Admin_Builder_Init extends RTPC_Models_Model {

    /**
     * Elementor template-library post-type slug.
     */
    const CPT = 'single_builder';

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->register_hook_callbacks();

	}

	public function register_hook_callbacks() {
        
	}

	/**
	 * Save local template.
	 *
	 * @return \WP_Error|int The ID of the saved/updated template, `WP_Error` otherwise.
	 */
	public function save_item( $type, $title ) {

		if ( ! $type ) {
			return new \WP_Error( 'save_error', sprintf( 'Invalid template type "%s".', $template_data['type'] ) );
		}

		$template_id = wp_insert_post( [
			'post_title' 	=> ! empty( $title ) ? $title : __( '(no title)', 'realty-pack-core' ),
			'post_status' 	=> current_user_can( 'publish_posts' ) ? 'publish' : 'pending',
			'post_type' 	=> $type,
		] );

		if ( is_wp_error( $template_id ) ) {
			return $template_id;
		}

		return $template_id;
	}


}