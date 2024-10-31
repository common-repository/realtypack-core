<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
use RTPC\Controllers\Wpl\RTPC_Controllers_WPL_Wpl;

$place_name = 'Select One';

if( isset( $state_selection ) && '' !== $state_selection ){
	$place_name = $state_selection[0];
}

if( isset( $country_selection )  && '' !== $country_selection  ){
	$place_name = $country_selection[0];
}

$listing_link = RTPC_Controllers_WPL_Wpl::get_needed_properties_permalink( $place_name, 'sf_locationtextsearch' );

$items = $items . ' ' . __( 'Properties','realty-pack-core' );
?>
<div class="rtpc-place">
	<span class="rtpc-place-title">
		<?php esc_html_e( $place_name ) ?>
	</span>
	<a href="<?php echo esc_url( $listing_link ); ?>" class="rtpc-place-properties">
		<?php esc_html_e( $items ); 
		esc_html_e( ' Properties', 'realty-pack-core' ); ?>
	</a>
</div>
