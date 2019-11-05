<?php
/**
 * Gutenberg Block Helpers
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package Intrinsic
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !function_exists( 'register_block_type' ) ) return;

/**
 * Intrinsic Gutenberg Blocks
 */
class Intrinsic_Gutenberg_blocks {

	/**
	 * @since 1.0
	 */
	public function __construct() {
		// Register Block Category Script
		add_filter( 'block_categories', array( $this, 'intrinsic_register' ), 10, 2 );

		// Register Editor Script
		add_action( 'init', array( $this, 'intrinsic_register_editor_script' ) );

		// // Register Editor Style
		add_action( 'init', array( $this, 'intrinsic_register_editor_style' ) );

		// Register Block
		add_action( 'init', array( $this, 'intrinsic_register_block' ) );

		// Image Size
		add_action( 'after_setup_theme', array( $this, 'intrinsic_blocks_image_size') );

		// PHP Block loading
		$this->intrinsic_include_php_blocks();
	}

	/**
	 * @since 1.0
	 * Intrinsic Register Editor Scripts
	 */
	public function intrinsic_register_editor_script() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Drop Cap Scripts
		wp_register_script(
		    'intrinsic_editor_script',
		    plugins_url( 'assets/js/block'. $suffix .'.js', __FILE__ ),
		    array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'  )
		);			

		// Get Contact Form 7 Short code
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[ esc_html__( 'No contact forms found', 'intrinsic-core' ) ] = 0;
		}

		wp_localize_script( 'intrinsic_editor_script', 'intrinsic_contact_form_7_parmas', array(
			'forms' => $contact_forms,
		));
	}
	/**
	 * @since 1.0
	 * Intrinsic Contact Form Render
	 */
	public function intrinsic_contact_form_render_block( $attributes ) {
		$form_id  = is_array( $attributes ) && isset( $attributes['form_id'] ) ? $attributes['form_id'] : false;
		$display_title       = isset( $attributes['displayFormTitle'] ) ? $attributes['displayFormTitle'] : true;
		$html = esc_html__('No Contact Form Selected', 'intrinsic-core');
		if ( $form_id ) {
			$html = do_shortcode( '[contact-form-7 id="'. $form_id .'" title="'. $display_title .'"]' );
		}

		$class = "intrinsic-contact-form-7";

		$block_content = sprintf(
			'<div class="%1$s">%2$s</div>',
			esc_attr( $class ),
			$html
		);
		return $block_content;
	}

	/**
	 * @since 1.0
	 * Intrinsic Register Editor Style
	 */
	public function intrinsic_register_editor_style() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		//Drop Cap Editor CSS
	    wp_register_style(
	        'intrinsic_editor_style',
	        plugins_url( 'assets/css/editor'. $suffix .'.css', __FILE__ ),
	        array( 'wp-edit-blocks' ),
	        filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/editor.css' )
	    );			   
	}
	/**
	 * @since 1.0
	 * Intrinsic Register Block Type
	 */
	public function intrinsic_register_block() {
		// Hero Banner
		register_block_type( 'intrinsic-core/hero-banner', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );

		// Intrinsic Advance Headings
		register_block_type( 'intrinsic-core/advance-headings', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );		

		// Service Item
		register_block_type( 'intrinsic-core/service-items', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );		

		// Progress bar Item
		register_block_type( 'intrinsic-core/progressbar-items', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );	

		// Counter Item
		register_block_type( 'intrinsic-core/counter-items', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );	

		// Call To Action
		register_block_type( 'intrinsic-core/call-to-action', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );		

		// Contact Form
		register_block_type( 'intrinsic-core/contact-form', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		    'render_callback' => array( $this, 'intrinsic_contact_form_render_block' ),
		) );	

		// Testimonials
		register_block_type( 'intrinsic-core/testimonial', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );		

		// Contact Info
		register_block_type( 'intrinsic-core/contact-info', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );		

		// Container
		register_block_type( 'intrinsic-core/section-container', array(
		    'editor_script' => 'intrinsic_editor_script',
		    'editor_style' => 'intrinsic_editor_style',
		) );
	}

	/**
	 * @since 1.0
	 * Intrinsic Register Local Data
	 */
	public function intrinsic_include_php_blocks() {
		/**
		 * Load Portfolio
		 */
		require_once plugin_dir_path( __FILE__ ) . 'php-blocks/portfolio.php';		

		/**
		 * Load Blog
		 */
		require_once plugin_dir_path( __FILE__ ) . 'php-blocks/blog.php';
	}

	/**
	 * @since 1.0
	 * Intrinsic Register Block
	 */
	public function intrinsic_register( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'intrinsic-blocks',
					'title' => esc_html__( 'Intrinsic Blocks', 'intrinsic-core' ),
				),
			)
		);
	}

	public function intrinsic_blocks_image_size( ) {
		// Portfolio Image Crop
		add_image_size( 'intrinsic-portfolio-x-x', 600, 600, true );
	}
}

new Intrinsic_Gutenberg_blocks;