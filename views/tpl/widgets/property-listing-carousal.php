<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
use RTPC\Controllers\Wpl\RTPC_Controllers_WPL_Wpl;
?>
<div class="rtp-carousel-container">
	<div class="<?php echo esc_attr( $layout_type ); ?>">
		<div class="swiper-wrapper">
			<?php if ( isset( $properties ) ): ?>
				<?php foreach ( $properties as $key => $gallery ) :

					if(!isset($gallery["items"]["gallery"][0])) continue;

					$params = array();
					$params['image_name'] 		=	$gallery["items"]["gallery"][0]->item_name;
					$params['image_parentid'] 	=	$gallery["items"]["gallery"][0]->parent_id;
					$params['image_parentkind'] =	$gallery["items"]["gallery"][0]->parent_kind;
					$params['image_source'] 	=	\wpl_global::get_upload_base_path(\wpl_property::get_blog_id($params['image_parentid'])) . $params['image_parentid'] . DS . $params['image_name'];

					if($gallery["items"]["gallery"][0]->item_cat != 'external') $image_url = \wpl_images::create_gallery_image($settings['image_width'], $settings['image_height'], $params, 1);
					else $image_url = $gallery["items"]["gallery"][0]->item_extra3;

					$image_title = \wpl_property::update_property_title($gallery['raw']);
					$image_location = isset( $gallery['raw']['location_text'] ) ? trim($gallery['raw']['location_text']) : '';
					$location2_name = isset( $gallery['raw']['location2_name'] ) ? __( ' in ', 'realty-pack-core' ) . $gallery['raw']['location2_name'] : '';
					$property_type  = isset( $gallery['materials']['property_type']['value'] ) ? ucfirst( $gallery['materials']['property_type']['value'] ) : '';
					$price = isset( $gallery['materials']['price']['value'] ) ? $gallery['materials']['price']['value'] : '';
					$area = isset( $gallery['materials']['lot_area']['value'] ) ? $gallery['materials']['lot_area']['value'] : '';
					$user_id = $gallery['raw']['user_id'];
					$user_data = \wpl_users::get_user( $user_id );

					if( trim( $user_data->wpl_data->profile_picture ) != '' ) {
						$user_data->profile_picture = array(
							'url' => \wpl_items::get_folder($user_id, 2).$user_data->wpl_data->profile_picture,
							'path' => \wpl_items::get_path($user_id, 2).$user_data->wpl_data->profile_picture,
							'name' => $user_data->wpl_data->profile_picture
						);
					} else {
						$user_data->profile_picture = array(
							'url' => \wpl_global::get_wpl_asset_url('img/crm/avatar.png'),
							'path' => WPL_ABSPATH. 'assets' .DS. 'img' .DS. 'crm' .DS. 'avatar.png',
							'name' => ''
						);
					}

                	// First name
					$meta_first_name = ( isset( $user_data->data->meta->first_name ) && $user_data->data->meta->first_name != '' ) ? $user_data->data->meta->first_name : '';
					$first_name = ( isset( $user_data->data->wpl_data->first_name ) && $user_data->data->wpl_data->first_name != '' ) ? $user_data->data->wpl_data->first_name : $meta_first_name;

					// Last name
					$meta_last_name = ( isset( $user_data->data->meta->last_name ) && $user_data->data->meta->last_name != '' ) ? $user_data->data->meta->last_name : '';
					$last_name = ( isset( $user_data->data->wpl_data->last_name ) && $user_data->data->wpl_data->last_name != '' ) ? $user_data->data->wpl_data->last_name : $meta_last_name;

					$full_name = $first_name . $last_name;

					$category_link = RTPC_Controllers_WPL_Wpl::get_needed_properties_permalink( $gallery['data']['property_type'], 'sf_select_property_type' );

					?>     
					<div class="swiper-slide">
						<img itemprop="image" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $params['image_name'] ); ?>" style="" />
						<div class="rtp-carousel-property-details">
							<div class="rtp-carousel-property-category">
								<a href="<?php echo esc_url( $category_link ); ?>"> <?php echo esc_html( $image_title ); ?> </a>
							</div>
							<a class="rtp-carousel-property-title" href="<?php echo esc_url( $gallery['link'] ); ?>"> <?php echo esc_html( $property_type . $location2_name ); ?> </a>
							<p class="rtp-carousel-property-price"> <?php echo esc_html( $price ); ?> </p>
							<div class="rtp-carousel-property-address">
								<i class="rtpf-map-marker"></i>
								<?php echo esc_html( $image_location ); ?>
							</div>
							<div class="rtp-carousel-property-features">
								<div>
									<?php esc_html_e( 'Bedroom: ' , 'realty-pack-core' ); ?> 
									<span>
										<?php echo isset( $gallery['raw']['bedrooms'] ) ? esc_html( $gallery['raw']['bedrooms'] ) : ''; ?>
									</span>
								</div>
								<div>
									<?php esc_html_e( 'Bedroom: ' , 'realty-pack-core' ); ?> 
									<span>
										<?php echo isset( $gallery['raw']['bathrooms'] ) ? esc_html( $gallery['raw']['bathrooms'] ) : ''; ?>
									</span>
								</div>
								<div>
									<?php esc_html_e( 'Area: ' , 'realty-pack-core' ); ?>
									<span>
										<?php echo esc_html( $area ); ?>
									</span>
								</div>
							</div>
							<div class="rtp-carousel-property-footer">
								<div class="rtp-carousel-agent">
									<img src="<?php echo esc_url( $user_data->profile_picture['url'] ); ?>" alt="" class="src">
									<span> <?php echo esc_html( $full_name ); ?></span>
								</div>
								<a class="rtp-carousel-property-more-details" href="<?php echo esc_url( $gallery['link'] ); ?>"><?php esc_html_e( 'More Details', 'realty-pack-core' ); ?> 
								<i class="rtpf-angle-right"></i>
							</a>
						</div>
				</div>
				<div class="rtp-carousel-details-bg rtp-carousel-property-details" style="position:absolute">
					<div class="rtp-carousel-property-category">
						<a href=""> <?php echo esc_html( $image_title ); ?> </a>
					</div>
					<p class="rtp-carousel-property-title"> <?php echo esc_html( $property_type . $location2_name ); ?> </p>
					<p class="rtp-carousel-property-price"> <?php echo esc_html( $price ); ?> </p>
					<div class="rtp-carousel-property-address">
						<i class="rtpf-map-marker"></i>
						<?php echo esc_html( $image_location ); ?>
					</div>
					<div class="rtp-carousel-property-features">
						<div>
							<?php esc_html_e( 'Bedroom: ' , 'realty-pack-core' ); ?> 
							<span>
								<?php echo isset( $gallery['raw']['bedrooms'] ) ? esc_html( $gallery['raw']['bedrooms'] ) : ''; ?>
							</span>
						</div>
						<div>
							<?php esc_html_e( 'Bedroom: ' , 'realty-pack-core' ); ?> 
							<span>
								<?php echo isset( $gallery['raw']['bathrooms'] ) ? esc_html( $gallery['raw']['bathrooms'] ) : ''; ?>
							</span>
						</div>
						<div>
							<?php esc_html_e( 'Area: ' , 'realty-pack-core' ); ?>
							<span>
								<?php echo esc_html( $area ); ?>
							</span>
						</div>
					</div>
					<a class="rtp-carousel-property-more-details" href="<?php echo esc_url( $gallery['link'] ); ?>">
						<?php echo esc_html( 'More Details', 'realty-pack-core' ); ?> 
						<i class="rtpf-angle-right"></i>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>  
<!-- navigation controllers -->
<a class="slider-control-left" href="#" data-jump="prev"></a>
<a class="slider-control-right" href="#" data-jump="next"></a>
<div class="slide-counter">
</div>

</div>
</div>
