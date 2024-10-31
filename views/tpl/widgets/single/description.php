<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-details-container">

	<div class="rtpc-sp-details">

		<?php if ( 'yes' === $settings['enable_title'] ): ?>
			<div class="rtpc-sp-details-box-title">
				<span>
					<?php echo esc_html( $data['title'] ); ?>
				</span> 
			</div>
		<?php endif; ?>

		<div class="rtpc-sp-details-content">
			<?php echo wp_kses_post( $data['field_308'] );  ?>
		</div>
	</div>
</div>