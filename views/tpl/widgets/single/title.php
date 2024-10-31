<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
// All data escaped before
?>
<div class="rtpc-single-property-title-box">
	<div class="rtpc-single-property-title">
		<div class="rtpc-single-property-title-text"><?php echo $prp_title; ?></div>
		<?php if( ! is_null( $listing_type ) ): ?>
			<div class="rtpc-single-property-cat"><?php echo $listing_type; ?></div>
		<?php endif; ?>
	</div>
	<div class="rtpc-single-property-price">
		<div class="rtpc-single-property-price-text"><?php echo $price_unit['name']; ?><?php echo $price; ?></div>
		<div class="rtpc-single-property-unit"><?php echo $sqft; ?></div>
	</div>
	<div class="rtpc-single-property-address">
		<div class="rtpc-single-property-address-text">
			<i class="rtpf rtpf-map-marker"></i>
			<span>
				<?php echo $location_string; ?>
			</span>
		</div>
		<div class="rtpc-single-property-visit">
			<i class="rtpf rtpf-eye-1"></i>
			<span>
				<?php echo $visits; ?>
			</span>
		</div>
	</div>
</div>