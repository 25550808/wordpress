<?php
if (!function_exists( 'littlemonsters_fnc_custom_customize_register' )) :
    function littlemonsters_fnc_custom_customize_register($wp_customize) {
        // Header Customizer
        $wp_customize->remove_control( 'wpopal_theme_options[headerlayout]' );
        $wp_customize->add_section( 'littlemonsters_header_settings', array(
            'title' => esc_html__( 'Header Settings', 'little-monsters' ),
            'transport' => 'postMessage',
            'priority' => 20,
        ) );

        $wp_customize->add_setting( 'wpopal_theme_options[headerlayout]', array(
            'type' => 'option',
            'capability' => 'manage_options',
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'wpopal_theme_options[headerlayout]', array(
            'label' => esc_html__( 'Header Layout Style', 'little-monsters' ),
            'section' => 'littlemonsters_header_settings',
            'type' => 'select',
            'choices' => function_exists('wpopal_themer_fnc_get_header_layouts') ? wpopal_themer_fnc_get_header_layouts() : '',
        ) );

        $wp_customize->remove_control( 'wpopal_theme_options[logo2]' );
        $wp_customize->add_setting( 'wpopal_theme_options[logo2]', array(
            'default' => '',
            'type' => 'option',
            'capability' => 'manage_options',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        // $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpopal_theme_options[logo2]', array(
        //     'label' => esc_html__( 'Logo For Absolute Header', 'little-monsters' ),
        //     'section' => 'littlemonsters_header_settings',
        //     'settings' => 'wpopal_theme_options[logo2]',
        //     'priority' => 10,
        // ) ) );

        $wp_customize->remove_control( 'wpopal_theme_options[logo2]' );
        $wp_customize->remove_control( 'wpopal_theme_options[keepheader]' );
        $wp_customize->add_setting( 'wpopal_theme_options[keepheader]', array(
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'default' => 0,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );



        $wp_customize->add_control( 'wpopal_theme_options[keepheader]', array(
            'settings' => 'wpopal_theme_options[keepheader]',
            'label' => esc_html__( 'Keep Header', 'little-monsters' ),
            'section' => 'littlemonsters_header_settings',
            'type' => 'checkbox',
            'transport' => 4,
        ) );

        // Breadcrumbs options

        $wp_customize->remove_control('wpopal_theme_options[woocommerce-single-breadcrum]');
        $wp_customize->remove_control( 'wpopal_theme_options[breadcrumb-bg]' );
        $wp_customize->add_section( 'littlemonsters_breadcrumb_settings', array(
            'title' => esc_html__( 'Breadcrumb Settings', 'little-monsters' ),
            'transport' => 'postMessage',
            'priority' => 20,
        ) );
        $wp_customize->add_setting( 'wpopal_theme_options[breadcrumb_layout]', array(
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'default' => '1',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'wpopal_theme_options[breadcrumb_layout]', array(
            'label' => esc_html__( 'Style Breadcrumb', 'little-monsters' ),
            'section' => 'littlemonsters_breadcrumb_settings',
            'type' => 'select',
            'choices' => array(
                'style-1' => esc_html__( 'Style 1', 'little-monsters' ),
                'style-2' => esc_html__( 'Style 2', 'little-monsters' ),
                'style-3' => esc_html__( 'Style 3', 'little-monsters' ),
                'style-4' => esc_html__( 'Style 4', 'little-monsters' ),
            )
        ) );

        $wp_customize->add_setting( 'wpopal_theme_options[breadcrumb-bg]', array(
            'default' => '',
            'type' => 'option',
            'capability' => 'manage_options',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpopal_theme_options[breadcrumb-bg]', array(
            'label' => esc_html__( 'Breadcrumb background', 'little-monsters' ),
            'section' => 'littlemonsters_breadcrumb_settings',
            'settings' => 'wpopal_theme_options[breadcrumb-bg]',
            'priority' => 10,
        ) ) );

        // Footer Settings
        $wp_customize->remove_control( 'wpopal_theme_options[footer-style]' );
        $wp_customize->add_section( 'littlemonsters_footer_settings', array(
            'title' => esc_html__( 'Footer Settings', 'little-monsters' ),
            'transport' => 'postMessage',
            'priority' => 20,
        ) );
        $wp_customize->add_setting( 'wpopal_theme_options[footer-style]', array(
            'type' => 'option',
            'capability' => 'manage_options',
            'default' => 'default',
            'sanitize_callback' => 'sanitize_text_field'
            //  'theme_supports' => 'static-front-page',
        ) );

        $wp_customize->add_control( 'wpopal_theme_options[footer-style]', array(
            'label' => esc_html__( 'Footer Styles Builder', 'little-monsters' ),
            'section' => 'littlemonsters_footer_settings',
            'type' => 'select',
            'choices' => function_exists('wpopal_themer_fnc_get_footer_profiles') ? wpopal_themer_fnc_get_footer_profiles() : ''
        ) );

        // remove section header_image
        $wp_customize->remove_section( 'header_image' );
        $wp_customize->remove_section( 'background_image' );
        //        $wp_customize->remove_section('general_settings');


        // Skin
        $wp_customize->remove_control( 'wpopal_theme_options[skin]' );
        $wp_customize->add_setting( 'wpopal_theme_options[skin]', array(
            'type' => 'option',
            'capability' => 'manage_options',
            'default' => 'default',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'wpopal_theme_options[skin]', array(
            'label' => esc_html__( 'Active Skin', 'little-monsters' ),
            'section' => 'pbr_cst_general_settings',
            'type' => 'select',
            'choices' => function_exists('wpopal_themer_fnc_cst_skins') ? wpopal_themer_fnc_cst_skins() : '',
        ) );

        
        ///blog archive config
        if(class_exists('Wpopal_Themer_Layout_DropDown')){
            $wp_customize->add_setting( 'wpopal_theme_options[blog-archive-layout]', array(
                'capability' => 'edit_theme_options',
                'type'       => 'option',
                'default'   => '',
                'sanitize_callback' => 'sanitize_text_field'
            ) );

            $wp_customize->add_control( new Wpopal_Themer_Layout_DropDown( $wp_customize,  'wpopal_theme_options[blog-archive-layout]', array(
                'settings'  => 'wpopal_theme_options[blog-archive-layout]',
                'label'     => esc_html__('Archive Blog Layout', 'little-monsters'),
                'section'   => 'archive_general_settings',
                'priority' => 1,
            ) ) );
        }
        

    }
endif;
add_action( 'customize_register', 'littlemonsters_fnc_custom_customize_register', 99999 );