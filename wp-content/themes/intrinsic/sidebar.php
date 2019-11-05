<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Intrinsic
 * @since 1.0
 */
$theme_color_version = intrinsic_get_options('theme_background_status');
if( $theme_color_version == 'dark' ) {
    $version_blog = 'dark';
} else {
    $version_blog = 'light';
} ?>
<?php 
if( is_single() ) {
    $sidebar_id = "sidebar-single";
} elseif ( is_page() ) {
    $sidebar_id = "sidebar-page";
} else {
    $sidebar_id = "sidebar-blog";
}
if ( is_active_sidebar( $sidebar_id ) ) : ?>
    <div class="sidebar-items <?php echo esc_attr( $version_blog ); ?>">
        <?php dynamic_sidebar( $sidebar_id ); ?>
    </div><!-- /.sidebar-items -->
<?php endif; ?>