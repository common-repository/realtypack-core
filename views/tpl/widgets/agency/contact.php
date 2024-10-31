<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-contact-container">
	<div class="rtpc-single-agency-contact-form rtp-contactform-label">

		<div class="rtp-col-md-4">
			<label><?php esc_html_e( 'Name', 'realty-pack-core' ); ?></label>
			<input id="rtpc-agency-contact-name" type="text" name="name" value="" placeholder="Your Name">
		</div>

		<div class="rtp-col-md-4">
			<label><?php esc_html_e( 'Phone', 'realty-pack-core' ); ?></label>
			<input id="rtpc-agency-contact-phone" type="text" name="phone" placeholder="Your Phone" value="">
		</div>

		<div class="rtp-col-md-4">
			<label><?php esc_html_e( 'Email', 'realty-pack-core' ); ?></label>
			<input id="rtpc-agency-contact-email" type="text" name="email" placeholder="Your Email" value="">
		</div>

		<div class="rtp-col-xs-12 rtpc-single-agency-contact-form-message">
			<label><?php esc_html_e( 'Message', 'realty-pack-core' ); ?></label>
			<textarea id="rtpc-agency-contact-contact" name="message" placeholder="Your Message" rows="7"  >
			</textarea>
		</div>

		<div class="rtpc-single-agency-contact-form-agreement rtp-col-xs-12">
			<label><?php esc_html_e( 'GDPR Agreement', 'realty-pack-core' ); ?> </label>
			<input type="checkbox" name="agreement" >
			<span><?php esc_html_e( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'realty-pack-core' ); ?></span>
		</div>

		<div class="rtp-main-button-blue rtp-btn-blue-black">
			<a href="#" data-nounce="<?php echo esc_attr( $nounce ); ?>" data-user="<?php echo esc_attr( $id ); ?>">
				<span> <?php esc_html_e( 'SEND NOW', 'realty-pack-core' ); ?> </span>
			</a>
		</div>

		<span class="rtpc-message"></span>

	</div> 
</div>

