<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-sp-attachments rtpc-details-container">
	<div class="rtpc-sp-details rtpc-sp-agent-info-container">
		<div class="rtpc-sp-details-box-title">
			<span>
				<?php esc_html_e( 'Agent info', 'realty-pack-core' ); ?>
			</span> 
		</div>
		<div class="rtpc-sp-agent-info">
			<?php if( isset( $profile_image ) ): ?>
				<img class="rtpc-sp-agent-image" src="<?php echo esc_url( $profile_image ); ?>" alt="agent image">
			<?php endif; ?>
			<div class="rtpc-sp-agent-details">
				<div class="rtpc-sp-agent-details-container">
					<?php if( isset( $display_name ) ): ?>
						<div>
							<span class="rtpc-sp-agent-name"><?php echo esc_html( $display_name ); ?></span>
							<span class="rtpc-sp-agent-title"><?php esc_html_e( 'Agent', 'realty-pack-core' ); ?></span>
						</div>
					<?php endif; ?>
					<div class="rtp-main-button-blue rtp-btn-blue-black">
						<a href="http://sample.com/submit-property">
							<span><?php esc_html_e( 'View My Property', 'realty-pack-core' ); ?></span>
						</a>
					</div>
					<span class="rtpc-sp-agent-divider"></span>

					<?php if( isset( $tel ) ): ?>
						<div class="rtpc-sp-agent-phone">
							<span class="rtpc-sp-agent-phone-label"><?php esc_html_e( 'Phone: ', 'realty-pack-core' ); ?></span>
							<span class="rtpc-sp-agent-phone-number"><?php echo esc_html( $tel ); ?></span>
						</div>
					<?php endif; ?>

					<?php if( isset( $email ) ): ?>
						<div class="rtpc-sp-agent-email">
							<span class="rtpc-sp-agent-email-label"><?php esc_html_e( 'Email: ', 'realty-pack-core' ); ?></span>
							<span class="rtpc-sp-agent-email-address"><?php echo esc_html( $email ); ?></span>
						</div>
					<?php endif; ?>

					<?php if( isset( $socials ) ): ?>
						<div class="rtpc-sp-agent-social">
							<span class="rtpc-sp-agent-social-label"><?php esc_html_e( 'Social: ', 'realty-pack-core' ); ?></span>
							<?php foreach( $socials as $social ): ?>
								<?php if( isset( $social['url'] ) ): ?>
									<a href="<?php echo esc_url( $social['url'] ); ?>" class="rtpc-sp-agent-social-icons rtp-default-blue-icon">
										<i class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<span class="rtpc-sp-agent-divider rtpc-sp-agent-divider-column"></span>
				</div>
			</div>   
		</div>		
	</div>
</div>