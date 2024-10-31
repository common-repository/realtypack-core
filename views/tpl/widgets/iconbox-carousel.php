<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-iconbox-carousel">
	<div class="swiper-wrapper">
		<!-- repeater -->
		<?php if ( $settings['iconbox_list'] ): ?>
			<?php foreach ( $settings['iconbox_list'] as $item ): ?>
				<div class="swiper-slide">
					<div class="rtpc-carousel-icon-box-wrapper">
						<div class="rtpc-carousel-icon-box-icon">
							<span class="rtpc-carousel-icon elementor-animation-">
								<i class="<?php echo esc_attr( $item['iconbox_icon'] ); ?>" aria-hidden="true"></i>
							</span>
						</div>
						<div class="rtpc-carousel-icon-box-content">
							<div class="rtpc-carousel-icon-box-title">
								<span>
									<?php echo esc_html( $item['iconbox_title'] ); ?>
								</span>
							</div>
							<p class="rtpc-carousel-icon-box-description">
								<?php echo esc_html( $item['iconbox_content'] ); ?>
							</p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
