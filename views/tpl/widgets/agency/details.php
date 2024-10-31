<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-details-container">
	<?php if ( 'yes' === $settings['phone'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Phone :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $phone ); ?>
			</span>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['email'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Email :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $email ); ?>
			</span>
		</div>
	<?php endif; ?>
	
	<?php if ( 'yes' === $settings['mobile'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Mobile :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $mobile ); ?>
			</span>
		</div>
	<?php endif; ?>

	
	<?php if ( 'yes' === $settings['skype'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Skype :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $skype ); ?>
			</span>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['fax'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Fax :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $fax ); ?>
			</span>
		</div>            
	<?php endif; ?>
	
	<?php if ( 'yes' === $settings['website'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Website :', 'realty-pack-core'); ?>
			</label>
			<a href="<?php echo esc_url( $website ); ?>">
				<span>
					<?php echo esc_html( $website ); ?>
				</span>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['address'] ): ?>
		<div class="rtpc-single-agency-detail">
			<label>
				<?php esc_html_e('Address :', 'realty-pack-core'); ?>
			</label>
			<span>
				<?php echo esc_html( $address ); ?>
			</span>
		</div>
	<?php endif; ?>
</div>

