<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;
use RTPC\Controllers\RTPC_Controllers_Controller;
use RTPC\controllers\RTPC_Controllers_Public as controller;
use RTPC\WPL\RTPC_WPL_Carousel;

/**
 * Elementor 'RecentPostsGridCarousel' widget.
 *
 * Elementor widget that displays an 'RecentPostsGridCarousel'.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_PropertyListingCarousal extends \Elementor\Widget_Base {

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
        return 'RTPC_property_listing_carousal';
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
        return __('Carousal Property Listing', 'realty-pack-core' );
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
        return'eicon-slideshow realtypack-flag';
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
        return array( 'RTPC_catergory' );
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

        /*-----------------------------------------------------------------------------------*/
        /*  query_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'query_section',
            array(
                'label'      => __('Query', 'realty-pack-core' ),
            )
        );

        $this->add_control(
            'cat',
            array(
                'label'       => __('Categories', 'realty-pack-core'),
                'description' => __('Specifies categories that you want to show properties from it.', 'realty-pack-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => $this->get_terms(),
                'default'     => array( ' ' ),
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

        $this->add_control(
            'order_by',
            array(
                'label'       => __('Order by', 'realty-pack-core'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'date',
                'options'     => array(
                    'date'            => __('Date', 'realty-pack-core'),
                    'menu_order date' => __('Menu Order', 'realty-pack-core'),
                    'title'           => __('Title', 'realty-pack-core'),
                    'ID'              => __('ID', 'realty-pack-core'),
                    'rand'            => __('Random', 'realty-pack-core'),
                    'comment_count'   => __('Comments', 'realty-pack-core'),
                    'modified'        => __('Date Modified', 'realty-pack-core'),
                    'author'          => __('Author', 'realty-pack-core'),
                    'post__in'        => __('Inserted Post IDs', 'realty-pack-core')
                ),
            )
        );

        $this->add_control(
            'order',
            array(
                'label'       => __('Order', 'realty-pack-core'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'DESC',
                'options'     => array(
                    'DESC'          => __('Descending', 'realty-pack-core'),
                    'ASC'           => __('Ascending', 'realty-pack-core'),
                ),
            )
        );

        $this->add_control(
            'only_posts__in',
            array(
                'label'       => __('Only properties','realty-pack-core' ),
                'description' => __('If you intend to display ONLY specific propertiess, you should specify the properties here. You have to insert the property IDs that are separated by comma (eg. 35,3,98,55).', 'realty-pack-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT
            )
        );

        $this->add_control(
            'include',
            array(
                'label'       => __('Include properties','realty-pack-core' ),
                'description' => __('If you intend to include additional properties, you should specify the properties here. You have to insert the property IDs that are separated by comma (eg. 35,3,98,55)', 'realty-pack-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT
            )
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  title_style_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'title_style_section',
            array(
                'label'     => __( 'Content', 'realty-pack-core' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'layout_type',
            array(
                'label'       => __('Layout Type', 'realty-pack-core'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => '1',
                'options'     => array(
                    '1'     => __('Type 1', 'realty-pack-core'),
                    '2'     => __('Type 2', 'realty-pack-core'),
                    '3'     => __('Type 3', 'realty-pack-core'),
                    '4'     => __('Type 4', 'realty-pack-core'),
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
                'return_value' => '1060',
                'default'      => '1060',
            )
        );            

        $this->add_control(
            'image_height',
            array(
                'label'        => __( 'Image Height (PX)', 'realty-pack-core' ),
                'type'         => \Elementor\Controls_Manager::TEXT,
                'return_value' => '646',
                'default'      => '646',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => __( 'Title Color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtp-carousel-property-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Title Typography', 'realty-pack-core' ),
                'name' => 'title_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rtp-carousel-property-title',
            )
        );

        $this->add_control(
            'price_color',
            array(
                'label' => __( 'Price color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtp-carousel-property-price' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .rtp-carousel-property-price',
            )
        );

        $this->add_control(
            'address_color',
            array(
                'label' => __( 'Address color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtp-carousel-property-address' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .rtp-carousel-property-address , {{WRAPPER}} .rtp-carousel-property-address i',
            )
        );
        
        $this->add_control(
            'features_label_color',
            array(
                'label' => __( 'Features label color', 'realty-pack-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .rtp-carousel-property-features' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .rtp-carousel-property-features span' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Features typography', 'realty-pack-core' ),
                'name' => 'features_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                    '{{WRAPPER}} .rtp-carousel-property-features',                
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
                    '{{WRAPPER}} .rtp-carousel-agent img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .rtp-carousel-agent span' => 'color: {{VALUE}};',
                ),
            )
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'label' => __( 'Author label typography', 'realty-pack-core' ),
                'name' => 'author_label_typography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' =>
                    '{{WRAPPER}} .rtp-carousel-agent span',                
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
                    '{{WRAPPER}} .rtp-rpgs-property-post-date' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .rtp-rpgs-property-post-date i,{{WRAPPER}} .rtp-rpgs-property-post-date span',                
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
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function render() {

    $settings = $this->get_settings_for_display();

    $args     = array(
        // Display section
        // 'display_media'               => $settings['display_media'],
        // 'display_tags'                => $settings['display_tags'],
        'display_title'               => isset( $settings['display_title'] ) ? $settings['display_title'] : '',
        // 'display_address'             => $settings['display_address'],
        'display_features'            => isset( $settings['display_features'] ) ? $settings['display_features'] : '',
        // 'display_more_details'        => $settings['display_more_details'],
        'display_author'              => isset( $settings['display_author'] ) ? $settings['display_author'] : '',
        'display_date'                => isset( $settings['display_date'] ) ? $settings['display_date'] : '',

        'layout_type'                   => $settings['layout_type'],
        // 'post_info_position'          => $settings['post_info_position'],
        // 'display_comments'            => $settings['display_comments'],
        // 'display_like'                => $settings['display_like'],
        // 'show_content'                => $settings['show_content'],
        // 'display_categories'          => $settings['display_categories'],
        // 'show_date'                   => $settings['show_date'],
        // 'show_excerpt'                => $settings['show_excerpt'],
        // 'excerpt_len'                 => $settings['excerpt_len'],
        // 'author_or_readmore'          => $settings['author_or_readmore'],

        // Content Section
        // 'preview_mode'                => $settings['preview_mode'],

        // 'desktop_cnum'                => $settings['columns'],
        // 'tablet_cnum'                 => $settings['columns_tablet'],
        // 'phone_cnum'                  => $settings['columns_mobile'],
        // 'content_layout'              => $settings['content_layout'],
        // 'grid_table_hover'            => $settings['grid_table_hover'],
        // 'carousel_navigation_control' => $settings['carousel_navigation_control'],
        // 'carousel_nav_control_pos'    => $settings['carousel_nav_control_pos'],
        // 'carousel_nav_control_skin'   => $settings['carousel_nav_control_skin'],
        // 'carousel_loop'               => $settings['carousel_loop'],
        // 'carousel_autoplay'           => $settings['carousel_autoplay'],
        // 'carousel_autoplay_delay'     => $settings['carousel_autoplay_delay'],

        // Query Section
        'cat'                         => isset( $settings['cat'] ) ? $settings['cat'] : '',
        'num'                         => isset( $settings['num'] ) ? $settings['num'] : '',
        'exclude_without_media'       => isset( $settings['exclude_without_media'] ) ? $settings['exclude_without_media'] : '',
        'order_by'                    => isset( $settings['order_by'] ) ? $settings['order_by'] : '',
        'order'                       => isset( $settings['order'] ) ? $settings['order'] : '',
        'only_posts__in'              => isset( $settings['only_posts__in'] ) ? $settings['only_posts__in'] : '',
        'include'                     => isset( $settings['include'] ) ? $settings['include'] : '',


        // Paginate Section
       // 'loadmore_type'               => $settings['loadmore_type'],

        // Style Section
        //'image_aspect_ratio'          => $settings['image_aspect_ratio'],
    );

    // @temprory
    $arr = array( 
      'title' =>  'Featured Properties',
      'layout' =>  'default',
      'wpltarget' =>  '',
      'data' => 
      array (
          'css_class' =>  '',
          'image_width' =>  '',
          'image_height' =>  '',
          'tablet_image_height' =>  '',
          'phone_image_height' =>  '',
          'thumbnail_width' =>  '',
          'thumbnail_height' =>  '',
          'slide_interval' =>  '',
          'images_per_page' =>  '',
          'slide_fillmode' =>  '',
          'kind' =>  '',
          'listing' =>  '',
          'property_type' =>  '',
          'location2_name' =>  '',
          'location3_name' =>  '',
          'location4_name' =>  '',
          'zip_name' =>  '',
          'build_year' =>  '',
          'living_area' =>  '',
          'price' =>  '',
          'listing_ids' =>  '',
          'only_featured' =>  '',
          'only_hot' =>  '',
          'only_openhouse' =>  '',
          'only_forclosure' =>  '',
          'tag_group_join_type' =>  '',
          'sml_only_similars' =>  '',
          'sml_inc_listing' =>  '',
          'sml_inc_property_type' =>  '',
          'sml_inc_price' =>  '',
          'sml_price_down_rate' =>  '',
          'sml_price_up_rate' =>  '',
          'sml_inc_radius' =>  '',
          'sml_radius' =>  '',
          'sml_radius_unit' =>  '',
          'data_sml_zip_code' =>  '',
          'sml_override_listing_new' =>  '',
          'sml_override_listing_old' =>  '',
          'orderby' =>  '',
          'order' =>  '',
          'limit' =>  '7'      
      ));

    $prop = new RTPC_WPL_Carousel;

    // Layout class
    switch ( $args['layout_type'] ) {
        case '1':
        $layout_type = 'rtp-carousel';
        break;        

        case '2':
        $layout_type = 'rtp-carousel-type2';
        break;        

        case '3':
        $layout_type = 'rtp-carousel rtp-carousel-type3';
        break;        

        case '4':
        $layout_type = 'rtp-carousel rtp-carousel-type4';
        break;
    }

    // get the shortcode base blog page
    echo controller::render_template(
        'widgets/property-listing-carousal.php',
        array(
            'settings'      => $settings,
            'args'          => $args,
            'properties'    => $prop->widget( '' ,$arr ),
            'layout_type'   => $layout_type,
        ),
        'always'
    );

  }

}
