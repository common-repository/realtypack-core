<?php

add_filter( 'rtpc/add/admin/menu', 'rtpc_add_admin_menu' );

function rtpc_add_admin_menu( $menu ) {

	$menu = array(
		array(
			'page_title' => 'RealtyPack',
			'menu_title' => 'RealtyPack',
			'capability' => 'manage_options',
			'menu_slug'  => 'realty-pack-core',
			'function'   =>  array( 'RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Dashboard' , 'render' ),
			'icon_url'   =>  RTPC_ASSETS_URL . 'assets/admin/img/logo-admin-menu.png',
			'position'   =>  2
		),
		array(
			'parent_slug' => 'realty-pack-core',
			'page_title'  => 'RealtyPack Importer',
			'menu_title'  => 'Demo Importer',
			'capability'  => 'manage_options',
			'menu_slug'   => 'realty-pack-core-importer',
			'function'    => array( 'RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Importer' , 'render' ),
			'position'    => 3
		),
		array(
			'parent_slug' => 'realty-pack-core',
			'page_title'  => 'RealtyPack Plugins',
			'menu_title'  => 'Plugins',
			'capability'  => 'manage_options',
			'menu_slug'   => 'realty-pack-core-plugins',
			'function'    => array( 'RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Plugin' , 'render' ),
			'position'    => 4
		),
		array(
			'parent_slug' => 'realty-pack-core',
			'page_title'  => 'RealtyPack Tutorials',
			'menu_title'  => 'Tutorials',
			'capability'  => 'manage_options',
			'menu_slug'   =>'realty-pack-core-tutorials',
			'function'    => array( 'RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot' , 'realtypack_toturials' ),
			'position'    => 5
		),
		array(
			'parent_slug' => 'realty-pack-core',
			'page_title'  => 'RealtyPack System Status',
			'menu_title'  => 'System Status',
			'capability'  => 'manage_options',
			'menu_slug'   =>'realty-pack-core-system-status',
			'function'    => array( 'RTPC\Controllers\Admin\Dashboard\RTPC_Controllers_Admin_Dashboard_Boot' , 'realtypack_system_status' ),
			'position'    => 6
		),
	);

	return $menu;
}
