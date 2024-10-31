<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Boot;

?>
<?php if ( isset( $user_info ) ): ?>
	<?php foreach ( $user_info as $info ): ?>
		<?php if ( '' === $settings['show_agency_with_image'] || ( $settings['show_agency_with_image'] === 'yes' && '' !== $info->company_logo['name'] ) ): ?>
			<?php
            // Company name
			$company_name = ( isset( $info->wpl_data->company_name ) && $info->wpl_data->company_name !== '' ) ? $info->wpl_data->company_name : $info->data->meta->company_name;
            // Company address
			$company_address = ( isset( $info->wpl_data->company_address ) && $info->wpl_data->company_address !== '' ) ? $info->wpl_data->company_address : $info->data->meta->company_address;
            // Email
			$secondary_email = ( isset( $info->wpl_data->secondary_email ) && $info->wpl_data->secondary_email !== '' ) ? $info->wpl_data->secondary_email : '';
            // Facebook
			$r_facebook = ( isset( $info->wpl_data->r_facebook ) && $info->wpl_data->r_facebook !== '' ) ? $info->wpl_data->r_facebook : '';
            // Twitter
			$r_twitter  = ( isset( $info->wpl_data->r_twitter ) && $info->wpl_data->r_twitter !== '' ) ? $info->wpl_data->r_twitter : '';
            // Pinterest
			$r_pinterest = ( isset( $info->wpl_data->r_pinterest ) && $info->wpl_data->r_pinterest !== '' ) ? $info->wpl_data->r_pinterest : '';
            // Pinterest
			$r_skype = ( isset( $info->wpl_data->r_skype ) && $info->wpl_data->r_skype !== '' ) ? $info->wpl_data->r_skype : '';
            // tel
			$tel = ( isset( $info->wpl_data->tel ) && $info->wpl_data->tel !== '' ) ? $info->wpl_data->tel : '';
            // tel
			$fax = ( isset( $info->wpl_data->fax ) && $info->wpl_data->fax !== '' ) ? $info->wpl_data->fax : '';
            // tel
			$website = ( isset( $info->wpl_data->website ) && $info->wpl_data->website !== '' ) ? $info->wpl_data->website : '';
			?>
			<div class="rtp-row rtpc-agency-list-container">
				<div class="rtp-col-md-4 rtpc-agency-image">
					<img src="<?php echo esc_url( $info->company_logo['url'] ); ?>" alt="<?php echo esc_attr( $company_name ); ?>" />
				</div>
				<div class="rtp-col-md-8 rtpc-agency-content">
					<div class="rtp-row rtpc-agency-header">
						<div >
							<div class="rtpc-agency-title">
								<a href="<?php echo esc_url( $info->link ); ?>" target="_blank">
									<?php echo esc_html( $company_name ); ?>
								</a>
							</div>
							<?php if ('yes' == $settings['show_address'] ): ?>
								<div class="rtpc-agency-address">
									<i class="rtpf rtpf-map-marker"></i>
									<span>
										<?php echo esc_html( $company_address );?>
									</span>
								</div>
							<?php endif;?>
						</div>
						<div class="rtpc-agency-listed-properties">
							<a href="<?php echo esc_url( $info->listing_link ); ?>">
								<?php echo sprintf( esc_html__( ' %s Listed properties', 'realty-pack-core' ), ( isset( $info->listing_count ) ? $info->listing_count : '0' ) ); ?>
							</a>
						</div>
					</div>

					<div class="rtp-row rtpc-agency-contacts">
						<?php if ( 'yes' == $settings['show_social'] ): ?>
							<div class="rtpc-agency-details">

								<?php if ( ( isset( $r_facebook ) && '' !== $r_facebook )
									|| ( isset( $r_facebook ) && '' !== $r_facebook ) 
									|| ( isset( $r_twitter ) && '' !== $r_twitter ) 
									|| ( isset( $r_pinterest ) && '' !== $r_pinterest ) 
									|| ( isset( $r_skype ) && '' !== $r_skype ) ): ?>
									<span class="rtpc-agency-contact-title">
										<?php _e( 'Social: ', 'realty-pack-core' );?>
									</span>
								<?php endif;?>
								<?php if ( isset( $r_facebook ) && '' !== $r_facebook ): ?>
									<a href="<?php echo esc_url( $r_facebook ); ?>">
										<i class="rtpf rtpf-facebook"></i>
									</a>
								<?php endif;?>

								<?php if ( isset( $r_twitter ) && '' !== $r_twitter ): ?>
									<a href="<?php echo esc_url( $r_twitter );?>">
										<i class="rtpf rtpf-twitter-alt"></i>
									</a>
								<?php endif;?>

								<?php if ( isset( $r_pinterest ) && '' !== $r_pinterest ): ?>
									<a href="<?php echo esc_url( $r_pinterest ); ?>">
										<i class="rtpf rtpf-pinterest-alt"></i>
									</a>
								<?php endif;?>

								<?php if ( isset( $r_skype ) && '' !== $r_skype ): ?>
									<a href="<?php echo esc_html( $r_skype );?>">
										<i class="rtpf rtpf-skype-1"></i>
									</a>
								<?php endif;?>

							</div>
						<?php endif;?>

						<?php if ( 'yes' == $settings['show_phone'] && isset( $tel ) && '' !== $tel ): ?>

							<div class="rtpc-agency-details">
								<span class="rtpc-agency-contact-title">
									<?php esc_html_e( 'Phone: ', 'realty-pack-core' ); ?>
								</span>
								<span class="rtpc-agency-contact-content">
									<?php echo esc_html( $tel ); ?>
								</span>
							</div>
						<?php endif;?>

						<?php if ( 'yes' === $settings['show_fax'] && isset( $fax ) && '' !== $fax ): ?>
							<div class="rtpc-agency-details">
								<span class="rtpc-agency-contact-title">
									<?php esc_html_e( 'Fax: ', 'realty-pack-core' ); ?>
								</span>
								<span class="rtpc-agency-contact-content">
									<?php echo esc_html( $fax ); ?>
								</span>
							</div>
						<?php endif;?>

						<?php if ( 'yes' === $settings['show_email'] && isset( $secondary_email ) && '' !== $secondary_email ): ?>
							<div class="rtpc-agency-details">
								<span class="rtpc-agency-contact-title">
									<?php esc_html_e('Email: ', 'realty-pack-core');?>
								</span>
								<span class="rtpc-agency-contact-content">
									<?php echo esc_html( $secondary_email ); ?>
								</span>
							</div>
						<?php endif;?>

						<?php if ( 'yes' === $settings['show_website'] && isset( $website ) && '' !== $website ): ?>
							<div class="rtpc-agency-details">
								<span class="rtpc-agency-contact-title">
									<?php esc_html_e( 'Website: ', 'realty-pack-core' ); ?>
								</span>
								<span class="rtpc-agency-contact-content">
									<?php echo esc_html( $website ); ?>
								</span>
							</div>
						<?php endif;?>

					</div>

					<div class="rtp-row rtpc-agency-footer">
						<div class="rtpc-agency-agent-list">
							<?php if ('yes' == $settings['show_agents']): ?>
								<?php if ( isset( $info->agent_images ) ): ?>
									<?php foreach( $info->agent_images as $agent_infos ): ?>
										<a href="<?php echo esc_url( $agent_infos->link ); ?>">
											<img src="<?php echo esc_url( $agent_infos->profile_picture['url'] ); ?>" alt="<?php echo esc_attr( $agent_infos->meta['nickname'] ); ?>">
										</a>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endif; ?>

						</div>
						<div class="rtpc-agency-readmore">
							<div class="rtp-main-button-blue rtp-btn-sm rtp-btn-blue-black">
								<a href="<?php echo esc_url( $info->link ); ?>" target="_blank">
									<?php esc_html_e('MORE DETAIL', 'realty-pack-core');?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<!-- Add Pagination -->
	<div class="rtp-pagination rtp-paginatelink-pagination">
		<?php echo $pagination_link; // escaped before ?>
	</div>
<?php endif; ?>
