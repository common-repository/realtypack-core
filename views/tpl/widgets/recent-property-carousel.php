<?php
/**
* @link       https://eightqueens.pro
* @since      1.0.0
*
* @package    RealtyPack Core
*/
?>
<div class="rtp-recent-viewed-container">
	<div class="swiper-wrapper">
		<?php foreach( $properties as $key => $property ):
			if( $key == 'current' ) continue;

			$property_price = isset($property['materials']['price']['value']) ? $property['materials']['price']['value'] : '';

			// Get gallery
			$raw_gallery = isset( $property['items']['gallery'] ) ? $property['items']['gallery'] : array();
			$gallery = \wpl_items::render_gallery( $raw_gallery, \wpl_property::get_blog_id( $property['data']['id'] ) );

			$gallery[0]['url'] = \RTP_Image::edit_attachment_media( null, $gallery[0]['url'], array( $settings['image_width'] , $settings['image_height'] ) );
			?>
			<div class="swiper-slide" style="margin-right: 10px;">

				<img src="<?php echo esc_url( $gallery[0]['url'] ); ?>" alt="<?php esc_attr_e( $gallery[0]['title'] ); ?>" itemprop="image">

				<div class="rtp-recent-viewed-content">
					<a href="<?php echo esc_url( $property['link'] ); ?>" class="rtp-recent-viewed-title">
						<?php echo esc_html( $property['property_title'] ); ?>
					</a>
					<div class="rtp-recent-viewed-options">
						<div class="rtp-recent-viewed-price">
							<?php echo esc_html( $property_price ); ?>
						</div>
						<div class="rtp-recent-viewed-icons">
                            <a href="#" class="rtp-default-blue-icon small"><i class="rtpf rtpf-reload" aria-hidden="true"></i></a>
                            <a href="#" class="rtp-default-blue-icon small"><i class="rtpf rtpf-heart-o" aria-hidden="true"></i></a>
                            <a href="#" class="rtp-default-blue-icon small"><i class="rtpf rtpf-share-1" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<!-- Pagination -->
	<div class="rtp-recent-viewed-swiper-pagination">
	</div>
</div>

