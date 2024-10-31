<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtp-property-list-container">
	<?php foreach( $properties as $key => $property ):
		if( $key == 'current' ) continue;
		// Get gallery
		$raw_gallery = isset( $property['items']['gallery'] ) ? $property['items']['gallery'] : array();
		$gallery = \wpl_items::render_gallery( $raw_gallery, \wpl_property::get_blog_id( $property['data']['id'] ) );
		$gallery[0]['url'] = \RTP_Image::edit_attachment_media( null, $gallery[0]['url'], array( $settings['image_width'] , $settings['image_height'] ) );
		// Property type
		$property_type  = isset( $property['materials']['property_type']['value'] ) ? ucfirst( $property['materials']['property_type']['value'] ) : '';

		// Property price
		$property_price = isset($property['materials']['price']['value']) ? $property['materials']['price']['value'] : '';
		?>
		<div class="rtp-property-list">

			<img src="<?php echo esc_url( $gallery[0]['url'] ); ?>" alt="<?php esc_attr_e( $gallery[0]['title'] ); ?>">

			<div class="rtp-property-list-section">
				<span class="rtp-property-list-cat"><?php echo esc_html( $property_type ); ?></span>
				<a class="rtp-property-list-title" href="<?php echo esc_url( $property['link'] ); ?>">
					<?php echo esc_html( $property['property_title'] ); ?>
				</a>
				<span class="rtp-property-list-price">
					<?php echo esc_html( $property_price ); ?>
				</span>
			</div>
		</div>
	<?php endforeach; ?>
</div>
