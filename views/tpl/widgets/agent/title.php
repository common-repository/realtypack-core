<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agent-title-container">
	<?php if ( $settings['name'] == 'yes' ): ?>
		<div class="rtpc-single-agent-title">
			<?php echo $name .' '. $last_name; // Already Escaped ?>
		</div>
	<?php endif; ?>

	<?php if ( $settings['role'] == 'yes' ): ?>
		<div class="rtpc-single-agent-address">
			<?php strtoupper( esc_html_e( 'Agent', 'realty-pack-core' ) ); ?>    
		</div>
	<?php endif; ?>

</div>
