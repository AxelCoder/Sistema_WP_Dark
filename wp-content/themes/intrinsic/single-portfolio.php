<?php
/**
 * The template for displaying Portfolio Details
 *
 * This is the template that displays all Portfolio.
 *
 * @package Intrinsic
 */
get_header();

$elemetor = get_post_meta( get_the_ID(), '_elementor_edit_mode');
$page_builder = ( get_post_meta($post->ID, '_wpb_vc_js_status', true) == 'true' ) ? true : false;


$theme_color_version = intrinsic_get_options('theme_background_status');
if( $theme_color_version == 'dark' ) {
    $version_color = 'theme-dark';
} else {
    $version_color = 'theme-light';
}

if( $elemetor ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="intrinsic-page-builder-content <?php echo esc_attr( $version_color ); ?> page-content-main clearfix pd-t-195 pd-b-135">
            <div class="container">                
                <?php if( get_post_meta( get_the_ID(), 'intrinsic_show_page_title', true) !== 'no' ) {
                    the_title( '<h2 class="entry-title mrb-30">', '</h2>' );
                } ?>
                <?php if( get_post_meta( get_the_ID(), 'intrinsic_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail()) { ?>
                    <figure class="entry-thumb">           
                        <?php intrinsic_post_featured_image(1920, 750, true, false); ?>  
                    </figure><!-- /.entry-thumb -->
                <?php } ?>
            </div>
            <div class="pagebuilder-content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php 
        endwhile; 
    endif;
// If Visual Composer Page Builder
elseif( $page_builder == 1 ) :
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
        <div class="intrinsic-page-vc-container page-content-main <?php echo esc_attr( $version_color ); ?> pd-t-195 pd-b-135">
            <div class="container">
                <?php the_content(); ?> 
            </div><!--  /.container -->
        </div>
        <?php 
        endwhile; 
    endif;
else: ?>
    <section class="blog-page-block page-content-main <?php echo esc_attr( $version_color ); ?> pd-t-220 pd-b-120">
        <div class="container">
            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-12 full-content">
                    <div class="blog-page-content blog-single-page site-single-post">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                            <?php if( get_post_meta( get_the_ID(), 'intrinsic_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail() ) { ?>
                                <figure class="entry-thumb">          
                                    <?php intrinsic_post_featured_image(1140, 750, true, false); ?>       
                                </figure><!-- /.entry-thumb -->
                            <?php } ?>

                            <div class="entry-content">
                                <?php if( get_post_meta( get_the_ID(), 'intrinsic_show_page_title', true) !== 'no' ) { ?>
                                    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                <?php } ?> 
                                <?php 
                                    the_content(); 
                                    intrinsic_wp_link_pages(); 
                                ?>
                            </div><!-- /.entry-content -->
                        </article><!-- /.post -->
                    </div><!-- /.blog-page-content -->
                </div><!-- /.col-md-12 full-content -->
                <?php endwhile; ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-block -->
<?php endif; ?>
<?php get_footer(); ?>