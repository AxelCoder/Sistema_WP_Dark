<?php
/**
 *  Intrinsic Register Custom Post type
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_custom_posts' ) ) :
function intrinsic_custom_posts() {

    /* Portfolio Custom Post*/  
    $portfolio_label = array(
        'name' => esc_html_x('Portfolio', 'Post Type General Name', 'intrinsic'),
        'singular_name' => esc_html_x('Portfolio', 'Post Type Singular Name', 'intrinsic'),
        'menu_name' => esc_html__('Portfolio', 'intrinsic'),
        'parent_item_colon' => esc_html__('Parent Portfolio:', 'intrinsic'),
        'all_items' => esc_html__('All Portfolio', 'intrinsic'),
        'view_item' => esc_html__('View Portfolio', 'intrinsic'),
        'add_new_item' => esc_html__('Add New Portfolio', 'intrinsic'),
        'add_new' => esc_html__('New Portfolio', 'intrinsic'),
        'edit_item' => esc_html__('Edit Portfolio', 'intrinsic'),
        'update_item' => esc_html__('Update Portfolio', 'intrinsic'),
        'search_items' => esc_html__('Search Portfolio', 'intrinsic'),
        'not_found' => esc_html__('No portfolio found', 'intrinsic'),
        'not_found_in_trash' => esc_html__('No portfolio found in Trash', 'intrinsic'),
    );
    $portfolio_args = array(
        'label' => esc_html__('Portfolio', 'intrinsic'),
        'description' => esc_html__('Portfolio', 'intrinsic'),
        'labels' => $portfolio_label,
        'supports' => array('title', 'thumbnail', 'editor'),
        'taxonomies' => array('portfolio-category'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-screenoptions',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'rewrite' => array('slug' => 'portfolio'),
    );
    register_post_type('portfolio', $portfolio_args);   

    // Add new taxonomy, make it hierarchical (like categories) 
    $portfolio_cat_taxonomy_labels = array(
        'name'              => esc_html__( 'Portfolio Categories','intrinsic-core' ),
        'singular_name'     => esc_html__( 'Portfolio Categories','intrinsic-core' ),
        'search_items'      => esc_html__( 'Search Portfolio Category','intrinsic-core' ),
        'all_items'         => esc_html__( 'All Portfolio Category','intrinsic-core' ),
        'parent_item'       => esc_html__( 'Parent Portfolio Category','intrinsic-core' ),
        'parent_item_colon' => esc_html__( 'Parent Portfolio Category:','intrinsic-core' ),
        'edit_item'         => esc_html__( 'Edit Portfolio Category','intrinsic-core' ),
        'update_item'       => esc_html__( 'Update Portfolio Category','intrinsic-core' ),
        'add_new_item'      => esc_html__( 'Add New Portfolio Category','intrinsic-core' ),
        'new_item_name'     => esc_html__( 'New Portfolio Category Name','intrinsic-core' ),
        'menu_name'         => esc_html__( 'Portfolio Category','intrinsic-core' ),
    );    

    // Now register the portfolio taxonomy
    register_taxonomy('portfolio-category', array('portfolio'), array(
        'hierarchical' => true,
        'labels' => $portfolio_cat_taxonomy_labels,
        'query_var' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'portfolio-category' ),
    ));   
}
endif;
add_action('init', 'intrinsic_custom_posts', 0);

// Support Elementor Editor By Default
function intrinsic_elementor_post_type_support() {
    //if exists, assign to $cpt_support var
	$cpt_support = get_option( 'elementor_cpt_support' );
	
	//check if option DOESN'T exist in db
	if( ! $cpt_support ) {
	    $cpt_support = [ 'page', 'post', 'portfolio' ]; //create array of our default supported post types
	    update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
	} else if( ! in_array( 'portfolio', $cpt_support ) ) {
	    $cpt_support[] = 'portfolio'; //append to array
	    update_option( 'elementor_cpt_support', $cpt_support ); //update database
	}
	
	//otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'init', 'intrinsic_elementor_post_type_support' );