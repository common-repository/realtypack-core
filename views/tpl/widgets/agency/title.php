<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-title-container">
	<?php if ( $settings['agency_title'] == 'yes' ): ?>
		<div class="rtpc-single-agency-title">
			<?php echo esc_html( $agency_title ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $settings['agency_address'] == 'yes' ): ?>
		<div class="rtpc-single-agency-address">
			<i class="rtpf rtpf-map-marker"></i>
			<?php echo esc_html( $agency_address ); ?>    
		</div>
	<?php endif; ?>

	<div class="rtpc-single-agency-phone">
		<?php if ( $settings['agency_phone'] == 'yes' || $settings['agency_mobile'] == 'yes' ): ?>
			<i class="rtpf rtpf-phone"></i>
		<?php endif; ?>
		<?php if ( $settings['agency_phone'] == 'yes' ): ?>
			<?php echo esc_html( $agency_phone ); ?>
		<?php endif; ?>
		<?php if ( $settings['agency_phone'] == 'yes' && $settings['agency_mobile'] == 'yes' ): ?>
			<span> - </span>
		<?php endif; ?>
		<?php if ( $settings['agency_mobile'] == 'yes' ): ?>
			<?php echo esc_html( $agency_mobile ); ?>
		<?php endif; ?>
	</div>

</div>
