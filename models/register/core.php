<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Register;
use RTPC\Models\RTPC_Models_Model;
use RTPC\WPL\RTPC_WPL_Property;

class RTPC_Models_Register_Core extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {
		$this->register_hook_callbacks();
	}

	public function register_hook_callbacks() {}

	public function login_user( $username, $password, $remeber_me ) {

        // ready for login
		$creds = array();
		$creds['user_login'] = $username;
		$creds['user_password'] = $password;
		$creds['remember'] = $remeber_me;

		$user = wp_signon( $creds, false );

		return $user;
	}

	public function save_user( $email, $fname, $lname, $username, $role, $password ) {

	    // ready for register
		$info['user_email'] 	=	$email;
		$info['first_name'] 	=	$fname;
		$info['last_name'] 		=	$lname;
		$info['user_login'] 	=	$username;
		$info['role'] 			=	$role;
		$info['user_pass'] 		=	$password;

	    // check for register or not
		$user_id = wp_insert_user( $info );

		// Sing in automatically
		if ( is_numeric( $user_id ) ) {

			$creds = array();
			$creds['user_login'] 		= $info['user_login'];
			$creds['user_password'] 	= $info['user_pass'];
			$creds['remember'] 			= true;

			$user = wp_signon( $creds, true );

			// Return status
			if ( is_wp_error( $user ) ) {
				$message[] = $user->get_error_message();
				wp_send_json( array( 'error' => true , 'message' => $message ) );
			} else {
				// Insert into wpl table
				if ( defined( '_WPLEXEC' ) ) {
					// add user to wpl
					\wpl_users::add_user_to_wpl( $user_id );
					if ( 'agency' === $role ) {
						$membership_id	= '-3';
					} else if( 'agent' === $role ) {
						$membership_id	= '-1';
					}
					// Change member ship then
					\wpl_users::change_membership($user_id, $membership_id);
				}
				$message[] = esc_html__( 'Registred Successfully.', 'realty-pack-core' );
				wp_send_json( array( 'error' => false , 'message' => $message ) );
			}
		}

	}


}