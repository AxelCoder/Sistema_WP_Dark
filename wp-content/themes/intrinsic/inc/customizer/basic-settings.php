<?php
/**
 *  Intrinsic Besic Theme Settings
 *
 * @since Intrinsic 1.0
 *
 * @return array intrinsic_customize_register
 *
*/
function intrinsic_customize_register( $wp_customize ) {
    //Basic Post Message Settings
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

    // Changing for site Identity
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'intrinsic_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'intrinsic_customize_partial_blogdescription',
    ));

    $wp_customize->add_setting( 'intrinsic_options[theme_color]' , array(
       'default'   => '#e51681',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'intrinsic_options[theme_color]', array(
           'label'    => esc_html__( 'Theme Color', 'intrinsic' ),
           'section'  => 'colors',
        ) 
    ));     
 
    /**
     * Intrinsic WordPress Theme General Settings
     */  
    $wp_customize->add_panel(
        'intrinsic_general_options', array(
            'priority' => 25,
            'title'    => esc_html__( 'General Options', 'intrinsic' ),
        )
    );

    $wp_customize->add_section( 'intrinsic_general_settings' , array(
        'title'      => esc_html__( 'General', 'intrinsic' ),
        'priority'   => 10,
        'panel'    => 'intrinsic_general_options',
    ) );

    if ( class_exists( 'Intrinsic_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'intrinsic_options[preloader]', array(
            'default'     => false,
            'sanitize_callback' => 'intrinsic_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Intrinsic_Toggle_Control( $wp_customize, 
            'intrinsic_options[preloader]', 
            array(
                'label'  => esc_html__( 'Preloader:', 'intrinsic' ),
                'type'   => 'ios',
                'section'  => 'intrinsic_general_settings',
                'priority' => 10, 
                
            ) 
        ));                     
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[theme_preloader_bg]' , array(
            'default'     => '#12141c',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_preloader_bg]',
                array(
                    'label'     => esc_html__( 'Preloader background', 'intrinsic' ),
                    'section'   => 'intrinsic_general_settings',
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[theme_preloader_buble_color]' , array(
            'default'     => '#e51681',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_preloader_buble_color]',
                array(
                    'label'     => esc_html__( 'Preloader Color', 'intrinsic' ),
                    'section'   => 'intrinsic_general_settings',
                )
            )
        );
    }  

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_scroll_to_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_scroll_to_heading', array(
            'label'     => esc_html__( 'Scroll Top', 'intrinsic' ),
            'section'   => 'intrinsic_general_settings',
            'priority'  => 15,
        ) ) );
    } 

    if ( class_exists( 'Intrinsic_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'intrinsic_options[scroll_top_btn]', array(
            'default'     => true,
            'sanitize_callback' => 'intrinsic_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Intrinsic_Toggle_Control( $wp_customize, 
            'intrinsic_options[scroll_top_btn]', 
            array(
                'label'  => esc_html__( 'Scroll Top:', 'intrinsic' ),
                'type'   => 'ios',
                'section'  => 'intrinsic_general_settings',
                'priority' => 20, 
                
            ) 
        ));    
    }

    $wp_customize->add_setting(
        'intrinsic_options[scroll_top_text]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'type'      =>  'theme_mod',
            'default'   => 'Back <br> To Top',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[scroll_top_text]', array(
            'label' => esc_html__( 'Scroll Top Text:', 'intrinsic' ),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_general_settings',
        )
    );

    //Container Settings
    $wp_customize->add_section( 'intrinsic_container_settings' , array(
        'title'      => esc_html__( 'Layout Settings', 'intrinsic' ),
        'priority'   => 10,
        'panel'    => 'intrinsic_general_options',
    ) );

    if ( class_exists( 'Intrinsic_Customizer_Range_Value_Control' ) ) {
        $wp_customize->add_setting(
            'intrinsic_options[container_width]', array(
                'sanitize_callback' => 'intrinsic_sanitize_number_range',
                'default'           => 1140,
            )
        );

        $wp_customize->add_control(
            new Intrinsic_Customizer_Range_Value_Control(
                $wp_customize, 'intrinsic_options[container_width]', array(
                    'label'       => esc_html__( 'Container Width (px)', 'intrinsic' ),
                    'description' => esc_html__('Select your container width of your layout.', 'intrinsic'),
                    'section'     => 'intrinsic_container_settings',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 0,
                        'max'  => 1500,
                        'step' => 0.1,
                    ),
                    'priority'    => 20,
                    'sum_type'    => false,
                )
            )
        );
    }    

    if ( class_exists( 'Intrinsic_Customizer_Range_Value_Control' ) ) {
        $wp_customize->add_setting(
            'intrinsic_options[post_content_width]', array(
                'sanitize_callback' => 'intrinsic_sanitize_number_range',
                'default'           => 66.666667,
            )
        );

        $wp_customize->add_control(
            new Intrinsic_Customizer_Range_Value_Control(
                $wp_customize, 'intrinsic_options[post_content_width]', array(
                    'label'       => esc_html__( 'Content Width (%)', 'intrinsic' ),
                    'description' => esc_html__('Select your Content width of your layout.', 'intrinsic'),
                    'section'     => 'intrinsic_container_settings',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 0.1,
                    ),
                    'priority'    => 20,
                    'sum_type'    => false,
                )
            )
        );
    }     

    if ( class_exists( 'Intrinsic_Customizer_Range_Value_Control' ) ) {
        $wp_customize->add_setting(
            'intrinsic_options[post_sidebar_width]', array(
                'sanitize_callback' => 'intrinsic_sanitize_number_range',
                'default'           => 33.333333,
            )
        );

        $wp_customize->add_control(
            new Intrinsic_Customizer_Range_Value_Control(
                $wp_customize, 'intrinsic_options[post_sidebar_width]', array(
                    'label'       => esc_html__( 'Sidebar Width (%)', 'intrinsic' ),
                    'description' => esc_html__('Select your Sidebar width of your layout.', 'intrinsic'),
                    'section'     => 'intrinsic_container_settings',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 0.1,
                    ),
                    'priority'    => 20,
                    'sum_type'    => false,
                )
            )
        );
    }

    // Page Layout
    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_page_layout_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_page_layout_heading', array(
            'label'     => esc_html__( 'Page Layout', 'intrinsic' ),
            'section'   => 'intrinsic_container_settings',
            'priority'  => 20,
        ) ) );
    } 

    if ( class_exists( 'Intrinsic_Customize_Control_Radio_Image' ) ) { 
        $page_sidebar_choices = array(
            'full'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
                'label' => esc_html__( 'Full Width', 'intrinsic' ),
            ),
            'left'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
                'label' => esc_html__( 'Left Sidebar', 'intrinsic' ),
            ),
            'right' => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
                'label' => esc_html__( 'Right Sidebar', 'intrinsic' ),
            ),
        );

        $wp_customize->add_setting( 'intrinsic_options[page_sidebar_dispay]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'full',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Control_Radio_Image(
                $wp_customize, 'intrinsic_options[page_sidebar_dispay]', array(
                    'label'    => esc_html__( 'Page Sidebar Layout', 'intrinsic' ),
                    'section'  => 'intrinsic_container_settings',
                    'priority' => 20,
                    'choices'  => $page_sidebar_choices,
                )
            )
        );
    }

    if( class_exists('Intrinsic_Customizer_Dimensions_Control') ) {
        /**
         * Page Padding
         */
        $wp_customize->add_setting( 'intrinsic_options[page_content_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 110,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[page_content_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 75,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[page_content_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 110,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[page_content_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 75,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[page_content_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 90,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[page_content_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 60,
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Dimensions_Control( $wp_customize, 'intrinsic_options[page_content_padding]', array(
            'label'                 => esc_html__( 'Content Padding (px)', 'intrinsic' ),
            'section'               => 'intrinsic_container_settings',             
            'settings'   => array(
                'desktop_top'       => 'intrinsic_options[page_content_top_padding]',
                'desktop_bottom'    => 'intrinsic_options[page_content_bottom_padding]',
                'tablet_top'        => 'intrinsic_options[page_content_tablet_top_padding]',
                'tablet_bottom'     => 'intrinsic_options[page_content_tablet_bottom_padding]',
                'mobile_top'        => 'intrinsic_options[page_content_mobile_top_padding]',
                'mobile_bottom'     => 'intrinsic_options[page_content_mobile_bottom_padding]',
            ),
            'priority'              => 20,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ) ) );
    }


    //Theme Color
    $wp_customize->add_section( 'intrinsic_themecolor_settings' , array(
        'title'      => esc_html__( 'Theme Color Version', 'intrinsic' ),
        'priority'   => 10,
        'panel'    => 'intrinsic_general_options',
    ) );

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_theme_chooser_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_theme_chooser_heading', array(
            'label'     => esc_html__( 'Theme Color Version', 'intrinsic' ),
            'section'   => 'intrinsic_themecolor_settings',
            'priority'  => 10,
        ) ) );
    } 

    if ( class_exists( 'Intrinsic_Customize_Control_Radio_Image' ) ) { 
        $theme_version = array(
            'light'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/theme-light.png' ),
                'label' => esc_html__( 'Light', 'intrinsic' ),
            ),
            'dark'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/theme-dark.png' ),
                'label' => esc_html__( 'Dark', 'intrinsic' ),
            ),
        );

        $wp_customize->add_setting( 'intrinsic_options[theme_background_status]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'light',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Control_Radio_Image(
                $wp_customize, 'intrinsic_options[theme_background_status]', array(
                    'label'    => esc_html__( 'Theme Status', 'intrinsic' ),
                    'section'  => 'intrinsic_themecolor_settings',
                    'priority' => 10,
                    'choices'  => $theme_version,
                )
            )
        );
    }  

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_theme_chooser_light_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_theme_chooser_light_heading', array(
            'label'     => esc_html__( 'Light Version', 'intrinsic' ),
            'section'   => 'intrinsic_themecolor_settings',
            'priority'  => 10,
        ) ) );
    } 

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {

        $wp_customize->add_setting( 'intrinsic_options[theme_background_light_color]' , array(
            'default'     => '#f8f8f8',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_background_light_color]',
                array(
                    'label'     => esc_html__( 'Theme Background Color', 'intrinsic' ),
                    'section'   => 'intrinsic_themecolor_settings',
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[theme_text_light_color]' , array(
            'default'     => '#3c3c3c',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_text_light_color]',
                array(
                    'label'     => esc_html__( 'Theme Text Color', 'intrinsic' ),
                    'section'   => 'intrinsic_themecolor_settings',
                )
            )
        );
    } 

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_theme_chooser_dark_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_theme_chooser_dark_heading', array(
            'label'     => esc_html__( 'Dark Version', 'intrinsic' ),
            'section'   => 'intrinsic_themecolor_settings',
            'priority'  => 10,
        ) ) );
    } 

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {

        $wp_customize->add_setting( 'intrinsic_options[theme_background_dark_color]' , array(
            'default'     => '#13152e',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_background_dark_color]',
                array(
                    'label'     => esc_html__( 'Theme Background Color', 'intrinsic' ),
                    'section'   => 'intrinsic_themecolor_settings',
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[theme_text_dark_color]' , array(
            'default'     => '#e1e1e1',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[theme_text_dark_color]',
                array(
                    'label'     => esc_html__( 'Theme Text Color', 'intrinsic' ),
                    'section'   => 'intrinsic_themecolor_settings',
                )
            )
        );
    } 

    /**
     * Header panel
     */
    $wp_customize->add_panel(
        'intrinsic_header_settings', array(
            'priority' => 25,
            'title'    => esc_html__( 'Header', 'intrinsic' ),
        )
    );

    // Logo Section
    $wp_customize->add_section(
        'intrinsic_logo_section', array(
            'title'    => esc_html__( 'Logo', 'intrinsic' ),
            'panel'    => 'intrinsic_header_settings',
            'priority' => 10,
        )
    );

    if( class_exists('Intrinsic_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'intrinsic_options[logo_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[logo_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[logo_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[logo_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[logo_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[logo_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Dimensions_Control( $wp_customize, 'intrinsic_options[logo_padding]', array(
            'label'                 => esc_html__( 'Logo Padding (px)', 'intrinsic' ),
            'section'               => 'intrinsic_logo_section',             
            'settings'   => array(
                'desktop_top'       => 'intrinsic_options[logo_top_padding]',
                'desktop_bottom'    => 'intrinsic_options[logo_bottom_padding]',
                'tablet_top'        => 'intrinsic_options[logo_tablet_top_padding]',
                'tablet_bottom'     => 'intrinsic_options[logo_tablet_bottom_padding]',
                'mobile_top'        => 'intrinsic_options[logo_mobile_top_padding]',
                'mobile_bottom'     => 'intrinsic_options[logo_mobile_bottom_padding]',
            ),
            'priority'              => 10,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ) ) );
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[site_branding_color]' , array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[site_branding_color]',
                array(
                    'label'     => esc_html__( 'Site Title Color', 'intrinsic' ),
                    'section'   => 'intrinsic_logo_section',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[site_description_color]' , array(
            'default'     => '#e1e1e1',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[site_description_color]',
                array(
                    'label'     => esc_html__( 'Site Description Color', 'intrinsic' ),
                    'section'   => 'intrinsic_logo_section',
                    'priority'  => 20,
                )
            )
        );
    } 

    $wp_customize->add_section(
        'intrinsic_menu_section', array(
            'title'    => esc_html__( 'Menu Styling', 'intrinsic' ),
            'panel'    => 'intrinsic_header_settings',
            'priority' => 15,
        )
    );

    // Main Menu 
    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[menu_color]' , array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[menu_color]',
                array(
                    'label'     => esc_html__( 'Main Menu Color', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[main_menu_hover_color]' , array(
            'default'     => '#f7f7f7',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[main_menu_hover_color]',
                array(
                    'label'     => esc_html__( 'Main Menu Hover Color', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[main_menu_separator_color]' , array(
            'default'     => '#e51681',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[main_menu_separator_color]',
                array(
                    'label'     => esc_html__( 'Main Menu Separator Color', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        );
    } 

    // Sub dropdown Heading 
    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_menu_main_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_menu_main_styling_heading', array(
            'label'                 => esc_html__( 'Dropdown Styling', 'intrinsic' ),
            'section'               => 'intrinsic_menu_section',
            'priority'              => 20,
        ) ) );
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[dropdown_menu_bg]' , array(
            'default'     => '#080d18',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[dropdown_menu_bg]',
                array(
                    'label'     => esc_html__( 'Sub Menu Background', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[dropdown_menu_color]' , array(
            'default'     => '#f7f7f7',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[dropdown_menu_color]',
                array(
                    'label'     => esc_html__( 'Sub Menu Text Color', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        ); 
    }

    if ( class_exists( 'Intrinsic_Customizer_Range_Value_Control' ) ) {
        $wp_customize->add_setting(
            'intrinsic_options[dropdown_menu_width]', array(
                'sanitize_callback' => 'intrinsic_sanitize_number_range',
                'default'           => 300,
            )
        );

        $wp_customize->add_control(
            new Intrinsic_Customizer_Range_Value_Control(
                $wp_customize, 'intrinsic_options[dropdown_menu_width]', array(
                    'label'       => esc_html__( 'Dropdown Menu Width:', 'intrinsic' ),
                    'description' => esc_html__('Select your dropdown menu width', 'intrinsic'),
                    'section'     => 'intrinsic_menu_section',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 0,
                        'max'  => 550,
                        'step' => 0.1,
                    ),
                    'priority'    => 20,
                    'sum_type'    => false,
                )
            )
        );
    } 

    // Sub dropdown Heading 
    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_mobile_main_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_mobile_main_styling_heading', array(
            'label'                 => esc_html__( 'Mobile Menu Styling', 'intrinsic' ),
            'section'               => 'intrinsic_menu_section',
            'priority'              => 20,
        ) ) );
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[mobile_menu_color]' , array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[mobile_menu_color]',
                array(
                    'label'     => esc_html__( 'Menu Color', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[mobile_menu_bg]' , array(
            'default'     => '#12141c',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[mobile_menu_bg]',
                array(
                    'label'     => esc_html__( 'Menu Background', 'intrinsic' ),
                    'section'   => 'intrinsic_menu_section',
                    'priority'  => 20,
                )
            )
        ); 
    }

    // Header General Styling
    $wp_customize->add_section(
        'intrinsic_header_general', array(
            'title'    => esc_html__( 'General Styling', 'intrinsic' ),
            'panel'    => 'intrinsic_header_settings',
            'priority' => 15,
        )
    );

    if ( class_exists( 'Intrinsic_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'intrinsic_options[enable_header_right]', array(
            'default'     => false,
            'sanitize_callback' => 'intrinsic_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Intrinsic_Toggle_Control( $wp_customize, 
            'intrinsic_options[enable_header_right]', 
            array(
                'label'  => esc_html__( 'Enable Header Right:', 'intrinsic' ),
                'type'   => 'ios',
                'section'  => 'intrinsic_header_general',
                'priority' => 10, 
            ) 
        ));         

        $wp_customize->add_setting( 'intrinsic_options[header_sticky]', array(
            'default'     => false,
            'sanitize_callback' => 'intrinsic_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Intrinsic_Toggle_Control( $wp_customize, 
            'intrinsic_options[header_sticky]', 
            array(
                'label'  => esc_html__( 'Sticky Header:', 'intrinsic' ),
                'type'   => 'ios',
                'section'  => 'intrinsic_header_general',
                'priority' => 10, 
            ) 
        ));                        
    } 

    //Header Left Block
    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_header_left_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_header_left_styling_heading', array(
            'label'     => esc_html__( 'Header Left Block', 'intrinsic' ),
            'section'   => 'intrinsic_header_general',
            'priority'  => 20,
        ) ) );
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[header_left_block_bg]' , array(
            'default'     => '#12141c',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[header_left_block_bg]',
                array(
                    'label'     => esc_html__( 'Left Block Background', 'intrinsic' ),
                    'section'   => 'intrinsic_header_general',
                    'priority'  => 20,
                )
            )
        );
    }

    //Header Right Block
    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_header_right_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_header_right_styling_heading', array(
            'label'     => esc_html__( 'Header Right Block', 'intrinsic' ),
            'section'   => 'intrinsic_header_general',
            'priority'  => 20,
        ) ) );
    }

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[header_right_block_bg]' , array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[header_right_block_bg]',
                array(
                    'label'     => esc_html__( 'Right Block Background', 'intrinsic' ),
                    'section'   => 'intrinsic_header_general',
                    'priority'  => 20,
                )
            )
        );        

        $wp_customize->add_setting( 'intrinsic_options[header_right_block_colors]' , array(
            'default'     => '#000000',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Alpha_Color_Control(
                $wp_customize,
                'intrinsic_options[header_right_block_colors]',
                array(
                    'label'     => esc_html__( 'Right Block Text Colors', 'intrinsic' ),
                    'section'   => 'intrinsic_header_general',
                    'priority'  => 20,
                )
            )
        );
    }

    $wp_customize->add_setting(
        'intrinsic_options[header_mail_icons]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'fas fa-envelope',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_mail_icons]', array(
            'label' => esc_html__( 'Email Icons:', 'intrinsic' ),
            'description' => esc_html__('Enter FontAwesome Icons Code. Ex. - "fas fa-envelope"','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );    

    $wp_customize->add_setting(
        'intrinsic_options[header_mail_address]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'example@domain.com',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_mail_address]', array(
            'label' => esc_html__( 'Email Address:', 'intrinsic' ),
            'description' => esc_html__('Enter Email Your Address','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_call_icons]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'fas fa-phone',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_call_icons]', array(
            'label' => esc_html__( 'Phone Icons:', 'intrinsic' ),
            'description' => esc_html__('Enter FontAwesome Icons Code. Ex. - "fas fa-phone"','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    ); 

    $wp_customize->add_setting(
        'intrinsic_options[header_phone_numbers]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => '008969854756',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_phone_numbers]', array(
            'label' => esc_html__( 'Phone Number:', 'intrinsic' ),
            'description' => esc_html__('Enter Your Phone Number','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_header_social_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_header_social_styling_heading', array(
            'label'     => esc_html__( 'Header Social Block', 'intrinsic' ),
            'section'   => 'intrinsic_header_general',
            'priority'  => 20,
        ) ) );
    }

    $wp_customize->add_setting( 'intrinsic_options[header_social_profile_target]', array(
        'default'     => '_blank',
        'capability' => 'edit_theme_options',
        'type' =>  'theme_mod',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
        'intrinsic_options[header_social_profile_target]', 
        array(
            'label'                 => esc_html__( 'Social Link Target', 'intrinsic' ),
            'type'                  => 'select',
            'section'               => 'intrinsic_header_general',
            'priority'              => 20, 
            'choices'               => array(
                '_blank' => esc_html__( 'New Window', 'intrinsic' ),
                '_self'  => esc_html__( 'Same Window', 'intrinsic' ),
            ),
        ) 
    ) );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_one_icon]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'fab fa-facebook-f',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_one_icon]', array(
            'label' => esc_html__( 'Social Icons:', 'intrinsic' ),
            'description' => esc_html__('Enter FontAwesome Icons Code. Ex. - "fas fa-phone"','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_one_url]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => '#',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_one_url]', array(
            'label' => esc_html__( 'Social URL:', 'intrinsic' ),
            'description' => esc_html__('Enter Your Social URL','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_two_icon]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'fab fa-twitter',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_two_icon]', array(
            'label' => esc_html__( 'Social Icons:', 'intrinsic' ),
            'description' => esc_html__('Enter FontAwesome Icons Code. Ex. - "fas fa-phone"','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_two_url]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => '#',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_two_url]', array(
            'label' => esc_html__( 'Social URL:', 'intrinsic' ),
            'description' => esc_html__('Enter Your Social URL','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_three_icon]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => 'fab fa-instagram',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_three_icon]', array(
            'label' => esc_html__( 'Social Icons:', 'intrinsic' ),
            'description' => esc_html__('Enter FontAwesome Icons Code. Ex. - "fas fa-phone"','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );

    $wp_customize->add_setting(
        'intrinsic_options[header_social_block_three_url]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'default'   => '#',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[header_social_block_three_url]', array(
            'label' => esc_html__( 'Social URL:', 'intrinsic' ),
            'description' => esc_html__('Enter Your Social URL','intrinsic'),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_header_general',
        )
    );
    //End Header 


    /**
     * Intrinsic WordPress Theme Blog Settings
     */ 
    $wp_customize->add_section( 'intrinsic_blog_settings' , array(
        'title'      => esc_html__( 'Blog Options', 'intrinsic' ),
        'priority'   => 90,   
    ));

    if( class_exists('Intrinsic_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'intrinsic_options[top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 30,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 120,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 0,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 120,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 0,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 120,
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Dimensions_Control( $wp_customize, 'intrinsic_options[blog_padding]', array(
            'label'                 => esc_html__( 'Blog Padding (px)', 'intrinsic' ),
            'section'               => 'intrinsic_blog_settings',             
            'settings'   => array(
                'desktop_top'       => 'intrinsic_options[top_padding]',
                'desktop_bottom'    => 'intrinsic_options[bottom_padding]',
                'tablet_top'        => 'intrinsic_options[tablet_top_padding]',
                'tablet_bottom'     => 'intrinsic_options[tablet_bottom_padding]',
                'mobile_top'        => 'intrinsic_options[mobile_top_padding]',
                'mobile_bottom'     => 'intrinsic_options[mobile_bottom_padding]',
            ),
            'priority'              => 10,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 400,
                'step'  => 1,
            ),
        ) ) );
    }

    if ( class_exists( 'Intrinsic_Customize_Control_Radio_Image' ) ) { 
        $sidebar_choices = array(
            'full'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
                'label' => esc_html__( 'Full Width', 'intrinsic' ),
            ),
            'left'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
                'label' => esc_html__( 'Left Sidebar', 'intrinsic' ),
            ),
            'right' => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
                'label' => esc_html__( 'Right Sidebar', 'intrinsic' ),
            ),
        );

        $wp_customize->add_setting( 'intrinsic_options[blog_sidebar_dispay]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'right',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Control_Radio_Image(
                $wp_customize, 'intrinsic_options[blog_sidebar_dispay]', array(
                    'label'    => esc_html__( 'Blog Sidebar Layout', 'intrinsic' ),
                    'section'  => 'intrinsic_blog_settings',
                    'priority' => 10,
                    'choices'  => $sidebar_choices,
                )
            )
        );
    }

    $wp_customize->add_setting( 'intrinsic_options[excerpt_length]' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'type'      =>  'theme_mod',
        'default' => 25,
    ));

    $wp_customize->add_control( 'intrinsic_options[excerpt_length]', array(
        'label' => esc_html__( 'Excerpt Length: ', 'intrinsic' ),
        'description' => esc_html__( 'How many words want to show per page?', 'intrinsic' ),
        'section' => 'intrinsic_blog_settings',
        'type'        => 'number',
        'priority' => 20,
        'input_attrs' => array(
            'min'  => 1,
            'max'   => 100,
            'step' => 1,
        ),
    ));

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_single_post_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_single_post_styling_heading', array(
            'label'     => esc_html__( 'Single Posts', 'intrinsic' ),
            'section'   => 'intrinsic_blog_settings',
            'priority'  => 30,
        ) ) );
    }

    if( class_exists('Intrinsic_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'intrinsic_options[blog_single_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 120,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[blog_single_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 120,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[blog_single_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 120,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[blog_single_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 120,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[blog_single_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 45,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[blog_single_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 45,
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Dimensions_Control( $wp_customize, 'intrinsic_options[blog_single_padding]', array(
            'label'                 => esc_html__( 'Blog Single Padding (px)', 'intrinsic' ),
            'section'               => 'intrinsic_blog_settings',             
            'settings'   => array(
                'desktop_top'       => 'intrinsic_options[blog_single_top_padding]',
                'desktop_bottom'    => 'intrinsic_options[blog_single_bottom_padding]',
                'tablet_top'        => 'intrinsic_options[blog_single_tablet_top_padding]',
                'tablet_bottom'     => 'intrinsic_options[blog_single_tablet_bottom_padding]',
                'mobile_top'        => 'intrinsic_options[blog_single_mobile_top_padding]',
                'mobile_bottom'     => 'intrinsic_options[blog_single_mobile_bottom_padding]',
            ),
            'priority'              => 35,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 400,
                'step'  => 1,
            ),
        ) ) );
    }

    if ( class_exists( 'Intrinsic_Customize_Control_Radio_Image' ) ) { 
        $sidebar_single_choices = array(
            'full'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
                'label' => esc_html__( 'Full Width', 'intrinsic' ),
            ),
            'left'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
                'label' => esc_html__( 'Left Sidebar', 'intrinsic' ),
            ),
            'right' => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
                'label' => esc_html__( 'Right Sidebar', 'intrinsic' ),
            ),
        );

        $wp_customize->add_setting( 'intrinsic_options[blog_single_sidebar_dispay]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'right',
        ));

        $wp_customize->add_control(
            new Intrinsic_Customize_Control_Radio_Image(
                $wp_customize, 'intrinsic_options[blog_single_sidebar_dispay]', array(
                    'label'    => esc_html__( 'Blog Single Sidebar Layout', 'intrinsic' ),
                    'section'  => 'intrinsic_blog_settings',
                    'priority' => 35,
                    'choices'  => $sidebar_single_choices,
                )
            )
        );
    }


    /**
     * End Intrinsic WordPress Theme Footer Control Panel
     */
    $wp_customize->add_section( 'intrinsic_footer' , array(
        'title'      => esc_html__( 'Footer Options', 'intrinsic' ),
        'priority'   => 100,   
    ));

    if( class_exists('Intrinsic_Customize_Alpha_Color_Control') ) {
        $wp_customize->add_setting( 'intrinsic_options[footer_background]' , array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
            'type'      =>  'theme_mod',
        ));

        $wp_customize->add_control( 
            new Intrinsic_Customize_Alpha_Color_Control( $wp_customize, 'intrinsic_options[footer_background]', array(
               'label'    => esc_html__( 'Footer Background Color: ', 'intrinsic' ),
               'section'  => 'intrinsic_footer',
            ) 
        ));

        $wp_customize->add_setting( 'intrinsic_options[footer_color]' , array(
            'default'     => '#000000',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
            'type'      =>  'theme_mod',
        ));

        $wp_customize->add_control( 
            new Intrinsic_Customize_Alpha_Color_Control( $wp_customize, 'intrinsic_options[footer_color]', array(
               'label'    => esc_html__( 'Footer Text Color: ', 'intrinsic' ),
               'section'  => 'intrinsic_footer',
            ) 
        ));    

        $wp_customize->add_setting( 'intrinsic_options[footer_link_color]' , array(
            'default'     => '#000000',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
            'type'      =>  'theme_mod',
        ));

        $wp_customize->add_control( 
            new Intrinsic_Customize_Alpha_Color_Control( $wp_customize, 'intrinsic_options[footer_link_color]', array(
               'label'    => esc_html__( 'Footer Link Color: ', 'intrinsic' ),
               'section'  => 'intrinsic_footer',
            ) 
        ));        

        $wp_customize->add_setting( 'intrinsic_options[footer_link_hover_color]' , array(
            'default'     => '#e51681',
            'sanitize_callback' => 'intrinsic_sanitize_rgba',
            'capability' => 'edit_theme_options',
            'type'      =>  'theme_mod',
        ));

        $wp_customize->add_control( 
            new Intrinsic_Customize_Alpha_Color_Control( $wp_customize, 'intrinsic_options[footer_link_hover_color]', array(
               'label'    => esc_html__( 'Footer Link Hover Color: ', 'intrinsic' ),
               'section'  => 'intrinsic_footer',
            ) 
        ));
    }

    if( class_exists('Intrinsic_Customizer_Dimensions_Control') ) {
        /**
         * Footer Padding
         */
        $wp_customize->add_setting( 'intrinsic_options[footer_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 75,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[footer_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number',
            'default'               => 75,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[footer_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 75,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[footer_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 75,
        ) );

        $wp_customize->add_setting( 'intrinsic_options[footer_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 75,
        ) );
        $wp_customize->add_setting( 'intrinsic_options[footer_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'intrinsic_sanitize_number_blank',
            'default'               => 75,
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Dimensions_Control( $wp_customize, 'intrinsic_options[footer_padding]', array(
            'label'                 => esc_html__( 'Footer Spacing (px)', 'intrinsic' ),
            'section'               => 'intrinsic_footer',             
            'settings'   => array(
                'desktop_top'       => 'intrinsic_options[footer_top_padding]',
                'desktop_bottom'    => 'intrinsic_options[footer_bottom_padding]',
                'tablet_top'        => 'intrinsic_options[footer_tablet_top_padding]',
                'tablet_bottom'     => 'intrinsic_options[footer_tablet_bottom_padding]',
                'mobile_top'        => 'intrinsic_options[footer_mobile_top_padding]',
                'mobile_bottom'     => 'intrinsic_options[footer_mobile_bottom_padding]',
            ),
            'priority'              => 5,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 400,
                'step'  => 1,
            ),
        ) ) );
    }


    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_footer_spacing_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_footer_spacing_styling_heading', array(
            'label'     => esc_html__( 'Footer Social', 'intrinsic' ),
            'section'   => 'intrinsic_footer',
            'priority'  => 10,
        ) ) );
    }

    $wp_customize->add_setting( 'intrinsic_options[social_profile_target]', array(
        'default'     => '_blank',
        'capability' => 'edit_theme_options',
        'type' =>  'theme_mod',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
        'intrinsic_options[social_profile_target]', 
        array(
            'label'                 => esc_html__( 'Social Link Target', 'intrinsic' ),
            'type'                  => 'select',
            'section'               => 'intrinsic_footer',
            'priority'              => 12, 
            'choices'               => array(
                '_blank' => esc_html__( 'New Window', 'intrinsic' ),
                '_self'  => esc_html__( 'Same Window', 'intrinsic' ),
            ),
        ) 
    ) );

    if ( class_exists( 'Intrinsic_Customizer_Repeater_Control' ) ) { 
        $wp_customize->add_setting( 'intrinsic_options[footer_social_url]', array(
            'sanitize_callback' => 'intrinsic_customizer_repeater_sanitize',
            'capability' => 'edit_theme_options',
        )); 
    
        $wp_customize->add_control( new Intrinsic_Customizer_Repeater_Control( $wp_customize, 'intrinsic_options[footer_social_url]', array(
            'label'   => esc_html__('Social URL','intrinsic'),
            'section' => 'intrinsic_footer',
            'priority' => 12,
            'customizer_repeater_title_control' => true,
            'customizer_repeater_link_control' => true,
        ) ) );
    }

    if( class_exists('Intrinsic_Customizer_Heading_Control') ) {    
        $wp_customize->add_setting( 'intrinsic_copyrights_styling_heading', array(
            'sanitize_callback'     => 'wp_kses',
        ) );

        $wp_customize->add_control( new Intrinsic_Customizer_Heading_Control( $wp_customize, 'intrinsic_copyrights_styling_heading', array(
            'label'     => esc_html__( 'Copyright', 'intrinsic' ),
            'section'   => 'intrinsic_footer',
            'priority'  => 15,
        ) ) );
    }

    $wp_customize->add_setting(
        'intrinsic_options[footer_copyright_info]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'intrinsic_sanitize_advance_html',
            'type'      =>  'theme_mod',
            'transport' => 'postMessage',
            'default'   => 'Softhopper <i class="fas fa-heart"></i> 2019. All rights reserved',
        )
    );

    $wp_customize->add_control(
        'intrinsic_options[footer_copyright_info]', array(
            'label' => esc_html__( 'Footer Copyright Text:', 'intrinsic' ),
            'type' => 'text',
            'priority' => 20,
            'section' => 'intrinsic_footer',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'intrinsic_options[footer_copyright_info]', array(
        'selector' => '.copyright-text', 
    ) );

    /**
     * End Intrinsic WordPress Theme Footer Control Panel
     */    
}
add_action( 'customize_register', 'intrinsic_customize_register' );