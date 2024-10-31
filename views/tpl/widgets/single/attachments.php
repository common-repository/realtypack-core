<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-sp-attachments rtpc-details-container">
	<div class="rtpc-sp-details">
		<div class="rtpc-sp-details-box-title">
			<span>
				<?php esc_html_e( 'Property Attachments', 'realty-pack-core' ); ?>
			</span> 
		</div>

		<?php \wpl_activity::import( 'listing_attachments', array(), $params ); ?>
	</div>
</div>