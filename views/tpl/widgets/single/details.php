<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<?php if( ! $edit_mode ): ?>

	<?php
	$i = 0;
	$details_boxes_num = count($wpl_properties['current']['rendered']);
	echo '<div class="rtpc-details-container">';

	foreach( $wpl_properties['current']['rendered'] as $values ) {

		// skip empty categories
		if( ! count( $values['data'] ) ) {
			continue;
		}

		echo '<div class="rtpc-sp-details rtpc-sp-details-category-'.$values['self']['id'].'">
		<div class="rtpc-sp-details-box-title"><span>'.__($values['self']['name'], 'realty-pack-core').'</span></div>
		<div class="rtpc-sp-details-content rtp-row">';

		foreach($values['data'] as $key => $value)
		{
			if(!isset($value['type'])) continue;

			elseif($value['type'] == 'neighborhood')
			{
				echo '<div id="wpl-dbst-show'.$value['field_id'].'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 neighborhood">' .__($value['name'],'realty-pack-core') .(isset($value['distance']) ? ' <span class="'.$value['vehicle_type'].'">'. $value['distance'] .' '. __('Minutes','realty-pack-core'). '</span>':''). '</div>';
			}
			elseif($value['type'] == 'feature')
			{
				echo '<div id="wpl-dbst-show'.$value['field_id'].'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature ';
				if(!isset($value['values'][0])) echo ' single ';
				
				echo '">'.__($value['name'], 'realty-pack-core');
				
				if(isset($value['values'][0]))
				{
					$html = '';
					echo ' : <span>';
					foreach($value['values'] as $val) $html .= __($val, 'realty-pack-core').', ';
					$html = rtrim($html, ', ');
					echo $html;
					echo '</span>';
				}
				
				echo '</div>';
			}
			elseif($value['type'] == 'locations' and isset($value['locations']) and is_array($value['locations']))
			{
				if(isset($value['settings']) and is_array($value['settings']))
				{
					foreach($value['settings'] as $ii=>$lvalue)
					{
						if(isset($lvalue['enabled']) and !$lvalue['enabled']) continue;

						$lk = isset($value['keywords'][$ii]) ? $value['keywords'][$ii] : '';
						if(trim($lk) == '') continue;

						echo '<div id="wpl-dbst-show'.$value['field_id'].'-'.$lk.'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location '.$lk.'">'.__($lk, 'realty-pack-core').' : ';
						echo '<span>'.$value['locations'][$ii].'</span>';
						echo '</div>';
					}
				}
				else
				{
					foreach($value['locations'] as $ii=>$lvalue)
					{
						$lk = isset($value['keywords'][$ii]) ? $value['keywords'][$ii] : '';
						if(trim($lk) == '') continue;

						echo '<div id="wpl-dbst-show'.$value['field_id'].'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location '.$lk.'">'.__($lk, 'realty-pack-core').' : ';
						echo '<span>'.$lvalue.'</span>';
						echo '</div>';
					}
				}
			}
			elseif($value['type'] == 'separator')
			{
				echo '<div id="wpl-dbst-show'.$value['field_id'].'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 separator">' .__($value['name'], 'realty-pack-core'). '</div>';
			}
			else echo '<div id="wpl-dbst-show'.$value['field_id'].'" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">' .__($value['name'], 'realty-pack-core'). ' : <span>'. __((isset($value['value']) ? $value['value'] : ''), 'realty-pack-core') .'</span></div>';
		}
		
		echo '</div></div>';
		$i++;
	}

	echo '</div>';
	?>
	<?php else: ?>
		<div class="rtpc-details-container">
			<div class="rtpc-sp-details rtpc-sp-details-category-1">
				<div class="rtpc-sp-details-box-title">
					<span><?php esc_html_e( 'Basic Details', 'realty-pack-core' ); ?></span>
				</div>
				<div class="rtpc-sp-details-content rtp-row">
					<div id="wpl-dbst-show3" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other"> 
						<?php esc_html_e( 'Property Type :', 'realty-pack-core' ); ?>
						<span><?php esc_html_e( 'Office', 'realty-pack-core' ); ?></span>
					</div>
					<div id="wpl-dbst-show2" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
						<?php esc_html_e( 'Listing Type :', 'realty-pack-core' ); ?> 
						<span><?php esc_attr_e( 'For Rent', 'realty-pack-core' ); ?></span>
					</div>
					<div id="wpl-dbst-show5" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other"><?php esc_html_e( 'Listing ID :', 'realty-pack-core' ); ?> 
					<span><?php esc_html_e( 'Basic Details', 'realty-pack-core' ); ?><?php esc_html_e( '1003', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show6" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Price : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '$859,000', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show7" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'View : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'Street', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show13" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Rooms : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '9', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show9" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Bathrooms : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '6', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show17" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Half Bathrooms : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '4', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show10" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Square Footage : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '969 Sqft', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show12" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Year Built : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '2007', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show11" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Lot Area : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '278 Sqft', 'realty-pack-core' ); ?></span>
				</div>
			</div>
		</div>
		<div class="rtpc-sp-details rtpc-sp-details-category-4">
			<div class="rtpc-sp-details-box-title">
				<span><?php esc_html_e( 'Features', 'realty-pack-core' ); ?></span>
			</div>
			<div class="rtpc-sp-details-content rtp-row">
				<div id="wpl-dbst-show132" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Jacuzzi', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show130" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Heating System', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show134" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Cooling System', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show135" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Garden', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show137" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Basement', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show139" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'View', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show140" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Pet Policy', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show142" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Steam', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show143" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Gymnasium', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show144" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Fireplace', 'realty-pack-core' ); ?>
				</div>
			</div>
		</div>
		<div class="rtpc-sp-details rtpc-sp-details-category-5">
			<div class="rtpc-sp-details-box-title">
				<span><?php esc_html_e( 'Appliances', 'realty-pack-core' ); ?></span>
			</div>
			<div class="rtpc-sp-details-content rtp-row">
				<div id="wpl-dbst-show156" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Washing Machine', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show161" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Cleaning Service', 'realty-pack-core' ); ?>
				</div>
				<div id="wpl-dbst-show163" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 feature  single ">
					<?php esc_html_e( 'Dishwasher', 'realty-pack-core' ); ?>
				</div>
			</div>
		</div>
		<div class="rtpc-sp-details rtpc-sp-details-category-2">
			<div class="rtpc-sp-details-box-title">
				<span>
					<?php esc_html_e( 'Address Map', 'realty-pack-core' ); ?>
				</span>
			</div>
			<div class="rtpc-sp-details-content rtp-row">
				<div id="wpl-dbst-show41-Country" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location Country">
					<?php esc_html_e( 'Country : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'US', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show41-State" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location State">
					<?php esc_html_e( 'State : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'GA', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show41-County" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location County">
					<?php esc_html_e( 'County : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'Bartley', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show41-City" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 location City">
					<?php esc_html_e( 'City : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'Bernburg', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show45" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Street Number : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '2735', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show43" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Postal Code : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '41031', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show55" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Floor Number : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( '0', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show51" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Longitude : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'E0° 0 0', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show52" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 other">
					<?php esc_html_e( 'Latitude : ', 'realty-pack-core' ); ?>
					<span><?php esc_html_e( 'N0° 0 0', 'realty-pack-core' ); ?> </span>
				</div>
			</div>
		</div>
		<div class="rtpc-sp-details rtpc-sp-details-category-6">
			<div class="rtpc-sp-details-box-title">
				<span><?php esc_html_e( 'Neighborhood', 'realty-pack-core' ); ?></span>
			</div>
			<div class="rtpc-sp-details-content rtp-row">
				<div id="wpl-dbst-show100" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 neighborhood">
					<?php esc_html_e( 'Shopping Center', 'realty-pack-core' ); ?> 
					<span class="Car"><?php esc_html_e( '77 Minutes', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show113" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 neighborhood">
					<?php esc_html_e( 'Town Center', 'realty-pack-core' ); ?> 
					<span class="Walk"><?php esc_html_e( '41 Minutes', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show112" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 neighborhood">
					<?php esc_html_e( 'Police Station', 'realty-pack-core' ); ?> 
					<span class="Train"><?php esc_html_e( '42 Minutes', 'realty-pack-core' ); ?></span>
				</div>
				<div id="wpl-dbst-show108" class="rtpc-single-content rtp-col-md-4  rtp-col-sm-6  rtp-col-xs-12 neighborhood">
					<?php esc_html_e( 'Bus Station', 'realty-pack-core' ); ?>
					<span class="Walk"><?php esc_html_e( '36 Minutes', 'realty-pack-core' ); ?></span>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

