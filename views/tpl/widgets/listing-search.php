<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div id="wpl_default_search_<?php echo esc_attr( $widget_id ); ?>">
	<form action="<?php echo esc_url( $listing_link ); ?>" id="wpl_search_form_<?php echo esc_attr( $widget_id ); ?>" method="GET" onsubmit="return wpl_do_search_<?php echo esc_attr( $widget_id ); ?>('wpl_searchwidget_<?php echo esc_attr( $widget_id ); ?>');"
		class="wpl_search_from_box rtpc-search-widget clearfix wpl_search_kind<?php echo esc_attr( $kind ); ?> <?php echo esc_attr( $style.' '.$css_class ); ?>">

		<?php if( 'yes' == $wpl_show_tabs ): ?>
			<div class="rtpc-search-tabs-container">
				<div class="rtpc-search-tab rtpc-search-tab-active">
					<?php esc_html_e( 'SALES', 'realty-pack-core' ); ?>
				</div>
				<div class="rtpc-search-tab">
					<?php esc_html_e( 'RENTAL', 'realty-pack-core' ); ?>
				</div>
			</div>
		<?php endif;?>

		<!-- Do not change the ID -->
		<div id="wpl_searchwidget_<?php echo esc_attr( $widget_id ); ?>" class="clearfix rtpc-search-box">
			<?php
			$top_div = '';
			$bott_div = '';
			$bott_div_open = false;

			$is_separator = false;
			$top_array = array();

			$counter = 1;
			foreach($rendered as $data)
			{
				if(($data['field_data']['type'] == 'separator') && $counter > 1)
				{
					$is_separator = true;
					break;
				}

				$counter++;
			}

			if(!$is_separator) $top_array = array(41, 3, 6, 8, 9, 2);

			$counter = 1;
			foreach($rendered as $data)
			{
				if($is_separator or (!$is_separator and in_array($data['id'], $top_array))) $top_div .= $data['html'];
				else
				{
					if(is_string($data['current_value']) and trim($data['current_value']) and $data['current_value'] != '-1') $bott_div_open = true;
					$bott_div .= $data['html'];
				}

				if($data['field_data']['type'] == 'separator' and $counter > 1) $is_separator = false;
				$counter++;
			}
			?>
			<div class="wpl_search_from_box_top">
				<?php echo $top_div; ?>
			</div>
			<?php if( $bott_div ): ?>
				<div class="rtpc-search-options-container">
					<div class="more_search_option" data-widget-id="<?php echo esc_attr( $widget_id ); ?>"
						id="more_search_option<?php echo esc_attr( $widget_id ); ?>">
						<span class="rtpc-search-more-option">
							<?php esc_html_e( 'More options (Advanced)', 'realty-pack-core' ); ?>
						</span>
						<span class="rtpc-search-less-option" style="display:none">
							<?php esc_html_e( 'Less options (Advanced)', 'realty-pack-core' ); ?>

						</span>
					</div>

					<div class="rtpc-search-options">
						<?php if( $show_reset_button ): ?>
							<div class="wpl_search_reset"
							onclick="wpl_do_reset<?php echo esc_attr( $widget_id ); ?>([], <?php echo ($ajax == 2 ? 'true' : 'false'); ?>);"
							id="wpl_search_reset<?php echo esc_attr( $widget_id ); ?>">
							<?php esc_html_e( 'Reset', 'realty-pack-core' ); ?></div>
						<?php endif; ?>
						<div class="search_submit_box">
							<input id="wpl_search_widget_submit<?php echo $widget_id; ?>" class="wpl_search_widget_submit"
							type="submit" value="<?php esc_html_e( 'SEARCH PROPERTY', 'realty-pack-core' ); ?>" />
							<?php if( $show_total_results == 1 ): ?><span id="wpl_total_results<?php echo $widget_id; ?>"
								class="wpl-total-results">(<span></span>)</span><?php endif; ?>
							</div>
							<?php if( $show_total_results == 2 ): ?><span id="wpl_total_results<?php echo $widget_id; ?>"
								class="wpl-total-results-after"><?php echo sprintf('%s listings', '<span></span>'); ?></span><?php endif; ?>
								<?php if( \wpl_global::check_addon('membership') and ($kind == 0 or $kind == 1)): ?>
								<div class="wpl_dashboard_links_container">
									<?php if( \wpl_global::check_addon('save_searches') and ( $show_saved_searches ) ) : ?>
									<a class="wpl-addon-save-searches-link"
									href="<?php echo $membership->URL('searches'); ?>"><?php esc_html_e('Saved Searches', 'realty-pack-core'); ?>
									<span
									id="wpl-addon-save-searches-count<?php echo $widget_id; ?>"><?php echo $saved_searches_count; ?></span>
								</a>
							<?php endif; ?>
							<?php if( $show_favorites ): ?>
								<a class="wpl-widget-favorites-link"
								href="<?php echo $membership->URL('favorites'); ?>"><?php esc_html_e('Favorites', 'realty-pack-core'); ?>
								<span id="wpl-widget-favorites-count<?php echo $widget_id; ?>"><?php echo $favorites_count; ?></span>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	<?php endif; ?>
	<div class="wpl_search_from_box_bot" style="display:none" id="wpl_search_from_box_bot<?php echo $widget_id; ?>">
		<?php echo $bott_div; ?>
	</div>
</div>

</form>
</div>

<?php if($more_options_type): ?>
	<!-- Advanced Search -->
	<div id="wpl_advanced_search<?php echo $widget_id; ?>" class="wpl-advanced-search-wp wpl-util-hidden">
		<div class="container">
			<div id="wpl_form_override_search<?php echo $widget_id; ?>" class="wpl-advanced-search-popup"></div>
		</div>
	</div>
<?php endif;
