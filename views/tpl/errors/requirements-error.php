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
		<?php esc_html_e( "RealtyPack Core Error: Your environment doesn't meet all  of the system requirements listed below.", 'realty-pack-core' ); ?>
	</p>
	<ul class="ul-disc">
		<li>
			<strong>
				<?php esc_html_e( 'PHP', 'realty-pack-core'); ?> 
				<?php echo RTPC::RTPC_PHP_VERSION; ?>
				<?php esc_html_e( '+ is required', 'realty-pack-core'); ?>
			</strong>
			<em>
				<?php esc_html_e( "You're running version ", 'realty-pack-core'); ?>
				<?php echo PHP_VERSION; ?>
			</em>
		</li>

		<li>
			<strong>
				<?php esc_html_e( 'WordPress', 'realty-pack-core'); ?> 
				<?php echo RTPC::RTPC_REQUIRED_WP_VERSION; ?>
				<?php esc_html_e( '+ is required', 'realty-pack-core'); ?>
			</strong>
			<em>
				<?php esc_html_e( "You're running version", 'realty-pack-core'); ?> <?php echo esc_html( $wp_version ); ?>
			</em>
		</li>
	</ul>
</div>