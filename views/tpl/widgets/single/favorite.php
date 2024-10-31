<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<a class="rtpc-sp-favorite" href="#" data-nounce="<?php echo wp_create_nonce( 'rtpc_favorite' ); ?>" data-pid="<?php echo $pid; ?>" data-mode="<?php echo ( $find_favorite_item ? '0' : '1' ); ?>" title="<?php echo ( $find_favorite_item ? __( 'Remove from favorites', 'realty-pack-core' ) : __( 'Add to favorites', 'realty-pack-core' ) ); ?>">
	<i class="rtpf rtpf-heart-1"></i>
</a>