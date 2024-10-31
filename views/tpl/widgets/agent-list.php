<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-agent-list-container">
	<div class="rtpc-agent-filters">
		<div class="rtpc-agent-view-sort-filters">

			<label id="rtpcAgentGrid" class="<?php ( $settings['default_view'] == 'grid' ) ? esc_attr_e( 'checked' ) : '' ; ?>">
				<i class="rtpf rtpf-layout-grid2"></i>
			</label>

			<label id="rtpcAgentColumn" class="<?php ( $settings['default_view'] == 'column' ) ? esc_attr_e( 'checked' ) : '' ; ?>">
				<i class="rtpf rtpf-view-list-alt"></i>
			</label>

			<div class="rtpc-agent-sort">
				<strong>
					<?php esc_html_e( 'SORT BY:', 'realty-pack-core' ); ?>
				</strong>
				<span>
					<?php esc_html_e( 'Default', 'realty-pack-core' ); ?>
					<i class="rtpf rtpf-angle-down"></i>
				</span>
			</div>
		</div>

	</div>
	<div class="rtpc-agent-list">
		<?php if ( isset( $user_info ) ): ?>
			<?php foreach ( $user_info as $info ): ?>
				<?php if ( '' === $settings['show_agents_with_image'] || ( $settings['show_agents_with_image'] === 'yes' && '' !== $info->profile_picture['name'] ) ): ?>
					<?php
                	// First name
					$first_name = ( isset( $info->wpl_data->first_name ) && $info->wpl_data->first_name !== '' ) ? $info->wpl_data->first_name : $info->data->meta->first_name;
                	// Last name
					$last_name = ( isset( $info->wpl_data->last_name ) && $info->wpl_data->last_name !== '' ) ? $info->wpl_data->last_name : $info->data->meta->last_name;
                	// Membersip Type
					$membership_type = ( isset( $info->wpl_data->last_name ) && $info->wpl_data->last_name !== '' ) ? \wpl_users::get_user_type( $info->wpl_data->membership_type, 1) : __( 'Agent', 'realty-pack-core' );
                	// Mobile
					$mobile = ( isset( $info->wpl_data->mobile ) && $info->wpl_data->mobile !== '' ) ? $info->wpl_data->mobile : '';
            		// About
					$about = ( isset( $info->wpl_data->about ) && $info->wpl_data->about !== '' ) ? $info->wpl_data->about : '';
                	// Email
					$secondary_email = ( isset( $info->wpl_data->secondary_email ) && $info->wpl_data->secondary_email !== '' ) ? $info->wpl_data->secondary_email : '';
                	// Facebook
					$r_facebook = ( isset( $info->wpl_data->r_facebook ) && $info->wpl_data->r_facebook !== '' ) ? $info->wpl_data->r_facebook : '';
                	// Twitter
					$r_twitter  = ( isset( $info->wpl_data->r_twitter ) && $info->wpl_data->r_twitter !== '' ) ? $info->wpl_data->r_twitter : '';
                	// Pinterest
					$r_pinterest = ( isset( $info->wpl_data->r_pinterest ) && $info->wpl_data->r_pinterest !== '' ) ? $info->wpl_data->r_pinterest : '';
					?>
					<div class="rtp-col-md-4 rtp-col-sm-6 rtp-col-xs-12 rtpc-agent-list-<?php esc_attr_e( $settings['default_view'] ); ?>">
						<div class="rtpc-agent-image-container">
							<img class="rtpc-agent-image" src="<?php echo esc_url( $info->profile_picture['url'] ); ?>"  alt="<?php echo esc_attr( $info->meta['nickname'] ); ?>" />
							<div class="rtpc-agent-details">
								<div class="rtpc-agent-details-container">
									<div>
										<span class="rtpc-agent-name">
											<?php echo esc_html( $first_name . ' ' . $last_name ); ?>
										</span>
										<span class="rtpc-agent-title">
											<?php echo is_object( $membership_type ) ? esc_html( strtoupper( $membership_type->name ) ) :  esc_html( strtoupper( $membership_type ) ); ?>
										</span>
									</div>
									<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black">
										<a href="<?php echo esc_url( $info->link ); ?>" >
											<span>
												<?php esc_html_e( 'MORE DETAILS', 'realty-pack-core' ); ?>
											</span>
										</a>
									</div>
									<div class="rtpc-agent-description">
										<?php echo esc_html( wp_trim_words( $about, 20 ) ); ?>
									</div>
									<span class="rtpc-agent-divider"></span>

									<?php if ( 'yes' === $settings['show_phone'] ): ?>
										<div class="rtpc-agent-phone">
											<span class="rtpc-agent-phone-label">
												<?php esc_html_e( 'Phone: ', 'realty-pack-core' ); ?>
											</span>
											<span class="rtpc-agent-phone-number">
												<?php echo esc_html( $mobile ); ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if ( 'yes' === $settings['show_secondary_email'] ): ?>
										<div class="rtpc-agent-email">
											<span class="rtpc-agent-email-label">
												<?php esc_html_e( 'Email: ', 'realty-pack-core' ); ?>
											</span>
											<span class="rtpc-agent-email-address">
												<?php echo esc_html( $secondary_email ); ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if ( 'yes' === $settings['show_socials'] ): ?>
										<div class="rtpc-agent-social"> 
											<span class="rtpc-agent-social-label">
												<?php esc_html_e( 'Social: ', 'realty-pack-core' ); ?>
											</span>
											<?php if ( '' !== $r_facebook ): ?>
												<a href="<?php echo esc_url( $r_facebook ); ?>" class="rtpc-agent-social-icons">
													<i class="rtpf rtpf-facebook"></i>
												</a>
											<?php endif; ?>
											<?php if ( '' !== $r_twitter ): ?>
												<a href="<?php echo esc_url( $r_twitter ); ?>" class="rtpc-agent-social-icons">
													<i class="rtpf rtpf-twitter"></i>
												</a>
											<?php endif; ?>
											<?php if ( '' !== $r_pinterest ): ?>
												<a href="<?php echo esc_url( $r_pinterest ); ?>" class="rtpc-agent-social-icons">
													<i class="rtpf rtpf-pinterest"></i>
												</a>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<!-- divider -->
									<span class="rtpc-agent-divider rtpc-agent-divider-column"></span>

									<div class="rtpc-agent-footer">
										<a href="<?php echo esc_url( $info->listing_link ); ?>" class="rtpc-agent-property-listed"><?php echo sprintf( esc_html__( ' %s Listed properties', 'realty-pack-core' ), ( isset( $info->listing_count ) ? $info->listing_count : '0' ) ); ?></a>

										<a href="<?php echo esc_url( $info->link ); ?>" class="rtpc-agent-property-more-detail"><?php esc_html_e( 'More Detials', 'realty-pack-core' ); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<!-- Add Pagination -->
	<?php if( isset( $pagination_link ) && '' != $pagination_link ): ?>
		<div class="rtp-pagination rtp-paginatelink-pagination">
			<?php echo $pagination_link; // escaped before ?>
		</div>
	<?php endif; ?>
</div>