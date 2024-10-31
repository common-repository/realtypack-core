<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Admin\Dashboard;

use RTPC\Models\RTPC_Models_Model;

class RTPC_Models_Admin_Dashboard_Dashboard extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {
		$this->register_hook_callbacks();
	}

	public function register_hook_callbacks() {}

}