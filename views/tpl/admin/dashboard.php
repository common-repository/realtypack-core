<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>

<?php echo $header; ?>

<div class="rtpc-admin-box type1">
	<h2 class="rtpc-admin-box-title blue"><?php esc_html_e( 'Theme Activate', 'realtif-core' ); ?></h2>
	<span class="rtpc-admin-box-separator blue"></span>
	<div>
		<?php esc_html_e( 'In order to use all theme features and options, please enter your license code.', 'realtif-core' ); ?>
		
	</div>
	<div class="rtpc-admin-clearfix rtpc-admin-activation">
		<div class="rtpc-admin-activation-form">
			<?php $email 	= get_option( 'realtypack_activate_email', false ); ?>
			<?php $purchase = get_option( 'realtypack_activate_purchase', false ); ?>
			<input type="text" value="<?php echo isset( $email ) ? esc_attr( $email ) : ''; ?>" class="rtpc-admin-activate-email" placeholder="<?php esc_html_e( 'Your Email', 'realtif-core' ); ?>" />
			<input type="text" value="<?php echo isset( $purchase ) ? esc_attr( $purchase ) : '';?>" class="rtpc-admin-activate-purchase" placeholder="<?php esc_html_e( 'License Code', 'realtif-core' ); ?>" />
			<a class="rtpc-admin-activation-form-submit"><?php esc_html_e( 'Submit', 'realtif-core' ); ?></a>
		</div>
		<?php $verify 	= get_option( 'realtypack_activation', false ); ?>
		<span class="rtpc-admin-msg rtpc-admin-success-msg"><?php echo ( ( false != $verify || '' != $verify ) ? esc_html__( 'RealtyPack Activated Successfully', 'realty-pack' ) : ''); ?></span>
		<span class="rtpc-admin-msg rtpc-admin-error-msg"></span>
	</div>
</div>	
<!-- <div class="rtpc-admin-box type1">
	<div class="rtp-row">
		<div class="rtp-col-md-3">
			<div class="rtpc-admin-chart-statistics pink">
				<i class="rtpc-admin-icon"></i>
				<span class="number">156</span>
				<span class="label">All Properties</span>
			</div>	
		</div>	
		<div class="rtp-col-md-3">
			<div class="rtpc-admin-chart-statistics orange">
				<i class="rtpc-admin-icon"></i>
				<span class="number">435</span>
				<span class="label">All Properties</span>
			</div>	
		</div>	
		<div class="rtp-col-md-3">
			<div class="rtpc-admin-chart-statistics purple">
				<i class="rtpc-admin-icon"></i>
				<span class="number">657</span>
				<span class="label">All Properties</span>
			</div>	
		</div>	
		<div class="rtp-col-md-3">
			<div class="rtpc-admin-chart-statistics green">
				<i class="rtpc-admin-icon"></i>
				<span class="number">322</span>
				<span class="label">All Properties</span>
			</div>	
		</div>	
	</div>	
</div>	
 --><div class="rtpc-admin-box type1">
	<h2 class="rtpc-admin-box-title red"><?php esc_html_e( 'Changelog', 'realtif-core' ); ?></h2>
	<span class="rtpc-admin-box-separator red"></span>
	<div class="rtpc-admin-changelog">

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.5 – 23 August 2019</span>
			<ul class="list">
				<li>Fixed 3rd party plugins update.</li>
				<li>Fixed issue regarding activation on plugins and importer.</li>
				<li>Fixed Agency contact widget in single builder.</li>
				<li>Fixed litsing type "unknown".</li>
				<li>Fixed Print button link.</li>
				<li>Fixed Favorite button issue.</li>
				<li>Fixed compare button issue.</li>
				<li>Fixed Unit switcher widget issue.</li>
				<li>Fixed Minor issues in simillar properties.</li>
				<li>Fixed google map widget in property single.</li>
				<li>Fixed Sort option and filter bar in property widget.</li>
				<li>Fixed issue on signin register modal.</li>
				<li>Fixed some minor issues.</li>
			</ul>
		</div>

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.4 – 13 August 2019</span>
			<ul class="list">
				<li>Fixed License activation issue.</li>
			</ul>
		</div>

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.3 – 12 August 2019</span>
			<ul class="list">
				<li>ADDED warning message for update wpl if is required.</li>
			</ul>
		</div>

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.2 – 25 July 2019</span>
			<ul class="list">
				<li>ADDED activation with license.</li>
				<li>Fixed demo importer for pro version.</li>
				<li>Fixed plugin activator for pro version.</li>
				<li>Fixed some minor issues.</li>
			</ul>
		</div>

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.1 – 12 July 2019</span>
			<ul class="list">
				<li>Fixed some demo importer issues</li>
				<li>Fixed plugin activator issues</li>
			</ul>
		</div>

		<div class="rtpc-admin-changelog-version">
			<span class="title">v 1.0.0 – 10 May 2019</span>
			<ul class="list">
				<li>Initial release</li>
			</ul>
		</div>

	</div>	
</div>	

<?php echo $footer; ?> 
