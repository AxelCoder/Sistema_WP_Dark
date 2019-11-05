<?php 

/**
 * Template functions part going here
 * @package Intrinsic
 */
if ( ! function_exists( 'intrinsic_preloader' ) ) :
    function intrinsic_preloader() {
        if( intrinsic_get_options('preloader') == true ) { ?>
        <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div><!-- /preloader-icon -->
            </div><!-- /preloader-inner -->
        </div><!-- /preloader -->
        <?php }
    }
endif;

/**
 *  Get theme options
 *
 * @since Intrinsic 1.0
 *
 * @return array intrinsic_options
 *
 */
if ( ! function_exists( 'intrinsic_get_options' ) ) :
    function intrinsic_get_options() {
        $result = get_theme_mod('intrinsic_options');
        foreach (func_get_args() as $arg) {
            if(is_array($arg)) {
                if (!empty($result[$arg[0]])) {
                    $result = $result[$arg[0]];
                } else {  
                  $result = $arg[1];
                }
            } else {
                if (!empty($result[$arg])) {
                    $result = $result[$arg];
                } else { 
                    $result = null;
                }
            }
        }
        return $result;
    }
endif;


/**
 * Return padding/margin values for customizer
 * @since Intrinsic 1.0
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_spacing_css' ) ) {

    function intrinsic_spacing_css( $top, $right, $bottom, $left ) {

        // Add px and 0 if no value
        $s_top      = ( isset( $top ) && '' !== $top ) ? intval( $top ) . 'px ' : '0px ';
        $s_right    = ( isset( $right ) && '' !== $right ) ? intval( $right ) . 'px ' : '0px ';
        $s_bottom   = ( isset( $bottom ) && '' !== $bottom ) ? intval( $bottom ) . 'px ' : '0px ';
        $s_left     = ( isset( $left ) && '' !== $left ) ? intval( $left ) . 'px' : '0px';
        
        // Return one value if it is the same on every inputs
        if ( ( intval( $s_top ) === intval( $s_right ) )
            && ( intval( $s_right ) === intval( $s_bottom ) )
            && ( intval( $s_bottom ) === intval( $s_left ) ) ) {
            return $s_left;
        }
        
        // Return
        return $s_top . $s_right . $s_bottom . $s_left;
    }
}