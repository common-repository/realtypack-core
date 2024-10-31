<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-socials">
	<?php if( 'yes' === $settings['facebook'] && '' !== $facebook ): ?>
		<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="rtpc-single-agency-social-icon rtp-default-blue-icon ">
			<i class="rtpf rtpf-facebook-1"></i>
		</a>
	<?php endif; ?>

	<?php if( 'yes' === $settings['twitter'] && '' !== $twitter ): ?>
		<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="rtpc-single-agency-social-icon rtp-default-blue-icon ">
			<i class="rtpf rtpf-twitter-alt"></i>
		</a>
	<?php endif; ?>

	<?php if( 'yes' === $settings['pinterest'] && '' !== $pinterest ): ?>
		<a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" class="rtpc-single-agency-social-icon rtp-default-blue-icon ">
			<i class="rtpf rtpf-pinterest"></i>
		</a>
	<?php endif; ?>

	<?php if( 'yes' === $settings['skype'] && '' !== $skype ): ?>
		<a href="<?php echo esc_url( $skype ); ?>" target="_blank" class="rtpc-single-agency-social-icon rtp-default-blue-icon ">
			<i class="rtpf rtpf-skype"></i>
		</a>
	<?php endif; ?>

	<?php if( 'yes' === $settings['website'] && '' !== $website ): ?>
		<a href="<?php echo esc_url( $website ); ?>" target="_blank" class="rtpc-single-agency-social-icon rtp-default-blue-icon ">
			<i class="rtpf rtpf-world"></i>
		</a>
	<?php endif; ?>
</div>
