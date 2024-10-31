<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>	
<div class="error">
	<p>
		<?php esc_html_e( "For using Realtypack full functionalities, Please update your WPL to latest version.", 'realty-pack-core' ); ?>
	</p>
	<ul class="ul-disc">
		<li>
			<strong>
				<?php esc_html_e( 'WPL 4.4.0 + is required', 'realty-pack-core'); ?> 
			</strong>
			<em>
				<?php esc_html_e( "You're running version ", 'realty-pack-core'); ?>
				<?php echo WPL_VERSION; ?>
			</em>
		</li>
	</ul>
</div>