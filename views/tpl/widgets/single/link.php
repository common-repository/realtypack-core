<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-sp-socials">
	<div class="rtpc-sp-social-container">
		<div class="rtpc-sp-social-share">
			<i class="rtpf rtpf-share-alt"></i>
		</div>
		<ul>
			<?php if( 'yes' === $settings['show_facebook'] ): ?>
				<li class="facebook_link">
					<a class="wpl-tooltip-left" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $property_link ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600'); return false;" title="<?php esc_attr_e('Share on Facebook', 'realty-pack-core'); ?>">
						<i class="rtpf rtpf-facebook"></i>
					</a>
					<div class="wpl-util-hidden"><?php esc_html_e('Share on Facebook', 'realty-pack-core'); ?></div>
				</li>
			<?php endif; ?>

			<?php if( 'yes' === $settings['show_twitter'] ): ?>
				<li class="twitter_link">
					<a class="wpl-tooltip-left" href="https://twitter.com/share?url=<?php echo esc_url( $property_link ); ?>" target="_blank" title="<?php esc_attr_e('Tweet', 'realty-pack-core'); ?>">
						<i class="rtpf rtpf-twitter"></i>
					</a>            
					<div class="wpl-util-hidden"><?php esc_html_e('Share on Twitter', 'realty-pack-core'); ?></div>
				</li>
			<?php endif; ?>

			<?php if( 'yes' === $settings['show_pinterest'] ): ?>
				<li class="pinterest_link">
					<a class="wpl-tooltip-left" href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url( $property_link ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600'); return false;" title="<?php esc_attr_e('Pin it', 'realty-pack-core'); ?>">
						<i class="rtpf rtpf-pinterest"></i>
					</a>
					<div class="wpl-util-hidden"><?php esc_html_e('Share on Pinterest', 'realty-pack-core'); ?></div>
				</li>
			<?php endif; ?>

			<?php if( 'yes' === $settings['show_linkedin'] ): ?>
				<li class="linkedin_link">
					<a class="wpl-tooltip-left" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $property_link ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600'); return false;" title="<?php esc_attr_e('Share on Linkedin', 'realty-pack-core'); ?>">
						<i class="rtpf rtpf-linkedin"></i>
					</a>
					<div class="wpl-util-hidden"><?php esc_html_e('Share on Linkedin', 'realty-pack-core'); ?></div>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
