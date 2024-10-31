<?php

add_filter('rtpc/add/plugins', 'rtpc_register_plugins');

function rtpc_register_plugins( $plugins ) {

	$plugins = array(
		array(
			'name'       => __( 'WPL PRO', 'realty-pack-core' ),
			'slug'       => 'real-estate-listing-realtyna-wpl-pro',
			'source'     => '',
			'required'   => false,
			'logo_src'	 => RTPC_ASSETS_URL . 'assets/admin/img/Group-11@2x.png',
			'pro'	 	 => true,
			'categories' => array( 'essential' )
		),

		array(
			'name'       => __( 'Elementor', 'realty-pack-core' ),
			'slug'       => 'elementor',
			'source'     => 'repo',
			'required'   => false,
			'logo_src'	 => RTPC_ASSETS_URL . 'assets/admin/img/elementor.png',
			'categories' => array( 'essential' )
		),

		array(
			'name'       => __( 'Revolution Slider', 'realty-pack-core' ),
			'slug'       => 'revslider',
			'source'     => '',
			'required'   => false,
			'logo_src'	 => RTPC_ASSETS_URL . 'assets/admin/img/Group-12@2x.png',
			'pro'	 	 => true,
			'categories' => array( 'recommended', 'bundled' )
		),

		array(
			'name'       => __( 'Contact Form 7', 'realty-pack-core' ),
			'slug'       => 'contact-form-7',
			'source'     => 'repo',
			'required'   => false,
			'logo_src'	 => RTPC_ASSETS_URL . 'assets/admin/img/contact-form7.png',
			'categories' => array( 'recommended' )
		),
	);

	return $plugins;
}
