<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-package">
	<div class="rtpc-package-container">
		<div class="rtpc-package-head">
			<h3 class="rtpc-package-head-title">
				<?php echo esc_html( $args[ 'rftc_pricing' ][ 'rtfc_package_name' ] ); ?>
			</h3>
			<p class="rtpc-package-head-description">
				<?php echo esc_html( $args[ 'rftc_pricing' ][ 'rtfc_package_description' ] ); ?>
			</p>
		</div>
		<div class="rtpc-package-content">
			<div class="rtpc-package-price">
				<span class="rtpc-package-price-currency">
					<?php echo esc_html( $args[ 'rftc_pricing' ][ 'rtfc_package_currency' ] ); ?>
				</span>
				<span class="rtpc-package-price-amount">
					<?php echo esc_html( $args[ 'rftc_pricing' ][ 'rtfc_package_price' ] ); ?>
				</span>
				<span class="rtpc-package-price-date">/
					<?php echo esc_html( $args[ 'rftc_pricing' ][ 'rtfc_package_date_range' ] ); ?>
				</span>
			</div>
			<div class="rtp-main-button-blue rtp-btn-blue-black ">
				<a href="<?php echo esc_url( $args[ 'rftc_pricing' ][ 'rtfc_package_link' ] ); ?>">
					<span><?php esc_html_e( 'Buy this package', 'realty-pack-core' ); ?></span>
				</a>
				
			</div>
			<div class="rtpc-package-items">
				<?php
				$allowed_html = array(
					'a'     =>  array(),
					'br'    =>  array(),
					'em'    =>  array(),
					'strong'=>  array(),
					'b'     =>  array(),
					'i'     =>  array(),
					'p'     =>  array(),
					'div'   =>  array(),
					'span'  =>  array(),
				);

				echo wp_kses( $args[ 'rftc_pricing' ][ 'rtfc_package_items' ], $allowed_html ); ?>
			</div>
		</div>
	</div>
</div>