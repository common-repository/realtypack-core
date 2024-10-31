<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>

<?php echo $header; ?>
<div class="rtpc-admin-box type4">
	<div class="rtpc-admin-box-inner">
		<?php esc_html_e( 'Requirements.', 'realty-pack-core' ); ?>
		<?php esc_html_e( 'When you install a demo it provides pages, images, theme options, posts, slider, widgets and etc. IMPORTANT: Please check below status to see if your server meets all essential requirements for a successful import.', 'realty-pack-core' );?>
		<div class="rtpc-admin-separator gray">
		</div>	
	</div>
	<div class="rtpc-admin-box-inner">
		<h3 class="rtpc-admin-grid-title"><?php esc_html_e( 'Wordpress Envioment', 'realty-pack-core' ); ?></h3>
	</div>	
	<table class="rtpc-admin-grid">
		<tbody>
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'Home URL', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo esc_url( home_url() ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'WP Version', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php bloginfo('version'); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'WP Multisite', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php ( is_multisite() ? esc_html_e( 'Yes', 'realty-pack-core' ) : esc_html_e( 'No', 'realty-pack-core' ) ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'WP Memory Limit', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo ( function_exists( 'ini_get' ) ? esc_html( ini_get( 'memory_limit') ) : '' ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'WP Permalink', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo esc_html( get_option( 'permalink_structure' ) ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'WP Debug Mode', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php ( defined('WP_DEBUG') ? esc_html_e( 'On', 'realty-pack-core' ) : esc_html_e( 'Off', 'realty-pack-core' ) ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'Active Language', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo esc_html( get_locale() ); ?>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>

	<div class="rtpc-admin-box-inner">
		<h3 class="rtpc-admin-grid-title"><?php esc_html_e( 'Server Environment', 'realty-pack-core' ); ?></h3>
	</div>	
	<table class="rtpc-admin-grid">
		<tbody>
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'PHP Version', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo ( function_exists( 'phpversion' )  ? esc_html( phpversion() ) : '' ); ?>
				</td>
				<td></td>
			</tr>		
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'PHP Maximum Execution Time', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo ( function_exists( 'ini_get' )  ?  esc_html( ini_get('max_execution_time') ) : '' ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'PHP Max Input Vars', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo ( function_exists( 'ini_get' )  ? esc_html( ini_get('max_input_vars') ) : '' ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'MySQL Version', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo esc_html( $db_version ); ?>
				</td>
				<td></td>
			</tr>			
			<tr>
				<td class="rtpc-admin-grid-label-column">
					<?php esc_html_e( 'Max Upload Size', 'realty-pack-core' ); ?>
				</td>	
				<td class="rtpc-admin-grid-tag-column" align="center"></td>	
				<td class="rtpc-admin-grid-status-column">
					<?php echo esc_html( size_format( wp_max_upload_size() ) ); ?>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>

	<div class="rtpc-admin-box-inner">
		<h3 class="rtpc-admin-grid-title"><?php esc_html_e( 'Active Plugins', 'realty-pack-core' ); ?></h3>
	</div>	
	<table class="rtpc-admin-grid">
		<tbody>
			<?php
			$active_plugins = (array) get_option( 'active_plugins', array() );

			if ( is_multisite() ) {
				$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			}

			foreach ( $active_plugins as $plugin ) {

				$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
				$dirname        = dirname( $plugin );

				if ( trim( $plugin_data['Name'] ) ) {
					?>
					<tr>
						<td class="rtpc-admin-grid-label-column">
							<?php echo esc_html( $plugin_data['Name'] ) ?>
						</td>
						<td class="rtpc-admin-grid-tag-column" align="center"></td>	
						<td class="rtpc-admin-grid-status-column">
							<?php echo esc_html( $plugin_data['Version'] ) ; ?>	
						</td>
						<td><?php echo sprintf( _x( 'by %s', 'by author', 'realty-pack-core' ), $plugin_data['Author'] ); ?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
</div>	
<?php echo $footer; ?>