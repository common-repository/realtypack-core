<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
use RTPC\WPL\RTPC_WPL_Listing;
?>

<?php if( ! $edit_mod ): ?>
	<div class="rtpc-rpgs-container rtpc-details-container">
		<div class="rtpc-sp-details">
			<div class="rtpc-sp-details-box-title">
				<span>
					<?php esc_html_e( 'Similar Properties', 'realty-pack-core' ); ?>
				</span> 
			</div>
			<div class="rtpc-rpgs-properties-container <?php echo esc_attr( 'rtpc-rpgs-properties-grid' ); ?>">
				<!-- property grid div for repeat   -->
				<?php foreach( $wpl_properties as $key => $property ):
					if( $key == 'current' ) continue;

					/** unset previous property **/
					unset( $wpl_properties['current'] );

					/** set current property **/
					$wpl_properties['current'] = $property;

                	// Get gallery
					$raw_gallery = isset( $property['items']['gallery'] ) ? $property['items']['gallery'] : array();
					$gallery = \wpl_items::render_gallery( $raw_gallery, \wpl_property::get_blog_id( $property['data']['id'] ) );

                	// Get tags
					$kind = $property['data']['kind'];
					$tags = \wpl_flex::get_tag_fields($kind);

					$property_price = isset($property['materials']['price']['value']) ? $property['materials']['price']['value'] : '';

					$living_area = isset($property['materials']['living_area']['value']) ? explode(' ', $property['materials']['living_area']['value']) : (isset($property['materials']['lot_area']['value']) ? explode(' ', $property['materials']['lot_area']['value']): array());
					$living_area_count = count($living_area);

					$build_up_area = $living_area_count ? (isset($living_area[0]) ? implode(' ', array_slice($living_area, 0, $living_area_count-1)) : '') : '';

					// Membership ID of current user
					$current_user_membership_id = \wpl_users::get_user_membership();

                	// Location visibility option
					$location_visibility = \wpl_property::location_visibility( $property['data']['id'], $property['data']['kind'], $current_user_membership_id );

                	// Rom parking Bath
					if(isset($property['materials']['bedrooms']['value']) and trim($property['materials']['bedrooms']['value'])) {

						$room = sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Bedroom : ", 'realty-pack-core') , $property['materials']['bedrooms']['value'] );

					} elseif (isset($property['materials']['rooms']['value']) and trim($property['materials']['rooms']['value'])) {

						$room = sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Room : ", 'realty-pack-core') , $property['materials']['rooms']['value'] );
					} else {
						$room = '';
					}

					$bathroom = (isset($property['materials']['bathrooms']['value']) and trim($property['materials']['bathrooms']['value'])) ? sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Bathroom : ", 'realty-pack-core') , esc_html( $property['materials']['bathrooms']['value'] ) ) : '';

					$parking = (isset($property['materials']['f_150']['values'][0]) and trim($property['materials']['f_150']['values'][0])) ? sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Parking : ", 'realty-pack-core') , esc_html( $property['materials']['f_150']['values'][0] ) ) : '';

                	// Author info
					$author_data = RTPC_WPL_Listing::get_user_info( $property['data']['user_id'] );
					$author_name = $author_last_name = '';
                	// first name
					if ( isset( $author_data->data->wpl_data->first_name ) ) {
						$author_name = $author_data->data->wpl_data->first_name;
					} elseif ( $author_data->data->meta->first_name ) {
						$author_name = $author_data->data->wpl_data->first_name;
					}            
                	// last name
					if ( isset( $author_data->data->wpl_data->last_name ) ) {
						$author_last_name = $author_data->data->wpl_data->last_name;
					} elseif ( $author_data->data->meta->last_name ) {
						$author_last_name = $author_data->data->wpl_data->last_name;
					}

                	// Date
					$ago = RTPC_WPL_Listing::time_elapsed_string( $property['data']['add_date'] );
					?>
					<div class="rtpc-rpgs-property-box rtp-col-md-<?php echo esc_attr('6') ?>">
						<div class="rtpc-rpgs-property">
							<div class="rtpc-rpgs-property-image">
								<div class="rtpc-rpgs-property-tags">
									<?php if ( $tags ): ?>
										<?php foreach( $tags as $tag ): ?>
											<span> <?php echo esc_html( $tag->name ); ?> </span>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<!-- Check gallery if it is one item do not print controls @temprory -->
								<?php if( $gallery ): ?>
									<div class="rtpc-rpgs-property-slider">
										<div class="swiper-wrapper">
											<?php foreach ( $gallery as $gitem ): ?>
												<div class="swiper-slide">
													<img src="<?php echo esc_attr( $gitem['url'] ); ?>" alt="<?php echo esc_attr( $gitem['title'] ); ?>" />
												</div>
											<?php endforeach; ?>
										</div>
										<!-- Add Arrows -->
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>

										<div class="rtpc-rpgs-property-image-footer">
											<div class="rtpc-rpgs-property-image-footer-icons">
												<i class="rtpf rtpf-reload" aria-hidden="true"></i>
												<i class="rtpf rtpf-heart-o" aria-hidden="true"></i>
												<i class="rtpf rtpf-share-1" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<!--  End image section -->

							<div class="rtpc-rpgs-property-content">
								<h3 class="rtpc-rpgs-property-title"><a href="<?php echo esc_url( $property['link'] ); ?>"><?php echo esc_html( $property['property_title'] ); ?></a></h3>
								<div class="rtpc-rpgs-property-content-price-container">
									<p class="rtpc-rpgs-property-content-price"> <?php echo esc_html( $property_price ); ?> </p>
									<p class="rtpc-rpgs-property-content-price-type">
										<span><?php echo esc_html( $build_up_area ); ?></span>
										<span><?php echo esc_html( ' / ' . $living_area[$living_area_count-1] ); ?></span>
									</p>
								</div>
								<div class="rtpc-rpgs-property-content-address">
									<i class="rtpf rtpf-map-marker rtpc-rpgs-property-address-icon"></i>
									<span class="rtpc-rpgs-property-address-text"> <?php echo esc_html( ($location_visibility === true ? $property['location_text'] : $location_visibility) ); ?> </span>
								</div>
								<div class="rtpc-rpgs-property-content-details">
									<?php if ( $room !== '' && $bathroom !== '' && $parking !== '' ): ?>
										<div class="rtpc-rpgs-property-features">
											<?php echo $room . $bathroom . $parking ; ?>
										</div>
									<?php endif; ?>
									<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black">
										<a href="<?php echo esc_url( $property['link'] ); ?>">
											<span>
												<?php esc_html_e( 'Details', 'realty-pack-core' ); ?>
											</span>
										</a>
									</div>
								</div>
								<div class="rtpc-rpgs-property-content-author">

									<div class="rtpc-rpgs-property-content-author-details">
										<img src="<?php echo esc_url( $author_data->data->profile_picture['url'] ); ?>"  alt="<?php echo esc_attr( $author_data->data->meta['nickname'] ); ?>" />
										<a  href="#"> <?php echo esc_html( $author_name . ' ' . $author_last_name ); ?> </a>
									</div>

									<div class="rtpc-rpgs-property-post-date <?php esc_attr_e('rtpc-rpgs-property-post-date-single'); ?>">
										<i class="rtpf rtpf-calendar-1"> </i>
										<span> <?php echo esc_html( $ago ); ?> </span>
									</div>

								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php else: ?>
		<div class="rtpc-rpgs-container rtpc-details-container">
			<div class="rtpc-sp-details">
				<div class="rtpc-sp-details-box-title">
					<span>
						<?php esc_html_e( 'Similar Properties', 'realty-pack-core' ); ?>
					</span> 
				</div>
				<div class="rtpc-rpgs-properties-container <?php echo esc_attr( 'rtpc-rpgs-properties-grid' ); ?>">
					<?php for ($i=0; $i < 2; $i++): ?>
						<div class="rtpc-rpgs-property-box rtp-col-md-<?php echo esc_attr('6'); ?>">
							<div class="rtpc-rpgs-property">
								<div class="rtpc-rpgs-property-image">
									<div class="rtpc-rpgs-property-tags">
										<span> <?php esc_html_e( 'Tag Name', 'realty-pack-core' ); ?> </span>
										<span> <?php esc_html_e( 'Tag Name', 'realty-pack-core' ); ?> </span>
										<span> <?php esc_html_e( 'Tag Name', 'realty-pack-core' ); ?> </span>
									</div>
									<!-- Check gallery if it is one item do not print controls @temprory -->
									<div class="rtpc-rpgs-property-slider">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/13711975_l@2x.png' ); ?>" alt="<?php esc_attr_e('Property Builder', 'realty-pack-core') ?>" />
											</div>
										</div>
										<!-- Add Arrows -->
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>

										<div class="rtpc-rpgs-property-image-footer">
											<div class="rtpc-rpgs-property-image-footer-icons">
												<i class="rtpf rtpf-reload" aria-hidden="true"></i>
												<i class="rtpf rtpf-heart-o" aria-hidden="true"></i>
												<i class="rtpf rtpf-share-1" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								</div>
								<!--  End image section -->

								<div class="rtpc-rpgs-property-content">
									<h3 class="rtpc-rpgs-property-title"><a href="#"><?php esc_html_e( 'Title', 'realty-pack-core' ); ?></a></h3>
									<div class="rtpc-rpgs-property-content-price-container">
										<p class="rtpc-rpgs-property-content-price"> <?php esc_html_e( '4500$', 'realty-pack-core' ); ?> </p>
										<p class="rtpc-rpgs-property-content-price-type">
											<span><?php esc_html_e( '360', 'realty-pack-core' ); ?></span>
											<span><?php esc_html_e( ' / ' . '260' ); ?></span>
										</p>
									</div>
									<div class="rtpc-rpgs-property-content-address">
										<i class="rtpf rtpf-map-marker rtpc-rpgs-property-address-icon"></i>
										<span class="rtpc-rpgs-property-address-text"><?php esc_html_e( '1131 Kidlington Knoll East, Southwell, North Dakota', 'realty-pack-core' );?></span>
									</div>
									<div class="rtpc-rpgs-property-content-details">
										<div class="rtpc-rpgs-property-features">
											<div>
												<span class="rtpc-rpgs-property-content-details-label"><?php esc_html_e( '2 Bedrooms', 'realty-pack-core' ); ?></span>
											</div>                    		
											<div>
												<span class="rtpc-rpgs-property-content-details-label"><?php esc_html_e( '1 Bathroom', 'realty-pack-core' ); ?></span>
											</div>
										</div>
										<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black">
											<a href="#">
												<span>
													<?php esc_html_e( 'Details', 'realty-pack-core' ); ?>
												</span>
											</a>
										</div>
									</div>
									<div class="rtpc-rpgs-property-content-author">

										<div class="rtpc-rpgs-property-content-author-details">
											<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/agent.png' ); ?>" alt="author image"/>
											<a href="#"> <?php esc_html_e( 'Jordan', 'realty-pack-core' ); ?> </a>
										</div>

										<div class="rtpc-rpgs-property-post-date <?php esc_attr_e('rtpc-rpgs-property-post-date-single'); ?>">
											<i class="rtpf rtpf-calendar-1"> </i>
											<span> <?php esc_html_e( '2 Week ago' , 'realty-pack-core' ); ?> </span>
										</div>

									</div>
								</div>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>

		</div>

		<?php endif; ?>