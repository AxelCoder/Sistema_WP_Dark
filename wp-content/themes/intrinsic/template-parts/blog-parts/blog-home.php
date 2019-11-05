<?php
/**
 * This template for displaying default layout
 *
 * @package Intrinsic
 * @since 1.0
 */

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
<section class="blog-page-block blog-content-main <?php echo esc_attr( $version_color ); ?> pd-t-150 pd-b-105">
    <div class="container">
        <!-- Title Row -->
        <div class="row">
            <div class="col-12 text-center">
                <?php if ( is_archive() || is_search() ): ?>
                <div class="section-title" data-bg-image="<?php header_image(); ?>">
                    <?php if ( is_archive() ) {
                        intrinsic_archive_title( '<h2 class="title-main">', '</h2>' );
                    } elseif ( is_search() ) { ?>
                        <h2 class="title-main"><?php printf( '<span>'. esc_html__( 'Search Results for : ', 'intrinsic' ) .'</span>%s', get_search_query() ); ?></h2>
                    <?php } ?>
                </div><!--  /.section-title -->
                <?php else: ?>
                    <div class="section-title" data-bg-image="<?php header_image(); ?>">
                        <h2 class="title-main"><?php echo esc_html__('Our Blog', 'intrinsic'); ?></h2><!-- /.title-main -->
                    </div><!--  /.section-title -->
                <?php endif; ?>
            </div><!--  /.col-12 -->
        </div><!--  /.row -->

        <!-- Content Row -->
        <div class="row">
            <?php 
                $sidebar_id = "sidebar-blog";
                $sidebar_position = intrinsic_get_options('blog_sidebar_dispay');
                if ( !is_active_sidebar( $sidebar_id ) ) {         
                    $post_columns_class = 'col-lg-11 full-content';
                    $sidebar_columns_class = '';       
                } else {
                    if ( $sidebar_position == 'full' ) {
                        $post_columns_class = 'col-lg-11 full-content';
                        $sidebar_columns_class = '';
                    } elseif ( $sidebar_position == 'left' ) {
                       $post_columns_class = 'col-lg-8 order-last layout-content';
                       $sidebar_columns_class = 'col-lg-4 order-first layout-sidebar';
                    } else {
                        $post_columns_class = 'col-lg-8 layout-content';
                        $sidebar_columns_class = 'col-lg-4 layout-sidebar';
                    }
                }
            ?>
            <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                <!-- Blog Items -->
                <div class="blog-latest-items <?php echo esc_attr($version_blog); ?>">
                    <?php 
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                if( get_post_type( get_the_ID() ) == 'portfolio' ) {
                                    get_template_part( 'template-parts/post/content', 'portfolio' );
                                } else {
                                    get_template_part( 'template-parts/post/content', get_post_format() );
                                }
                            endwhile;  
                        else :  
                            get_template_part( 'template-parts/post/content', 'none' ); 
                        endif; 
                    ?> 
                    
                    <?php intrinsic_posts_pagination_nav(); ?>
                </div><!--  /.blog-latest-items -->
            </div><!--  /.col-lg-8 -->

            <?php if( $sidebar_position !=='full' || !is_active_sidebar( $sidebar_id ) ) { ?>
            <div class="<?php echo esc_attr( $sidebar_columns_class ); ?>">
                <?php get_sidebar(); ?>
            </div><!-- /.col-lg-4 -->
            <?php } ?>
        </div><!--  /.row -->
    </div><!--  /.container -->  
</section><!-- /.blog-block -->