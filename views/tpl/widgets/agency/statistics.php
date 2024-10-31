<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-statistics">
	<div>
		<label><?php esc_html_e( 'LISTINGS', 'realty-pack-core' )?> :</label>
		<span><?php echo esc_html( $listing_count ); ?></span>
	</div>
	<div>
		<label><?php esc_html_e( 'AGENTS', 'realty-pack-core' )?> :</label>
		<span><?php echo esc_html( $agency_count ); ?></span>
	</div>

</div>