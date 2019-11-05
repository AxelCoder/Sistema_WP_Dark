<?php 
/**
 *  Intrinsic Get Template Parts
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_get_template_part' ) ) :
    function intrinsic_get_template_part($part_name = "") {
        $part_style_url = (isset($_GET["{$part_name}_style"])) ? sanitize_text_field( wp_unslash( $_GET["{$part_name}_style"] ) ) : '';
        switch($part_style_url) { 
            case 'one': 
            case 'two': 
                $part_style = $part_style_url; break;
            default: $part_style = "one"; break;
        }  
        return get_template_part( "template-parts/$part_name/$part_style" );
    }
endif;

/**
 *  Intrinsic Excerpt Length
 *
 * @package Intrinsic
 * @since 1.0
 */
function intrinsic_excerpt_length($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if ( count($excerpt) >= $limit ) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

/**
 *  Intrinsic String To Excerpt
 *
 * @package Intrinsic
 * @since 1.0
 */
function intrinsic_string_to_excerpt($text = "", $limit = null) {
    $excerpt = explode(' ', $text, $limit);
    if ( count($excerpt) >= $limit ) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
