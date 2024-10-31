<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-qrcode-widget">
	<?php if ( ! $edit_mode ): ?>
		<?php \wpl_activity::import( 'qrcode', array(), $params ); ?>
	<?php else: ?>
		<img src="<?php echo esc_url( $image ); ?>" alt="qrcode">
	<?php endif; ?>
</div>