<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Register;

use RTPC\RTPC_Lib_Actions as Actions;
use RTPC\Controllers\Admin\RTPC_Controllers_Admin_Admin;
use RTPC\Models\Register\RTPC_Models_Register_Core;

class RTPC_Controllers_Register_Boot extends RTPC_Controllers_Admin_Admin {

    public static $signin_ajax_action	= 'RTPC_signin';
    public static $register_ajax_action = 'RTPC_register';

    private static $nounce_signin       = 'RTPC_signin';
    private static $nounce_register     = 'RTPC_register';

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {

        $this->model = RTPC_Models_Register_Core::get_instance();
        $this->register_hook_callbacks();

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {

        Actions::add_action( 'rtp_header_main_signin_after_markup', $this,  'signin_markup' );
        Actions::add_action( 'rtp_header_main_register_after_markup', $this,  'register_markup' );

    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function signin_markup() {

        // Get register status
        $login_style        =   get_theme_mod( 'choose_login_style', 'wordpress' );

        $register_status = false;
        if ( 'realty-pack' === $login_style ) {
            $register_status    =   get_theme_mod( 'register_header', false );
        }

        echo parent::render_template(
            'frontend/signin.php',
            array(
                'email'             =>      esc_attr__( 'Your Email*', 'realty-pack-core' ),
                'header_text'      =>       esc_html__( 'SIGN IN', 'realty-pack-core' ),
                'username'         =>       esc_attr__( 'Email or User name*', 'realty-pack-core' ),
                'password'         =>       esc_attr__( 'Password*', 'realty-pack-core' ),
                'remeber_me'       =>       esc_html__( 'Remeber Me', 'realty-pack-core' ),
                'lost_url'         =>       esc_url( wp_lostpassword_url() ),
                'lost_url_text'    =>       esc_html__( 'Forgot your password?', 'realty-pack-core' ),
                'login_button'     =>       esc_html__( 'Login', 'realty-pack-core' ),
                'register_text'    =>       esc_html__( "Don't Have an Account?", 'realty-pack-core' ),
                'register_here'    =>       esc_html__( 'Register Here', 'realty-pack-core' ),
                'register_status'  =>       $register_status,
            ),
            'always'
        );

    }    

	/**
	 * Register callbacks for actions and filters
	 *
	 * @since    1.0.0
	 */
	public function register_markup() {

		$roles 		 = get_theme_mod( 'registerd_roles', array( 'subscriber' => 'Subscriber' ) );
		$enable_term = get_theme_mod( 'enable_term_of_service' , false );
		$term_link   = get_theme_mod( 'term_of_service_link' , false );
		$agree = false;

		if ( true == $enable_term && false !== $term_link ) {
			$term_link  = get_permalink( $term_link );
			$agree 		= esc_html__( 'I Agree To The Terms Of Service', 'realty-pack-core' );
		}

		echo parent::render_template(
			'frontend/register.php',
			array(
				'header_text'  		=>		esc_html__( 'REGISTER', 'realty-pack-core' ),
				'email'        		=>		esc_attr__( 'Your Email*', 'realty-pack-core' ),
				'username'     		=>		esc_attr__( 'Your Username*', 'realty-pack-core' ),
				'fname'        		=>		esc_attr__( 'First Name', 'realty-pack-core' ),
				'lname'        		=>		esc_attr__( 'Last name', 'realty-pack-core' ),
				'password'     		=>		esc_attr__( 'Your password*', 'realty-pack-core' ),
				'rpassword'    		=>		esc_attr__( 'Retype password*', 'realty-pack-core' ),
				'utype'        		=>		esc_attr__( 'User Type*', 'realty-pack-core' ),
				'agree'        		=>		$agree,
				'register_text'		=>		esc_html__( 'Register', 'realty-pack-core' ),
				'term_link'			=>		$term_link,
				'roles'				=>		$roles,
			),
			'always'
		);

	}

    /**
     * @return js scripts
     */
    public static function scripts() {

        $nounce_signin	 = wp_create_nonce( self::$nounce_signin );
        $nounce_register = wp_create_nonce( self::$nounce_register );

        // Generating javascript code tpl
        $javascript = '
            jQuery(document).ready(function() {

                jQuery(".featherlight .rtpc-signin-submit").RTPC_signin_register({
                    selector: ".featherlight .rtpc-signin-submit",
                    type: "signin",
                    nounce : "'. $nounce_signin .'",
                    action_hook: "'. self::$signin_ajax_action .'",
                });                

                jQuery(".featherlight .rtpc-register-submit").RTPC_signin_register({
                    selector: ".featherlight .rtpc-register-submit",
                    type: "register",
                    nounce : "'. $nounce_register .'",
                    action_hook: "'. self::$register_ajax_action .'",
                });

                jQuery(".featherlight .rtpc-reopen-register-modal").RTPC_signin_register({
                    selector: ".featherlight .rtpc-reopen-register-modal",
                    type: "reOpenRegister",
                });

            });';

        return $javascript;

    }

    public function render_login() {

        check_ajax_referer( self::$nounce_signin, 'security' );

        //sanitize
        $username 	= isset( $_POST[ 'username' ] ) ? sanitize_text_field( $_POST[ 'username' ] )   : '';
        $password   = isset( $_POST[ 'password' ] ) ? sanitize_text_field( $_POST[ 'password' ] )   : '';
        $remeber_me = isset( $_POST[ 'remeber_me' ] ) ? sanitize_text_field( $_POST[ 'remeber_me' ] ) : '';

        // Check username
        if ( '' == $username ) {
        	wp_send_json( array( 'error' => true , 'message' => esc_html__( 'Please set username.', 'realty-pack-core' ) ) );
        }

        // Check password
        if ( '' == $password ) {
        	wp_send_json( array( 'error' => true , 'message' => esc_html__( 'Please set password.', 'realty-pack-core' ) ) );
        }

        // Do login action
        $user = $this->model->login_user( $username, $password, $remeber_me );

        if ( is_wp_error( $user ) ) {
            wp_send_json( array( 'error' => true , 'message' => $user->get_error_message() ) );
        } else {
            wp_send_json( array( 'error' => false , 'message' => esc_html__( 'Congratulations!', 'realty-pack-core' ) ) );
        }

    }


	public function render_register() {

		check_ajax_referer( self::$nounce_register, 'security' );

		$email 			 =	isset( $_POST[ 'email' ] ) ? sanitize_email( urldecode( $_POST[ 'email' ] ) ) : '';
		$username 		 =	isset( $_POST[ 'username' ] ) ? sanitize_user( $_POST[ 'username' ] ) : '';
		$fname 			 =	isset( $_POST[ 'fname' ] ) ? sanitize_text_field( urldecode( $_POST[ 'fname' ] ) ) : '';
		$lname 			 =	isset( $_POST[ 'lname' ] ) ? sanitize_text_field( urldecode( $_POST[ 'lname' ] ) ) : '';
		$role 			 =	isset( $_POST[ 'role' ] ) ? sanitize_text_field( urldecode( $_POST[ 'role' ] ) ) : '';
		$password 		 =	isset( $_POST[ 'password' ] ) ? wp_filter_nohtml_kses( $_POST[ 'password' ] ) : '';
		$rpassword 		 =	isset( $_POST[ 'rpassword' ] ) ? wp_filter_nohtml_kses( $_POST[ 'rpassword' ] ) : '';
		$term_services 	 =	isset( $_POST[ 'term_services' ] ) ? wp_filter_nohtml_kses( $_POST[ 'term_services' ] ) : '';

	    //sanitize
		$info 	 = array();
		$message = null;

	    // Check email        
		if ( '' === $email ) {
			$message[] = esc_html__( 'Email is required.', 'realty-pack-core' );
		}

		if ( ! is_email( $email ) ) {
			$message[] = esc_html__( 'Invalid email.', 'realty-pack-core' );
		}

		if ( email_exists( $email ) ) {
			$message[] = esc_html__( 'Email is exist.', 'realty-pack-core' );
		}

	    // Check username        
		if ( '' === $username ) {
			$message[] = esc_html__( 'Username is required.', 'realty-pack-core' );
		}

		if ( username_exists( $username ) ) {
			$message[] = esc_html__( 'Username is exist.', 'realty-pack-core' );
		}

	    // Check Password
		if ( '' === $password ) {
			$message[] = esc_html__( 'Password is empty.', 'realty-pack-core' );
		}

		if ( '' === $rpassword ) {
			$message[] = esc_html__( 'Password confirmation is empty.', 'realty-pack-core' );
		}

		if ( $password !== $rpassword ) {
			$message[] = esc_html__( 'Password dose not match.', 'realty-pack-core' );
		}

	    // Check terms
		$enable_term = get_theme_mod( 'enable_term_of_service' , false );
		$term_link   = get_theme_mod( 'term_of_service_link' , false );
		if ( 'false' == $term_services  && ( true == $enable_term && is_numeric( $term_link ) ) ) {
			$message[] = esc_html__( 'Check term of service.', 'realty-pack-core' );
		}

	    // Return message 
		if ( null !== $message ) {
			wp_send_json( array( 'error' => true , 'message' => $message ) );
		}

	    // Do save action
		$user = $this->model->save_user( $email, $fname, $lname, $username, $role, $password );

	}


}