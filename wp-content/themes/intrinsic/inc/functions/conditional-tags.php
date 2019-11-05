<?php
/**
 * One Click Demo Importer
 *
 * @package Intrinsic
 */

function intrinsic_theme_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           =>     esc_html__('Intrinsic Light Version','intrinsic'),
            'import_file_url'            =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/light/content.xml'),
            'import_widget_file_url'     =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/light/widgets.wie'),
            'import_customizer_file_url' =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/light/customizer.dat'),
            'import_preview_image_url'   =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/light/screenshot-light.png'),
            'import_notice'              =>     esc_html__( 'Before importing demo data you must have to install required plugins', 'intrinsic' ),
            'preview_url'                =>     esc_url('http://intrinsic.softhopper.net'),
        ),        
        array(
            'import_file_name'           =>     esc_html__('Intrinsic Dark Version','intrinsic'),
            'import_file_url'            =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/dark/content.xml'),
            'import_widget_file_url'     =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/dark/widgets.wie'),
            'import_customizer_file_url' =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/dark/customizer.dat'),
            'import_preview_image_url'   =>     esc_url('http://intrinsic.softhopper.net/intrinsic-demos/dark/screenshot-dark.png'),
            'import_notice'              =>     esc_html__( 'Before importing demo data you must have to install required plugins', 'intrinsic' ),
            'preview_url'                =>     esc_url('http://intrinsic.softhopper.net/dark'),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'intrinsic_theme_ocdi_import_files' );


function intrinsic_theme_ocdi_after_import_setup( $selected_import ) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    if ( 'Intrinsic Light Version' === $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Light' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    } elseif ( 'Intrinsic Dark Version' === $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Dark' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'intrinsic_theme_ocdi_after_import_setup' );


function intrinsic_theme_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Intrinsic Demo Import' , 'intrinsic' );
    $default_settings['menu_title']  = esc_html__( 'Demo Importer' , 'intrinsic' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'intrinsic-one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'intrinsic_theme_ocdi_plugin_page_setup' );