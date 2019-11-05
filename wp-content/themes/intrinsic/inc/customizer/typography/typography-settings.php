<?php
/**
 * Typography settings for both Intrinsic
 *
 * @package Intrinsic
 * @since 1.0
 */

/**
 * Include functions file for Font Family controls.
 */
get_template_part('inc/customizer/customizer-font-selector/font-functions');
get_template_part('inc/customizer/customizer-font-selector/class/class-font-selector');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 */
function intrinsic_customize_preview() {
	wp_enqueue_script( 'intrinsic-typo-customizer', get_theme_file_uri( '/inc/customizer/typography/js/typo-customizer.js' ), array( 'customize-preview' ), '1.0', true );
}

add_action( 'customize_preview_init', 'intrinsic_customize_preview' );

/**
 * Customizer controls for typography settings.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 *
 * @since 1.0
 */
function intrinsic_typography_settings( $wp_customize ) {
	/**
	 * Main typography panel
	 */
	$wp_customize->add_panel(
		'intrinsic_typography_settings', array(
			'priority' => 25,
			'title'    => esc_html__( 'Typography', 'intrinsic' ),
		)
	);

	$wp_customize->add_section(
		'intrinsic_typography', array(
			'title'    => esc_html__( 'Font Family', 'intrinsic' ),
			'panel'    => 'intrinsic_typography_settings',
			'priority' => 25,
		)
	);	

	/**
	 * Main typography Size
	 */
	$wp_customize->add_section(
		'intrinsic_typography_size', array(
			'title'    => esc_html__( 'Font Size', 'intrinsic' ),
			'panel'    => 'intrinsic_typography_settings',
			'priority' => 25,
		)
	);

	/**
	 * Main typography Colors
	 */
	$wp_customize->add_section(
		'intrinsic_typography_color', array(
			'title'    => esc_html__( 'Font Color', 'intrinsic' ),
			'panel'    => 'intrinsic_typography_settings',
			'priority' => 25,
		)
	);	

	$wp_customize->add_setting(
	    'intrinsic_options[body_font_color]', array(
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'type'      =>  'theme_mod',
	        'transport'   => 'postMessage',
	        'default' => '#3c3c3c',
	    )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'intrinsic_options[body_font_color]', array(
	        	'label' => esc_html__('Body Font Color','intrinsic'), 
	            'section' => 'intrinsic_typography_color',
	        )
	    )
	);	
	$wp_customize->add_setting(
	    'intrinsic_options[heading_font_color]', array(
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'type'      =>  'theme_mod',
	        'transport'   => 'postMessage',
	        'default' => '#121212',
	    )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'intrinsic_options[heading_font_color]', array(
	        	'label' => esc_html__('Headings Font Color','intrinsic'), 
	            'section' => 'intrinsic_typography_color',
	        )
	    )
	);

	/**
	 * ------------------
	 * 1. Font Family tab
	 * ------------------
	 */
	if ( class_exists( 'Intrinsic_Font_Selector' ) ) {
		/**
		 * ---------------------------------
		 * 1.a. Headings font family control
		 * This control allows the user to choose a font family for all Headings used in the theme ( h1 - h6 )
		 * --------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[headings_font]', array(
				'type' => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Dosis',
			)
		);
		$wp_customize->add_control(
			new Intrinsic_Font_Selector(
				$wp_customize, 'intrinsic_options[headings_font]', array(
					'label'    => esc_html__( 'Headings font family', 'intrinsic' ),
					'section'  => 'intrinsic_typography',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);

		/**
		 * ---------------------------------
		 * 1.b. Body font family control
		 * This control allows the user to choose a font family for all elements in the body tag
		 * --------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[body_font]', array(
				'type' => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Dosis',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Font_Selector(
				$wp_customize, 'intrinsic_options[body_font]', array(
					'label'    => esc_html__( 'Body font family', 'intrinsic' ),
					'section'  => 'intrinsic_typography',
					'priority' => 10,
					'type'     => 'select',
				)
			)
		);

		/**
		 * ---------------------------------
		 * 1.b. Body font family control
		 * This control allows the user to choose a font family for all elements in the body tag
		 * --------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[site_title_font]', array(
				'type' => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Dosis',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Font_Selector(
				$wp_customize, 'intrinsic_options[site_title_font]', array(
					'label'    => esc_html__( 'Site Title/Logo Font Family', 'intrinsic' ),
					'section'  => 'intrinsic_typography',
					'priority' => 10,
					'type'     => 'select',
				)
			)
		);
	} // End if().

	if ( class_exists( 'Intrinsic_Select_Multiple' ) ) {
		/**
		 * --------------------
		 * 1.c. Font Subsets control
		 * This control allows the user to choose a subset for the font family ( for e.g. lating, cyrillic etc )
		 * --------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[font_subsets]', array(
				'sanitize_callback' => 'intrinsic_sanitize_multiselect',
				'default'           => array( 'latin' ),
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Select_Multiple(
				$wp_customize, 'intrinsic_options[font_subsets]', array(
					'section'  => 'intrinsic_typography',
					'label'    => esc_html__( 'Font Subsets', 'intrinsic' ),
					'choices'  => array(
						'latin'        => 'latin',
						'latin-ext'    => 'latin-ext',
						'cyrillic'     => 'cyrillic',
						'cyrillic-ext' => 'cyrillic-ext',
						'greek'        => 'greek',
						'greek-ext'    => 'greek-ext',
						'vietnamese'   => 'vietnamese',
					),
					'priority' => 45,
				)
			)
		);
	} // End if().

	/**
	 * ------------------
	 * 2. Font Size tab
	 * ------------------
	 */
	if ( class_exists( 'Intrinsic_Customizer_Range_Value_Control' ) ) {
		/**
		 * --------------------------------------------------------------------------
		 * 2.b. Font size controls for Posts & Pages
		 * --------------------------------------------------------------------------
		 *
		 * Title control [Posts & Pages]
		 * This control allows the user to choose a font size for the main titles
		 * that appear in the header for pages and posts.
		 *
		 * The values area between 0 and 60 rem.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[body_font_size]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 16,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[body_font_size]', array(
					'label'       => esc_html__( 'Body Font Size (px):', 'intrinsic' ),
					'description' => esc_html__('All font size is REM based. So please use slider to increase font size', 'intrinsic'),
					'section'     => 'intrinsic_typography_size',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 0.1,
					),
					'priority'    => 110,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Headings control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for all headings
		 * ( h1 - h6 ) from pages and posts.
		 *
		 * The values area between 0 and 60 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[site_title_font_size]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1.25,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[site_title_font_size]', array(
					'label'      => esc_html__( 'Site Logo/Title:', 'intrinsic' ),
					'description' => esc_html__('All font size is REM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 0.1,
					),
					'priority'   => 112,
					'sum_type'    => false,
				)
			)
		);		

		/**
		 * --------------------------------------------------------------------------
		 * Headings control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for all headings
		 * ( h1 - h6 ) from pages and posts.
		 *
		 * The values area between 0 and 60 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[menu_font_size]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 16,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[menu_font_size]', array(
					'label'      => esc_html__( 'Menu Font Size(px):', 'intrinsic' ),
					'section'    => 'intrinsic_typography_size',
					'description' => esc_html__('This font size is px based. So please use slider to increase font size', 'intrinsic'),
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 0.1,
					),
					'priority'   => 115,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Content control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for the main content
		 * area in pages and posts.
		 *
		 * The values area between 0 and +90 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[post_blockquote_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 25,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[post_blockquote_content]', array(
					'label'      => esc_html__( 'Block-Quote Font Size (px):', 'intrinsic' ),
					'description' => esc_html__('This font size is px based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 0.1,
					),
					'priority'   => 120,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Content control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for the main content
		 * area in pages and posts.
		 *
		 * The values area between -25 and +25 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[post_title_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1.953,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[post_title_content]', array(
					'label'      => esc_html__( 'Post Title Font Size:', 'intrinsic' ),
					'description' => esc_html__('All font size is REM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 0.1,
					),
					'priority'   => 120,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * 2.c. Font size controls for Frontpage
		 * --------------------------------------------------------------------------
		 * Big Title Section / Header Slider font size control. [Frontpage Sections]
		 *
		 * This is changing the big title/slider titles, the
		 * subtitle and the button in the big title section.
		 *
		 * The values are between 0 and 120 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[heading_one_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 2.441,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_one_content]', array(
					'label'      =>  esc_html__( 'H1:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 120,
						'step' => 0.1,
					),
					'priority'   => 210,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Section Title [Frontpage Sections]
		 *
		 * This control is changing sections titles and card titles
		 * The values are between 0 and 120 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[heading_two_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1.953,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_two_content]', array(
					'label'      => esc_html__( 'H2:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 120,
						'step' => 0.1,
					),
					'priority'   => 215,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * Subtitles control [Frontpage Sections]
		 * This control allows the user to choose a font size
		 * for all Subtitles on Frontpage sections.
		 * The values area between 0 and 105 px.
		 * -----------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[heading_three_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1.563,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_three_content]', array(
					'label'      => esc_html__( 'H3:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 105,
						'step' => 0.1,
					),
					'priority'   => 220,
					'sum_type'    => false,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * Content control [Frontpage Sections]
		 * This control allows the user to choose a font size
		 * for the Main content for Frontpage Sections
		 * The values area between 0 and 90 px.
		 * -----------------------------------------------------
		 */
		$wp_customize->add_setting(
			'intrinsic_options[heading_four_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1.25,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_four_content]', array(
					'label'      => esc_html__( 'H4:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 0.1,
					),
					'priority'   => 225,
					'sum_type'    => false,
				)
			)
		);

		$wp_customize->add_setting(
			'intrinsic_options[heading_five_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 1,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_five_content]', array(
					'label'      => esc_html__( 'H5:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 75,
						'step' => 0.1,
					),
					'priority'   => 226,
					'sum_type'    => false,
				)
			)
		);

		$wp_customize->add_setting(
			'intrinsic_options[heading_six_content]', array(
				'sanitize_callback' => 'intrinsic_sanitize_number_range',
				'default'           => 0.8,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Intrinsic_Customizer_Range_Value_Control(
				$wp_customize, 'intrinsic_options[heading_six_content]', array(
					'label'      => esc_html__( 'H6:', 'intrinsic' ),
					'description' => esc_html__('All Heading font size is EM based. So please use slider to increase font size', 'intrinsic'),
					'section'    => 'intrinsic_typography_size',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 0.1,
					),
					'priority'   => 227,
					'sum_type'    => false,
				)
			)
		);
	} // End if().
}

add_action( 'customize_register', 'intrinsic_typography_settings', 20 );

if ( ! function_exists( 'intrinsicfonts_inline_style' ) ) {
	/**
	 * Add inline style for custom fonts.
	 *
	 * @since 1.0
	 */

	function intrinsic_typo_header_scripts_css() {	
		// Custom CSS
		$custom_css = '';
		/**
		 * Body font family.
		 */ 

		$body_font = intrinsic_get_options( array('body_font', 'Dosis' ) );
		$body_font_color = intrinsic_get_options( array('body_font_color', '#3c3c3c' ) );

		if ( ! empty( $body_font ) ) {
			intrinsic_enqueue_google_font( $body_font );
			$custom_css .= 'body {font-family: ' . $body_font . '; color: '.$body_font_color.'; }';
		}
		/**
		 * Heading font family.
		 * All Font Size
		 */
		$headings_font = intrinsic_get_options( array('headings_font', 'Dosis' ) );

		if ( ! empty( $headings_font ) ) {
			intrinsic_enqueue_google_font( $headings_font );
			$custom_css .= 'h1, h2, h3, h4, h5, h6 { font-family: ' . $headings_font . '; color: '. intrinsic_get_options( array('heading_font_color', '#121212' ) ) .';}';

			$custom_css .= 'body { font-size: ' . esc_attr( intrinsic_get_options( array('body_font_size', 16 ) ) ) .'px;}';
			$custom_css .= '.navigation .mainmenu > li > a { font-size: ' . esc_attr( intrinsic_get_options( array('menu_font_size', 16 ) ) ) . 'px;}';
			$custom_css .= 'blockquote { font-size: ' . esc_attr( intrinsic_get_options( array('post_blockquote_content', 25 ) ) ) . 'px;}';
			$custom_css .= '.post .entry-title { font-size: ' . esc_attr( intrinsic_get_options( array('post_title_content', 1.953 ) ) ) . 'em;}';
			$custom_css .= 'h1 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_one_content', 2.441 ) ) ) . 'em;}';
			$custom_css .= 'h2 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_two_content', 1.953 ) ) ) . 'em;}';
			$custom_css .= 'h3 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_three_content', 1.563 ) ) ) . 'em;}';
			$custom_css .= 'h4 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_four_content', 1.25 ) ) ) . 'em;}';
			$custom_css .= 'h5 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_five_content', 1 ) ) ) . 'em;}';
			$custom_css .= 'h6 { font-size: ' . esc_attr( intrinsic_get_options( array('heading_six_content', 0.8 ) ) ) . 'em;}';
		}

		$site_title_font = intrinsic_get_options( array('site_title_font', 'Dosis' ) );
		$site_title_font_color = intrinsic_get_options( array('site_branding_color', '#ffffff' ) );
		$site_description_font_color = intrinsic_get_options( array('site_description_color', '#e1e1e1' ) );
		if(!empty($site_title_font)) {
			intrinsic_enqueue_google_font( $site_title_font );

			$site_logo_font = intrinsic_get_options( array('site_title_font_size', 1.25 ) );
			$custom_css .= '.site-branding-text .site-title { font-family: ' . $site_title_font . '; font-size: '. esc_attr( $site_logo_font ) .'em; color: '. $site_title_font_color .';}';
			$custom_css .= '.site-branding-text .site-description { color: '. $site_description_font_color .';}';
		}

		wp_add_inline_style( 'intrinsic-main-style', $custom_css );


	}
	add_action( 'wp_enqueue_scripts', 'intrinsic_typo_header_scripts_css', 300 );
}