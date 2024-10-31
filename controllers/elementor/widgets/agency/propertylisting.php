<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets\Agency;
use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Listing;

/**
 * Elementor 'RecentPostsGridCarousel' widget.
 *
 * Elementor widget that displays an 'RecentPostsGridCarousel'.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_Agency_PropertyListing extends \Elementor\Widget_Base {

	protected $tags;
    /**
     * Get widget name.
     *
     * Retrieve 'RecentPostsGridCarousel' widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'agency-listing';
    }

    /**
     * Get widget title.
     *
     * Retrieve 'RecentPostsGridCarousel' widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Agency Property Listing', 'realty-pack-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve 'RecentPostsGridCarousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-grid realtypack-flag';
    }

    /**
     * Get widget categories.
     *
     * Retrieve 'RecentPostsGridCarousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_categories() {
        return array( 'RTPC_Agency_Builder' );
    }

    /**
     * Retrieve the terms in a given taxonomy or list of taxonomies.
     *
     * Retrieve 'RecentPostsGridCarousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_terms() {
        $terms = get_terms( 'category', 'orderby=count&hide_empty=0' );
        $list  = array( ' ' => __('All Categories', 'realty-pack-core' ) ) ;
        foreach ( $terms as $key => $value ) {
            $list[$value->term_id] = $value->name;
        }

        return $list;
    }

    /**
     * Register 'RecentPostsGridCarousel' widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        // Global WPL Settings
        $wpl_settings = \wpl_global::get_settings();

        // Kind Options
        $kinds = \wpl_flex::get_kinds('wpl_properties');
        $kinds_options = array();
        foreach($kinds as $kind) $kinds_options[$kind['id']] = esc_html__($kind['name'], 'realty-pack-core');

        // Listing Options
        $listings = \wpl_global::get_listings();

        $listings_options = array();
        foreach($listings as $listing) $listings_options[$listing['id']] = esc_html__($listing['name'], 'realty-pack-core');

        // Property type
        $property_types = \wpl_global::get_property_types();
        $property_types_options = array();
        foreach($property_types as $property_type) $property_types_options[$property_type['id']] = esc_html__($property_type['name'], 'realty-pack-core');

        // Location Text
        $location_settings = \wpl_global::get_settings('3'); # location settings

        // Price Options
        $units = \wpl_units::get_units(4);

        $default_unit = NULL;
        $price_unit_options = array();
        $p = 1;
        foreach($units as $unit)
        {
            if($p == 1) $default_unit = $unit['id'];

            $price_unit_options[$unit['id']] = esc_html__($unit['name'], 'realty-pack-core');
            $p++;
        }

        // Tags Options
        $this->tags = \wpl_flex::get_tag_fields(0);

        // Order Options
        $sorts = \wpl_sort_options::render(\wpl_sort_options::get_sort_options(0, 1));
        $sorts_options = array();
        foreach($sorts as $sort) $sorts_options[$sort['field_name']] = esc_html__($sort['name'], 'realty-pack-core');

        ////////////////////
        // filter section //
        ////////////////////
        $this->start_controls_section(
            'filter_section', 
            array(
                'label' => __('Filter', 'realty-pack-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 
            'kind', 
            array(
                'label' => esc_html__('Kind', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $kinds_options,
                'default' => 0,
            )
        );

        $this->add_control(
            'sf_select_listing', 
            array(
                'label' => esc_html__('Listing Type', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $listings_options,
            )
        );

        $this->add_control(
            'sf_select_property_type', 
            array(
                'label' => esc_html__('Property Type', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $property_types_options,
            )
        );

        $this->add_control(
            'sf_min_price', 
            array(
                'label' => esc_html__('Price (Min)', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '',
            )
        );

        $this->add_control(
            'sf_max_price', 
            array(
                'label' => esc_html__('Price (Max)', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '',
            )
        );

        $this->add_control(
            'sf_locationtextsearch', 
            array(
                'label' => esc_html__('Location', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__($location_settings['locationzips_keyword'].', '.$location_settings['location3_keyword'].', '.$location_settings['location1_keyword'], 'realty-pack-core'),
            )
        );

        $this->add_control(
            'sf_unit_price', 
            array(
                'label' => esc_html__('Price Unit', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $price_unit_options,
                'default' => $default_unit,
            )
        );

        foreach( $this->tags as $tag ) {
            $this->add_control(
                'sf_select_'.$tag->table_column, 
                array(
                    'label' => esc_html__($tag->name, 'realty-pack-core'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => array(
                        '-1'    =>  esc_html__('Any', 'realty-pack-core'),
                        '0'     =>  esc_html__('No', 'realty-pack-core'),
                        '1'     =>  esc_html__('Yes', 'realty-pack-core'),
                    ),
                )
            );
        }


        $this->end_controls_section();


        ///////////////////
        // query section //
        ///////////////////
        $this->start_controls_section(
            'query_section',
            array(
                'label'      => __('Query', 'realty-pack-core' ),
            )
        );

        $this->add_control(
            'orderby', 
            array(
                'label' => esc_html__('Order By', 'realty-pack-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $sorts_options,
            )
        );

        // Order By Options
        $this->add_control(
            'order', 
            array(
            'label' => esc_html__('Order', 'realty-pack-core'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'ASC' => esc_html__('Ascending', 'realty-pack-core'),
                'DESC' => esc_html__('Descending', 'realty-pack-core'),
            ),
        ));

        // Columns Options
        $this->add_responsive_control(
            'wplcolumns',
            array(
                'label'          => __( 'Columns', 'realty-pack-core' ),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => '6',
                'tablet_default' => 'inherit',
                'mobile_default' => '1',
                'options' => array(
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                ),
                'condition'   => array(
                    'preview_mode' => array( 'grid' ),
                ),
                'frontend_available' => true,
            )
        );

        $this->add_control(
            'num',
            array(
                'label'       => __('Number of properties to show', 'realty-pack-core'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'default'     => '6',
                'min'         => 1,
                'step'        => 1
            )
        );

        $this->add_control(
            'exclude_without_media',
            array(
                'label'        => __('Exclude properties without media','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'no'
            )
        );

        $this->end_controls_section();

        ////////////////////
        // Layout Section //
        ////////////////////
        $this->start_controls_section(
            'layout_section',
            array(
                'label' => __('Layout', 'realty-pack-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT
            )
        );

        $this->add_control(
            'display_pagination',
            array(
                'label'        => __('Display pagination','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'default'      => 'yes',

            )
        );      

        $this->add_control(
            'preview_mode',
            array(
                'label'       => __('Display items as', 'realty-pack-core'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'grid',
                'options'     => array(
                    'grid'           => __( 'Grid', 'realty-pack-core' ),
                    'column'     => __( 'List', 'realty-pack-core' ),

                ),
            )
        );

        $this->add_control(
            'carousel_loop',
            array(
                'label'        => __('Loop navigation','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'   => array(
                    'preview_mode' => array( 'grid' ),
                )
            )
        );

        $this->add_control(
            'carousel_autoplay',
            array(
                'label'        => __('Autoplay carousel','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'default'      => 'no',
                'condition'   => array(
                    'preview_mode' => array( 'grid' ),
                )
            )
        );
        $this->add_control(
            'display_tabs',
            array(
                'label'        => __('Display Tabs','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-filters' => 'justify-content: space-between;',
                ),
            )
        );
        $this->add_control(
            'display_views',
            array(
                'label'        => __('Display Grid/List View Option','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'default'      => 'yes',

            )
        );
        $this->add_control(
            'display_sort_options',
            array(
                'label'        => __('Display Sort Options','realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'default'      => 'yes',

            )
        );

        $this->end_controls_section();

        /////////////////////
        // display section //
        /////////////////////
        $this->start_controls_section(
            'display_section',
            array(
                'label' => __('Display', 'realty-pack-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT
            )
        );

        $this->add_control(
            'display_media',
            array(
                'label'        => __('Display property media (image, video, etc)','realty-pack-core' ),
                'label_block'  => true,
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'label_block'  => true
            )
        );

        $this->add_control(
            'display_tags',
            array(
                'label'        => __('Display property tags','realty-pack-core' ),
                'label_block'  => true,
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'label_block'  => true,
                'condition'   => array(
                    'display_media' => 'yes',
                )
            )
        );

        $this->add_control(
            'display_title',
            array(
                'label'        => __('Display property title', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_address',
            array(
                'label'        => __('Display property address', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_features',
            array(
                'label'        => __('Display property features', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_more_details',
            array(
                'label'        => __('Display property more details', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_author',
            array(
                'label'        => __('Display property author', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_date',
            array(
                'label'        => __('Display property date', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'realty-pack-core' ),
                'label_off'    => __( 'Off', 'realty-pack-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',


            )
        );

        $this->end_controls_section();


        /////////////////////////
        // title style section //
        /////////////////////////
        $this->start_controls_section(
            'title_style_section',
            array(
                'label'     => __( 'Content', 'realty-pack-core' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'display_title' => 'yes',
                ),
            )
        );

        $this->add_control(
            'image_width',
            array(
                'label'        => __( 'Image Width (PX)', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::TEXT,
                'label_on'     => __( 'Show', 'realty-pack-core' ),
                'label_off'    => __( 'Hide', 'realty-pack-core' ),
                'return_value' => '477',
                'default'      => '477',
            )
        );            

        $this->add_control(
            'image_height',
            array(
                'label'        => __( 'Image Height (PX)', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::TEXT,
                'return_value' => '300',
                'default'      => '300',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => __( 'Title Color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-title' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Title Typography', 'realty-pack-core' ),
                'name' => 'title_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rtpc-rpgs-property-title',
                'condition' => array(
                    'display_title' => 'yes',
                )
            )
        );

        $this->add_control(
            'price_color',
            array(
                'label' => __( 'Price color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-price' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Price typography', 'realty-pack-core' ),
                'name' => 'price_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rtpc-rpgs-property-content-price',
                'condition' => array(
                    'display_title' => 'yes',
                )
            )
        );

        $this->add_control(
            'price_measure_color',
            array(
                'label' => __( 'Price measure color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-price-type' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Price measure typography', 'realty-pack-core' ),
                'name' => 'price_measure_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rtpc-rpgs-property-content-price-type',
                'condition' => array(
                    'display_title' => 'yes',
                )
            )
        );

        $this->add_control(
            'address_color',
            array(
                'label' => __( 'Address color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-address' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Address typography', 'realty-pack-core' ),
                'name' => 'address_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                '{{WRAPPER}} .rtpc-rpgs-property-address-icon , {{WRAPPER}} .rtpc-rpgs-property-address-text',                
                'condition' => array(
                    'display_title' => 'yes',
                )
            )
        );

        $this->add_control(
            'features_label_color',
            array(
                'label' => __( 'Features label color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-details-label' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_features' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_control(
            'features_value_color',
            array(
                'label' => __( 'Features value color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-details-value' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_features' => 'yes',
                )
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Features typography', 'realty-pack-core' ),
                'name' => 'features_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                '{{WRAPPER}} .rtpc-rpgs-property-content-details-value , {{WRAPPER}} .rtpc-rpgs-property-content-details-label',                
                'condition' => array(
                    'display_features' => 'yes',
                )
            )
        );

        $this->add_responsive_control(
            'author_image',
            array(
                'label' => __( 'Author image size', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 40,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-author-details img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'display_author' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_control(
            'author_label_color',
            array(
                'label' => __( 'Author label color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-content-author-details span' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_author' => 'yes',
                )
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Author label typography', 'realty-pack-core' ),
                'name' => 'author_label_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                '{{WRAPPER}} .rtpc-rpgs-property-content-author-details span',                
                'condition' => array(
                    'display_author' => 'yes',
                )
            )
        );

        $this->add_control(
            'date_color',
            array(
                'label' => __( 'Date color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtpc-rpgs-property-post-date' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_date' => 'yes',
                ),
                'separator' => 'before'
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Date typography', 'realty-pack-core' ),
                'name' => 'date_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                '{{WRAPPER}} .rtpc-rpgs-property-post-date i,{{WRAPPER}} .rtpc-rpgs-property-post-date span',                
                'condition' => array(
                    'display_date' => 'yes',
                )
            )
        );

        $this->end_controls_section();

    }

    /**
    * Render image box widget output on the frontend.
    *
    * @since 1.0.0
    * @access protected
    */
    protected function render() {
        // Get settings
        $settings = $this->get_settings_for_display();

        $id = get_query_var( 'agency_id' );
        $edit_mod = '';

        // Listing instances
        $instance = array (
            'kind'                      =>  (string) $settings['kind'],
            'sf_select_listing'         =>  $settings['sf_select_listing'],
            'sf_select_property_type'   =>  $settings['sf_select_property_type'],
            'sf_locationtextsearch'     =>  $settings['sf_locationtextsearch'],
            'sf_min_price'              =>  $settings['sf_min_price'],
            'sf_max_price'              =>  $settings['sf_max_price'],
            'sf_unit_price'             =>  $settings['sf_unit_price'],
            'sf_select_user_id'         =>  $id,
            'limit'                     =>  (string) $settings['num'],
            'wplorderby'                =>  $settings['orderby'],
            'wplorder'                  =>  $settings['order'],
        );

        $this->tags = \wpl_flex::get_tag_fields(0);
        if ( isset( $this->tags ) ) {               
            foreach ( $this->tags as $tag ) {
                if ( $settings['sf_select_'.$tag->table_column] ) {
                    $instance['sf_select_'.$tag->table_column] = $settings['sf_select_'.$tag->table_column];
                }
            }
        }

        if ( $id ) {
        	$edit_mod = false;
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $edit_mod = true;
        }


		$listing = new RTPC_WPL_Listing;
		$listing->elementor_settings = $settings;
		$listing->edit_mod 			 = $edit_mod;
		$listing->display( $instance );

    }

}