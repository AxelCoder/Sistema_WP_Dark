<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Intrinsic for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 */
get_template_part('inc/libs/tgm-plugin-activation/class-tgm-plugin-activation');

add_action( 'tgmpa_register', 'intrinsic_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function intrinsic_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
		    'name'      => esc_html__('Elementor', 'intrinsic'),
		    'slug'      => 'elementor',
		    'required'  => true,
		), 	
		array(
		    'name'      => esc_html__('WPBakery Visual Composer', 'intrinsic'),
		    'slug'      => 'js_composer',
		    'version' 	=> '5.6',
		    'source'    => get_template_directory() . '/inc/libs/tgm-plugin-activation/plugins/js_composer.zip',
		    'required'  => false,
		), 
		array(
			'name'               => esc_html__('Intrinsic Core', 'intrinsic'), // The plugin name.
			'slug'               => 'intrinsic-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/libs/tgm-plugin-activation/plugins/intrinsic-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0',  
			'force_activation'   => false,  
			'force_deactivation' => false,  
			'external_url'       => '',  
			'is_callable'        => '', 
		),
		array(
		    'name'      => esc_html__('Envato Market', 'intrinsic'),
		    'slug'      => 'envato-market', 
		    'source' => get_template_directory() . '/inc/libs/tgm-plugin-activation/plugins/envato-market.zip', // The plugin source.
		    'external_url' => ''
		),		
		array(
		    'name'      => esc_html__('Contact Form 7', 'intrinsic'),
		    'slug'      => 'contact-form-7', 
		),	
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'intrinsic',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
