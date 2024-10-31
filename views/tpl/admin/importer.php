<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core:Importer
 */
use RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin as Plugins;
?>

<?php echo $header; ?>

<div class="rtp-row">

	<?php foreach ( $demos_list as $demo_key => $demos ): ?>
		<div class="rtp-col-md-4">
			<div class="rtpc-admin-box type2">
				<img src="<?php esc_attr_e( esc_url( $demos['logo_src'] ) ); ?>"  width="100%"/>
				<div class="rtpc-admin-box-footer rtpc-admin-clearfix">
					<span class="rtpc-admin-box-footer-title"><?php esc_html_e( $demos['name'] ); ?></span>
					<div class="rtpc-admin-box-footer-btns">
						<a href="<?php echo esc_url( $demos['preview_url'] ); ?>" class="rtpc-admin-btn black">
							<?php esc_html_e( 'Preview', 'realty-pack-core' ); ?>
						</a>
						<?php if ( isset( $demos['pro'] ) && true == $demos['pro'] ): ?>
							<a href="<?php echo esc_url( 'https://eightqueens.pro/realtypack/landing/' ); ?>" class="rtpc-admin-btn open-popup blue">
								<?php esc_html_e( 'Unlock', 'realty-pack-core' ); ?>
							</a>
						<?php else: ?>
							<a href="" data-demo-slug="<?php esc_html_e( $demos['slug'] ); ?>" class="rtpc-admin-btn open-popup <?php echo ( $imported_demo === $demos['slug'] ? 'green' : 'blue' );?>" data-featherlight=".rtpc-admin-popup-<?php echo esc_attr( $demos['slug'] ); ?>">
								<?php ( $imported_demo === $demos['slug'] ? esc_html_e( 'Imported', 'realty-pack-core' ) : esc_html_e( 'Import', 'realty-pack-core' ) );?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- import lightbox -->
		<?php if ( isset( $demos['pro'] ) && true == $demos['pro'] ) continue; ?>

		<div class="rtpc-admin-popup-<?php echo esc_attr( $demos['slug']); ?> rtpc-admin-hidden" >
			<div class="rtpc-admin-flex">
				<div class="rtpc-admin-importer-form-sidebar rtp-col-md-4 rtp-col-sm-4 rtp-col-xs-4">
					<img src="<?php esc_attr_e( esc_url( $demos['logo_src'] ) ); ?>"  width="100%"/>
					<span class="rtpc-admin-box-footer-title"><?php esc_html_e( $demos['name'] ); ?></span>
				</div>
				<div class="rtpc-admin-importer-form-content rtp-col-md-8 rtp-col-sm-8 rtp-col-xs-8">
					<div class="rtpc-admin-form-section">
						<div class="rtpc-admin-form-title clearfix">
							<span class="rtpc-admin-form-title-text">
								<?php esc_html_e( 'Required Plugin To Import', 'realty-pack-core' ); ?>
							</span>
							<!-- <a href="#" class="rtpc-admin-btn blue lowercase rtpc-activate-all-plugins"><?php //esc_html_e( 'Activate All Plugins', 'realty-pack-core' ); ?></a> -->
						</div>
						<?php if ( is_array( $demos['plugins'] ) ): ?>
						<ul class="rtpc-admin-form-plugin-list">
							<?php foreach ( $demos['plugins'] as $plugin ): ?>
								<?php $action = Plugins::get_plugin_status( $plugin ); ?>
								<?php 
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
								<li>
									<div class="clearfix">
										<span class="title"><?php esc_html_e( $plugin['name'] ); ?></span>
										<div class="btn">
											<div class="rtp-ajax-loader-wrap">
												<div class="rtp-ajax-loader"></div>
											</div>
											<a href="#" data-slug="<?php esc_attr_e( $plugin['slug'] ); ?>" data-action="<?php esc_attr_e( $action['action'] ); ?>" data-source="<?php echo esc_url( $nonce_url ); ?>" class="rtpc-admin-btn small lowercase <?php ( $action['action'] === 'activated' ? esc_attr_e( 'gray' ) : esc_attr_e( 'blue' ) ); ?>"><?php esc_html_e( $action['text'] );?></a>

										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<div class="rtpc-admin-form-separator"></div>
						<div class="rtpc-admin-form-title clearfix">
							<span><?php esc_html_e( 'Import Content', 'realty-pack-core' ); ?></span>	
						</div>
						<ul class="rtpc-admin-form-checkbox-list rtp-row">
							<li class="rtp-col-md-4 rtp-col-sm-6">
								<input class="rtpc-admin-check-all" name="all" type="checkbox" />
								<span data-action="imported" for="all"><?php esc_html_e( 'All', 'realty-pack-core' ); ?></span>
							</li>
							<?php foreach ( $demos['contents'] as $contents ): ?>
								<?php 
								$action_importer = 'ready';
								if ( get_option( 'realty_pack_importer_' . $contents['slug'] , false ) ) {
									$action_importer = 'downloaded';
								}
								?>
								<li class="rtp-col-md-4 rtp-col-sm-6">
									<input name="<?php esc_attr_e( $contents['slug'] ); ?>" type="checkbox" />
									<span name="<?php esc_attr_e( $contents['slug'] ); ?>" data-slug="<?php esc_html_e( $contents['slug'] ); ?>" data-source="<?php echo esc_url( $contents['source'] ); ?>" data-action="<?php echo esc_attr( $action_importer ); ?>" class="RTPC_importer_option_<?php echo esc_attr( $contents['slug'] ); ?>">
										<?php esc_html_e( $contents['name'], 'realty-pack-core' ); ?>
									</span>
								</li>
							<?php endforeach; ?>
						</ul>	
						<a href="#" class="rtpc-admin-btn square rtpc-admin-import-button gray" data-slug="<?php echo esc_attr( $demos['slug'] ); ?>"><?php esc_html_e( 'Import Demo', 'realty-pack-core' ); ?></a>
					</div>
					<div class="rtpc-admin-form-section rtpc-admin-wizard-step-progress-bar rtpc-admin-hidden">
						<img class="rtpc-admin-box-shadow" src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/HOME@2x.jpg' );?>"  width="100%"/>
						<div class="rtpc-admin-progress-bar clearfix">
							<span class="text"><?php esc_html_e( 'It may Take 5 minutes', 'realty-pack' ); ?></span>
							<span class="percent rogress-label"><?php esc_html_e( 'Loading...', 'realty-pack' ); ?></span>
						</div>
						<div id="progressbar" class="progressbar rtpc-admin-box-shadow"></div>
						<div>
							<?php esc_html_e( 'Please don’t refresh the page until import is done completely.', 'realty-pack-core' ); ?>
						</div>	
					</div>
					<div class="rtpc-admin-form-section rtpc-admin-wizard-step-finalize rtpc-admin-hidden">
						<img class="rtpc-admin-box-shadow" src="<?php echo esc_url( RTPC_ASSETS_URL . 'assets/admin/img/HOME@2x.jpg' );?>"  width="100%"/>
						<div class="rtpc-admin-wizard-finalize">
							<span class="percent">100%</span>
							<span class="congrats"><?php esc_html_e( 'Congratulations', 'realty-pack-core' ); ?></span>
							<span class="text"><?php esc_html_e( 'Demo is Successfully Imported', 'realty-pack-core' ); ?></span>
						</div>
						<div class="rtpc-admin-wizard-finalize-btns">
							<a href="#" class="rtpc-admin-btn white rtpc-close-import-modal"><?php esc_html_e( 'Close', 'realty-pack-core' ); ?></a>
							<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="rtpc-admin-btn blue"><?php esc_html_e( 'CUSTOMIZE', 'realty-pack-core' ); ?></a>
							<a href="<?php echo esc_url( home_url() ); ?>" class="rtpc-admin-btn green"><?php esc_html_e( 'VISIT SITE', 'realty-pack-core' ); ?></a>
						</div>	
					</div>
				</div>
			</div>	
		</div>
	<?php endforeach; ?>
</div>

<?php echo $footer; ?> 
