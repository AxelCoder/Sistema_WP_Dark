<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'intrinsic' ) );

register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Blog', 'intrinsic' ),
    'description'   => esc_html__( 'This sidebar will show in blog page', 'intrinsic' ),
    'id'            => 'sidebar-blog',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title"><span class="text">',
    'after_title'   => '</span><span class="large-border bg-deep-cerise"></span><span class="small-border bg-black"></span><span class="small-border bg-black"></span></h4>',
) );

register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Single', 'intrinsic' ),
    'description'   => esc_html__( 'This sidebar will show in blog single page', 'intrinsic' ),
    'id'            => 'sidebar-single',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s ">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title"><span class="text">',
    'after_title'   => '</span><span class="large-border bg-deep-cerise"></span><span class="small-border bg-black"></span><span class="small-border bg-black"></span></h4>',
) );

register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Page', 'intrinsic' ),
    'description'   => esc_html__( 'This sidebar will show in page', 'intrinsic' ),
    'id'            => 'sidebar-page',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s ">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title"><span class="text">',
    'after_title'   => '</span><span class="large-border bg-deep-cerise"></span><span class="small-border bg-black"></span><span class="small-border bg-black"></span></h4>',
) );
 