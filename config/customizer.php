<?php
/**
 * Add RealtyPack options to the WordPress Customizer.
 *
 * @since   1.0.0
 */
if ( ! defined( 'RTP_ADMIN_ASSETS_URL' ) ) {
    return;
}
add_filter('rtp/customizer/add/panels', 'rpt_add_customizer_panel');
function rpt_add_customizer_panel($panels) {
    // * array of Panels
    $panels = array(
        'general_options' => array(
            'id'          => 'general_options',
            'priority'    => 1,
            'title'       => esc_attr__('RealtyPack : General Option', 'realty-pack-core'),
            'description' => esc_attr__('Geeral layout and option', 'realty-pack-core'),
        ),        
        'header_panel' => array(
            'id'          => 'header_panel',
            'priority'    => 2,
            'title'       => esc_attr__('RealtyPack : Header', 'realty-pack-core'),
            'description' => esc_attr__('header panel description', 'realty-pack-core'),
        ),
        'footer_panel' => array(
            'id'          => 'footer_panel',
            'priority'    => 3,
            'title'       => esc_attr__('RealtyPack : Footer', 'realty-pack-core'),
            'description' => esc_attr__('Footer panel description', 'realty-pack-core'),
        ),
        'social_panel' => array(
            'id'          => 'social_panel',
            'priority'    => 4,
            'title'       => esc_attr__('RealtyPack : Social, Login & Register', 'realty-pack-core'),
            'description' => esc_attr__('Website socials and login register settings', 'realty-pack-core'),
        ),
        'blog_panel'   => array(
            'id'          => 'blog_panel',
            'priority'    => 5,
            'title'       => esc_attr__('RealtyPack : Blog', 'realty-pack-core'),
            'description' => esc_attr__('Single blog settings', 'realty-pack-core'),
        ),
        'wpl_panel'   => array(
            'id'          => 'wpl_panel',
            'priority'    => 6,
            'title'       => esc_attr__('RealtyPack : WPL', 'realty-pack-core'),
            'description' => esc_attr__('WPL Settings', 'realty-pack-core'),
        ),         
        'agency_panel'   => array(
            'id'          => 'agency_panel',
            'priority'    => 7,
            'title'       => esc_attr__( 'RealtyPack : Agency, Agent', 'realty-pack-core' ),
            'description' => esc_attr__( 'Agency Settings', 'realty-pack-core' ),
        ),        
        'intgreation_panel'   => array(
            'id'          => 'intgreation_panel',
            'priority'    => 8,
            'title'       => esc_attr__( 'RealtyPack : Intgreation', 'realty-pack-core' ),
            'description' => esc_attr__( 'Intgreation Settings', 'realty-pack-core' ),
        ),        
        'extras_panel'   => array(
            'id'          => 'extras_panel',
            'priority'    => 9,
            'title'       => esc_attr__('RealtyPack : Extras', 'realty-pack-core'),
            'description' => esc_attr__('Extras setting', 'realty-pack-core'),
        ),
    );

    return $panels;
}

add_filter('rtp/customizer/add/sections', 'rpt_add_customizer_sections');
function rpt_add_customizer_sections($sections) {
    // * Array of section
    $sections = array(
        // General
        'general_page_layout' => array(
            'name'        => 'general_page_layout',
            'title'       => esc_attr__('General Layout', 'realty-pack-core'),
            'description' => esc_attr__('General Layout Option', 'realty-pack-core'),
            'panel'       => 'general_options',
            'priority'    => 1,
        ),        
        'general_sidebar_layout' => array(
            'name'        => 'general_sidebar_layout',
            'title'       => esc_attr__('General Sidebar Layout', 'realty-pack-core'),
            'description' => esc_attr__('General Sidebar Layout Option', 'realty-pack-core'),
            'panel'       => 'general_options',
            'priority'    => 1,
        ),        
        'general_bread_crump' => array(
            'name'        => 'general_bread_crump',
            'title'       => esc_attr__('General Breadcrumb', 'realty-pack-core'),
            'description' => esc_attr__('General Breadcrumb Option', 'realty-pack-core'),
            'panel'       => 'general_options',
            'priority'    => 1,
        ),        
        'general_featured_image_size' => array(
            'name'        => 'general_featured_image_size',
            'title'       => esc_attr__('General Featured Image', 'realty-pack-core'),
            'description' => esc_attr__('General Page Featured Image Size', 'realty-pack-core'),
            'panel'       => 'general_options',
            'priority'    => 1,
        ),
        'general_preloading_settings' => array(
            'name'        => 'general_preloading_settings',
            'title'       => esc_attr__('General Preloading ', 'realty-pack-core'),
            'description' => esc_attr__('General Preloading Settings', 'realty-pack-core'),
            'panel'       => 'general_options',
            'priority'    => 1,
        ),
        // Header
        'top_bar_header_section' => array(
            'name'        => 'top_bar_header_section',
            'title'       => esc_attr__('Top Header Bar', 'realty-pack-core'),
            'description' => esc_attr__('Top Header Bar Settings', 'realty-pack-core'),
            'panel'       => 'header_panel',
            'priority'    => 1,
        ),
        'header_section'         => array(
            'name'        => 'header_section',
            'title'       => esc_attr__('Header Section', 'realty-pack-core'),
            'description' => esc_attr__('Main Header Section Settings', 'realty-pack-core'),
            'panel'       => 'header_panel',
            'priority'    => 2,
        ),
        'header_button_1'        => array(
            'name'        => 'header_button_1',
            'title'       => esc_attr__('Header Button', 'realty-pack-core'),
            'description' => esc_attr__('Header button in our menu', 'realty-pack-core'),
            'panel'       => 'header_panel',
            'priority'    => 3,
        ),
        // Footer
        'footer_section'         => array(
            'name'        => 'footer_section',
            'title'       => esc_attr__('Footer Setting', 'realty-pack-core'),
            'description' => esc_attr__('indicate your footer settings', 'realty-pack-core'),
            'panel'       => 'footer_panel',
            'priority'    => 2,
        ),
        // Social
        'social_section'         => array(
            'name'        => 'social_section',
            'title'       => esc_attr__('Social Icon', 'realty-pack-core'),
            'description' => esc_attr__('Add your website socials here', 'realty-pack-core'),
            'panel'       => 'social_panel',
            'priority'    => 1,
        ),        
        'login_register_section'         => array(
            'name'        => 'login_register_section',
            'title'       => esc_attr__('Login Register', 'realty-pack-core'),
            'description' => esc_attr__('Config Login Register Option Here', 'realty-pack-core'),
            'panel'       => 'social_panel',
            'priority'    => 1,
        ),
        // Single Post
        'blog_page'           => array(
            'name'        => 'blog_page',
            'title'       => esc_attr__('Blog Page', 'realty-pack-core'),
            'description' => esc_attr__('Activate section you want to show.', 'realty-pack-core'),
            'panel'       => 'blog_panel',
            'priority'    => 1,
        ),        
        // Single Post
        'single_post'           => array(
            'name'        => 'single_post',
            'title'       => esc_attr__('Single Post', 'realty-pack-core'),
            'description' => esc_attr__('Activate section you want to show.', 'realty-pack-core'),
            'panel'       => 'blog_panel',
            'priority'    => 1,
        ),        
        // Single Post
        'single_post_sidebar'           => array(
            'name'        => 'single_post_sidebar',
            'title'       => esc_attr__( 'Post Sidebar', 'realty-pack-core' ),
            'description' => esc_attr__( 'Post sidebar layout.', 'realty-pack-core' ),
            'panel'       => 'blog_panel',
            'priority'    => 2,
        ),
        // Agency
        'agency_single'           => array(
            'name'        => 'agency_single',
            'title'       => esc_attr__('Agency Single', 'realty-pack-core'),
            'description' => esc_attr__('Select your agency single template', 'realty-pack-core'),
            'panel'       => 'agency_panel',
            'priority'    => 1,
        ),            
        'agent_single'           => array(
            'name'        => 'agent_single',
            'title'       => esc_attr__('Agent Single', 'realty-pack-core'),
            'description' => esc_attr__('Select your agent single template', 'realty-pack-core'),
            'panel'       => 'agency_panel',
            'priority'    => 2,
        ),         
        // Extra
        'goto_top_section'           => array(
            'name'        => 'goto_top_section',
            'title'       => esc_attr__('Go To Top Button', 'realty-pack-core'),
            'description' => esc_attr__('Activate to show button.', 'realty-pack-core'),
            'panel'       => 'extras_panel',
            'priority'    => 1,
        ),
        'lazy_load_section'           => array(
            'name'        => 'lazy_load_section',
            'title'       => esc_attr__('LazyLoad', 'realty-pack-core'),
            'description' => esc_attr__('Theme lazy load is usefull for loading image when user scroll to the content', 'realty-pack-core'),
            'panel'       => 'extras_panel',
            'priority'    => 2,
        ),        
        // Intgreation
        'intgreation_section'           => array(
            'name'        => 'intgreation_section',
            'title'       => esc_attr__( 'MailChimp Intgreation', 'realty-pack-core' ),
            'description' => esc_attr__( 'MailChimp Intgreation Settings', 'realty-pack-core' ),
            'panel'       => 'intgreation_panel',
            'priority'    => 1,
        ),
		// Properties
		'properties_section'           => array(
			'name'        => 'properties_section',
			'title'       => esc_attr__( 'WPL Properties', 'realty-pack-core' ),
			'description' => esc_attr__( 'WPL Properties Settings', 'realty-pack-core' ),
			'panel'       => 'wpl_panel',
			'priority'    => 1,
		),        
        // Properties
        'properties_archive'           => array(
            'name'        => 'properties_archive',
            'title'       => esc_attr__( 'Properties Archive', 'realty-pack-core' ),
            'description' => esc_attr__( 'Properties Archive Settings', 'realty-pack-core' ),
            'panel'       => 'wpl_panel',
            'priority'    => 1,
        ),
    );

    return $sections;
}

add_filter('rtp/customizer/add/fields', 'rpt_add_customizer_fields');
function rpt_add_customizer_fields($fields) {
    // Array of fields
    $fields = array(
        // General layout
        'general_layout_option'         => array(
            'name'            => 'general_layout_option',
            'type'            => 'radio-image',
            'settings'        => 'general_layout_option',
            'label'           => esc_attr__('General Page Layout', 'realty-pack-core'),
            'description'     => esc_attr__('If you select "Full", content fills the full width of the page. If you select "Boxed" content will be boxed', 'realty-pack-core'),
            'section'         => 'general_page_layout',
            'default'         => 'top-bar-1',
            'choices'         => array(
                'full'  => RTP_ADMIN_ASSETS_URL . 'images/layout-full.svg',
                'boxed' => RTP_ADMIN_ASSETS_URL . 'images/layout-box.svg',
            ),
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),         

        // General Sidebar layout
        'general_sidebar_layout_option'         => array(
            'name'            => 'general_sidebar_layout_option',
            'type'            => 'radio-image',
            'settings'        => 'general_sidebar_layout_option',
            'label'           => esc_attr__('General Sidebar Layout', 'realty-pack-core'),
            'description'     => esc_attr__('With this option you can change the sidebar position for all pages that are using the theme default option.', 'realty-pack-core'),
            'section'         => 'general_sidebar_layout',
            'default'         => 'c_sp',
            'choices'         => array(
                'c'           => RTP_ADMIN_ASSETS_URL . 'images/layouts/c.svg',
                'c_sp'        => RTP_ADMIN_ASSETS_URL . 'images/layouts/cs.svg',
                'sp_c'        => RTP_ADMIN_ASSETS_URL . 'images/layouts/sc.svg',
                'c_sp_ss'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/css.svg',
                'sp_ss_c'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/ssc.svg',
                'sp_c_ss'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/scs.svg',
            ),
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),            

        // General Breadcrump
        'general_bread_crump_option'         => array(
            'name'            => 'general_bread_crump_option',
            'type'            => 'select',
            'settings'        => 'general_bread_crump_option',
            'label'           => esc_attr__('General Sidebar Layout', 'realty-pack-core'),
            'description'     => esc_attr__('Show or hide breadcrumb for all pages that are using the theme default option.', 'realty-pack-core'),
            'section'         => 'general_bread_crump',
            'default'         => 'hide',
            'choices'         => array(
                'show'        => esc_html( 'Show' ),
                'hide'        => esc_html( 'Hide' ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),          

        // General Featured Image
        'general_featured_image_height_px'         => array(
            'name'            => 'general_featured_image_height_px',
            'type'            => 'text',
            'settings'        => 'general_featured_image_height_px',
            'label'           => esc_attr__('Image Height (Px)', 'realty-pack-core'),
            'description'     => esc_attr__('Set image height for your featured image and it will crop to fit the size. If the original image is smaller than the height you entered it will not crop.', 'realty-pack-core'),
            'section'         => 'general_featured_image_size',
            'default'         => '700',
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),           
        'general_featured_image_width_px'         => array(
            'name'            => 'general_featured_image_width_px',
            'type'            => 'text',
            'settings'        => 'general_featured_image_width_px',
            'label'           => esc_attr__( 'Image Width (Px)', 'realty-pack-core' ),
            'description'     => esc_attr__( 'Set image width for your featured image and it will crop to fit the size. If the original image is smaller than the width you entered it will not crop.', 'realty-pack-core' ),
            'section'         => 'general_featured_image_size',
            'default'         => '1920',
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),    
        
        // General Preloading Settings
        'general_preloading_settings_switch'         => array(
            'name'            => 'general_preloading_settings_switch',
            'type'            => 'switch',
            'settings'        => 'general_preloading_settings_switch',
            'label'           => esc_attr__('Enable Page Preloading', 'realty-pack-core'),
            'description'     => esc_attr__('Enable this option to display a loading animation while site is loading.', 'realty-pack-core'),
            'section'         => 'general_preloading_settings',
            'default'         => false,
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),  

        'general_preloading_settings_add_image'         => array(
            'name'            => 'general_preloading_settings_add_image',
            'type'            => 'switch',
            'settings'        => 'general_preloading_settings_add_image',
            'label'           => esc_attr__('Add Preloading Image', 'realty-pack-core'),
            'description'     => esc_attr__('Enable this option to loading image for the site.', 'realty-pack-core'),
            'section'         => 'general_preloading_settings',
            'default'         => false,
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),

        'general_preloading_settings_image'            => array(
            'name'         => 'general_preloading_settings_image',
            'type'         => 'image',
            'settings'     => 'general_preloading_settings_image',
            'label'        => esc_attr__('Loading Image', 'realty-pack-core'),
            'description'  => esc_attr__('Add your custom image', 'realty-pack-core'),
            'section'      => 'general_preloading_settings',
            'default'      => '',
            'theme_config' => 'rtp',
            'priority'     => 3,
            'required'  => array(
                array(
                  'setting'  => 'general_preloading_settings_add_image',
                  'operator' => '==',
                  'value'    => 1,
                ),
            ),
        ),

        'general_preloading_settings_progressbar_switch'         => array(
            'name'            => 'general_preloading_settings_progressbar_switch',
            'type'            => 'switch',
            'settings'        => 'general_preloading_settings_progressbar_switch',
            'label'           => esc_attr__('Add Preloading Progress Bar', 'realty-pack-core'),
            'description'     => esc_attr__('Enable this option to show progressbar on preloding for the site.', 'realty-pack-core'),
            'section'         => 'general_preloading_settings',
            'default'         => false,
            'theme_config'    => 'rtp',
            'priority'        => 4,
        ),

        'general_preloading_settings_progressbar_position'         => array(
            'name'            => 'general_preloading_settings_progressbar_position',
            'type'            => 'select',
            'settings'        => 'general_preloading_settings_progressbar_position',
            'label'           => esc_attr__('Progress Bar Position', 'realty-pack-core'),
            'description'     => esc_attr__('', 'realty-pack-core'),
            'choices'         => array(
                'top'    => esc_attr__('Top', 'realty-pack-core'),
                'bottom' => esc_attr__('Bottom', 'realty-pack-core'),
            ),
            'section'         => 'general_preloading_settings',
            'default'         => 'top',
            'theme_config'    => 'rtp',
            'required'  => array(
                array(
                  'setting'  => 'general_preloading_settings_progressbar_switch',
                  'operator' => '==',
                  'value'    => 1,
                ),
            ),
            'priority'        => 5,
        ),

        'general_preloading_settings_progressbar_color'         => array(
            'name'            => 'general_preloading_settings_progressbar_color',
            'type'            => 'color',
            'settings'        => 'general_preloading_settings_progressbar_color',
            'label'           => esc_attr__('Progress Bar Color', 'realty-pack-core'),
            'description'     => esc_attr__('', 'realty-pack-core'),
            'section'         => 'general_preloading_settings',
            'default'         => '#000',
            'theme_config'    => 'rtp',
            'required'  => array(
                array(
                  'setting'  => 'general_preloading_settings_progressbar_switch',
                  'operator' => '==',
                  'value'    => 1,
                ),
            ),
            'priority'        => 6,
        ),

        //top bar header fields
        'top_bar_availability'   => array(
            'name'         => 'top_bar_availability',
            'type'         => 'switch',
            'settings'     => 'top_bar_availability',
            'label'        => esc_attr__('Enable Top Header Bar', 'realty-pack-core'),
            'description'  => esc_attr__('By enabling this option, the top header bar will be displayed', 'realty-pack-core'),
            'section'      => 'top_bar_header_section',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        'top_bar_layout'         => array(
            'name'            => 'top_bar_layout',
            'type'            => 'radio-image',
            'settings'        => 'top_bar_layout',
            'label'           => esc_attr__('Top bar layout', 'realty-pack-core'),
            'description'     => esc_attr__('choose your top bar  type', 'realty-pack-core'),
            'section'         => 'top_bar_header_section',
            'default'         => 'top-bar-1',
            'choices'         => array(
                'top-bar-1' => RTP_ADMIN_ASSETS_URL . 'images/headers/top-header-layout-1.svg',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'top_bar_availability',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),
        'social_in_topheader'    => array(
            'name'            => 'social_in_topheader',
            'type'            => 'switch',
            'settings'        => 'social_in_topheader',
            'label'           => esc_attr__('Social Icons', 'realty-pack-core'),
            'description'     => esc_attr__('Turn on social icons in top header bar', 'realty-pack-core'),
            'section'         => 'top_bar_header_section',
            'default'         => false,
            'active_callback' => array(
                array(
                    'setting'  => 'top_bar_availability',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),
        'website_email'          => array(
            'name'            => 'website_email',
            'type'            => 'text',
            'settings'        => 'website_email',
            'label'           => esc_attr__('Email Address:', 'realty-pack-core'),
            'description'     => esc_attr__('', 'realty-pack-core'),
            'section'         => 'top_bar_header_section',
            'default'         => esc_html__('office@example.com'),
            'active_callback' => array(
                array(
                    'setting'  => 'top_bar_availability',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),
        'website_tel'            => array(
            'name'            => 'website_tel',
            'type'            => 'text',
            'settings'        => 'website_tel',
            'label'           => esc_attr__('Phone Number:', 'realty-pack-core'),
            'description'     => esc_attr__('', 'realty-pack-core'),
            'section'         => 'top_bar_header_section',
            'default'         => esc_html__('(123) 123-456'),
            'active_callback' => array(
                array(
                    'setting'  => 'top_bar_availability',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),
        //header section
        'transparent_header' => array(
            'name'         => 'transparent_header',
            'type'         => 'switch',
            'settings'     => 'transparent_header',
            'label'        => esc_attr__('Transparent Header', 'realty-pack-core'),
            'description'  => esc_attr__('Transparent Header Layout', 'realty-pack-core'),
            'section'      => 'header_section',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),

        'header_layout'          => array(
            'name'         => 'header_layout',
            'type'         => 'radio-image',
            'settings'     => 'header_layout',
            'label'        => esc_attr__('Header Layout', 'realty-pack-core'),
            'description'  => esc_attr__('Choose your header layout', 'realty-pack-core'),
            'section'      => 'header_section',
            'default'      => 'header-nav-1',
            'choices'      => array(
                'header-nav-1' => RTP_ADMIN_ASSETS_URL . 'images/headers/Menu-type1.svg',
                'header-nav-2' => RTP_ADMIN_ASSETS_URL . 'images/headers/Menu-type2.svg',
                'header-nav-3' => RTP_ADMIN_ASSETS_URL . 'images/headers/Menu-type3.svg',
                'header-nav-4' => RTP_ADMIN_ASSETS_URL . 'images/headers/Menu-type4.svg',

            ),
            'output'       => array(
                array(
                    'element' => '.rtp-header-main',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),

        'signin_header' => array(
            'name'         => 'signin_header',
            'type'         => 'switch',
            'settings'     => 'signin_header',
            'label'        => esc_attr__('Signin Button', 'realty-pack-core'),
            'description'  => esc_attr__('Enable Sign In in the header section', 'realty-pack-core'),
            'section'      => 'header_section',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),        

        'register_header' => array(
            'name'         => 'register_header',
            'type'         => 'switch',
            'settings'     => 'register_header',
            'label'        => esc_attr__('Register Button ', 'realty-pack-core'),
            'description'  => esc_attr__('Enable Register in the header section', 'realty-pack-core'),
            'section'      => 'header_section',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),

        'header_logo'            => array(
            'name'         => 'header_logo',
            'type'         => 'image',
            'settings'     => 'header_logo',
            'label'        => esc_attr__('Upload Logo Image', 'realty-pack-core'),
            'description'  => esc_attr__('', 'realty-pack-core'),
            'section'      => 'header_section',
            'default'      => '',
            'theme_config' => 'rtp',
            'priority'     => 2,
        ),
        'header_button_1'        => array(
            'name'         => 'header_button_1',
            'type'         => 'switch',
            'settings'     => 'header_button_1',
            'label'        => esc_attr__('Enable Button', 'realty-pack-core'),
            'description'  => esc_attr__('By enabling this option, a button will appear in your header.', 'realty-pack-core'),
            'section'      => 'header_button_1',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        'header_button_1_label'  => array(
            'name'            => 'header_button_1_label',
            'type'            => 'text',
            'settings'        => 'header_button_1_label',
            'label'           => esc_attr__('Button Label', 'realty-pack-core'),
            'description'     => '',
            'section'         => 'header_button_1',
            'default'         => __('SUBMIT PROPERTY','realty-pack-core'),
            'active_callback' => array(
                array(
                    'setting'  => 'header_button_1',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),
        'header_button_1_url'    => array(
            'name'            => 'header_button_1_url',
            'type'            => 'text',
            'settings'        => 'header_button_1_url',
            'label'           => esc_attr__('Button URL', 'realty-pack-core'),
            'description'     => '',
            'section'         => 'header_button_1',
            'default'         => '',
            'active_callback' => array(
                array(
                    'setting'  => 'header_button_1',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),
        //------ Footer Layout
        'footer_layout'          => array(
            'name'         => 'footer_layout',
            'type'         => 'select',
            'settings'     => 'footer_layout',
            'label'        => esc_attr__('Footer Type', 'realty-pack-core'),
            'description'  => esc_attr__('choose your footer type', 'realty-pack-core'),
            'section'      => 'footer_section',
            'choices'      => post_type( 'footer_builder' ),
            'output'       => array(
                array(
                    'element' => '.rtp-header',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        // Socials
        'social_icons', array(
            'type'         => 'repeater',
            'label'        => esc_html__('Social Icons', 'realty-pack-core'),
            'section'      => 'social_section',
            'priority'     => 10,
            'row_label'    => array(
                'type'  => 'text',
                'value' => esc_html__('Social Icon', 'realty-pack-core'),
            ),
            'button_label' => esc_html__('Add New Icon', 'realty-pack-core'),
            'settings'     => 'social_icons',
            'default'      => array(
                array(
                    'social_icon' => 'youtube',
                    'social_url'  => 'https://youtube.com/',
                ),
                array(
                    'social_icon' => 'facebook',
                    'social_url'  => 'https://facebook.com/',
                ),
                array(
                    'social_icon' => 'twitter',
                    'social_url'  => 'https://twitter.com/',
                ),
                array(
                    'social_icon' => 'pinterest',
                    'social_url'  => 'https://pinterest.com/',
                ),
            ),
            'fields'       => array(
                'social_icon' => array(
                    'type'     => 'select',
                    'settings' => 'social_icon',
                    'label'    => esc_html__('Select your social', 'realty-pack-core'),
                    'section'  => 'social_section',
                    'default'  => '',
                    'priority' => 10,
                    'multiple' => 1,
                    'choices'  => array(
                        'choose'      => esc_html__('Choose Icon', 'realty-pack-core'),
                        'facebook'    => esc_html__('Facebook', 'realty-pack-core'),
                        'twitter'     => esc_html__('Twitter', 'realty-pack-core'),
                        'linkedin'    => esc_html__('Linkedin', 'realty-pack-core'),
                        'googleplus'  => esc_html__('Google+', 'realty-pack-core'),
                        'pinterest'   => esc_html__('Pinterest', 'realty-pack-core'),
                        'behance'     => esc_html__('Behance', 'realty-pack-core'),
                        'github'      => esc_html__('Github', 'realty-pack-core'),
                        'flickr'      => esc_html__('Flickr', 'realty-pack-core'),
                        'tumblr'      => esc_html__('Tumblr', 'realty-pack-core'),
                        'telegram'    => esc_html__('Telegram', 'realty-pack-core'),
                        'dribbble'    => esc_html__('Dribbble', 'realty-pack-core'),
                        'soundcloud'  => esc_html__('Soundcloud', 'realty-pack-core'),
                        'stumbleupon' => esc_html__('StumbleUpon', 'realty-pack-core'),
                        'instagram'   => esc_html__('Instagram', 'realty-pack-core'),
                        'vimeo'       => esc_html__('Vimeo', 'realty-pack-core'),
                        'youtube'     => esc_html__('Youtube', 'realty-pack-core'),
                        'twitch'      => esc_html__('Twitch', 'realty-pack-core'),
                        'vk'          => esc_html__('Vk', 'realty-pack-core'),
                        'reddit'      => esc_html__('Reddit', 'realty-pack-core'),
                        'weibo'       => esc_html__('Weibo', 'realty-pack-core'),
                        'wechat'      => esc_html__('WeChat', 'realty-pack-core'),
                        'rss'         => esc_html__('RSS', 'realty-pack-core'),
                    ),
                ),
                'social_url'  => array(
                    'type'         => 'text',
                    'settings'     => 'social_url',
                    'label'        => esc_attr__('URL:', 'realty-pack-core'),
                    'description'  => esc_attr__('', 'realty-pack-core'),
                    'section'      => 'social_section',
                    'default'      => '',
                    'theme_config' => 'rtp',
                ),
            ),

        ),

        'choose_login_style'          => array(
            'name'         => 'choose_login_style',
            'type'         => 'select',
            'settings'     => 'choose_login_style',
            'label'        => esc_attr__( 'Choose Login Type', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Choose your login type', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'choices'      => array(
                'wordpress'    => 'WordPress',
                'realty-pack'  => 'RealtyPack Mode',
            ),
            'theme_config'  => 'rtp',
            'default'       => 'realty-pack',
            'priority'      => 1,
        ),

        'signin_text'     => array(
            'name'         => 'signin_text',
            'type'         => 'text',
            'settings'     => 'signin_text',
            'label'        => esc_attr__( 'Signin Text ', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Enter Singin text', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => 'SING IN',
            'theme_config' => 'rtp',
            'priority'     => 2,
        ),

        'register_text'     => array(
            'name'         => 'register_text',
            'type'         => 'text',
            'settings'     => 'register_text',
            'label'        => esc_attr__( 'Register Text ', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Enter Register text', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => 'REGISTER',
            'theme_config' => 'rtp',
            'priority'     => 3,
        ),

        'registerd_roles'          => array(
            'name'         => 'registerd_roles',
            'type'         => 'multicheck',
            'settings'     => 'registerd_roles',
            'label'        => esc_attr__( 'Choose Role', 'realty-pack-core' ),
            'description'  => esc_attr__( 'These roles are choosable from re register page', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'choices'      => array(
                'subscriber' => 'Subscriber',
                'agent'      => 'Agent',
                'agency'     => 'Agency',
            ),
            'default'      => 'subscriber',
            'theme_config' => 'rtp',
            'priority'     => 4,
        ),

        'enable_term_of_service'     => array(
            'name'          =>   'enable_term_of_service',
            'type'          =>   'switch',
            'settings'      =>   'enable_term_of_service',
            'label'         =>   esc_attr__( 'Enable term of service', 'realty-pack-core' ),
            'description'   =>   esc_attr__( 'Enable term of service link in registration form', 'realty-pack-core' ),
            'section'       =>   'login_register_section',
            'default'       =>   false,
            'theme_config'  =>   'rtp',
            'priority'      =>   5,
        ),

        'term_of_service_link'          => array(
            'name'         => 'term_of_service_link',
            'type'         => 'select',
            'settings'     => 'term_of_service_link',
            'label'        => esc_attr__('Select Term Page', 'realty-pack-core'),
            'description'  => esc_attr__('Choose term of service link', 'realty-pack-core'),
            'section'      => 'login_register_section',
            'choices'      => post_type( 'page' ),
            'active_callback' => array(
                array(
                    'setting'  => 'enable_term_of_service',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 6,
        ),       

        'enable_google_register'     => array(
            'name'         => 'enable_google_register',
            'type'         => 'switch',
            'settings'     => 'enable_google_register',
            'label'        => esc_attr__( 'Enable google login ', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Enable google login for not logged in users', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => false,
            'theme_config' => 'rtp',
            'priority'     => 7,
        ),

        'google_login_appname'     => array(
            'name'         => 'google_login_appname',
            'type'         => 'text',
            'settings'     => 'google_login_appname',
            'label'        => esc_attr__( 'Google Client App Name ', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => '',
            'active_callback' => array(
                array(
                    'setting'  => 'enable_google_register',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 8,
        ),

        'google_login_client'     => array(
            'name'         => 'google_login_client',
            'type'         => 'text',
            'settings'     => 'google_login_client',
            'label'        => esc_attr__( 'Google Client ID', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Example: 253673258632-j3omdk62ad4l7069u56ufs20tjbp202d.apps.googleusercontent.com', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => '',
            'active_callback' => array(
                array(
                    'setting'  => 'enable_google_register',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 9,
        ),

        'google_login_secret'     => array(
            'name'         => 'google_login_secret',
            'type'         => 'text',
            'settings'     => 'google_login_secret',
            'label'        => esc_attr__( 'Google Client Secret', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Example: JgNAlfdK2RTvAc-32Bwz_8jf', 'realty-pack-core' ),
            'section'      => 'login_register_section',
            'default'       => '',
            'active_callback' => array(
                array(
                    'setting'  => 'enable_google_register',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 10,
        ),

        //------ Blog Page
        'blog_page_featured_image'     => array(
            'name'         => 'blog_page_featured_image',
            'type'         => 'switch',
            'settings'     => 'blog_page_featured_image',
            'label'        => esc_attr__( 'Featured Media', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Show or hide featured image and video', 'realty-pack-core' ),
            'section'      => 'blog_page',
            'default'       => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),          

        'blog_page_image_height'     => array(
            'name'         => 'blog_page_image_height',
            'type'         => 'text',
            'settings'     => 'blog_page_image_height',
            'label'        => esc_attr__( 'Image Height (Px)', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Set image height for your featured image and it would be crop to fit on your size, If original image is smaller than height you entered it would not crop', 'realty-pack-core' ),
            'section'      => 'blog_page',
            'default'       => '640',
            'active_callback' => array(
                array(
                    'setting'  => 'blog_page_featured_image',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),          

        'blog_page_image_width'     => array(
            'name'         => 'blog_page_image_width',
            'type'         => 'text',
            'settings'     => 'blog_page_image_width',
            'label'        => esc_attr__( 'Image Width (Px)', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Set image width for your featured image and it would be crop to fit on your size, If original image is smaller than height you entered it would not crop', 'realty-pack-core' ),
            'section'      => 'blog_page',
            'default'       => '1136',
            'active_callback' => array(
                array(
                    'setting'  => 'blog_page_featured_image',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),          

        'blog_page_read_more'          => array(
            'name'            => 'blog_page_read_more',
            'type'            => 'text',
            'settings'        => 'blog_page_read_more',
            'label'           => esc_attr__('Read More Text:', 'realty-pack-core'),
            'description'     => esc_attr__('', 'realty-pack-core'),
            'section'         => 'blog_page',
            'default'         => esc_html__('Continue Reading'),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),           

        'blog_page_pagination'          => array(
            'name'         => 'blog_page_pagination',
            'type'         => 'select',
            'settings'     => 'blog_page_pagination',
            'label'        => esc_attr__('Pagination Type', 'realty-pack-core'),
            'description'  => esc_attr__('Choose pagination type', 'realty-pack-core'),
            'section'      => 'blog_page',
            'choices'      => array(
                'load_more' => 'Load More Button',
                'pagination' => 'Pagination Style',
            ),
            'default'      => 'load_more',
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),

        'blog_page_loadmore_count'          => array(
            'name'            => 'blog_page_loadmore_count',
            'type'            => 'text',
            'settings'        => 'blog_page_loadmore_count',
            'label'           => esc_attr__('Post number in load more:', 'realty-pack-core'),
            'description'     => esc_attr__('Enter post number you want to display in load more option', 'realty-pack-core'),
            'section'         => 'blog_page',
            'default'         => 3,
            'active_callback' => array(
                array(
                    'setting'  => 'blog_page_pagination',
                    'operator' => '==',
                    'value'    => 'load_more',
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),      

        // Single post sidebar
        'single_sidebar_layout_option'         => array(
            'name'            => 'single_sidebar_layout_option',
            'type'            => 'radio-image',
            'settings'        => 'single_sidebar_layout_option',
            'label'           => esc_attr__( 'Single Sidebar Layout', 'realty-pack-core' ),
            'description'     => esc_attr__( 'With this option you can change sidebar position for whole blog posts.', 'realty-pack-core' ),
            'section'         => 'single_post_sidebar',
            'default'         => 'c_sp',
            'choices'         => array(
                'c'           => RTP_ADMIN_ASSETS_URL . 'images/layouts/c.svg',
                'c_sp'        => RTP_ADMIN_ASSETS_URL . 'images/layouts/cs.svg',
                'sp_c'        => RTP_ADMIN_ASSETS_URL . 'images/layouts/sc.svg',
                'c_sp_ss'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/css.svg',
                'sp_ss_c'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/ssc.svg',
                'sp_c_ss'     => RTP_ADMIN_ASSETS_URL . 'images/layouts/scs.svg',
            ),
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),

        //------ Single blog layout
        'enable_single_blog_image' => array(
            'name'         => 'enable_single_blog_image',
            'type'         => 'switch',
            'settings'     => 'enable_single_blog_image',
            'label'        => esc_attr__( 'Featured Image', 'realty-pack-core' ),
            'description'  => esc_attr__( 'Enable Featured Image', 'realty-pack-core' ),
            'section'      => 'single_post',
            'default'      => false,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),

        'single_featured_image_height_px'         => array(
            'name'            => 'single_featured_image_height_px',
            'type'            => 'text',
            'settings'        => 'single_featured_image_height_px',
            'label'           => esc_attr__( 'Image Height (Px)', 'realty-pack-core' ),
            'description'     => esc_attr__( 'Set image height for your featured image and it would be crop to fit on your size, If original image is smaller than height you entered it would not crop.', 'realty-pack-core' ),
            'section'         => 'single_post',
            'default'         => '720',
            'active_callback' => array(
                array(
                    'setting'  => 'enable_single_blog_image',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),

        'single_featured_image_width_px'         => array(
            'name'            => 'single_featured_image_width_px',
            'type'            => 'text',
            'settings'        => 'single_featured_image_width_px',
            'label'           => esc_attr__( 'Image Width (Px)', 'realty-pack-core' ),
            'description'     => esc_attr__( 'Set image width for your featured image and it would be crop to fit on your size, If original image is smaller than width you entered it would not crop.', 'realty-pack-core' ),
            'section'         => 'single_post',
            'default'         => '1674',
            'active_callback' => array(
                array(
                    'setting'  => 'enable_single_blog_image',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config'    => 'rtp',
            'priority'        => 3,
        ),

        'blog_options_share'     => array(
            'name'         => 'blog_options_share',
            'type'         => 'switch',
            'settings'     => 'blog_options_share',
            'label'        => esc_attr__('Share post icons', 'realty-pack-core'),
            'description'  => esc_attr__('Activate to show share icons', 'realty-pack-core'),
            'section'      => 'single_post',
            'default'       => true,
            'output'       => array(
                array(
                    'element' => '.rtp-single-post-share',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 4,
        ),

        'blog_options_navigation'     => array(
            'name'         => 'blog_options_navigation',
            'type'         => 'switch',
            'settings'     => 'blog_options_navigation',
            'label'        => esc_attr__('Single Post Navigation', 'realty-pack-core'),
            'description'  => esc_attr__('Activate to show Next post & Previous post.', 'realty-pack-core'),
            'section'      => 'single_post',
            'default'       => true,
            'output'       => array(
                array(
                    'element' => '.rtp-single-post-pagination',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 5,
        ),

        'blog_options_author'     => array(
            'name'         => 'blog_options_author',
            'type'         => 'switch',
            'settings'     => 'blog_options_author',
            'label'        => esc_attr__('About author section', 'realty-pack-core'),
            'description'  => esc_attr__('Activate to show about author section.', 'realty-pack-core'),
            'section'      => 'single_post',
            'default'       => true,
            'output'       => array(
                array(
                    'element' => '.rtp-singlepost-author',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 6,
        ),

        'blog_options_suggestion'     => array(
            'name'         => 'blog_options_suggestion',
            'type'         => 'switch',
            'settings'     => 'blog_options_suggestion',
            'label'        => esc_attr__('Related post suggestion', 'realty-pack-core'),
            'description'  => esc_attr__('Activate to show related posts.', 'realty-pack-core'),
            'section'      => 'single_post',
            'default'       => true,
            'output'       => array(
                array(
                    'element' => '.rtp-post-suggestion',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 7,
        ),

        'blog_option_post_count'     => array(
            'name'         => 'blog_option_post_count',
            'type'         => 'switch',
            'settings'     => 'blog_option_post_count',
            'label'        => esc_attr__('Post views', 'realty-pack-core'),
            'description'  => esc_attr__('Enable and disable post views in single page', 'realty-pack-core'),
            'section'      => 'single_post',
            'default'       => true,
            'theme_config' => 'rtp',
            'priority'     => 8,
        ),
        // Agency 
        'agency_permalink'          => array(
            'name'         => 'agency_permalink',
            'type'         => 'select',
            'settings'     => 'agency_permalink',
            'label'        => esc_attr__('Single Agency', 'realty-pack-core'),
            'description'  => esc_attr__('choose your agency single', 'realty-pack-core'),
            'section'      => 'agency_single',
            'choices'      => post_type( 'agency_builder' ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'agent_permalink'          => array(
            'name'         => 'agent_permalink',
            'type'         => 'select',
            'settings'     => 'agent_permalink',
            'label'        => esc_attr__('Single Agent', 'realty-pack-core'),
            'description'  => esc_attr__('choose your agent single', 'realty-pack-core'),
            'section'      => 'agent_single',
            'choices'      => post_type( 'agent_builder' ),
            'theme_config' => 'rtp',
            'priority'     => 2,
        ), 
        // Extras
        'goto_top_activation'     => array(
            'name'         => 'goto_top_activation',
            'type'         => 'switch',
            'settings'     => 'goto_top_activation',
            'label'        => esc_attr__('Activate Go To Top Button', 'realty-pack-core'),
            'description'  => '',
            'section'      => 'goto_top_section',
            'default'       => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),        
        'lazy_load_activation'     => array(
            'name'         => 'lazy_load_activation',
            'type'         => 'switch',
            'settings'     => 'lazy_load_activation',
            'label'        => esc_attr__( 'Activate LazyLoad', 'realty-pack-core' ),
            'description'  => '',
            'section'      => 'lazy_load_section',
            'default'       => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        // Intgreation
        'mailchimp_intgreation_api'     => array(
            'name'         => 'mailchimp_intgreation_api',
            'type'         => 'text',
            'settings'     => 'mailchimp_intgreation_api',
            'label'        => esc_attr__( 'MailChimp API Key', 'realty-pack-core' ),
            'description'  => '',
            'section'      => 'intgreation_section',
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),        
        'mailchimp_intgreation_list'     => array(
            'name'         => 'mailchimp_intgreation_list',
            'type'         => 'text',
            'settings'     => 'mailchimp_intgreation_list',
            'label'        => esc_attr__( 'MailChimp List ID', 'realty-pack-core' ),
            'description'  => '',
            'section'      => 'intgreation_section',
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        // WPL
        'properties_permalink'          => array(
        	'name'         => 'properties_permalink',
        	'type'         => 'select',
        	'settings'     => 'properties_permalink',
        	'label'        => esc_attr__('Single Property', 'realty-pack-core'),
        	'description'  => esc_attr__('choose your single property', 'realty-pack-core'),
        	'section'      => 'properties_section',
        	'choices'      => post_type( 'property_builder' ),
        	'theme_config' => 'rtp',
        	'priority'     => 1,
        ),
        'wpl_main_permalink'          => array(
            'name'         => 'wpl_main_permalink',
            'type'         => 'select',
            'settings'     => 'wpl_main_permalink',
            'label'        => esc_attr__('Main Property Permalink', 'realty-pack-core'),
            'description'  => esc_attr__('By changeing this option all of the link in wpl like listing manager link will be follow your property builder', 'realty-pack-core'),
            'section'      => 'properties_section',
            'choices'      => array(
                'wpl'           => 'WPL',
                'realtypack'    => 'RealtyPack'
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        // Properties archive
        'prp_archive_preview_mode'          => array(
            'name'         => 'prp_archive_preview_mode',
            'type'         => 'select',
            'settings'     => 'prp_archive_preview_mode',
            'label'        => esc_attr__('Display items as', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'choices'      => array(
                'grid'       => __( 'Grid', 'realty-pack-core' ),
                'column'     => __( 'List', 'realty-pack-core' ),
            ),
            'default'      => 'grid',
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'prp_archive_columns'          => array(
            'name'         => 'prp_archive_columns',
            'type'         => 'select',
            'settings'     => 'prp_archive_columns',
            'label'        => esc_attr__('Columns', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'choices'      => array(
                '6' => '2',
                '4' => '3',
                '3' => '4',
            ),
            'default'      => '4',
            'active_callback' => array(
                array(
                    'setting'  => 'prp_archive_preview_mode',
                    'operator' => '==',
                    'value'    => 'grid',
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        'prp_archive_limit'          => array(
            'name'         => 'prp_archive_limit',
            'type'         => 'number',
            'settings'     => 'prp_archive_limit',
            'label'        => esc_attr__('Display Tabs', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => '6',
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),       
        'prp_archive_image_height_px'         => array(
            'name'            => 'prp_archive_image_height_px',
            'type'            => 'text',
            'settings'        => 'prp_archive_image_height_px',
            'label'           => esc_attr__('Image Height (Px)', 'realty-pack-core'),
            'description'     => esc_attr__('Set image height for your featured image and it will crop to fit the size. If the original image is smaller than the height you entered it will not crop.', 'realty-pack-core'),
            'section'         => 'general_featured_image_size',
            'default'         => '477',
            'theme_config'    => 'rtp',
            'priority'        => 1,
        ),           
        'prp_archive_image_width_px'         => array(
            'name'            => 'prp_archive_image_width_px',
            'type'            => 'text',
            'settings'        => 'prp_archive_image_width_px',
            'label'           => esc_attr__( 'Image Width (Px)', 'realty-pack-core' ),
            'description'     => esc_attr__( 'Set image width for your featured image and it will crop to fit the size. If the original image is smaller than the width you entered it will not crop.', 'realty-pack-core' ),
            'section'         => 'general_featured_image_size',
            'default'         => '300',
            'theme_config'    => 'rtp',
            'priority'        => 2,
        ),    
        'prp_archive_display_tabs'          => array(
            'name'         => 'prp_archive_display_tabs',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_tabs',
            'label'        => esc_attr__('Display Tabs', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),           
        'prp_archive_display_views'          => array(
            'name'         => 'prp_archive_display_views',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_views',
            'label'        => esc_attr__('Display Grid/List View Option', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'prp_archive_display_sort_options'          => array(
            'name'         => 'prp_archive_display_sort_options',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_sort_options',
            'label'        => esc_attr__('Display Sort Options', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),            
        'prp_archive_display_media'          => array(
            'name'         => 'prp_archive_display_media',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_media',
            'label'        => esc_attr__('Display property media (image, video, etc)', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),        
        'prp_archive_display_tags'          => array(
            'name'         => 'prp_archive_display_tags',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_tags',
            'label'        => esc_attr__('Display property tags', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'active_callback' => array(
                array(
                    'setting'  => 'prp_archive_display_media',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),
        'prp_archive_display_title'          => array(
            'name'         => 'prp_archive_display_title',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_title',
            'label'        => esc_attr__('Display property title', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'prp_archive_display_address'          => array(
            'name'         => 'prp_archive_display_address',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_address',
            'label'        => esc_attr__('Display property address', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'prp_archive_display_features'          => array(
            'name'         => 'prp_archive_display_features',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_features',
            'label'        => esc_attr__('Display property features', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),          
        'prp_archive_display_more_details'          => array(
            'name'         => 'prp_archive_display_more_details',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_more_details',
            'label'        => esc_attr__('Display property more details', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),          
        'prp_archive_display_property_authors'          => array(
            'name'         => 'prp_archive_display_property_authors',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_property_authors',
            'label'        => esc_attr__('Display property author', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),         
        'prp_archive_display_dates'          => array(
            'name'         => 'prp_archive_display_dates',
            'type'         => 'switch',
            'settings'     => 'prp_archive_display_dates',
            'label'        => esc_attr__('display_date', 'realty-pack-core'),
            'section'      => 'properties_archive',
            'default'      => true,
            'theme_config' => 'rtp',
            'priority'     => 1,
        ),  
    );

    return $fields;
}

/**
 * Get footer custom post type list
 *
 * @since 1.0
 */
function post_type( $post_type ) {
    $args = array(
        'post_type' => $post_type,
    );
    $posts       = get_posts($args);
    $list = array();
    $list[] = __( 'Select Option', 'realty-pack-core' );

    foreach ($posts as $post):
        $list[$post->ID] = esc_html__( $post->post_title, 'realty-pack-core' );
    endforeach;
    return $list;

}