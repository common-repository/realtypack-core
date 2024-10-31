<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models;
use RTPC\Models\RTPC_Models_Model;

class RTPC_Models_DB extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->register_hook_callbacks();

	}

	public function register_hook_callbacks() {}

    /**
     * Returns WPL users
	 *
     * @return array
     */
	public static function get_wpl_users() {

		$query = "SELECT `id` FROM `#__wpl_users` WHERE `id` > 0";
		
		return \wpl_db::select($query);

	}

	/**
     * read sql commands and run it
	 *
     * @return array
     */
	public static function process_sql( $filename ) {

		// Initialise variables.
		$fh = fopen($filename, 'rb');

		if(false === $fh) return false;

		clearstatcache();

		if( $fsize = @filesize( $filename ) ) {
			$data = fread($fh, $fsize);
			fclose($fh);
		} else {
			fclose($fh);
			return false;
		}

		$queries = $data;
		$queries = str_replace(";\r\n", "-=++=-", $queries);
		$queries = str_replace(";\r", "-=++=-", $queries);
		$queries = str_replace(";\n", "-=++=-", $queries);

		$sqls = explode( "-=++=-", $queries );

		foreach( $sqls as $sql ) {
			try{
				\wpl_db::q(trim($sql));
			} catch (Exception $e) {

			}
		}

		return true;
	}

	public static function query( $query ) {
		global $wpdb;

		$wpdb->query( $query );
	}

}