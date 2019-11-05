<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Intrinsic
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <?php if ( has_post_thumbnail() ) {  ?>
        <figure class="post-thumb">          
            <a href="<?php the_permalink(); ?>">
                <?php 
                $sidebar_position = intrinsic_get_options('blog_sidebar_dispay');
                if ( $sidebar_position == 'full' ) {
                    intrinsic_post_featured_image(924, 450, true, false);
                } elseif ( $sidebar_position == 'left' ) {
                   intrinsic_post_featured_image(730, 460, true, false);
                } else {
                    intrinsic_post_featured_image(730, 460, true, false);
                } ?>            
            </a> 
        </figure><!-- /.post-thumb -->
    <?php } ?>

    <div class="post-details blog-post-items">                            
        <?php 
            /* translators: %s: Permalinks of Posts */
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
        ?>
        <div class="entry-content">
            <?php 
                the_excerpt();
            ?>
        </div><!--  /.entry-content -->
    </div><!--  /.post-details -->
</article><!--  /.post -->