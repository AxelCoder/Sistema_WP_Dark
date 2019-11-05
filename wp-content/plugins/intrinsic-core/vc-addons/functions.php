<?php 
/**
 *  Intrinsic Visual Composer Short-code
 *
 * @package Intrinsic
 * @since 1.0
 */
// We check if the Visual Composer plugin has been installed / activated.
if( !in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

class Intrinsic_Visual_Composer_Components {
	private static $instance = null;

	/**
	 * @since 1.0
	 */
	public static function get_instance() {
	    if ( ! self::$instance )
	       self::$instance = new self;
	    return self::$instance;
	}

	/**
	 * @since 1.0
	 */
	public function init(){
		//Include Visual Composer Files
		$this->includer_viusal_composer_components();
	}

	/**
	 * @since 1.0
	 */
	public function includer_viusal_composer_components() {
		//Require all PHP files in the /elementor/widgets directory
		foreach( glob( plugin_dir_path( __FILE__ ) . "addons/*.php" ) as $file ) {
		    require $file; 
		} 
	}
}

function intrinsic_vc_css_param() {
	return array(
        'type' => 'css_editor',
        'heading' => esc_html__( 'Css', 'intrinsic-core' ),
        'param_name' => 'css',
        'group' => esc_html__( 'Design options', 'intrinsic-core' ),
    );
}

Intrinsic_Visual_Composer_Components::get_instance()->init();