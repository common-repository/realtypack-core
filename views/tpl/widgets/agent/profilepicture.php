<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<?php if( isset( $image ) ): ?>
	<div class="rtpc-single-agent-profile-picture">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
	</div>
<?php else:?>
	<div class="rtpc-single-agent-profile-picture-noimage">

	</div>
<?php endif;?>