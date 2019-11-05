<?php 
/**
 *  Intrinsic Page Builder Shortcode
 *
 * @package Intrinsic
 * @since 1.0
 */
// We check if the Elementor plugin has been installed / activated.

if( !in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

class Intrinsic_Elementor_Widget {
 
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
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );

		add_action('elementor/frontend/after_register_scripts', array($this, 'register_frontend_scripts'), 10);

		add_action('elementor/frontend/after_register_styles', array($this, 'register_frontend_styles'), 10);

		add_action( 'elementor/elements/categories_registered', array( $this, 'elementor_widget_categories' ) );

		add_action( 'elementor/element/section/section_background/before_section_end', array( $this, 'add_elementor_section_background_controls' ) );
		add_action( 'elementor/frontend/section/before_render', array( $this, 'elementor_extension_included' ), 10);

	}

	// Add Parallax Control (Switch) to Section Element in the Editor.
	public function add_elementor_section_background_controls( $element ) {

		$element->add_control(
			'parallax_background_enable',
			[
				'label'					=> esc_html__( 'Parallax Background', 'intrinsic-core' ),
				'type' 					=> \Elementor\Controls_Manager::SWITCHER,
				'default' 				=> '',
				'label_on' 				=> esc_html__( 'Yes', 'intrinsic-core' ),
				'label_off' 			=> esc_html__( 'No', 'intrinsic-core' ),
				'return_value' 			=> 'yes',
				'frontend_available' 	=> true,
				'return_value' => 'parallax',
				'render_type'  => 'template',
				'prefix_class' => 'section-',
				'condition'				=> [
					'background_background' 	=> [ 'classic' ],
				]
			]
		);

	}

	public function elementor_extension_included( $widget ) {
		$settings = $widget->get_active_settings();
		if ( 'yes' === $settings['parallax_background_enable'] ) {
			$widget->add_render_attribute( '_wrapper', [
				'class' => 'section-parallax'
			] );
		}
	}

	/**
	 * @since 1.0
	 */
	public function widgets_registered() {
					
		//Require all PHP files in the /elementor/widgets directory
		foreach( glob( plugin_dir_path( __FILE__ ) . "widgets/*.php" ) as $file ) {
		    require $file; 
		} 
	}

	/**
	 * @since 1.0
	 */
	public function register_frontend_scripts() {
		wp_enqueue_script( 'intrinsic-frontend-widget-scripts',  plugin_dir_url( __FILE__ ) . 'assets/js/front-end-widget.js', array('jquery'), false, true);
		wp_register_script( 'morphext',  plugin_dir_url( __FILE__ ) . 'assets/js/morphext.min.js', array('jquery'), false, true);
		wp_register_script( 'typed',  plugin_dir_url( __FILE__ ) . 'assets/js/typed.min.js', array('jquery'), false, true);
		wp_register_script( 'eventmove',  plugin_dir_url( __FILE__ ) . 'assets/js/jquery.event.move.min.js', array('jquery'), false, true);
		wp_register_script( 'twentytwenty',  plugin_dir_url( __FILE__ ) . 'assets/js/jquery.twentytwenty.min.js', array('jquery'), false, true);
	}

	/**
	 * @since 1.0
	 */
	public function register_frontend_styles() {
		wp_register_style( 'twentytwenty', plugin_dir_url( __FILE__ ) . 'assets/css/twentytwenty.css', null, 1.0 );
	}


	/**
	 * @since 1.0
	 */
	public function elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'intrinsic-category',
			[
				'title' => esc_html__( 'Intrinsic Theme', 'intrinsic-core' ),
				'icon' => 'fa fa-plug',
			]
		);  
	}
}
 
Intrinsic_Elementor_Widget::get_instance()->init();