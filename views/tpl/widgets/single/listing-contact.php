<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<?php if( ! $is_edit_mode ): ?>
	<?php \wpl_activity::import( 'listing_contact', 0, $params ); ?> 
<?php else: ?>
	<div class="rtpc-sp-agent-contact-form rtp-contactform-label">
		<div class="rtpc-sp-agent-contact-form-title"><?php esc_html_e( 'Enquire About This Property', 'realty-pack-core' ); ?></div>
		<div class>
			<input type="text" name="name" value="" placeholder="Your Name">
			<input type="text" name="phone" placeholder="Phone" value="">
			<input type="text" name="email" placeholder="Email" value="">
		</div>
		<div>
			<textarea name="description" placeholder="<?php esc_attr_e( 'I am interested in this property and I would like to know more details.', 'realty-pack-core' ); ?>" rows="7">
			</textarea>
		</div>

		<div class="rtp-main-button-blue rtp-btn-blue-black">
			<a href="http://sample.com/submit-property">
				<span> <?php esc_html_e( 'REQUEST INFO', 'realty-pack-core' ); ?> </span>
			</a>
		</div>
	</div>
	<?php endif; ?>