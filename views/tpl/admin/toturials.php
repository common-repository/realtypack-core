<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>

<?php echo $header; ?>
<div class="rtp-row">
	<div class="rtp-col-md-6">
		<div class="rtpc-admin-box-colorful gradiant-blue support-forum">
			<div class="rtpc-admin-box-colorful-inner">
				<h3 class="rtpc-admin-box-colorful-title"><?php esc_html_e( 'Support Forum', 'realty-pack-core' ); ?></h3>
				<p class="rtpc-admin-box-colorful-content"><?php esc_html_e( 'EightQueens support team with high percentage of satisfied user. If you have any issues please use our support forum.' ); ?></p>
				<a href="<?php echo esc_url( 'https://support.realtyna.com/' ); ?>" class="rtpc-admin-btn"><?php esc_html_e( 'Open Support', 'realty-pack-core' ); ?></a>
			</div>
		</div>	
	</div>	
	<div class="rtp-col-md-6">
		<div class="rtpc-admin-box-colorful gradiant-pink documentation">
			<div class="rtpc-admin-box-colorful-inner">
				<h3 class="rtpc-admin-box-colorful-title"><?php esc_html_e( 'Documentation', 'realty-pack-core' ); ?></h3>
				<p class="rtpc-admin-box-colorful-content"><?php esc_html_e( 'Please visit our RealtyPack documentation page if you want to know more about realtypack theme.' ); ?></p>
				<a href="<?php echo esc_url( 'https://eightqueens.pro/realtypack/documentation/' ); ?>" class="rtpc-admin-btn"><?php esc_html_e( 'Documentation', 'realty-pack-core' ); ?></a>
			</div>
		</div>	
	</div>	
</div>	
<!-- <div class="rtp-row">
	<div class="rtp-col-md-4">
		<div class="rtpc-admin-box-video">
			<iframe width="100%" height="315" src="<?php echo esc_url( 'https://www.youtube.com/watch?v=snFzbPm_RUE' ); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>	
 -->
<?php echo $footer; ?>