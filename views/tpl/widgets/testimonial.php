<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-testimonial-swiper-container" style="background-image:<?php echo isset( $settings['bg_image']['url'] ) ? esc_attr( "url('".$settings['bg_image']['url'] . "')") : 'unset'; ?>">
	<div class="swiper-wrapper">
		<?php if ( $settings['list'] ): ?>
			<?php foreach ( $settings['list'] as $item ): ?>
				<div class="swiper-slide">
					<span class="rtpc-testimonial-qout" style="" >,,</span>
					<div class="rtpc-testimonial-comment" >
						<?php echo esc_html( $item['content'] ); ?>
					</div>
					<div class="rtpc-testimonial-comment-author">
						<img class="rtpc-testimonial-comment-author-pic" src="<?php echo esc_url( $item['client_image']['url'] ); ?>" alt="testimonial" />
						<div class="rtpc-testimonial-comment-author-container">
							<div class="rtpc-testimonial-comment-author-name">
								<?php echo esc_html( $item['client_name'] ); ?> 
							</div>
							<div class="rtpc-testimonial-comment-author-job"> 
								<?php echo esc_html( $item['client_job'] ); ?> 
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<!-- Add Arrows -->
	<div class="rtpc-testimonial-arrowbutton-next"></div>
	<div class="rtpc-testimonial-arrowbutton-prev"></div>
</div>