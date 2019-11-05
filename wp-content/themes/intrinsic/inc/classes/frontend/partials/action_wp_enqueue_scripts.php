<?php
/**
 * Front-End CSS and Scripts Files
 * @package Intrinsic
 * @since 1.0
 */ 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'intrinsic' ) );

$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

// enqueue styles
wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap'. $suffix .'.css' ) );
wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/fontawesome'. $suffix .'.css' ) );
wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup'. $suffix .'.css' ) );
wp_enqueue_style( 'odometer-theme', get_theme_file_uri( '/assets/css/odometer-theme-default'. $suffix .'.css' ) ); 
wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/assets/css/owl.carousel'. $suffix .'.css' ) ); 
wp_enqueue_style( 'intrinsic-style', get_theme_file_uri( '/assets/css/style'. $suffix .'.css' ) ); 
wp_enqueue_style( 'intrinsic-main-style', get_stylesheet_uri() ); 

// enqueue scripts
wp_enqueue_script( 'popper', get_theme_file_uri( '/assets/js/popper'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'imagesloaded', get_theme_file_uri( '/assets/js/imagesloaded.pkgd'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'isInViewport', get_theme_file_uri( '/assets/js/isInViewport.jquery'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/isotope.pkgd'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/assets/js/jquery.magnific-popup'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'odometer', get_theme_file_uri( '/assets/js/odometer'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/assets/js/owl.carousel'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'scrolla', get_theme_file_uri( '/assets/js/scrolla.jquery'. $suffix .'.js' ), array('jquery'), false, true);
wp_enqueue_script( 'intrinsic-main', get_theme_file_uri( '/assets/js/main'. $suffix .'.js' ), array('jquery'), false, true);

// localize scripts
wp_localize_script('intrinsic-main', 'intrinsic', array (
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    )
);

// Comment Reply Scripts
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}
