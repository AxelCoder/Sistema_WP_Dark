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
    <?php if ( has_post_thumbnail() ) { ?>
    <figure class="post-thumb">
        <?php 
            the_post_thumbnail( 'intrinsic-single-full', array( 'class' => " img-responsive", 'alt' => get_the_title() ));
        ?>
    </figure> <!-- /.post-thumb -->
    <?php } ?>

    <div class="post-details">                            
        <?php 
            /* translators: %s: Permalinks of Posts */
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
        ?>
        <div class="entry-content">
            <?php 
                the_content(); 
                intrinsic_wp_link_pages();
            ?>
        </div><!--  /.entry-content -->
    </div><!--  /.post-details -->
</article><!--  /.post -->
