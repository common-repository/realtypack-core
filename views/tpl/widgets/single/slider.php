<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<!-- slider -->
<div class="swiper-container rtpc-single-property-gallery" data-slide-count="<?php esc_attr_e( sizeof($images) )?>">
	<div class="swiper-wrapper">
		<?php foreach ( $images as $image): ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( $image ); ?>" alt="Property Image">
			</div>
		<?php endforeach; ?>
	</div>
	<!-- Add Arrows -->
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>
</div>
<div class="swiper-container rtpc-single-property-gallery-thumbs">
	<div class="swiper-wrapper">
		<?php foreach ( $images as $image): ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( $image ); ?>" alt="Property Image">
			</div>
		<?php endforeach; ?>
	</div>
</div>