<?php 
/**
 *  Intrinsic page meta box
 *
 * @package Intrinsic
 * @since 1.0
 */

class Intrinsic_Metabox {
 
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
		add_action( 'plugins_loaded', array( $this, 'load_butterbean' ) );
        add_action( 'butterbean_register', array( $this, 'add_metabox' ), 10, 2 );
	}

	/**
	 * @since 1.0
	 */
	public function load_butterbean() {
        require_once plugin_dir_path( __FILE__ ) . 'butterbean/butterbean.php';
	}

	/**
	 * @since 1.0
	 */
	public function add_metabox( $butterbean, $post_type ) {
        // Post types to add the metabox to
        $post_type = array(
            'post',
            'page',
            'product',
            'elementor_library',
            'ae_global_templates',
        );
        
        $prefix = 'intrinsic_mb_';
        
        $butterbean->register_manager(
            $prefix . 'settings',
            array(
                'label'     => esc_html__( 'Custom Settings', 'intrinsic-core' ),
                'post_type' => $post_type,
                'context'   => 'normal',
                'priority'  => 'high'
            )
        ); 
        $manager = $butterbean->get_manager( $prefix . 'settings' );

        // layout
        $manager->register_section(
            $prefix . 'layout',
            array(
                'label' => esc_html__( 'Layout', 'intrinsic-core' ),
                'icon'  => 'dashicons-admin-generic'
            )
        );

        $manager->register_control(
            $prefix . 'header_part', // Same as setting name.
            array(
                'section' => $prefix . 'layout',
                'type'          => 'radio',
                'label'         => esc_html__( 'Header Part', 'intrinsic-core' ), 
                'choices'       => array(
                    'show'      => esc_html__( 'Show', 'intrinsic-core' ),
                    'hide'   => esc_html__( 'Hide', 'intrinsic-core' ), 
                ),
            )
        ); 
        $manager->register_setting(
            $prefix . 'header_part', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'show',
            )
        ); 

        $manager->register_control(
            $prefix . 'footer_part', // Same as setting name.
            array(
                'section' => $prefix . 'layout',
                'type'          => 'radio',
                'label'         => esc_html__( 'Footer Part', 'intrinsic-core' ), 
                'choices'       => array(
                    'show'      => esc_html__( 'Show', 'intrinsic-core' ),
                    'hide'   => esc_html__( 'Hide', 'intrinsic-core' ), 
                ),
            )
        ); 
        $manager->register_setting(
            $prefix . 'footer_part', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'show',
            )
        );

        $butterbean->register_manager(
            $prefix . 'service_settings',
            array(
                'label'     => esc_html__( 'Service Meta', 'intrinsic-core' ),
                'post_type' => 'service',
                'context'   => 'normal',
                'priority'  => 'high'
            )
        ); 
        $manager = $butterbean->get_manager( $prefix . 'service_settings' );

        // service_setting
        $manager->register_section(
            $prefix . 'service_setting',
            array(
                'label' => esc_html__( 'Service Content', 'intrinsic-core' ),
                'icon'  => 'dashicons-admin-generic'
            )
        );

        $manager->register_control(
            $prefix . 'service_icon', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'text',
                'label'         => esc_html__( 'Service Icon', 'intrinsic-core' ),  
                'description'   => esc_html__( 'You can also add bootstrap class like: fa fa-facebook', 'intrinsic-core' ),  
            )
        ); 
        $manager->register_setting(
            $prefix . 'service_icon', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'gra-laptop',
            )
        ); 

        $manager->register_control(
            $prefix . 'short_title', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'text',
                'label'         => esc_html__( 'Short Title', 'intrinsic-core' ),   
            )
        ); 
        $manager->register_setting(
            $prefix . 'short_title', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => esc_html__( 'Web Designing', 'intrinsic-core' ),
            )
        );

        $manager->register_control(
            $prefix . 'short_desc', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'textarea',
                'label'         => esc_html__( 'Short Description', 'intrinsic-core' ),   
            )
        ); 
        $manager->register_setting(
            $prefix . 'short_desc', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => esc_html__( 'Her extensive perceived may any sincerity extremity', 'intrinsic-core' ),
            )
        ); 
 
		  
	}
}
 
Intrinsic_Metabox::get_instance()->init();