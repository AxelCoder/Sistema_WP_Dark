<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'intrinsic' ) );
if( ! class_exists( 'Intrinsic_Master' ) ) :
    class Intrinsic_Master {
        /**
         * Call all loading functions for the theme. They will be started right after theme setup.
         * 
         * @since v1.0
         */
        public function __construct() { 
            // Run after instalation setup.
            $this->theme_setup();

            // Register actions using add_actions() custom function.
            $this->add_actions();
        }

        /**
         * Initial theme setup
         * 
         * Loading scripts and stylesheets. Register custom elements
         * and functionality in the theme.
         * 
         * @uses get_template_directory_uri()
         * @uses add_theme_support()
         * @since v1.0
         */
        public function theme_setup() {
            // Set content width for custom media information
            global $content_width;
            if ( ! isset( $content_width ) ) $content_width = 1020;
        }


        /**
         * Add actions and filters in wordpress theme. All the actions will be here.
         * 
         * @uses add_action()
         * @uses add_filter()
         * @since v1.0
         */
        public function add_actions() {

            // Register all wp scripts and styles
            add_action( 'wp_enqueue_scripts', array($this, 'load_wp_scripts_and_styles') );

            // Post title filter.
            add_filter( "wp_title", array( $this, "page_title" ) );

            // Change excerpt lenght
            add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 10 );

            // Add read more link instead of [...]
            add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
            add_filter( 'the_content_more_link', array( $this, 'excerpt_more' ) );
        }

        /**
         * Loading scripts and stylesheets for Innocence
         * The order of initialising bootstrap css files is important
         * for the theme responsivness work proerly.
         * 
         * @uses wp_enqueue_style()
         * @since v1.0
         */
        public function load_wp_scripts_and_styles() {
            get_template_part('inc/classes/frontend/partials/action_wp_enqueue_scripts');
        } 

        /**
         * Write the theme title. It doesnt return anything.
         * The simple name comes, because its very natural when call it:
         * Header::title();
         * 
         * @uses get_bloginfo()
         * @uses wp_title()
         * @uses is_home()
         * @uses is_front_page();
         * 
         * @since  v1.0
         */
        public function page_title( $title, $sep = ' | ' ) {
            global $page, $paged;

            if ( is_feed() )
                return $title;

            $site_description = get_bloginfo( 'description' );

            $filtered_title = $title . get_bloginfo( 'name' );
            $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? $sep . $site_description: '';
            /* translators: %s: Page Number */
            $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? $sep . sprintf( __( 'Page %s', 'intrinsic' ), max( $paged, $page ) ) : '';

            return $filtered_title;
        }

        /**
         * Change the default valued for length of the post excerpt.
         * @param  int $length The length of desired excerpt. (for all pages and all calls)
         * @return int         Hardcoded value of the excerpt length
         */
        public function excerpt_length( $length ) {
            if ( is_admin() ) {
                return $length;
            } else {            
                $length = intrinsic_get_options(array('excerpt_length','25'));
                return $length;
            }
        }

        /**
         * Change the default valued for after the post excerpt.
         * @param  string $more Not used vcariable, wanted from WP
         * @return string       Link for the post.
         */
        public function excerpt_more( $more ) { 
            return '<a href="' . get_permalink() . '" class="more-link">' . esc_html__( 'Read More', 'intrinsic' ) . '<i class="fa fa-arrow-right"></i></a>';
        }
    }

    // Removing this line is like not having a functions.php file
    new Intrinsic_Master;
endif;