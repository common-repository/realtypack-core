<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Wpl;
use RTPC\Models\RTPC_Models_Model;
use RTPC\WPL\RTPC_WPL_Property;

class RTPC_Models_WPL_Wpl extends RTPC_Models_Model {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {

		$this->register_hook_callbacks();

	}

	public function register_hook_callbacks() {
        // Detect wpl is installed or not
        if ( ! defined( '_WPLEXEC' ) ) {
            return;
        }
		add_action( 'wp_loaded', array( $this, 'wpl_flush_rules' ), 1 );
        add_filter( 'rewrite_rules_array', array( $this, 'wpl_insert_rewrite_rules' ) );

	}

    /**
     * Flushes Rewrite rules if WPL rules are not yet included
     * @global object $wp_rewrite
     * @return void
     */
    public function wpl_flush_rules() {
    	$rules = get_option('rewrite_rules');
    	$wpl_rules = self::get_main_rewrite_rule();

    	$flushed = false;
    	foreach($wpl_rules as $wpl_rule)
    	{
    		if($flushed or isset($rules[$wpl_rule['regex']])) continue;

    		global $wp_rewrite;
    		$wp_rewrite->flush_rules();
    		$flushed = true;
    	}
    }

    /**
     * Adds WPL rewrite rukes
     * @param array $rules
     * @return array
     */
    public function wpl_insert_rewrite_rules( $rules ) {
    	$wpl_rules = self::get_main_rewrite_rule();

        $newrules = array();
        foreach($wpl_rules as $wpl_rule) $newrules[$wpl_rule['regex']] = $wpl_rule['url'];

    	return $newrules + $rules;
    }

	/**
     * Returns WPL Main rewrite rule
     * @static
     * @return array
     */
    public static function get_main_rewrite_rule() {

        $main_permalink = self::get_wpl_permalink();

        $wpl_rules = array();
        
        if( \wpl_global::check_multilingual_status() ) {
            $lang_options = \wpl_addon_pro::get_wpl_language_options();
            
            $lang_str = '.+';
            foreach( $lang_options as $lang_option ) $lang_str .= $lang_option['shortcode'].'|';
            $lang_str = trim($lang_str, '|.+ ');
            
            $wpl_rules[] = array('regex'=>'('.$lang_str.')/('.$main_permalink.')/(.+)$', 'url'=>'index.php?pagename=$matches[2]&wpl_qs=$matches[3]');
            $wpl_rules[] = array('regex'=>'language/('.$lang_str.')/('.$main_permalink.')/(.+)$', 'url'=>'index.php?pagename=$matches[2]&wpl_qs=$matches[3]');
            
            foreach($lang_options as $lang_option)
			{
				$wpl_rules[] = array('regex'=>'('.$lang_option['shortcode'].')/('.\wpl_sef::get_post_name((isset($lang_option['main_page']) ? $lang_option['main_page'] : $main_permalink)).')/(.+)$', 'url'=>'index.php?pagename=$matches[2]&wpl_qs=$matches[3]');
				$wpl_rules[] = array('regex'=>'language/('.$lang_option['shortcode'].')/('.\wpl_sef::get_post_name((isset($lang_option['main_page']) ? $lang_option['main_page'] : $main_permalink)).')/(.+)$', 'url'=>'index.php?pagename=$matches[2]&wpl_qs=$matches[3]');
			}
        }
        
        $wpl_rules[] = array('regex'=>'('.$main_permalink.')/(.+)$', 'url'=>'index.php?post_type=property_builder&name=$matches[1]&wpl_qs=$matches[2]');

        return $wpl_rules;
    }
    
    /**
     * Returns WPL permalink
     * @param boolean $full
     * @return string
     */
    public static function get_wpl_permalink( $full = false ) {

        $main_permalink = get_theme_mod( 'properties_permalink', 'property' );

        /** Multilingual **/
        if( \wpl_global::check_multilingual_status() ) {
            _wpl_import('libraries.addon_pro');
            $lang_permalink = \wpl_addon_pro::get_lang_main_page();
            if($lang_permalink) $main_permalink = $lang_permalink;
        }

        if ( $full ) {
            $url = get_page_link( $main_permalink );
            
            /** make sure / character is added to the end of URL in case WordPress SEO permalink is enabled **/
            $nosef = \wpl_sef::is_permalink_default();
            if(!$nosef) $url = trim($url, '/').'/';
            
            return $url;
        }

        return \wpl_sef::get_post_slug( $main_permalink );
    }
   

   /**
     * Returns property page link
     * @static
     * @param array $property_data
     * @param int $property_id
     * @param int $target_id
     * @return string
     */
    public static function get_property_link( $property_id = 0, $target_id = 0 ) {
        /** fetch property data if property id is setted **/
        if( $property_id ) {
           $property_data = \wpl_property::get_property_raw_data( $property_id );
        }

        $url = self::get_wpl_permalink(true);
        $alias_column = 'alias';
        $alias_field = \wpl_flex::get_field_by_column( $alias_column, $property_data['kind'] );
        
        if( isset( $alias_field->multilingual ) and $alias_field->multilingual and \wpl_global::check_multilingual_status() ) { 
            $alias_column = \wpl_addon_pro::get_column_lang_name( $alias_column, \wpl_global::get_current_language(), false );
        }
        
        if( trim( $property_data[ $alias_column ] ) != '' ) { 
            $alias = urlencode( $property_data[ $alias_column ] );
        } else {
            $alias = urlencode( \wpl_property::update_alias( $property_data, $property_id ) );
        }

        $home_type = \wpl_global::get_wp_option( 'show_on_front', 'posts' );
        $home_id = \wpl_global::get_wp_option( 'page_on_front', 0 );

        if( !$target_id ) {
            $target_id = \wpl_request::getVar( 'wpltarget', 0 );
        }

        if( $target_id ) {
            $url = \wpl_global::add_qs_var('pid', $property_id, \wpl_sef::get_page_link( $target_id ) );
            $url = \wpl_global::add_qs_var('alias', $alias, $url);

            $url = \wpl_global::add_qs_var('wplview', 'property_show', $url);
        } else {
            $nosef = \wpl_sef::is_permalink_default();
            $wpl_main_page_id = \wpl_sef::get_wpl_main_page_id();
            
            if( $nosef or ( $home_type == 'page' and $home_id == $wpl_main_page_id ) ) {
                $url = \wpl_global::add_qs_var('wplview', 'property_show', $url);
                $url = \wpl_global::add_qs_var('pid', $property_id, $url);
                $url = \wpl_global::add_qs_var('alias', $alias, $url);
            } else {
                $url .= $property_id.'-'.$alias.'/';
            }
        }
        
        return $url;
    }

    public static function get_needed_properties_permalink( $value, $search = 'sf_select_user_id' ) {

        $permalink = get_theme_mod( 'properties_permalink' );

        $permalink = \wpl_sef::get_post_slug( $permalink );

        $permalink = get_site_url() .'/'. $permalink .'/?'. $search .'='. $value ;

        return $permalink;
    }

    public static function get_properties_permalink() {

        $permalink = get_theme_mod( 'properties_permalink' );

        $permalink = \wpl_sef::get_post_slug( $permalink );

        $permalink = get_site_url() .'/'. $permalink .'/';

        return $permalink;
    }
}