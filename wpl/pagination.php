<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

/**
 * WPL pagination class extend
 *
 * @since 1.0.0
 */
class RTPC_WPL_Pagination extends \wpl_pagination
{
    public static function get_pagination($num_result, $page_size = '', $show_options = false, $js_link = 0)
	{
        if(!$page_size) $page_size = 20;

        $p = new RTPC_WPL_Pagination;
        
        /** return js function **/
        $p->js_link = $js_link;
        
        $p->items($num_result);
        $p->limit($page_size); // Limit entries per page
        $p->target(\wpl_global::get_full_url());
        $p->currentPage(\wpl_request::getVar('wplpage')); // Gets and validates the current page
        $p->parameterName('wplpage');
        $p->calculate(); // Calculates what to show
        $p->adjacents(1); //No. of page away from the current page
        //making next and previous keyword to be translated
        $p->nextLabel(__("Next", 'real-estate-listing-realtyna-wpl'));
        $p->prevLabel(__("Previous", 'real-estate-listing-realtyna-wpl'));

        /** validation for page **/
        if(!\wpl_request::getVar('wplpage')) $p->page = 1;
        else $p->page = \wpl_request::getVar('wplpage');

        $p->max_page = ceil($num_result / $page_size);
        if($p->page <= 0 or ($p->page > $p->max_page)) $p->page = 1;

        //Query for limit paging
        $p->limit_query = "LIMIT " . ($p->page - 1) * $p->limit . ", " . $p->limit;

        if($show_options)
		{
            $p->show_total = true;
            $p->show_page_size = true;
        }

        return $p;
    }
}
