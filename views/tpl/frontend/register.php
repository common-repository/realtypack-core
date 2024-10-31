<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-register-box" id="rtpc-register-container">
	<div class="rtpc-register-box-container">
		<div class="rtpc-register-image-holder">
			<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/img/cover.png' ); ?>" alt="login-cover">
		</div>

		<div class="rtpc-register-data-holder">
			<h3><?php echo $header_text; // Already escaped ?></h3>

            <input type="text" id="RTPC_register_email" tabindex="1" placeholder="<?php echo $email;// Already escaped ?>" required>
            <input type="text" id="RTPC_register_username" tabindex="2" placeholder="<?php echo $username;// Already escaped ?>" required>
            <div class="rtpc-register-two-div">
                <input type="text" id="RTPC_register_fname" tabindex="3" placeholder="<?php echo $fname;// Already escaped ?>" required>
                <input type="text" id="RTPC_register_lname" tabindex="4" placeholder="<?php echo $lname;// Already escaped ?>" required>
            </div>
            <div class="rtpc-register-two-div">
                <input type="password" id="RTPC_register_password" tabindex="5" placeholder="<?php echo $password;// Already escaped ?>" required>
                <input type="password" id="RTPC_register_rpassword" tabindex="6" placeholder="<?php echo $rpassword;// Already escaped ?>" required>
            </div>
            <div class="rtpc-register-select">
                <select id="RTPC_register_role" tabindex="7" >
                    <?php foreach ( $roles as $krole => $role ): ?>
                        <option value="<?php echo esc_attr( $krole ); ?>"><?php echo esc_html( $role ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if ( $agree ): ?>
            <div class="rtpc-register-controls">
                <div class="rtpc-agree-term">
                    <input type="checkbox" id="term_register_services" tabindex="8">
                    <a href="<?php echo esc_url( $term_link ); ?>">
                        <?php echo $agree; ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>

			<div class="rtpc-register-button rtp-main-button-blue rtp-btn-blue-black rtpc-register-submit">
				<a href="#" class="rtpc-register-submit"><?php echo $register_text; ?></a>
			</div>

			<div class="register-message"></div>

		</div>
	</div>

</div>