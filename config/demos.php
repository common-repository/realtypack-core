<?php

add_filter('rtpc/add/demos', 'rtpc_register_demos');

function rtpc_register_demos( $demos ) {

	$demos = array(
		array(
			'name'       	=> __('Default Demo', 'realty-pack-core'),
			'slug'       	=> 'default_demo',
			'logo_src'      => RTPC_ASSETS_URL . 'assets/admin/img/default_demo.jpg',
			'preview_url'   => '#',
			'pro'   		=> true,
		),
	);

	return $demos;
}
