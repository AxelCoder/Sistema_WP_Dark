<?php
/*
Plugin Name: Intrinsic Core
Plugin URI: https://intrinsic.softhopper.net/
Description: This plugin is some component/shortcode/blocks and essential function for Intrinsic Creative Portfolio WordPress theme, To use Intrinsic theme properly you must install this plugin.
Author: SoftHopper
Version: 1.0.0
Author URI: https://softhopper.net/
Text Domain: intrinsic-core
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit; 

// Plugin Path
define( 'INTRINSIC_PLUGIN_PATH', ABSPATH . 'wp-content/plugins/intrinsic-core' );

// Plugin URL
define( 'INTRINSIC_PLUGIN_URL', plugins_url( '', __FILE__ ) );

/**
 * Include language
 */
add_action( 'after_setup_theme', 'intrinsic_load_plugin_textdomain' );
function intrinsic_load_plugin_textdomain() {
	load_plugin_textdomain( 'intrinsic-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
/**
 * Include Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'functions.php'; 
/**
 * Include Elementor Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'elementor/functions.php';

/**
 * Include Visual Composer Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'vc-addons/functions.php';

/**
 * Include Gutenberg Block Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'gutenberg-block/functions.php';

/**
 * Include Custom Posts
 */ 
require_once plugin_dir_path( __FILE__ ) . 'custom-post.php';

/**
 * Include Image Resizer
 */ 
require_once plugin_dir_path( __FILE__ ) . 'inc/aqua-resizer-master/aq_resizer.php';

/**
 * Include Metabox
 */
if ( is_admin() ) {
    require_once plugin_dir_path( __FILE__ ) . 'inc/metaboxes/metaboxes.php';
    require_once plugin_dir_path( __FILE__ ) . 'inc/demo-import/one-click-demo-import.php';
}