<?php 
/**
 * Some theme and plugin functions goes here
 * =========================================
 */

/**
 *  Intrinsic Image Dimension Issue
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_image_resize_dimensions' ) ) :
    function intrinsic_image_resize_dimensions() {
        remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );
    }
endif;

/**
 *  Remove Unnecessary p and br tag from shortcode
 *
 * @package Intrinsic
 * @since 1.0
 */
if( !function_exists('intrinsic_fix_shortcodes') ) :
    function intrinsic_fix_shortcodes($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;   
    }
    add_filter('the_content', 'intrinsic_fix_shortcodes');
endif;

/**
 *  Intrinsic Social Post Share
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_social_share_link' ) ) :
function intrinsic_social_share_link( $before_text = "" ) { ?>
    <div class="entry-share">
        <?php if($before_text != ""): ?> 
        <span class="share-head"><?php echo esc_html($before_text); ?></span>    
        <?php endif; ?> 
        <ul class="social-item remove-broswer-defult">
            <!-- facebook share -->
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Facebook', 'intrinsic-core' ); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="intrinsic_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
               <i class="fab fa-facebook"></i>
            </a></li>
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Twitter', 'intrinsic-core' ); ?>" href="https://twitter.com/home?status=<?php the_permalink(); ?>"  onclick="intrinsic_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-twitter"></i>
            </a></li>

            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on GooglePlus', 'intrinsic-core' ); ?>" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="intrinsic_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-google-plus"></i>
            </a></li>

            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Linkedin', 'intrinsic-core' ); ?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onclick="intrinsic_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-linkedin"></i>
            </a></li>
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Pinterest', 'intrinsic-core' ); ?>" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                <i class="fab fa-pinterest-p"></i>
            </a></li> 
        </ul>
    </div><!-- /.entry-share --> 
    <?php
}
endif;

/**
 *  Return Mailchimp Functions
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! function_exists( 'intrinsic_mail_chimp_functions' ) ) :
    function intrinsic_mail_chimp_functions() {
        if( get_post_meta( get_the_ID(), 'intrinsic_footer_mail_chimp', true) == 'yes' ) {
            $enableMailChimp = true;
        } elseif( get_post_meta( get_the_ID(), 'intrinsic_footer_mail_chimp', true) == 'no' ) {
            $enableMailChimp = false;
        } else {
            $enableMailChimp = intrinsic_get_options('mail_chimp_visivility');
        }

        if( $enableMailChimp == true ) {
            echo do_shortcode( '[mc4wp_form]' );
        }
    } 
endif;

/**
 *  Remove Query String
 *
 * @package Intrinsic
 * @since 1.0
 */
function intrinsic_remove_query_string_one( $src ){   
    $rqs = explode( '?ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) { 
    add_filter( 'script_loader_src', 'intrinsic_remove_query_string_one', 15, 1 );
    add_filter( 'style_loader_src', 'intrinsic_remove_query_string_one', 15, 1 );
}

function intrinsic_remove_query_string_two( $src ){
    $rqs = explode( '&ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) { 
    add_filter( 'script_loader_src', 'intrinsic_remove_query_string_two', 15, 1 );
    add_filter( 'style_loader_src', 'intrinsic_remove_query_string_two', 15, 1 );
}