<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\WPL;

use RTPC\models\wpl\RTPC_Models_WPL_Wpl;

/**
 * WPL carusel trait.
 *
 * @since 1.0.0
 */
class RTPC_WPL_Carousel extends \wpl_carousel_widget {
   
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        $this->instance = $instance;
        
        $this->widget_id = $this->number;
        if($this->widget_id < 0) $this->widget_id = abs($this->widget_id)+1000;
        
        $this->widget_uq_name = 'wplc'.$this->widget_id;
        $widget_id = $this->widget_id;
        
        $this->css_class = isset($instance['data']['css_class']) ? $instance['data']['css_class'] : '';

        /** render properties **/
        $query = self::query($instance);
        $model = new \wpl_property();
        $properties = $model->search($query);
        
        /** return if no property found **/
        if(!count($properties)) return;
        
        $plisting_fields = $model->get_plisting_fields();
        $wpl_properties = array();
        $render_params['wpltarget'] = isset($instance['wpltarget']) ? $instance['wpltarget'] : 0;
        
        foreach($properties as $property)
        {
            $wpl_properties[$property->id] = $model->full_render($property->id, $plisting_fields, $property, $render_params);
            $wpl_properties[$property->id]['link'] = RTPC_Models_WPL_Wpl::get_property_link( $property->id );

        }
        
        return $wpl_properties;
        
    }
}