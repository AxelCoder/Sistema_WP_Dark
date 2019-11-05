<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'intrinsic' ) );

if( ! class_exists( 'Intrinsic_Static' ) ) :
class Intrinsic_Static {

    /**
     * Allow HTML tag from escaping HTML 
     * 
     * @return void
     * @since v1.0
     */
    public static function html_allow() {
        return array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'del' => array(),
            'span' => array(),
            'em' => array(),
            'strong' => array(),
            'h1' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h2' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h3' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h4' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h5' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h6' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'div' => array(
                'class' => array(),
                'id' => array(),
            ),
            'p' => array(
                'class' => array(),
                'id' => array(),
            ),          
            'i' => array(
                'class' => array(),
                'id' => array(),
            ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_grid() {
        return array(
            '1' => esc_html__( '1 Grid', 'intrinsic' ),
            '2' => esc_html__( '2 Grid', 'intrinsic' ),
            '3' => esc_html__( '3 Grid', 'intrinsic' ),
            '4' => esc_html__( '4 Grid', 'intrinsic' ),
            '5' => esc_html__( '5 Grid', 'intrinsic' ),
            '6' => esc_html__( '6 Grid', 'intrinsic' ),
            '7' => esc_html__( '7 Grid', 'intrinsic' ),
            '8' => esc_html__( '8 Grid', 'intrinsic' ),
            '9' => esc_html__( '9 Grid', 'intrinsic' ),
            '10' => esc_html__( '10 Grid', 'intrinsic' ),
            '11' => esc_html__( '11 Grid', 'intrinsic' ),
            '12' => esc_html__( '12 Grid', 'intrinsic' ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_items() {
        return array(
            '2' => esc_html__( 'Two', 'intrinsic' ),
            '3' => esc_html__( 'Three', 'intrinsic' ),
            '4' => esc_html__( 'Four', 'intrinsic' ),
            '5' => esc_html__( 'Five', 'intrinsic' ),
            '6' => esc_html__( 'Six', 'intrinsic' ),
            '7' => esc_html__( 'Seven', 'intrinsic' ),
        );
    }

}

// Removing this line is like not having a functions.php file
new Intrinsic_Static;

endif;