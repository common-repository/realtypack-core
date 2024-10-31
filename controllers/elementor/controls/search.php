<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Controls;

use Elementor\Plugin;
use Elementor\Base_Data_Control;

/**
 * Elementor emoji one area control.
 *
 * A control for displaying a textarea with the ability to add emojis.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Controls_Search extends \Elementor\Base_Data_Control {

	/**
	 * Get emoji one area control type.
	 *
	 * Retrieve the control type, in this case `emojionearea`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'listing_search';
	}

	/**
	 * Enqueue emoji one area control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles used by the emoji one
	 * area control.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {
		
	}

	/**
	 * Get emoji one area control default settings.
	 *
	 * Retrieve the default settings of the emoji one area control. Used to return
	 * the default settings while initializing the emoji one area control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 3,
			'emojionearea_options' => [],
		];
	}

	/**
	 * Render emoji one area control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();

		?>
		<style type="text/css">
			.wpl-widget-search-wp{margin: 10px 0;}
			.wpl-widget-search-wp input[type=checkbox] + label{vertical-align:top;display:inline-block;}
			.wpl_field_container{border: 0px; width: 100%; border-bottom: 1px solid #CCC;}
			.wpl_field_container select{min-width: 215px;}
			.wpl_field_container td, wpl_field_container tr{border: 0px; text-align: left;}
			tr[wpl_situation="disable"] > td{display: none;}
			tr[wpl_situation="enable"] > td{display: table-cell;}
			.fields_category_box > .fields_category_inputs{display: none;}
			.fields_category_box{}
			.wpl_listing_field_add{cursor: pointer; width: 20px; text-align: center; height: 15px;}
			.wpl_listing_field_add.disable{background: #F93; color: #333;}
			.wpl_listing_field_add.enable{background: #393; color: #030;}
			.wpl_listing_field_add.enable:before{content: "-"; font-size: 12px; text-align: center;	padding: 0px 5px 0px 7px;}
			.wpl_listing_field_add.disable:before{content: "+";	font-size: 12px; text-align: center; padding: 0px 5px 0px 7px;}
			.fields_category_box:hover{background: #EEE;}
			.fields_category_box:hover > .fields_category_title{background: #CCC; cursor: pointer;}
			.fields_category_title{border-bottom: 1px solid #CCC; padding: 0px 10px; margin-bottom: 5px; border-left: 3px solid #999; line-height: 25px; font-weight: bold;}
			.fields_category_title:hover{background: #CCC;}
			.fields_category_box > table:hover{border-bottom: 1px solid #000;}
			input[name$="[sort]"]{width: 100%; margin: 0px; font-size: 11px; padding: 0px; height: 20px;}
			.wpl_extoptions_span{display: none;}
			.wpl_extoptions_span.show,
			.wpl_extoptions_span.predefined,
			.wpl_extoptions_span.select-predefined,
			.wpl_extoptions_span.minmax,
			.wpl_extoptions_span.minmax_slider,
			.wpl_extoptions_span.minmax_selectbox,
			.wpl_extoptions_span.minmax_selectbox_plus,
			.wpl_extoptions_span.minmax_selectbox_minus,
			.wpl_extoptions_span.locationtextsearch,
			.wpl_extoptions_span.advanced_locationtextsearch,
			.wpl_extoptions_span.googleautosuggest,
			.wpl_extoptions_span.radiussearch,
			.wpl_extoptions_span.dropdown,
			.wpl_extoptions_span.multiselect_dropdown,
			.wpl_extoptions_span.hier_dropdown,
			.wpl_extoptions_span.hier_multiselect_dropdown,
			.wpl_extoptions_span.mullocationkeys,
			.wpl_extoptions_span.datepicker,
			.wpl_extoptions_span.minmax_selectbox_any{display: inline;}
			.wpl_widget_shortcode_preview{text-align: center; padding: 15px 3px 5px;}
		</style>
		<button id="btn-search-<?php echo esc_attr( $control_uid ); ?>"
			data-is-init="false"
			data-item-id="<?php echo esc_attr( $control_uid ); ?>"
			data-fancy-id="wpl_view_fields_<?php echo esc_attr( $control_uid );; ?>" class="wpl-btn-search-view-fields wpl-button button-1"
			href="#wpl_view_fields_<?php echo esc_attr( $control_uid ); ?>" type="button"><?php echo __('View Fields', 'wpl'); ?></button>

			<div id="wpl_view_fields_<?php echo esc_attr( $control_uid ); ?>" class="hidden">
				<div class="fanc-content" id="wpl_flex_modify_container_<?php echo esc_attr( $control_uid ); ?>">
					<h2><?php echo __('Search Fields Configurations', 'wpl'); ?></h2>
					<div class="fanc-body fancy-search-body wpl-widget-search-fields-wp">
						<div class="search-fields-wp">
							<div class="search-tabs-wp">
								<?php// $search->generate_backend_categories_tabs($instance['data']); ?>
							</div>
							<div class="search-tab-content">
								<?php// $search->generate_backend_categories($instance['data']); ?>
							</div>
						</div>
						<div id="fields-order" class="order-list-wp">
							<h4>
								<span>
									<?php echo __('Fields Order', 'wpl'); ?>    
								</span>
							</h4>

							<div class="order-list-body">
								<ul>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

}
