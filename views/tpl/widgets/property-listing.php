<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
use RTPC\WPL\RTPC_WPL_Listing;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Agent;

$sort_options = \wpl_sort_options::get_sort_options( $kind, 1 );

// Membership ID of current user
$current_user_membership_id = \wpl_users::get_user_membership();

$listing_types = \wpl_global::get_listings();

?>

<?php if( 1 < count( $wpl_properties ) ): ?>
	<div class="rtpc-rpgs-container<?php echo isset( $elementor_settings['archive_class'] ) ? esc_attr( $elementor_settings['archive_class'] ) : ''; ?>">
		<div class="rtpc-rpgs-filters">
			<?php if ( $elementor_settings['display_tabs'] ): ?>
				<div class="rtpc-rpgs-filter-tabs rtpc-change-checked">
					<input type="radio" class="tab" data-listing="all" name="tabs" id="toggle-tab-all" checked />
					<label for="toggle-tab-all" class="checked">
						<?php esc_html_e( 'All', 'realty-pack-core' ); ?>
                    </label>

					<?php foreach( $listing_types as $listing_type ): ?>
						<input type="radio" class="tab" name="tabs" data-listing="<?php echo esc_attr( $listing_type['id'] ); ?>" id="toggle-tab<?php echo esc_attr( $listing_type['id'] ); ?>" />
						<label for="toggle-tab<?php echo esc_attr( $listing_type['id'] ); ?>">
							<?php echo esc_html( $listing_type['name'] ); ?>
						</label>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="rtpc-rpgs-view-sort-filters">
				<?php if ( $elementor_settings['display_views'] ) :?>

					<label id="rtpcPropertyGrid" class="<?php if( 'grid' == $elementor_settings['preview_mode'] ) echo esc_html( 'checked' ); ?>" >
						<i class="rtpf rtpf-layout-grid2"></i>
					</label>

					<label id="rtpcPropertyColumn" class="<?php if( 'column' == $elementor_settings['preview_mode'] ) echo esc_attr( 'checked' ); ?>" >
						<i class="rtpf rtpf-view-list-alt"></i>
					</label>
				<?php endif; ?>

				<?php if ( $elementor_settings['display_sort_options'] ): ?>
					<div class="rtpc-agent-sort">
<!-- 						<strong>
							<?php esc_attr_e( 'SORT BY:', 'realty-pack-core' ); ?>
						</strong>
						<span>
							<?php esc_attr_e( 'Default', 'realty-pack-core' ); ?>
							<i class="rtpf rtpf-angle-down"></i>
						</span> -->
						<?php if( count( $sort_options ) ): ?>
							<?php echo $model->generate_sorts( array( 'type' => 0, 'kind' => $kind, 'sort_options' => $sort_options ) ); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>


<?php endif; ?>
<?php if( ! $edit_mod ): ?>
	<?php if(  1 < count( $wpl_properties ) ): ?>
		<div class="rtpc-rpgs-properties-container <?php echo ( 'grid' == $elementor_settings['preview_mode'] ? esc_attr( 'rtpc-rpgs-properties-grid' ) : esc_attr( 'rtpc-rpgs-properties-column') ); ?> ">
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
				$living_area_living_area_count = isset( $living_area[$living_area_count-1] ) ? $living_area[$living_area_count-1] : '';

        		// Location visibility option
				$location_visibility = \wpl_property::location_visibility($property['data']['id'], $property['data']['kind'], $current_user_membership_id);

        		// Rom parking Bath
				if(isset($property['materials']['bedrooms']['value']) and trim($property['materials']['bedrooms']['value'])) {

					$room = sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Bedroom : ", 'realty-pack-core') , $property['materials']['bedrooms']['value'] );

				} elseif (isset($property['materials']['rooms']['value']) and trim($property['materials']['rooms']['value'])) {

					$room = sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Room : ", 'realty-pack-core') , $property['materials']['rooms']['value'] );
				} else {
					$room = '';
				}

				$bathroom = (isset($property['materials']['bathrooms']['value']) and trim($property['materials']['bathrooms']['value'])) ? sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Bathroom : ", 'realty-pack-core') , $property['materials']['bathrooms']['value'] ) : '';

				$parking = (isset($property['materials']['f_150']['values'][0]) and trim($property['materials']['f_150']['values'][0])) ? sprintf('<div><span class="rtpc-rpgs-property-content-details-label">%s</span><span class="rtpc-rpgs-property-content-details-value">%s</span></div>', __("Parking : ", 'realty-pack-core') , $property['materials']['f_150']['values'][0] ) : '';

        		// Author info
				$author_data = RTPC_WPL_Listing::get_user_info( $property['data']['user_id'] );
				$author_name = $author_last_name = '';

        		// first name
				if ( isset( $author_data->data->wpl_data->first_name ) && '' !== $author_data->data->wpl_data->first_name ) {
					$author_name = $author_data->data->wpl_data->first_name;
				} elseif ( isset( $author_data->data->meta->first_name ) && '' !== $author_data->data->meta->first_name ) {
					$author_name = $author_data->data->wpl_data->first_name;
				}

        		// last name
				if ( isset( $author_data->data->wpl_data->last_name ) && '' !== $author_data->data->wpl_data->last_name ) {
					$author_last_name = $author_data->data->wpl_data->last_name;
				} elseif ( isset( $author_data->data->meta->last_name ) &&  '' !== $author_data->data->meta->last_name ) {
					$author_last_name = $author_data->data->wpl_data->last_name;
				}

        		// Agent Link
				$agent_link = RTPC_Controllers_Agency_Agent::get_agent_link( $property['data']['user_id'] );

        		// Date
				$ago = RTPC_WPL_Listing::time_elapsed_string( $property['data']['add_date'] );
				?>
				<div class="rtpc-rpgs-property-box rtp-col-md-<?php echo $elementor_settings['wplcolumns']; ?>" data-listing="<?php echo esc_attr( $property['data']['listing'] ); ?>">
					<div class="rtpc-rpgs-property">
						<?php if ( $elementor_settings['display_media'] ): ?>
							<div class="rtpc-rpgs-property-image">
								<?php if ( $elementor_settings['display_tags'] ): ?>
									<div class="rtpc-rpgs-property-tags">
										<?php if ( $tags ): ?>
											<?php foreach( $tags as $tag ): ?>
												<?php if( $property['data'][$tag->table_column] ): ?>
													<span> <?php _e( $tag->name, 'realty-pack-core' ); ?> </span>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<!-- Check gallery if it is one item do not print controls @temprory -->
								<?php if( sizeof( $gallery ) > 1 ): ?>
									<div class="rtpc-rpgs-property-slider">
										<div class="swiper-wrapper">
											<?php foreach ( $gallery as $gitem ): ?>
												<?php  $gitem['url'] = \RTP_Image::edit_attachment_media( null, $gitem['url'], array( $elementor_settings['image_width'] , $elementor_settings['image_height'] ) ); ?>
												<div class="swiper-slide">
													<img src="<?php echo esc_url( $gitem['url'] ); ?>" alt="<?php echo esc_attr( $gitem['title'] ); ?>" />
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
									<?php else: ?>
										<div class="rtpc-rpgs-property-slider">
											<div>
												<?php  $gallery[0]['url'] = \RTP_Image::edit_attachment_media( null, $gallery[0]['url'], array( $elementor_settings['image_width'] , $elementor_settings['image_height'] ) ); ?>
												<div class="swiper-slide">
													<img src="<?php echo esc_url( $gallery[0]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[0]['title'] ); ?>" />
												</div>
											</div>
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
							<?php endif; ?>
							<!--  End image section -->

							<div class="rtpc-rpgs-property-content">
								<?php if ( $elementor_settings['display_title'] ) :?>
									<h3 class="rtpc-rpgs-property-title <?php echo esc_attr( $itemprop_name ); ?>"><a href="<?php echo esc_url( $property['link'] ); ?>"><?php echo esc_html( $property['property_title'] ); ?></a>
									</h3>
								<?php endif; ?>
								<div class="rtpc-rpgs-property-content-price-container <?php echo esc_attr( $itemscope.' '.$itemtype_offer ); ?>">
									<p class="rtpc-rpgs-property-content-price"> <?php echo esc_html( $property_price ); ?> </p>
									<p class="rtpc-rpgs-property-content-price-type">
										<span><?php echo esc_html( $build_up_area ); ?></span>
										<?php if( '' !== $living_area_living_area_count ) : ?>
											<span>
												<?php echo esc_html( ' / ' . $living_area_living_area_count ); ?>
											</span>
										<?php endif; ?>
									</p>
								</div>
								<?php if ( $elementor_settings['display_address'] ):?> 
									<div class="rtpc-rpgs-property-content-address">
										<i class="rtpf rtpf-map-marker rtpc-rpgs-property-address-icon"></i>
										<span class="rtpc-rpgs-property-address-text" <?php echo esc_attr( $itemprop_address.' '.$itemscope.' '.$itemtype_PostalAddress .' '. $itemprop_addressLocality ); ?> > <?php echo esc_html( ($location_visibility === true ? $property['location_text'] : $location_visibility) );?> </span>
									</div>
								<?php endif; ?>
								<div class="rtpc-rpgs-property-content-details">
									<?php if ( $elementor_settings['display_features'] || $room !== '' && $bathroom !== '' && $parking !== '' ): ?>
										<div class="rtpc-rpgs-property-features">
											<?php echo $room . $bathroom . $parking; ?>
										</div>
									<?php endif; ?>
									<?php if ( $elementor_settings['display_more_details'] ): ?>
										<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black rtp-btn-sm rtp-transition">
											<a href="<?php echo esc_url( $property['link'] ); ?>">
												<span>
													<?php esc_html_e( 'Details', 'realty-pack-core' ); ?>
												</span>
											</a>
										</div>
									<?php endif; ?>
								</div>
								<div class="rtpc-rpgs-property-content-author">
									<?php if ( $elementor_settings['display_author'] ): ?>
										<div class="rtpc-rpgs-property-content-author-details">
											<img src="<?php echo esc_url( $author_data->data->profile_picture['url'] ); ?>" alt="<?php echo esc_attr( $author_data->data->meta['nickname'] ); ?>" />
											<a href="<?php echo  esc_url( $agent_link ); ?>"> <?php echo esc_html( $author_name . ' ' . $author_last_name ); ?> </a>
										</div>
									<?php endif; ?>

									<?php if ( $elementor_settings['display_date'] ):?>
										<div class="rtpc-rpgs-property-post-date <?php  !$elementor_settings['display_author'] ? esc_attr_e('rtpc-rpgs-property-post-date-single') : ''; ?>">
											<i class=" rtpf rtpf-calendar-1"> </i>
											<span> <?php echo esc_html( $ago ); ?> </span>
										</div>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( isset( $elementor_settings['display_pagination'] ) && $elementor_settings['display_pagination'] ): ?>
			<div class="rtp-pagination">
				<?php
				echo wp_kses( $pagination->pagination, 
					array(
						'li' => array(
							'class' => array(),
						),        
						'a' => array(
							'href' => array(),
						)
					) 
				); 
				?>
			</div>
		<?php endif; ?>

	<?php else: ?>
		<div class="rtpc-rpgs-properties-container <?php echo ( 'grid' == $elementor_settings['preview_mode'] ? esc_attr( 'rtpc-rpgs-properties-grid' ) : esc_attr( 'rtpc-rpgs-properties-column') ); ?> ">
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
										<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/13711975_l@2x.png' ); ?>" />
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
								<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black rtp-btn-sm">
									<a href="#">
										<span>
											<?php esc_html_e( 'Details', 'realty-pack-core' ); ?>
										</span>
									</a>
								</div>
							</div>
							<div class="rtpc-rpgs-property-content-author">
								<div class="rtpc-rpgs-property-content-author-details">
									<img src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/property_builder/agent.png' ); ?>" />
									<a href="#" <?php esc_html_e( 'Jordan', 'realty-pack-core' ); ?> </a>
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
	<?php endif; ?>
	<?php if( 1 < count( $wpl_properties ) ): ?>
	</div>
<?php endif; ?>

