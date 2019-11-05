<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Intrinsic
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function intrinsic_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'intrinsic_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function intrinsic_jetpack_setup
add_action( 'after_setup_theme', 'intrinsic_jetpack_setup' );

function intrinsic_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	}
} // end function intrinsic_infinite_scroll_render