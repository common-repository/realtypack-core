<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Agent;
use RTPC\Controllers\Wpl\RTPC_Controllers_WPL_Wpl;
use RTPC\Controllers\Agency\RTPC_Controllers_Agency_Boot;

trait RTPC_WPL_User {

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_info_agent( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->profile_picture ) != '') {
            $data->profile_picture = array(
                'url' => \wpl_items::get_folder($user_id, 2).$data->wpl_data->profile_picture,
                'path' => \wpl_items::get_path($user_id, 2).$data->wpl_data->profile_picture,
                'name' => $data->wpl_data->profile_picture
            );
        }

        $data->link = RTPC_Controllers_Agency_Agent::get_agent_link( $user_id );
        $data->listing_count = \wpl_db::num("SELECT COUNT(*) FROM `#__wpl_properties` WHERE `user_id` = " . $user_id );

        $data->listing_link = RTPC_Controllers_WPL_Wpl::get_needed_properties_permalink( $user_id, 'sf_select_user_id' );

        return $data;
    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_info_agency( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->company_logo ) != '') {
            $data->company_logo = array(
                'url' => \wpl_items::get_folder($user_id, 2).$data->wpl_data->company_logo,
                'path' => \wpl_items::get_path($user_id, 2).$data->wpl_data->company_logo,
                'name' => $data->wpl_data->company_logo
            );
        }

        // Check for agent list 
        if ( $data->wpl_data->rtp_agent_list != '' ) {
            $agent_list = explode(',', $data->wpl_data->rtp_agent_list );
            $agents = array();
            foreach ( $agent_list as $agent_id ) {
                $agents[] = self::get_user_info_agent( $agent_id );
            }

            $data->agent_images = $agents;
        }

        $data->link = RTPC_Controllers_Agency_Boot::get_agency_link( $user_id );
        $data->listing_count = \wpl_db::num("SELECT COUNT(*) FROM `#__wpl_properties` WHERE `user_id` = " . $user_id );

        $data->listing_link = RTPC_Controllers_WPL_Wpl::get_needed_properties_permalink( $user_id, 'sf_select_user_id' );

        return $data;
    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_cover_image( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->agent_cover ) != '' ) {
            $data->agent_cover = array(
                'url' => \wpl_items::get_folder( $user_id, 2 ).$data->wpl_data->agent_cover,
                'path' => \wpl_items::get_path( $user_id, 2 ).$data->wpl_data->agent_cover,
                'name' => $data->wpl_data->agent_cover
            );
        }

        return $data;
    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_profile_picture( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->profile_picture ) != '') {
            $data->profile_picture = array(
                'url' => \wpl_items::get_folder($user_id, 2).$data->wpl_data->profile_picture,
                'path' => \wpl_items::get_path($user_id, 2).$data->wpl_data->profile_picture,
                'name' => $data->wpl_data->profile_picture
            );
        } else {
            $data->profile_picture = array(
                'url' => \wpl_global::get_wpl_asset_url('img/crm/avatar.png'),
                'path' => WPL_ABSPATH. 'assets' .DS. 'img' .DS. 'crm' .DS. 'avatar.png',
                'name' => ''
            );
        }

        return $data;

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_agency_logo( $user_id ) {

        $data = \wpl_users::get_user( $user_id );

        if( trim( $data->wpl_data->company_logo ) != '') {
            $data->company_logo = array(
                'url' => \wpl_items::get_folder($user_id, 2).$data->wpl_data->company_logo,
                'path' => \wpl_items::get_path($user_id, 2).$data->wpl_data->company_logo,
                'name' => $data->wpl_data->company_logo
            );
        } else {
            $data->company_logo = array(
                'url' => \wpl_global::get_wpl_asset_url('img/crm/avatar.png'),
                'path' => WPL_ABSPATH. 'assets' .DS. 'img' .DS. 'crm' .DS. 'avatar.png',
                'name' => ''
            );
        }

        return $data;

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_agency_title( $user_id ) {

		$query = "SELECT `company_name`, `company_address`, `tel`, `mobile` FROM `#__wpl_users` WHERE `id`='$user_id'";

		return \wpl_db::select($query, 'loadAssocList');

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_agency_details( $user_id ) {

		$query = "SELECT `secondary_email`, `fax`, `company_address`, `tel`, `mobile`, `r_skype`, `website` FROM `#__wpl_users` WHERE `id`='$user_id'";

		return \wpl_db::select($query, 'loadAssocList');

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_agency_describtion( $user_id ) {

		$query = "SELECT `about` FROM `#__wpl_users` WHERE `id`='$user_id'";

		return \wpl_db::select($query, 'loadAssoc');

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_user_data( $user_id, $cols = '*' ) {

		$query = "SELECT `$cols` FROM `#__wpl_users` WHERE `id`='$user_id'";

		return \wpl_db::select($query, 'loadAssoc');

    }

    /**
     * Get user information
     *
     * @return array  User Data
     */
    public static function get_agency_social( $user_id ) {

		$query = "SELECT `r_facebook`,`r_twitter`,`r_pinterest`,`r_skype`,`website` FROM `#__wpl_users` WHERE `id`='$user_id'";

		return \wpl_db::select($query, 'loadAssoc');

    }

    /**
     * Returns WPL users
     *
     * @return array
     */
    public static function get_wpl_users( $membership_type ) {

        $query = "SELECT `id` FROM `#__wpl_users` WHERE `id` > 0 AND membership_type = '$membership_type' AND profile_picture > ''";
        
        return \wpl_db::select($query);

    }

    /**
     * Returns WPL users
     *
     * @return array
     */
    public static function get_properties_user_id( $pid, $result = 'loadObjectList' ) {

        $query = "SELECT `user_id` FROM `#__wpl_properties` WHERE id = '$pid'";
        
        return \wpl_db::select( $query, $result );

    }
}