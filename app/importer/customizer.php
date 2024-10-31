<?php
	
include_once ABSPATH . 'wp-includes/class-wp-customize-setting.php';

final class RTPC_customizer_importer extends WP_Customize_Setting {

	public function import( $value ) {
		$this->update( $value );	
	}
}