<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'intrinsic' ) );

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Intrinsic, use a find and replace
 * to change 'intrinsic' to the name of your theme in all the template files
 */
load_theme_textdomain( 'intrinsic', get_template_directory() . '/languages' );

/**
 * Add default posts and comments RSS feed links to head.
 * @package Intrinsic
 * @since 1.0
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 * @package Intrinsic
 * @since 1.0
 */
add_theme_support( 'title-tag' );

/**
 * Enable support for Post Thumbnails on posts and pages.
 * @package Intrinsic
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 * @since 1.0
 */
add_theme_support( 'post-thumbnails' );

/**
 * Enable support for register menu
 * @package Intrinsic
 * @since 1.0
 */
register_nav_menus( 
    array(
        'main-menu' => esc_html__( 'Main Menu', 'intrinsic' ),
    ) 
);

/**
 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
 * @package Intrinsic
 * @since 1.0
 */
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) 
);

/**
 * Enable support for custom background.
 * @package Intrinsic
 * @since 1.0
 */
add_theme_support( 'custom-background', apply_filters( 'intrinsic_custom_background_args', array (
    'default-color' => 'fff',
    'default-image' => '',
) ) );

/**
 * Enable support for custom Header Image.
 * @package Intrinsic
 * @since 1.0
 */
$args = array(
    'flex-width'    => true,
    'width'         => 1920,
    'flex-height'    => true,
    'height'        => 932,
);
add_theme_support( 'custom-header', $args );

/**
 * Enable support for custom Logo Image.
 * @package Intrinsic
 * @since 1.0
 */
$intrinsic_cutom_logo = array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
    'flex-width'  => true,
);
add_theme_support( 'custom-logo', $intrinsic_cutom_logo );


/** 
 * Enable WP Responsive embedded content
 *
 * @since 1.0
 */
add_theme_support( 'responsive-embeds' );

/** 
 * Enable WP Gutenberg Align Wide
 *
 * @since 1.0
 */
add_theme_support( 'align-wide' );


/** 
 * Enable selective refresh for widgets.
 *
 * @since 1.0
 */
add_theme_support( 'customize-selective-refresh-widgets' );

/** 
 * Enable WP Gutenberg Block Style
 *
 * @since 1.0
 */
add_theme_support( 'wp-block-styles' );

/**
 * Add Editor Style
 *
 * @since 1.0
 */
// Add support for editor styles.
add_theme_support( 'editor-styles' );

/**
 * Enable support for custom Editor Style.
 *
 * @since 1.0
 */
add_editor_style( 'custom-editor-style.css' );

/**
 * Enable fonts Google font family
 *
 * @since 1.0
 */
// Enqueue fonts in the editor.
add_editor_style( intrinsic_enqueue_google_fonts_url( intrinsic_get_options( array('body_font', 'Dosis' ) ) ) );

/** 
 * Enable Custom Color Scheme For Block Style
 *
 * @since 1.0
 */
add_theme_support( 'editor-color-palette', array(
    array(
        'name' => esc_html__( 'deep cerise', 'intrinsic' ),
        'slug' => 'deep-cerise',
        'color' => '#e51681',
    ),    
    array(
        'name' => esc_html__( 'strong magenta', 'intrinsic' ),
        'slug' => 'strong-magenta',
        'color' => '#a156b4',
    ),
    array(
        'name' => esc_html__( 'light grayish magenta', 'intrinsic' ),
        'slug' => 'light-grayish-magenta',
        'color' => '#d0a5db',
    ),
    array(
        'name' => esc_html__( 'very light gray', 'intrinsic' ),
        'slug' => 'very-light-gray',
        'color' => '#eee',
    ),
    array(
        'name' => esc_html__( 'very dark gray', 'intrinsic' ),
        'slug' => 'very-dark-gray',
        'color' => '#444',
    ),
    array(
        'name'  =>  esc_html__( 'strong blue', 'intrinsic' ),
        'slug'  => 'strong-blue',
        'color' => '#0073aa',
    ),
    array(
        'name'  =>  esc_html__( 'lighter blue', 'intrinsic' ),
        'slug'  => 'lighter-blue',
        'color' => '#229fd8',
    ),
) );

/** 
 * Block Font Sizes
 *
 * @since 1.0
 */
add_theme_support( 'editor-font-sizes', array(
    array(
        'name' => esc_html__( 'Small', 'intrinsic' ),
        'size' => 12,
        'slug' => 'small'
    ),
    array(
        'name' => esc_html__( 'Regular', 'intrinsic' ),
        'size' => 16,
        'slug' => 'regular'
    ),
    array(
        'name' => esc_html__( 'Large', 'intrinsic' ),
        'size' => 36,
        'slug' => 'large'
    ),
    array(
        'name' => esc_html__( 'Huge', 'intrinsic' ),
        'size' => 50,
        'slug' => 'larger'
    )
) );

/** 
 * Enable Support For WooCommerce Features
 *
 * @since 1.0
 */
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );