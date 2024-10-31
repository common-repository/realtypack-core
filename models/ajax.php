<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models;

use RTPC\Models\RTPC_Models_Model;
use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\Builder\RTPC_Controllers_Admin_Builder_Boot;
use RTPC\Controllers\Register\RTPC_Controllers_Register_Boot;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Importer;
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Dashboard;
use RTPC\WPL\RTPC_WPL_User;
use MailchimpAPI\Mailchimp;

class RTPC_Models_Ajax extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->register_hook_callbacks();

	}

	public function register_hook_callbacks() {

		// Admin template hook
		$template = RTPC_Controllers_Admin_Builder_Boot::get_instance();

		// Register Signin
		$register = RTPC_Controllers_Register_Boot::get_instance();

		// Plugin ajax
		$plugins = RTPC_Controllers_Admin_Dashboard_Plugin::get_instance();

		// Importer ajax
		$importer = RTPC_Controllers_Admin_Dashboard_Importer::get_instance();

		// Dashboard Ajax
		$dashboard = RTPC_Controllers_Admin_Dashboard_Dashboard::get_instance();

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			// template ajax
			Actions::add_action( "wp_ajax_$template->ajax_action", $template,  'render' );

			// Signin ajax
			Actions::add_action( "wp_ajax_" . $register::$signin_ajax_action , $register,  'render_login' );
			Actions::add_action( "wp_ajax_nopriv_" . $register::$signin_ajax_action,  $register, 'render_login' );
			// Register ajax
			Actions::add_action( "wp_ajax_" . $register::$register_ajax_action , $register,  'render_register' );
			Actions::add_action( "wp_ajax_nopriv_" . $register::$register_ajax_action,  $register, 'render_register' );

			// Register ajax
			Actions::add_action( "wp_ajax_" . $plugins->ajax_action , $plugins,  'ajax_handler' );

			// Register ajax
			Actions::add_action( "wp_ajax_" . $importer->ajax_action , $importer,  'ajax_handler' );

			// Register ajax
			Actions::add_action( "wp_ajax_" . $dashboard->ajax_action , $dashboard,  'ajax_handler' );

			// Register ajax
			Actions::add_action( "wp_ajax_rtpc_agency_contact" , $this,  'contact_ajax_handler' );
			Actions::add_action( "wp_ajax_nopriv_rtpc_agency_contact" , $this,  'contact_ajax_handler' );

            // Register ajax
            Actions::add_action( "wp_ajax_rtpc_newsletter" , $this,  'newsletter_widget' );
            Actions::add_action( "wp_ajax_nopriv_rtpc_newsletter" , $this,  'newsletter_widget' );

            // Register favorit button ajax
            Actions::add_action( "wp_ajax_rtpc_single_favorite" , $this,  'favorite_widget' );
            Actions::add_action( "wp_ajax_nopriv_rtpc_single_favorite" , $this,  'favorite_widget' );

		}

	}

    /**
     * [contact_ajax_handler description]
     * @return [type] [description]
     */
    public function contact_ajax_handler() {
    	// Security check
    	check_ajax_referer( 'rtpc_agency_contact', 'security' );

    	// Check 
    	$user_id = isset( $_POST['user'] ) ? esc_sql( $_POST['user'] ) : false;
    	$name 	 = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : false;
    	$phone 	 = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : false;
    	$email 	 = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
    	$contact = isset( $_POST['contact'] ) ? sanitize_text_field( $_POST['contact'] ) : false;

    	// Simple check for user id
    	if ( ! $user_id ) {
            wp_send_json( array( 'error' => true, 'message' => __( 'Invalid user ID.', 'realty-pack-core' ) ) );
    	}    	

    	if ( ! $name ) {
            wp_send_json( array( 'error' => true, 'message' => __( 'Please fill name field.', 'realty-pack-core' ) ) );
    	}

    	if ( ! $email ) {
            wp_send_json( array( 'error' => true, 'message' => __( 'Please fill email field.', 'realty-pack-core' ) ) );
    	}

    	if ( ! $contact ) {
            wp_send_json( array( 'error' => true, 'message' => __( 'Please fill contact field.', 'realty-pack-core' ) ) );
    	}


    	$result = RTPC_WPL_User::get_user_data( $user_id, 'main_email' );
    	$result = isset( $result['main_email'] ) ? $result['main_email'] : false;

    	// check for agency or agent email
    	if ( ! $result && is_email( $result ) ) {
            wp_send_json( array( 'error' => true, 'message' => __( 'Currently you can not send your email.', 'realty-pack-core' ) ) );
    	}

    	$subject = get_bloginfo('name') . ': ' . __( 'You have new email', 'realty-pack-core' );
    	$msg  = __( 'Hi There,', 'realty-pack-core' ) . "\r\n";
    	$msg .= $name . __( ' Sent you message via your contact form.', 'realty-pack-core' ) . "\r\n";
    	$msg .= "\r\n";
    	$msg .= $contact . "\r\n";
    	$msg .= __('Regards,', 'realty-pack-core') . "\r\n";
    	$msg .= __('realty-pack-core Plugin', 'realty-pack-core');


        if ( wp_mail( $result, $subject, $msg ) ) {
        	wp_send_json( array( 'error' => false, 'message' => __( 'Your contact form sent successfully.', 'realty-pack-core' ) ) );
        } else {
            wp_send_json( array( 'error' => true, 'message' => __( 'There is an issue to sending contact form.', 'realty-pack-core' ) ) );
        }

    }

    /**
     * [newsletter_widget description]
     * @return [type] [description]
     */
    public function newsletter_widget() {
        // Security check
        check_ajax_referer( 'rtpc_newsletter', 'security' );
        $apikey = get_theme_mod( 'mailchimp_intgreation_api', false );
        $list   = get_theme_mod( 'mailchimp_intgreation_list', false );

        // Check for in configuration is set or not
        if ( ! $apikey && ! $list ) {            
            if ( is_admin() ) {
                wp_send_json( array( 'error' => true, 'message' => esc_html__( 'MailChmip API Key and List Id is not configured in your customizer option.', 'realty-pack-core' ) ) );
            }

            wp_send_json( array( 'error' => true, 'message' => esc_html__( 'You can not subscribe at this momment please try again later.', 'realty-pack-core' ) ) );
        }

        // Check for email
        if ( ! is_email( $_POST[ 'email'] ) ) {
            wp_send_json( array( 'error' => true, 'message' => esc_html__( 'Please enter valid email', 'realty-pack-core' ) ) );
        }

        // Create arguments
        $args = array(
            'method' => 'PUT',
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode( 'user:'. $apikey )
            ),
            'body' => json_encode(array(
                'email_address' => $_POST[ 'email'],
                'status'        => 'subscribed'
            ))
        );

        $response = wp_remote_post( 'https://' . substr( $apikey, strpos( $apikey,'-' ) +1 ) . '.api.mailchimp.com/3.0/lists/' . $list . '/members/' . md5(strtolower( $_POST[ 'email'] ) ), $args );

        $body = json_decode( $response['body'] );

        if ( $response['response']['code'] == 200 && $body->status == 'subscribed' ) {
            wp_send_json( array( 'error' => false, 'message' => esc_html__( 'Subsribed successfully.', 'realty-pack-core' ) ) );
        } else {
            wp_send_json( array( 'error' => true, 'message' => esc_html__( 'You subscribed this newsletter.', 'realty-pack-core' ) ) );
        }

    }

    /**
     * [favorite_widget description]
     * @return [type] [description]
     */
    public function favorite_widget() {
        // Security check
        check_ajax_referer( 'rtpc_favorite', 'security' );

        $pid  = isset( $_POST['pid'] ) ? $_POST['pid']: false;
        $mode = isset( $_POST['mode'] ) ? $_POST['mode']: false;
        $mode = $mode ? 'add' : 'remove';

        $results = \wpl_addon_pro::favorite_add_remove( $pid, $mode );
        $pids    = \wpl_addon_pro::favorite_get_pids();

        wp_send_json( array( 'error' => false, 'action'=>$mode ) );
    }

}