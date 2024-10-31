<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin\Builder;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\Builder\RTPC_Controllers_Admin_Builder_Boot;
use RTPC\Models\Admin\Builder\RTPC_Models_Admin_Builder_Table;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot;

class RTPC_Controllers_Admin_Builder_Table extends RTPC_Controllers_Admin_Builder_Boot {

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {

        // $this->model = RTPC_Models_Admin_Builder_Table::get_instance();
        $this->register_hook_callbacks();

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    protected function register_hook_callbacks() {

		Actions::add_filter( 'set-screen-option', __CLASS__, 'set_screen' , 10, 3 );

		Actions::add_action( 'admin_menu', $this, 'plugin_menu' , 11 );

    }

    public static function set_screen( $status, $option, $value ) {
    	return $value;
    }

	public function plugin_menu() {
		global $submenu, $menu;

		$hook = add_submenu_page( 'realty-pack-core', 'Single Builder', 'Template Builder', 'moderate_comments', 'realtypack_builder', array ( $this, 'render_callback' ) );
		add_action( "load-$hook", array( $this, 'screen_option' ) );

	}

	/**
	* Screen options
	*/
	public function screen_option() {

		$option = 'per_page';
		$args   = array(
		'label'   => 'Comments',
		'default' => 10,
		'option'  => 'inapp_comments_per_page'
		);

		add_screen_option( $option, $args );

		$this->model = RTPC_Models_Admin_Builder_Table::get_instance();
	}

	/**
	* WP Query
	*/
	public function query() {

		$args = array(
			'post_status' => 'published',
			'post_type' => array( 'property_builder', 'footer_builder', 'agency_builder', 'agent_builder' ),
		);

        $post_count = new \WP_Query( $args );
		
		return $post_count->found_posts;
	}

	/**
	* 
	*/
	public function render_callback() {

		if ( $this->query() > 0 ) {
			$this->render_data();
		} else {
			$this->maybe_render_blank_state();
		}

	}

	/**
	* 
	*/
	public function render_data() {
		?>
		<div class="wrap">

			<h1 class="wp-heading-inline"><?php esc_attr_e( 'Single Template Builder', 'realty-pack-core' ); ?></h1>
			<a href="http://rte.test/wp-admin/post-new.php?post_type=single_builder" class="page-title-action" data-featherlight=".rtpc-single-builder-continer"><?php esc_html_e( 'New Single Template' ); ?></a>
			<hr class="wp-header-end">
			<h2 class="screen-reader-text"></h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->model->prepare_items();
								$this->model->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
		<?php
	}

	/**
     * Maybe render blank state.
     *
     * @param string
     */
    public function maybe_render_blank_state() {

        $inline_style = '#posts-filter .wp-list-table, #posts-filter .tablenav.top, .tablenav.bottom .actions, .wrap .subsubsub { display:none;}';
        ?>
        <div class="wrap">
        	<h1 class="wp-heading-inline"><?php esc_attr_e( 'Single Template Builder', 'realty-pack-core' ); ?></h1>
        	<a href="http://rte.test/wp-admin/post-new.php?post_type=single_builder" class="page-title-action" data-featherlight=".rtpc-single-builder-continer"><?php esc_html_e( 'New Single Template' ); ?></a>
        	<hr class="wp-header-end">
        	<h2 class="screen-reader-text"></h2>
		</div>

        <style type="text/css"><?php esc_html_e( $inline_style ); ?></style>
        <div class="elementor-template_library-blank_state">
            <div class="elementor-blank_state">
                <i class="eicon-folder"></i>
                <h2>
                    <?php esc_html_e( 'Create Your First Single', 'realty-pack-core' ); ?>
                </h2>
                <p><?php esc_html_e( 'Create your single Property and Footer layout then assign it in your customizer option and use it easily.', 'elementor' ); ?></p>
                <a id="elementor-template-library-add-new" class="elementor-button elementor-button-success" data-featherlight=".rtpc-single-builder-continer" href="#"> <?php esc_html_e( 'Add New Single', 'realty-pack-core' );?></a>
            </div>
        </div>
        <?php

    }

}