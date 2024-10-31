<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core:Plugins
 */
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin as controller;
?>

<?php echo $header; ?>

<div class="rtp-row">

	<?php foreach( $plugins_list as $plugin ) : ?>

	<?php
		$action = controller::get_plugin_status( $plugin );

		$nonce_url = wp_nonce_url(
			add_query_arg(
				array(
					'plugin'   => urlencode( $plugin['slug'] ),
					'tgmpa-' . $action['action'] => $action['action'] . '-plugin',
				),
				$tgmpaurl
			),
			'tgmpa-' . $action['action'],
			'tgmpa-nonce'
		);

		?>
		<div class="rtp-col-md-4">
			<div class="rtpc-admin-box type3">
				<img src="<?php esc_attr_e( esc_url( $plugin['logo_src'] ) ); ?>"  width="50%"/>
				<div class="rtpc-admin-box-footer rtpc-admin-clearfix">
					<span class="rtpc-admin-box-footer-title no-padding">
						<?php echo ( $plugin['source'] == 'repo' ? controller::get_info_link( $plugin ) : esc_html( $plugin['name'] ) ); ?>
						<span class="rtpc-admin-box-footer-subtitle"><?php ( controller::get_installed_version( $plugin['slug'] ) == ''  ? esc_html_e( $action['status'] ) : printf( __( 'Version %s', 'realty-pack-core' ), controller::get_installed_version( $plugin['slug'] ) ) ); ?></span>
					</span>
					</span>
					<div class="rtpc-admin-box-footer-btns rtpc-admin-box-plugins">
						<div class="rtp-ajax-loader-wrap">
							<div class="rtp-ajax-loader"></div>
						</div>
						<?php if( isset( $plugin['pro'] ) && true === $plugin['pro'] ): ?>
							<a href="<?php echo esc_url( 'https://eightqueens.pro/realtypack/landing/' ); ?>" class="rtpc-admin-btn blue">
								<?php esc_html_e( 'Unlock', 'realty-pack-core'  );?>
							</a>
						<?php else: ?>
							<a href="#" data-slug="<?php esc_attr_e( $plugin['slug'] ); ?>" data-action="<?php esc_attr_e( $action['action'] ); ?>" data-source="<?php echo esc_url( $nonce_url ); ?>" class="rtpc-admin-btn blue <?php ( $action['action'] === 'activated' ? esc_attr_e( 'gray' ) : esc_attr_e( $action['action'] ) ); ?>">
								<?php esc_html_e( $action['text'], 'realty-pack-core' );?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>	
		</div>
	<?php endforeach; ?>

</div>	
<?php echo $footer; 

