<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Intrinsic
 */
get_header();

$elemetor = get_post_meta( get_the_ID(), '_elementor_edit_mode');
$page_builder = ( get_post_meta($post->ID, '_wpb_vc_js_status', true) == 'true' ) ? true : false;

// If Elementor Page Builder
if( $elemetor ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="intrinsic-page-builder-elementor clearfix">
            <?php the_content(); ?>
        </div>
        <?php 
        endwhile; 
    endif;
// If Visual Composer Page Builder
elseif( $page_builder == 1 ) :
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
        <div class="intrinsic-page-vc-container">
            <div class="container">
                <?php the_content(); ?> 
            </div><!--  /.container -->
        </div>
        <?php 
        endwhile; 
    endif;
else: ?>
    <!-- Blog Block
    ================================================== -->
    <?php 
        $theme_color_version = intrinsic_get_options('theme_background_status');
        if( $theme_color_version == 'dark' ) {
            $version_color = 'theme-dark';
        } else {
            $version_color = 'theme-light';
        }
    ?>
    <section class="blog-page-block page-content-main <?php echo esc_attr( $version_color ); ?> pd-t-220 pd-b-105">
        <div class="container">
            <!-- Content Row -->
            <?php
                $sidebar_position = intrinsic_get_options('page_sidebar_dispay');
                if ( !is_active_sidebar( "sidebar-page" ) ) {
                    $post_columns_class = 'col-lg-10 full-content';
                    $sidebar_columns_class = '';
                } else {                
                    if ( $sidebar_position == 'right' ) {
                        $post_columns_class = 'col-lg-8 layout-content';
                        $sidebar_columns_class = 'col-lg-4 layout-sidebar';
                    } elseif ( $sidebar_position == 'left' ) {
                       $post_columns_class = 'col-lg-8 order-last layout-content';
                       $sidebar_columns_class = 'col-lg-4 order-first layout-sidebar';
                    } else {
                       $post_columns_class = 'col-lg-10 full-content';
                       $sidebar_columns_class = '';
                    }
                }
            ?>
            
            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                    <div class="blog-latest-items blog-single-page">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                            <?php if ( has_post_thumbnail() ) { ?>
                                <figure class="post-thumb">          
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        if ( $sidebar_position == 'right' ) {
                                            intrinsic_post_featured_image(730, 460, true, false);
                                        } elseif ( $sidebar_position == 'left' ) {
                                           intrinsic_post_featured_image(730, 460, true, false);
                                        } else {
                                            intrinsic_post_featured_image(924, 450, true, false);
                                        } ?>
                                    </a> 
                                </figure><!-- /.entry-thumb -->
                            <?php } ?>

                            <div class="post-details">
                                <?php if( get_post_meta( get_the_ID(), 'intrinsic_show_page_title', true) !== 'no' ) { ?> 
                                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                <?php } ?> 
                                <div class="entry-content">                            
                                    <?php 
                                        the_content(); 
                                        intrinsic_wp_link_pages(); 
                                    ?>
                                </div><!--  /.entry-content -->
                            </div><!-- /.entry-content -->
                        </article><!-- /.post -->
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif; ?>
                    </div><!-- /.blog-page-content -->
                    
                </div><!-- /.col-md-9 full-content -->
                <?php endwhile; ?>

                <?php if( $sidebar_position =='left' || $sidebar_position =='right' || !is_active_sidebar( "sidebar-page" ) ) { ?>
                <div class="<?php echo esc_attr( $sidebar_columns_class ); ?> ">
                    <?php get_sidebar(); ?>
                </div><!-- /.col-lg-4 -->
                <?php } ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-block -->
<?php endif; ?>
<?php get_footer(); ?>