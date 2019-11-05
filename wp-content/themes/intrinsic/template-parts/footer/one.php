<?php
/**
 * This template for displaying footer part
 *
 * @package Intrinsic
 * @since 1.0
 */

/**
 * Footer Part show/hide condition
 *
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'intrinsic_footer_show_footer', true) == 'no' ) {
    return;
} ?>

<!-- Footer
================================================== -->
<footer class="site-footer pd-t-75 pd-b-75">
    <div class="container text-center">
        <!-- Scroll Top -->
        <div class="row">
            <div class="col-12">
                <?php 
                $scrollOptions = intrinsic_get_options( 'scroll_top_btn' );
                if( $scrollOptions == true ) { ?>
                <a href="#top" class="back-to-top">
                    <span class="text"><?php echo wp_kses( intrinsic_get_options( array('scroll_top_text', __('Back <br>To Top','intrinsic') ) ), Intrinsic_Static::html_allow() ); ?></span>
                    <i class="fas fa-angle-up"></i>
                </a>
                <?php } ?>
            </div><!--  /.col-12 -->
        </div><!--  /.row -->

        <!-- Social Link -->
        <div class="row">
            <div class="col-12">
                <?php 
                $social_url_field = intrinsic_get_options('footer_social_url');
                $item_json_decode = json_decode($social_url_field);
                $item_open = intrinsic_get_options(array('social_profile_target','_blank'));
                if( !empty($social_url_field) ) : ?>
                    <ul class="footer-social mrt-30 mrb-30">
                    <?php foreach ($item_json_decode as $key ) { ?>
                        <li><a href="<?php echo esc_url($key->link); ?>" target="<?php echo esc_attr( $item_open ); ?>"><?php echo esc_html($key->title); ?></a></li>
                    <?php } ?>
                    </ul><!--  /.footer-social -->
                <?php endif; ?>
            </div><!--  /.col-12 -->
        </div><!--  /.row -->

        <!-- Copy Right -->
        <div class="row">
            <div class="col-12">
                <p class="copyright-text"><?php echo wp_kses( intrinsic_get_options( array('footer_copyright_info', __('Softhopper <i class="fas fa-heart"></i> 2019. All rights reserved','intrinsic') ) ), Intrinsic_Static::html_allow() ); ?></p>
            </div><!--  /.col-12 -->
        </div><!--  /.row -->
    </div><!--  /.container -->
</footer><!--  /.site-footer -->
