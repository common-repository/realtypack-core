<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="our-agents-container">
	<div class="swiper-wrapper">
		<?php foreach ( $user_info as $info ): ?>
			<?php if ( $settings['show_agents_with_image'] === 'yes' && isset( $info->profile_picture['name'] ) ): ?>
				<div class="swiper-slide">
					<img class="our-agents-image" src="<?php echo esc_url( $info->profile_picture['url'] ); ?>" alt="<?php echo esc_attr( $info->meta['nickname'] ); ?>" />
					<div class="our-agents-details">
						<div class="our-agents-details-container">
							<?php 
							// First name
							$first_name = ( isset( $info->wpl_data->first_name ) && $info->wpl_data->first_name !== '' ) ? $info->wpl_data->first_name : '';
							// Last name
							$last_name = ( isset( $info->wpl_data->last_name ) && $info->wpl_data->last_name !== '' ) ? $info->wpl_data->last_name : '';
							// Membersip Type
							$membership_type = ( isset( $info->wpl_data->last_name ) && $info->wpl_data->last_name !== '' ) ? \wpl_users::get_user_type( $info->wpl_data->membership_type, 1) : __( 'Agent', 'realty-pack-core' );
							// Mobile
							$mobile = ( isset( $info->wpl_data->mobile ) && $info->wpl_data->mobile !== '' ) ? $info->wpl_data->mobile : '';
							// Email
							$secondary_email = ( isset( $info->wpl_data->secondary_email ) && $info->wpl_data->secondary_email !== '' ) ? $info->wpl_data->secondary_email : '';
							// Facebook
							$r_facebook = ( isset( $info->wpl_data->r_facebook ) && $info->wpl_data->r_facebook !== '' ) ? $info->wpl_data->r_facebook : '';
							// Twitter
							$r_twitter = ( isset( $info->wpl_data->r_twitter ) && $info->wpl_data->r_twitter !== '' ) ? $info->wpl_data->r_twitter : '';
							// Pinterest
							$r_pinterest = ( isset( $info->wpl_data->r_pinterest ) && $info->wpl_data->r_pinterest !== '' ) ? $info->wpl_data->r_pinterest : '';
							?>
							<div>
								<span class="our-agents-name">
									<?php echo esc_html( $first_name . ' ' . $last_name ); ?>
								</span>

								<span class="our-agents-title">
									<?php echo is_object( $membership_type ) ? esc_html( $membership_type->name ) :  esc_html( $membership_type ); ?>
								</span>
							</div>

							<span class="our-agents-divider"></span>

							<?php if ( 'yes' === $settings['show_phone'] ): ?>
								<div class="our-agents-phone"> 
									<span class="our-agents-phone-label">
										<?php esc_html_e( 'Phone: ', 'realty-pack-core' ); ?>
									</span>
									<span class="our-agents-phone-number">
										<?php echo esc_html( $mobile ); ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if ( 'yes' === $settings['show_secondary_email'] ): ?>
								<div class="our-agents-email"> 
									<span class="our-agents-email-label">
										<?php esc_html_e( 'Email: ', 'realty-pack-core' ); ?>
									</span>
									<span class="our-agents-email-address">
										<?php echo esc_html( $secondary_email ); ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if ( 'yes' === $settings['show_socials'] ): ?>
								<div class="our-agents-social"> 
									<span class="our-agents-social-label"><?php esc_html_e( 'Social: ', 'realty-pack-core' ); ?></span>

									<?php if ( '' !== $r_facebook ): ?>
										<a href="<?php echo esc_url( $r_facebook ); ?>" class="our-agents-social-icons">
											<i class="rtpf rtpf-facebook"></i>
										</a>
									<?php endif; ?>

									<?php if ( '' !== $r_twitter ): ?>
										<a href="<?php echo esc_url( $r_twitter ); ?>" class="our-agents-social-icons">
											<i class="rtpf rtpf-twitter"></i>
										</a>
									<?php endif; ?>

									<?php if ( '' !== $r_pinterest ): ?>
										<a href="<?php echo esc_url( $r_pinterest ); ?>" class="our-agents-social-icons">
											<i class="rtpf rtpf-pinterest"></i>
										</a>
									<?php endif; ?>

								</div>
							<?php endif; ?>

							<span class="our-agents-divider"></span>

							<a href="<?php echo esc_url( $info->listing_link ); ?>" class="our-agents-property-listed">
								<?php echo sprintf( esc_html__( ' %s Listed properties', 'realty-pack-core' ), ( isset( $info->listing_count ) ? $info->listing_count : '0' ) );  ?>
							</a>

							<a href="<?php echo esc_url( $info->link ); ?>" class="rtpc-agent-property-more-detail">
								<?php esc_html_e( 'More Detials', 'realty-pack-core' ); ?>
							</a>

						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<!-- Add Pagination -->
	<div class="our-agents-pagination"></div>
</div>
