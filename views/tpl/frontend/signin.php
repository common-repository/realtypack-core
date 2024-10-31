<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-signin-box" id="rtpc-signin-container">
	<div class="rtpc-signin-box-container">
		<div class="rtpc-signin-image-holder">
			<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/img/cover.png' ); ?>" alt="login-cover">
		</div>

		<div class="rtpc-signin-data-holder rtpc-signin-show">
			<h3><?php echo $header_text; // Already escaped ?></h3>

			<input type="text" id="rtpc-username" placeholder="<?php echo $username;// Already escaped ?>" required tabindex="1">

			<input type="password" id="rtpc-password" placeholder="<?php echo $password;// Already escaped ?>" required tabindex="2">

			<div class="rtpc-signin-controls">
				<div class="rtpc-remember-me">
					<input type="checkbox" id="remeber_me" tabindex="3">
					<label for="remeber_me"><?php echo $remeber_me; ?></label>
				</div>
				<a id="rtpc-reset-password" href="#"><?php esc_html_e( 'Forgot your password?' , 'realty-pack-core' ); ?></a>
			</div>
			<span class="signin-message"></span>

			<div class="rtpc-signin-button rtp-main-button-blue rtp-btn-blue-black rtpc-signin-submit" tabindex="4">
				<a href="#" class="rtpc-signin-submit"><?php echo $login_button; ?></a>
			</div>

<!-- 			<span class="rtpc-signin-divider">
				<span><? esc_html_e( 'OR' ); ?></span>
			</span> -->
<!-- 			<div class="rtpc-signin-button rtpc-signin-google rtp-main-button-blue rtp-btn-blue-black">
				<img src="<?php //echo esc_attr( RTPC_ASSETS_URL . 'assets/img/google-favicon.png' ); ?>" alt="google-login">
				<a href="#" class="rtpc-signin-submit"><?php //_e( 'LOGIN WITH GOOGLE' , 'realty-pack-core' ) ?></a>
			</div>

			<div class="rtpc-signin-button rtpc-signin-facebook rtp-main-button-blue rtp-btn-blue-black">
				<img src="<?php //echo esc_attr( RTPC_ASSETS_URL . 'assets/img/facebook-favicon.png' ) ?>" alt="facebook-login">
				<a href="#" class="rtpc-signin-submit"><?php //_e( 'LOGIN WITH FACEBOOK' , 'realty-pack-core' ) ?></a>
			</div> -->

			<?php if ( true === $register_status ): ?>
				<div class="rtpc-signin-register">
					<span><?php echo $register_text; ?></span>
					<a href="#" class="rtpc-reopen-register-modal rtpc-register-link">
						<?php echo $register_here; ?> 
					</a>
				</div>
			<?php endif; ?>
		</div>

		<!-- Reset Password -->
		<div class="rtpc-signin-data-holder rtpc-resetpass-show">
			<h3><?php esc_html_e('Reset your password', 'realty-pack-core' ); ?></h3>

			<span class="rtpc-resetpass-desc">
				<?php esc_html_e( 'Please Enter Your User Name Or Email Address And Submit To Receive An Email With Instruction To Reset Your Password.' , 'realty-pack-core' ); ?>
			</span>

			<input type="text" id="RTPC_email" placeholder="<?php echo $email;// Already escaped ?>" required>

			<div class="rtpc-signin-button rtp-main-button-blue rtp-btn-blue-black">
				<a href="#" class="rtpc-signin-submit"><?php esc_html_e( 'SEND RESET LINK' , 'realty-pack-core' ); ?></a>
			</div>

			<div class="rtpc-back-to-signin">
				<a id="rtpc-back-to-signin" href="#" class="rtpc-register-link"><?php esc_html_e( 'Back to Sign in' , 'realty-pack-core' ); ?></a>
			</div>
		</div>
	</div>
</div>