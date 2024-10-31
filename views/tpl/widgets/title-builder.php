<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtp-elementor-titlebuilder">
	<div class="rtp-elementor-titlebuilder-title-container">
		<span class="rtp-elementor-titlebuilder-shape" style="position:absolute;"></span>
		<span class="rtp-elementor-titlebuilder-title">
			<?php echo esc_html( $settings['titlebuilder_title'] ); ?>
		</span>
	</div>
	<div class="rtp-elementor-titlebuilder-subtitle">
		<?php echo wp_kses_post( $settings['titlebuilder_subtitle'] ); ?>
	</div>
</div>