<?php
/**
 * Theme Helpers
 *
 * @package Intrinsic
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(! class_exists( 'Intrinsic_Helpers' ) ) {
    /**
     * The Intrinsic Helpers
     */
    class Intrinsic_Helpers {
        
        public function __construct() {
            //Print Theme Colors
            $this->intrinsic_color();

            //Print Heading Colors
            $this->intrinsic_main_headings_color();

            //Theme Version Color
            $this->intrinsic_theme_version_color();            

            //Header Color Background and styles
            $this->intrinsic_backgound_image_cover_bg();

            //Spacing Elements
            $this->intrinsic_spaing_elements( );            

            //Page Elements
            $this->intrinsic_page_elements( );
        }
        /**
         * Hexa to RGBA Convector
         *
         * @package Intrinsic
         * @since 1.0
         */
        private function intrinsic_hex_2_rgba($color, $opacity = false) {
            $default = 'rgb(0,0,0)';
            //Return default if no color provided
            if(empty($color))
                return $default; 
         
            //Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }
         
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                return $default;
            }
         
            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);
         
            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }
         
            //Return rgb(a) color string
            return $output;
        }

        /**
         * Theme Colors
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_color() {  
            $setting_color = intrinsic_get_options(array('theme_color', '#7540ee'));
            switch( $setting_color ) {
                case '1':  
                    // add a condition to show demo color scheme by url
                    ( isset($_GET["color_scheme_color"]) ) ? $color_scheme_color = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) )  : $color_scheme_color = "" ;
                    if (preg_match('/^[A-Z0-9]{6}$/i', $color_scheme_color)) {
                        $demo_color_scheme = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) );
                    }
                    else {
                       $demo_color_scheme = "e7272d";
                    }
                    $intrinsic_color = "#".$demo_color_scheme; 
                    break;
                case '2': 
                    $intrinsic_color = "#d12a5c";
                    break;
                case '3': 
                    $intrinsic_color = "#49ca9f";
                    break;
                case '4': 
                    $intrinsic_color = "#1f1f1f";
                    break;
                case '5': 
                    $intrinsic_color = "#808080";
                    break;
                case '6': 
                    $intrinsic_color = "#ebebeb";
                    break;
                default: 
                    $intrinsic_color = intrinsic_get_options(array('theme_color', '#e51681'));
                    break; 
            }
            //rgba color
            $intrinsic_rgba_color = $this->intrinsic_hex_2_rgba($intrinsic_color, 0.90); ?>
            a:hover, a:focus, a:active {color: <?php echo esc_attr($intrinsic_color); ?>; } label a {color: <?php echo esc_attr($intrinsic_color); ?>; } .top-nav-collapse.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li.active > a, .navbar-default .navbar-nav > li.active > a:focus, .navbar-default .navbar-nav > li.active > a:hover { color: <?php echo esc_attr($intrinsic_color); ?> !important; } .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {background-color: <?php echo esc_attr($intrinsic_color); ?>; border-color: <?php echo esc_attr($intrinsic_color); ?>;} .blog-item .blog-content .post-meta a { color: <?php echo esc_attr($intrinsic_color); ?> } .blog-item.sticky {border-bottom-color: <?php echo esc_attr($intrinsic_color); ?>} .signle-post-content .entry-content a { color: <?php echo esc_attr($intrinsic_color); ?> } .signle-post-content .entry-tag a {background: <?php echo esc_attr($intrinsic_color); ?> } .post-password-form input[type="submit"] {background: <?php echo esc_attr($intrinsic_color); ?>} .comments .single-comment-content .single-comment-content-head a.comment-reply-link {color: <?php echo esc_attr($intrinsic_rgba_color); ?>} .btn-dark, .comment-navigation a {background: <?php echo esc_attr($intrinsic_rgba_color); ?>} .btn-dark:hover, .btn-dark:active, .btn-dark:focus, .btn-dark:active:focus, .btn-dark.active.focus, .btn-dark.active:focus, .btn-dark.focus, .btn-dark:active:focus, .btn-dark:focus { color: <?php echo esc_attr($intrinsic_rgba_color); ?>; border-color: <?php echo esc_attr($intrinsic_rgba_color); ?>; } .single-comment-content a {color: <?php echo esc_attr($intrinsic_rgba_color); ?>} .comment-respond .logged-in-as a {color: <?php echo esc_attr($intrinsic_rgba_color); ?>} .searchform .btn {background: <?php echo esc_attr($intrinsic_rgba_color); ?>} .widget_calendar a, .widget a:hover {color: <?php echo esc_attr($intrinsic_rgba_color); ?>} .bg-deep-cerise {background: <?php echo esc_attr($intrinsic_color); ?>} .pagination-block .pagination li.active a {background: <?php echo esc_attr($intrinsic_color); ?>} .blog-sidebar-content .widget-title:before, .blog-sidebar-content .widget-title:after {background: <?php echo esc_attr($intrinsic_color); ?>} .woocommerce nav.woocommerce-pagination ul li > span.current, .woocommerce-single-content .woocommerce-tabs ul.tabs li.active a {background: <?php echo esc_attr($intrinsic_color); ?>} .woocommerce span.onsale {background-color: <?php echo esc_attr($intrinsic_color); ?>} .woocommerce-single-content .single_add_to_cart_button {background: <?php echo esc_attr($intrinsic_color); ?> !important;} .contact-sticky-button {background: <?php echo esc_attr($intrinsic_color); ?>} .mini-service-list > li > i { background: <?php echo esc_attr($intrinsic_color); ?> } .comment-reply-link:hover, .single-post-footer .entry-tag a:hover, .comment-respond #submit, .comment-respond .submit { background: <?php echo esc_attr($intrinsic_color); ?>; border-color:  <?php echo esc_attr($intrinsic_color); ?>;  } @media only screen and (max-width: 767px) { .mainmenu li a:after { border-top-color: <?php echo esc_attr($intrinsic_color); ?>; }} .color-blue-violet { color: <?php echo esc_attr($intrinsic_color); ?>; } .single-post-footer .post-navigation a:hover .navigation-text { background-color: <?php echo esc_attr($intrinsic_color); ?>; border-color: <?php echo esc_attr($intrinsic_color); ?>; } .blog-page-content:not(.blog-single-page) .more-link:hover { background: <?php echo esc_attr($intrinsic_color); ?>; } body:not(.bbpress) .blog-single-page .entry-content .entry-title, body:not(.buddypress) .blog-single-page .entry-content .entry-title, .blog-page-content:not(.blog-single-page) .entry-title { color: <?php echo esc_attr($intrinsic_color); ?>; } .title-divider span:nth-child(1), .title-divider span:nth-child(2) { border-right-color: <?php echo esc_attr($intrinsic_color); ?>; } .title-divider:before, .title-divider:after { background: <?php echo esc_attr($intrinsic_color); ?>; } .intrinsic-page-gutenberg-content > .entry-title {  color: <?php echo esc_attr($intrinsic_color); ?>; } .tagcloud a, .entry-content .page-links > span { background: <?php echo esc_attr($intrinsic_color); ?>; } .entry-content .page-links > span { border-color: <?php echo esc_attr($intrinsic_color); ?>; } .error-page-block .error-main, .error-page-block .go-home { color: <?php echo esc_attr($intrinsic_color); ?>; }
            <?php
        } // end intrinsic_color function

        /**
         * Title Color
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_main_headings_color() {
                $header_text_color = get_theme_mod('header_textcolor');
                if(!empty( $header_text_color) && $header_text_color !== 'blank' ) {
                    $head_text_color = $header_text_color;
                } else {
                    $head_text_color = '121212';
                } ?>
                .blog-page-block .section-title .title-main { color: #<?php echo esc_attr( $head_text_color ); ?> } .preloader { background-color:  <?php echo esc_attr( intrinsic_get_options(array('theme_preloader_bg', '#12141c'))); ?> } .preloader-icon span { background-color:  <?php echo esc_attr( intrinsic_get_options(array('theme_preloader_buble_color', '#e51681'))); ?> } .site-branding-text .site-title { color: <?php echo esc_attr( intrinsic_get_options(array('site_branding_color', '#ffffff')) ); ?> } .site-branding-text .site-description { color: <?php echo esc_attr( intrinsic_get_options(array('site_description_color', '#e1e1e1')) ); ?> } @media only screen and (min-width: 1199px) { .mainmenu > li > a {color: <?php echo esc_attr( intrinsic_get_options(array('menu_color', '#ffffff')) ); ?> !important; } .mainmenu > li > a:hover { color: <?php echo esc_attr( intrinsic_get_options(array('main_menu_hover_color', '#f7f7f7')) ); ?> !important; } .navigation .mainmenu > li:after { background: <?php echo esc_attr( intrinsic_get_options(array('main_menu_separator_color', '#e51681')) ); ?> } .mainmenu .sub-menu, .mainmenu .sub-menu .sub-menu, .mainmenu .sub-menu .sub-menu .sub-menu {background: <?php echo esc_attr( intrinsic_get_options(array('dropdown_menu_bg', '#1d2023')) ); ?>  } .mainmenu .sub-menu li a {color: <?php echo esc_attr( intrinsic_get_options(array('dropdown_menu_color', '#f7f7f7')) ); ?>} } @media only screen and (max-width: 1199px) { .navigation { background: <?php echo esc_attr( intrinsic_get_options(array('mobile_menu_bg', '#12141c')) ); ?> } .navigation .mainmenu > li > a { color: <?php echo esc_attr( intrinsic_get_options(array('mobile_menu_color', '#ffffff')) ); ?>  }} .header-left-block { background: <?php echo esc_attr( intrinsic_get_options(array('header_left_block_bg', '#12141c')) ); ?> } .header-right-block { background: <?php echo esc_attr( intrinsic_get_options(array('header_right_block_bg', '#ffffff')) ); ?> !important; color: <?php echo esc_attr( intrinsic_get_options(array('header_right_block_colors', '#000000')) ); ?> !important;  } .header-right-block .mail-block i, .header-right-block .call-block i { color: <?php echo esc_attr( $this->intrinsic_hex_2_rgba( intrinsic_get_options(array('header_right_block_colors', '#000000')), 0.65 ) ); ?> } .header-right-block .mail-block a, .header-right-block .call-block a, .header-right-block .social-block>ul { border-left-color: <?php echo esc_attr( $this->intrinsic_hex_2_rgba( intrinsic_get_options(array('header_right_block_colors', '#000000')), 0.15 ) ); ?> } .header-right-block>*:after { border-bottom-color: <?php echo esc_attr( $this->intrinsic_hex_2_rgba( intrinsic_get_options(array('header_right_block_colors', '#000000')), 0.05 ) ); ?> }  footer.site-footer {background: <?php echo esc_attr( intrinsic_get_options(array('footer_background', '#ffffff')) ); ?>; color: <?php echo esc_attr( intrinsic_get_options(array('footer_color', '#000000')) ); ?>; } footer.site-footer a, .site-footer .footer-social li a {color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_color', '#000000'))); ?>; border-bottom-color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_color', '#000000'))); ?> } .back-to-top { color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_color', '#000000'))); ?>; border-color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_color', '#000000'))); ?> } footer a:hover, .back-to-top:hover {color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_hover_color', '#e51681'))); ?>} .back-to-top:hover { border-color:  <?php echo esc_attr(intrinsic_get_options(array('footer_link_hover_color', '#e51681'))); ?> } .site-footer .footer-social li a:hover { border-bottom-color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_hover_color', '#e51681'))); ?>; color: <?php echo esc_attr(intrinsic_get_options(array('footer_link_hover_color', '#e51681'))); ?> }
            <?php
        }

        /**
         * Theme Background Colors
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_backgound_image_cover_bg() { ?>
    
            <?php 
        }

        /**
         * Theme Version Colors
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_theme_version_color() { 
            ?>
            body:not(.custom-background) .theme-light { background: <?php echo esc_attr( intrinsic_get_options( array('theme_background_light_color', '#f8f8f8') ) ); ?>; } .theme-light { color: <?php echo esc_attr( intrinsic_get_options( array('theme_text_light_color', '#3c3c3c') ) ); ?>; } body:not(.custom-background) .theme-dark { background: <?php echo esc_attr( intrinsic_get_options( array('theme_background_dark_color', '#13152e') ) ); ?>; } .theme-dark { color: <?php echo esc_attr( intrinsic_get_options( array('theme_text_dark_color', '#e1e1e1') ) ); ?>; }
            <?php
        }

        /**
         * Theme Spacing Element
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_spaing_elements() {
            //Blog Wrapper Padding
            $blog_wrap_desktop_top = intrinsic_get_options( array('top_padding', 35) );
            $blog_wrap_desktop_bottom = intrinsic_get_options( array('bottom_padding', 120) );            
            $blog_wrap_tablet_top = intrinsic_get_options( array('tablet_top_padding', 35) );
            $blog_wrap_tablet_bottom = intrinsic_get_options( array('tablet_bottom_padding', 120) );
            $blog_wrap_mobile_top = intrinsic_get_options( array('mobile_top_padding', 35) );
            $blog_wrap_mobile_bottom = intrinsic_get_options( array('mobile_bottom_padding', 75) );            

            //Blog Wrapper Padding
            $blog_single_wrap_desktop_top = intrinsic_get_options( array('blog_single_top_padding', 120) );
            $blog_single_wrap_desktop_bottom = intrinsic_get_options( array('blog_single_bottom_padding', 120) );            
            $blog_single_wrap_tablet_top = intrinsic_get_options( array('blog_single_tablet_top_padding', 120) );
            $blog_single_wrap_tablet_bottom = intrinsic_get_options( array('blog_single_tablet_bottom_padding', 120) );
            $blog_single_wrap_mobile_top = intrinsic_get_options( array('blog_single_mobile_top_padding', 75) );
            $blog_single_wrap_mobile_bottom = intrinsic_get_options( array('blog_single_mobile_bottom_padding', 75) );

            //Page Wrapper Padding
            $page_wrap_desktop_top = intrinsic_get_options( array('page_content_top_padding', 110) );
            $page_wrap_desktop_bottom = intrinsic_get_options( array('page_content_bottom_padding', 75) );            
            $page_wrap_tablet_top = intrinsic_get_options( array('page_content_tablet_top_padding', 110) );
            $page_wrap_tablet_bottom = intrinsic_get_options( array('page_content_tablet_bottom_padding', 75) );
            $page_wrap_mobile_top = intrinsic_get_options( array('page_content_mobile_top_padding', 90) );
            $page_wrap_mobile_bottom = intrinsic_get_options( array('page_content_mobile_bottom_padding', 60) );

            //Logo Padding
            $logo_desktop_top = intrinsic_get_options( 'logo_top_padding' );
            $logo_desktop_bottom = intrinsic_get_options( 'logo_bottom_padding' );
            $logo_tablet_top = intrinsic_get_options( 'logo_tablet_top_padding' );
            $logo_tablet_bottom = intrinsic_get_options( 'logo_tablet_bottom_padding' );
            $logo_mobile_top = intrinsic_get_options( 'logo_mobile_top_padding' );
            $logo_mobile_bottom = intrinsic_get_options( 'logo_mobile_bottom_padding' );  

            //Footer Padding
            $footer_desktop_top = intrinsic_get_options( array('footer_top_padding', 75) );
            $footer_desktop_bottom = intrinsic_get_options( array('footer_bottom_padding', 75) );
            $footer_tablet_top = intrinsic_get_options( array('footer_tablet_top_padding', 75) );
            $footer_tablet_bottom = intrinsic_get_options( array('footer_tablet_bottom_padding', 75) );
            $footer_mobile_top = intrinsic_get_options( array('footer_mobile_top_padding', 75) );
            $footer_mobile_bottom = intrinsic_get_options( array('footer_mobile_bottom_padding', 75) );

            $css = '';
            $content_padding_css = '';
            $tablet_content_padding_css = '';
            $mobile_content_padding_css = '';    

            $single_content_padding_css = '';
            $single_tablet_content_padding_css = '';
            $single_mobile_content_padding_css = '';            

            $page_content_padding_css = '';
            $page_tablet_content_padding_css = '';
            $page_mobile_content_padding_css = '';

            $logo_desktop_padding_css = '';
            $logo_tablet_padding_css = '';
            $logo_mobile_padding_css = '';            

            $footer_desktop_padding_css = '';
            $footer_tablet_padding_css = '';
            $footer_mobile_padding_css = '';

            // Content top padding
            if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top ) {
                $content_padding_css .= 'padding-top:'. $blog_wrap_desktop_top .'px;';
            }

            // Content bottom padding
            if ( isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
                $content_padding_css .= 'padding-bottom:'. $blog_wrap_desktop_bottom .'px;';
            }

            // Content padding css
            if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top
                || isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
                $css .= '.blog-content-main {'. $content_padding_css .'}';
            }

            // Tablet content top padding
            if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top ) {
                $tablet_content_padding_css .= 'padding-top:'. $blog_wrap_tablet_top .'px;';
            }

            // Tablet content bottom padding
            if ( isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
                $tablet_content_padding_css .= 'padding-bottom:'. $blog_wrap_tablet_bottom .'px;';
            }

            // Tablet content padding css
            if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top
                || isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
                $css .= '@media (max-width: 768px){.blog-content-main {'. $tablet_content_padding_css .'}}';
            }

            // Mobile content top padding
            if ( isset( $blog_wrap_mobile_top ) && '' != $blog_wrap_mobile_top ) {
                $mobile_content_padding_css .= 'padding-top:'. $blog_wrap_mobile_top .'px;';
            }

            // Mobile content bottom padding
            if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom ) {
                $mobile_content_padding_css .= 'padding-bottom:'. $blog_wrap_mobile_bottom .'px;';
            }

            // Mobile content padding css
            if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom
                || isset( $blog_wrap_mobile_top ) && '' != $blog_wrap_mobile_top ) {
                $css .= '@media (max-width: 480px){.blog-content-main {'. $mobile_content_padding_css .'}}';
            } 

            // Page Content top padding
            if ( isset( $page_wrap_desktop_top ) && '' != $page_wrap_desktop_top ) {
                $page_content_padding_css .= 'padding-top:'. $page_wrap_desktop_top .'px;';
            }

            // Page Content bottom padding
            if ( isset( $page_wrap_desktop_bottom ) && '' != $page_wrap_desktop_bottom ) {
                $page_content_padding_css .= 'padding-bottom:'. $page_wrap_desktop_bottom .'px;';
            }

            // Page Content padding css
            if ( isset( $page_wrap_desktop_top ) && '' != $page_wrap_desktop_top
                || isset( $page_wrap_desktop_bottom ) && '' != $page_wrap_desktop_bottom ) {
                $css .= '.page-content-main {'. $page_content_padding_css .'}';
            }

            // Tablet Page content top padding
            if ( isset( $page_wrap_tablet_top ) && '' != $page_wrap_tablet_top ) {
                $page_tablet_content_padding_css .= 'padding-top:'. $page_wrap_tablet_top .'px;';
            }

            // Tablet Page content bottom padding
            if ( isset( $page_wrap_tablet_bottom ) && '' != $page_wrap_tablet_bottom ) {
                $page_tablet_content_padding_css .= 'padding-bottom:'. $page_wrap_tablet_bottom .'px;';
            }

            // Tablet Page content padding css
            if ( isset( $page_wrap_tablet_top ) && '' != $page_wrap_tablet_top
                || isset( $page_wrap_tablet_bottom ) && '' != $page_wrap_tablet_bottom ) {
                $css .= '@media (max-width: 768px){ .page-content-main {'. $page_tablet_content_padding_css .'}}';
            }         

            // Mobile Page content top padding
            if ( isset( $page_wrap_mobile_top ) && '' != $page_wrap_mobile_top ) {
                $page_mobile_content_padding_css .= 'padding-top:'. $page_wrap_mobile_top .'px;';
            }

            // Mobile Page content bottom padding
            if ( isset( $page_wrap_mobile_bottom ) && '' != $page_wrap_mobile_bottom ) {
                $page_mobile_content_padding_css .= 'padding-bottom:'. $page_wrap_mobile_bottom .'px;';
            }

            // Mobile Page content padding css
            if ( isset( $page_wrap_mobile_bottom ) && '' != $page_wrap_mobile_bottom
                || isset( $page_wrap_mobile_top ) && '' != $page_wrap_mobile_top ) {
                $css .= '@media (max-width: 480px){.page-content-main {'. $page_mobile_content_padding_css .'}}';
            }

            //logo top padding
            if ( isset( $logo_desktop_top ) && '' != $logo_desktop_top ) {
                $logo_desktop_padding_css .= 'padding-top:'. $logo_desktop_top .'px;';
            }            

            //logo bottom padding
            if ( isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
                $logo_desktop_padding_css .= 'padding-bottom:'. $logo_desktop_bottom .'px;';
            }

            // logo padding css
            if ( isset( $logo_desktop_top ) && '' != $logo_desktop_top
                || isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
                $css .= '.site-branding {'. $logo_desktop_padding_css .'}';
            }

            //logo tablet top padding
            if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top ) {
                $logo_tablet_padding_css .= 'padding-top:'. $logo_tablet_top .'px;';
            }            

            //logo tablet bottom padding
            if ( isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
                $logo_tablet_padding_css .= 'padding-bottom:'. $logo_tablet_bottom .'px;';
            }

            // logo tablet padding css
            if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top
                || isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
                $css .= '@media (max-width: 768px){ .site-branding {'. $logo_tablet_padding_css .'}}';
            }

            //logo mobile top padding
            if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top ) {
                $logo_mobile_padding_css .= 'padding-top:'. $logo_mobile_top .'px;';
            }            

            //logo mobile bottom padding
            if ( isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
                $logo_mobile_padding_css .= 'padding-bottom:'. $logo_mobile_bottom .'px;';
            }

            // logo mobile padding css
            if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top
                || isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
                $css .= '@media (max-width: 480px){ .site-branding {'. $logo_mobile_padding_css .'}}';
            }

            //Single Blog top padding
            if ( isset( $blog_single_wrap_desktop_top ) && '' != $blog_single_wrap_desktop_top ) {
                $single_content_padding_css .= 'padding-top:'. $blog_single_wrap_desktop_top .'px;';
            }            

            //Single Blog bottom padding
            if ( isset( $blog_single_wrap_desktop_bottom ) && '' != $blog_single_wrap_desktop_bottom ) {
                $single_content_padding_css .= 'padding-bottom:'. $blog_single_wrap_desktop_bottom .'px;';
            }

            // Single Blog padding css
            if ( isset( $blog_single_wrap_desktop_top ) && '' != $blog_single_wrap_desktop_top
                || isset( $blog_single_wrap_desktop_bottom ) && '' != $blog_single_wrap_desktop_bottom ) {
                $css .= '.blog-single-spacing {'. $single_content_padding_css .'}';
            }

            //Single Blog tablet top padding
            if ( isset( $blog_single_wrap_tablet_top ) && '' != $blog_single_wrap_tablet_top ) {
                $single_tablet_content_padding_css .= 'padding-top:'. $blog_single_wrap_tablet_top .'px;';
            }            

            //Single Blog tablet bottom padding
            if ( isset( $blog_single_wrap_tablet_bottom ) && '' != $blog_single_wrap_tablet_bottom ) {
                $single_tablet_content_padding_css .= 'padding-bottom:'. $blog_single_wrap_tablet_bottom .'px;';
            }

            // Single Blog tablet padding css
            if ( isset( $blog_single_wrap_tablet_top ) && '' != $blog_single_wrap_tablet_top
                || isset( $blog_single_wrap_tablet_bottom ) && '' != $blog_single_wrap_tablet_bottom ) {
                $css .= '@media (max-width: 768px){ .blog-single-spacing {'. $single_tablet_content_padding_css .'}}';
            }

            //Single Blog mobile top padding
            if ( isset( $blog_single_wrap_mobile_top ) && '' != $blog_single_wrap_mobile_top ) {
                $single_mobile_content_padding_css .= 'padding-top:'. $blog_single_wrap_mobile_top .'px;';
            }            

            //Single Blog mobile bottom padding
            if ( isset( $blog_single_wrap_mobile_bottom ) && '' != $blog_single_wrap_mobile_bottom ) {
                $single_mobile_content_padding_css .= 'padding-bottom:'. $blog_single_wrap_mobile_bottom .'px;';
            }

            // Single Blog mobile padding css
            if ( isset( $blog_single_wrap_mobile_top ) && '' != $blog_single_wrap_mobile_top
                || isset( $blog_single_wrap_mobile_bottom ) && '' != $blog_single_wrap_mobile_bottom ) {
                $css .= '@media (max-width: 480px){ .blog-single-spacing {'. $single_mobile_content_padding_css .'}}';
            }

            //Footer padding
            if ( isset( $footer_desktop_top ) && '' != $footer_desktop_top ) {
                $footer_desktop_padding_css .= 'padding-top:'. $footer_desktop_top .'px;';
            }            

            //Footer bottom padding
            if ( isset( $footer_desktop_bottom ) && '' != $footer_desktop_bottom ) {
                $footer_desktop_padding_css .= 'padding-bottom:'. $footer_desktop_bottom .'px;';
            }

            // Footer padding css
            if ( isset( $footer_desktop_top ) && '' != $footer_desktop_top
                || isset( $footer_desktop_bottom ) && '' != $footer_desktop_bottom ) {
                $css .= '.site-footer {'. $footer_desktop_padding_css .'}';
            }

            //Footer tablet top padding
            if ( isset( $footer_tablet_top ) && '' != $footer_tablet_top ) {
                $footer_tablet_padding_css .= 'padding-top:'. $footer_tablet_top .'px;';
            }            

            //Footer tablet bottom padding
            if ( isset( $footer_tablet_bottom ) && '' != $footer_tablet_bottom ) {
                $footer_tablet_padding_css .= 'padding-bottom:'. $footer_tablet_bottom .'px;';
            }

            // Footer tablet padding css
            if ( isset( $footer_tablet_top ) && '' != $footer_tablet_top
                || isset( $footer_tablet_bottom ) && '' != $footer_tablet_bottom ) {
                $css .= '@media (max-width: 768px){ .site-footer {'. $footer_tablet_padding_css .'}}';
            }

            //Footer mobile top padding
            if ( isset( $footer_mobile_top ) && '' != $footer_mobile_top ) {
                $footer_mobile_padding_css .= 'padding-top:'. $footer_mobile_top .'px;';
            }            

            //Footer mobile bottom padding
            if ( isset( $footer_mobile_bottom ) && '' != $footer_mobile_bottom ) {
                $footer_mobile_padding_css .= 'padding-bottom:'. $footer_mobile_bottom .'px;';
            }

            //Footer mobile padding css
            if ( isset( $footer_mobile_top ) && '' != $footer_mobile_top
                || isset( $footer_mobile_bottom ) && '' != $footer_mobile_bottom ) {
                $css .= '@media (max-width: 480px){ .site-footer {'. $footer_mobile_padding_css .'}}';
            }

            // Return CSS
            if ( ! empty( $css ) ) {
                echo esc_attr( $css );
            }
        }

        /**
         * Page Spacing Element
         *
         * @package Intrinsic
         * @since 1.0
         */
        public function intrinsic_page_elements() { ?>
            <?php if( get_post_meta( get_the_ID(), 'intrinsic_content_padding_top', true) !== '' ) { ?> .blog-page-block.page-content-main { padding-top: <?php echo esc_attr( get_post_meta( get_the_ID(), 'intrinsic_content_padding_top', true) ); ?> !important;  } <?php } ?>
            <?php if( get_post_meta( get_the_ID(), 'intrinsic_content_padding_bottom', true) !== '' ) { ?> .blog-page-block.page-content-main { padding-bottom: <?php echo esc_attr( get_post_meta( get_the_ID(), 'intrinsic_content_padding_bottom', true) ); ?> !important; } <?php } ?> <?php if( get_post_meta( get_the_ID(), 'intrinsic_article_spacing_top', true) !== '' ) { ?> .blog-single-page .post { margin-top: <?php echo esc_attr( get_post_meta( get_the_ID(), 'intrinsic_article_spacing_top', true) ); ?> } <?php } ?> <?php if( get_post_meta( get_the_ID(), 'intrinsic_article_spacing_bottom', true) !== '' ) { ?> .blog-single-page .post { margin-bottom: <?php echo esc_attr( get_post_meta( get_the_ID(), 'intrinsic_article_spacing_bottom', true) ); ?> } <?php } ?>
            @media (min-width: 1200px) { .blog-page-block > .container { max-width: <?php echo esc_attr( intrinsic_get_options( array('container_width', 1140) ) ) ?>px; } } @media (min-width: 992px) { .blog-page-block > .container .layout-content { -ms-flex: 0 0 <?php echo esc_attr( intrinsic_get_options( array('post_content_width', 66.666667) ) ) ?>%; flex: 0 0 <?php echo esc_attr( intrinsic_get_options( array('post_content_width', 66.666667) ) ) ?>%; max-width: <?php echo esc_attr( intrinsic_get_options( array('post_content_width', 66.666667) ) ) ?>%;  } .blog-page-block > .container .layout-sidebar { -ms-flex: 0 0 <?php echo esc_attr( intrinsic_get_options( array('post_sidebar_width', 33.333333) ) ) ?>%; flex: 0 0 <?php echo esc_attr( intrinsic_get_options( array('post_sidebar_width', 33.333333) ) ) ?>%; max-width: <?php echo esc_attr( intrinsic_get_options( array('post_sidebar_width', 33.333333) ) ) ?>%; } } @media only screen and (min-width: 1199px) { .mainmenu .sub-menu { min-width: <?php echo esc_attr( intrinsic_get_options( array('dropdown_menu_width', 260) ) ) ?>px; } } <?php if( get_post_meta( get_the_ID(), 'intrinsic_page_color', true) !== '' ) { ?> body:not(.custom-background) .blog-page-block.page-content-main { background: <?php echo esc_attr( get_post_meta( get_the_ID(), 'intrinsic_page_color', true) ); ?> } <?php } ?>
            <?php
        }
    }
}

new Intrinsic_Helpers;