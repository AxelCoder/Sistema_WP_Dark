<?php
/**
 * Intrinsic functions and definitions
 *
 * @package Intrinsic
 * @since 1.0
 */

/**
 * Include all conditional tags
 */
require get_parent_theme_file_path( '/inc/functions/conditional-tags.php' );

/**
 * Include Frontend_Master Class
 */
require get_parent_theme_file_path( '/inc/classes/frontend/master.php' );

/**
 * Include Backend_Master Class
 */
require get_parent_theme_file_path( '/inc/classes/backend/backend_master.php' );

/**
 * Include Backend_Master Class
 */
require get_parent_theme_file_path( '/inc/classes/static.php' );

/**
 * Query function to get post
 */
require get_parent_theme_file_path( '/inc/functions/theme-functions.php' );

/**
 * Include the Redux theme options framework
 */
require get_parent_theme_file_path( '/inc/functions/template-functions.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/functions/template-tags.php' );

/**
 * Customizer Basic Settings.
 */
require get_parent_theme_file_path( '/inc/customizer/basic-settings.php' );

/**
 * Sanitization Callback.
 */
require get_parent_theme_file_path( '/inc/customizer/sanitize-callback.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( '/inc/functions/jetpack.php' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/inc/libs/tgm-plugin-activation/tgm-admin-config.php' );

/**
 * WordPress comment seciton override 
 */
require get_parent_theme_file_path( '/inc/functions/wp-comment-section-override.php' );

/**
 * Query function to get post
 */
require get_parent_theme_file_path( '/inc/functions/function-for-post.php' );

/**
 * Include header, Hooks for template header
 */
require get_parent_theme_file_path( '/inc/frontend/header.php' );

/**
 * Include header, Hooks for template header
 */
require get_parent_theme_file_path( '/inc/frontend/footer.php' );

/**
 * Include override functions
 */
require get_parent_theme_file_path( '/inc/functions/wordpress-override.php' );
