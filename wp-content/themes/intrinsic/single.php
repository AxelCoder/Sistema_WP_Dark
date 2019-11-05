<?php
/**
 * The template for displaying all single posts.
 *
 * @package Intrinsic
 * @since 1.0
 */
get_header(); 

$theme_color_version = intrinsic_get_options('theme_background_status');
if( $theme_color_version == 'dark' ) {
    $version_color = 'theme-dark';
    $version_blog = 'dark';
} else {
    $version_color = 'theme-light';
    $version_blog = 'light';
} ?>

<!-- Blog Page Block
================================================== -->
<div class="blog-page-block blog-single-spacing <?php echo esc_attr( $version_color ); ?> pd-t-220 pd-b-105">
    <div class="container">
        <?php
            if( get_post_meta( get_the_ID(), 'intrinsic_sidebar_position', true) && get_post_meta( get_the_ID(), 'intrinsic_sidebar_position', true) !=='default' ) {
                $sidebar_position = get_post_meta( get_the_ID(), 'intrinsic_sidebar_position', true);
                if ( $sidebar_position == 'full' ) {
                    $post_columns_class = 'col-lg-10 full-content';
                    $sidebar_columns_class = '';
                } elseif ( $sidebar_position == 'left' ) {
                    $post_columns_class = 'col-lg-8 order-last layout-content';
                    $sidebar_columns_class = 'col-lg-4 order-first layout-sidebar';
                } else {
                    $post_columns_class = 'col-lg-8 layout-content';
                    $sidebar_columns_class = 'col-lg-4 layout-sidebar';
                }
            } else {
                if ( !is_active_sidebar( "sidebar-single" ) ) { 
                    $post_columns_class = 'col-lg-10 full-content';
                    $sidebar_columns_class = '';
                } else {                
                    $sidebar_position = intrinsic_get_options('blog_single_sidebar_dispay');
                    if ( $sidebar_position == 'full' ) {
                        $post_columns_class = 'col-lg-10 full-content';
                        $sidebar_columns_class = '';
                    } elseif ( $sidebar_position == 'left' ) {
                        $post_columns_class = 'col-lg-8 order-last layout-content';
                        $sidebar_columns_class = 'col-lg-4 order-first layout-sidebar';
                    } else {
                        $post_columns_class = 'col-lg-8 layout-content';
                        $sidebar_columns_class = 'col-lg-4 layout-sidebar';
                    }
                }
            }
        ?>
        <!-- Content Row -->
        <div class="row">
            <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                <!-- Blog Items -->
                <div class="blog-latest-items blog-single-page <?php echo esc_attr( $version_blog ); ?>">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                        <?php if ( has_post_thumbnail() ) { ?>
                            <figure class="post-thumb">
                                <?php 
                                if ( $sidebar_position == 'full' ) {
                                    intrinsic_post_featured_image(924, 450, true, false);
                                } elseif ( $sidebar_position == 'left' ) {
                                    intrinsic_post_featured_image(730, 470, true, false);
                                } else {
                                    intrinsic_post_featured_image(730, 470, true, false);
                                } ?> 
                            </figure><!-- /.post-thumb -->
                        <?php } ?>

                        <div class="post-details">                            
                            <ul class="entry-meta remove-broswer-defult">
                                <li class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
                                <?php if( function_exists('intrinsic_estimated_reading_time') ) { ?>
                                <li class="time-need"><i class="fa fa-clock"></i> <?php echo wp_kses_post( intrinsic_estimated_reading_time( get_the_content() ) ); ?> <?php esc_html_e('Minute to read', 'intrinsic'); ?></li>
                                <?php } ?>
                                <li class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', '); ?></li>
                            </ul>
                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 

                            <div class="entry-content">
                                <?php 
                                    the_content(); 
                                    intrinsic_wp_link_pages(); 
                                ?>
                            </div><!--  /.entry-content -->
                            <?php if( has_tag() ): ?>
                            <div class="entry-tag mrt-20">
                                <?php the_tags(' ', ' ', ' '); ?>
                            </div><!-- /.entry-tag -->
                            <?php endif; ?>
                        </div><!--  /.post-details -->
                    </article><!--  /.post -->
                    <?php endwhile; ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                        comments_template();
                        endif;
                    ?>
                </div><!--  /.blog-latest-items -->
            </div><!--  /.col-lg-8 -->

            <?php if( intrinsic_get_options('blog_single_sidebar_dispay') !=='full' || !is_active_sidebar( "sidebar-single" ) ) { ?>
            <div class="<?php echo esc_attr( $sidebar_columns_class ); ?>">
                <?php get_sidebar(); ?>
            </div><!-- /.col-lg-4 -->
            <?php } ?>
        </div><!--  /.row -->
    </div><!--  /.container -->
</div><!--  /.blog-page-block -->
<?php get_footer(); ?>