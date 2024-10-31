<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-sp-agency-contact-container" >
	<div class="rtpc-sp-agency-info-container">
		<a href="<?php echo esc_url( $link ); ?>">
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $company_name ); ?>" />
		</a>
		<div class="rtpc-sp-agency-info">
			<?php if( 'yes' === $settings['show_name'] && '' !== $company_name ): ?>
				<div class="rtpc-sp-agency-info-title">
					<?php echo esc_html( $company_name ); ?>
				</div>
			<?php endif;?>
			<?php if( 'yes' === $settings['show_phone'] && '' !== $tel ): ?>
				<div class="rtpc-sp-agency-info-phone">
					<i class="rtpf rtpf-phone"></i>
					<span>
						<?php echo esc_html( $tel ); ?>
					</span>
				</div>
			<?php endif;?>
			<a href="<?php echo esc_url( $listing_link ); ?>" class="rtpc-agent-property-listed"><?php echo sprintf( esc_html__( ' %s Listed properties', 'realty-pack-core' ), ( isset( $listing_count ) ? $listing_count : '0' ) ); ?></a>
		</div>
	</div>
	<div class="rtpc-sp-agency-details">
		<?php if($settings['show_desc']): ?>
			<p>
				<?php echo esc_html( wp_trim_words( $about, 20 ) ); ?>
			</p>
		<?php endif;?>
		<?php if( 'yes' === $settings['show_email'] && '' !== $secondary_email ): ?>
			<div class="rtpc-sp-agency-contact">
				<label>
					<?php esc_html_e( 'Email :', 'realty-pack-core' ); ?>
				</label>
				<span> 
					<?php echo esc_html( $secondary_email ); ?>
				</span>
			</div>
		<?php endif;?>
		<?php if( 'yes' === $settings['show_socials'] ): ?>
			<div class="rtpc-sp-agency-contact">
				<label>
					<?php esc_html_e( 'Socials :', 'realty-pack-core' ); ?>
				</label>
				<div class="rtpc-sp-agency-contact-socials">
					<?php if( '' !== $r_facebook ): ?>
						<a href="<?php echo esc_url( $r_facebook ); ?>"><i class="rtpf rtpf-facebook"></i></a>
					<?php endif; ?>

					<?php if( '' !== $r_twitter ): ?>
						<a href="<?php echo esc_url( $r_twitter ); ?>"><i class="rtpf rtpf-twitter"></i></a>
					<?php endif; ?>

					<?php if( '' !== $r_pinterest ): ?>
						<a href="<?php echo esc_url( $r_pinterest ); ?>"><i class="rtpf rtpf-pinterest"></i></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif;?>
		<?php if( 'yes' === $settings['show_skype'] && '' !== $r_skype ): ?>
			<div class="rtpc-sp-agency-contact">
				<label>
					<?php esc_html_e( 'Skype :', 'realty-pack-core' ); ?>
				</label>
				<span>
					<?php echo esc_html( $r_skype ); ?>
				</span>
			</div>
		<?php endif;?>

	</div>

	<div class="rtpc-sp-agency-contact-form rtp-contactform-label">
		<div>
			<input type="text" name="email" value="" placeholder="Your Email">
		</div>
		<div>
			<input type="text" name="phone" placeholder="Your Phone" value="">
		</div>
		<div>
			<textarea name="description" placeholder="I am interested in this property and I would like to know more details." rows="5"  >

			</textarea>
		</div>

		<div class="rtp-main-button-blue rtp-btn-blue-black">
			<a href="#">
				<span><?php esc_html_e( 'SUBMIT', 'realty-pack-core' ); ?></span>
			</a>
		</div>
	</div> 
</div>
