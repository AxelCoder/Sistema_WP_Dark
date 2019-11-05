<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Intrinsic
 * @since 1.0
 */
get_header(); ?> 

<!-- Error  Block
================================================== -->
<?php 
    $theme_color_version = intrinsic_get_options('theme_background_status');
    if( $theme_color_version == 'dark' ) {
        $version_color = 'theme-dark';
        $version_blog = 'dark';
    } else {
        $version_color = 'theme-light';
        $version_blog = 'light';
    }
?>
<section class="error-page-block <?php echo esc_attr( $version_color .' '. $version_blog ); ?> page-content-main">
    <div class="container error-content">
        <div class="row align-items-center">
            <div class="col-md-12">        
                <div class="error-right-blocks text-center">
                    <h2 class="error-main color-blue-violet"><?php esc_html_e('404', 'intrinsic'); ?></h2><!-- /.error-main -->
                    <h2 class="error-title text-uppercase"><?php esc_html_e('Looks Like You\'re Lost', 'intrinsic'); ?></h2><!-- /.error-title -->
                    <p class="error-descriptions"><?php esc_html_e('The page you are looking for not available!', 'intrinsic'); ?></p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-default go-home mrt-15"><?php esc_html_e('Go To Home', 'intrinsic'); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div><!--  /.col-md-7 -->
        </div><!--  /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-block -->
<?php get_footer(); ?>