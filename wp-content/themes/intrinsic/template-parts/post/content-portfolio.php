<?php
/**
 * The default template for displaying Portfolio content
 *
 * Used for both single and index/archive/search.
 *
 * @package Intrinsic
 * @since 1.0
 */
?>
<div class="portfolio-item" data-animate="hg-fadeInUp">
    <figure class="portfolio-thumb">
        <?php
            $image_size = get_post_meta(get_the_ID(), 'intrinsic_featured_image_masonry_size', true); 
            if( $image_size == 'x_x' ) {
                intrinsic_post_featured_image(550, 385, true, false); 
            } elseif ( $image_size == 'x_dx' ) {
                intrinsic_post_featured_image(550, 588, true, false); 
            } elseif ( $image_size == 'dx_x' ) {
                intrinsic_post_featured_image(550, 749, true, false); 
            } elseif ( $image_size == 'dx_dx' ) {
                intrinsic_post_featured_image(550, 441, true, false); 
            } else {
                intrinsic_post_featured_image(540, 411, true, false); 
            }
        ?>
        <div class="overlay-wrapper">
            <div class="overlay"></div><!--  /.overlay -->
            <div class="popup">
                <div class="popup-inner">
                    <a href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ) ); ?>" class="popup-image"><i class="fa fa-search"></i></a>
                </div><!--  /.popup-inner -->
            </div><!--  /.popup -->
        </div><!--  /.overlay-wrapper -->
    </figure><!-- /.portfolio-thumb -->
    <div class="content">
        <?php 
            $portfilio_cats = get_the_terms( get_the_ID(), 'portfolio-category' ); 
            $cats_name = "";
            foreach($portfilio_cats as $cat_name) {    
                $cats_name .= $cat_name->name.' '; 
            }
        ?>
        <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
        <div class="cate"><?php echo esc_html($cats_name); ?></div>
    </div>                      
</div><!--  /.portfolio-item -->