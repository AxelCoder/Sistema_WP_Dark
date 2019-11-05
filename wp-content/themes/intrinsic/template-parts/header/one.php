<?php
/**
 * This template for displaying header part
 *
 * @package Intrinsic
 * @since 1.0
 */
/* ================================================== */
/**
 * Preloader
 * @package Intrinsic
 * @since 1.0
 */
intrinsic_preloader(); 

/**
 * Header Part show/hide condition
 * @package Intrinsic
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'intrinsic_header_show_header', true) == 'no' ) {
    return;
}

/**
 * Header Sticky/Fixed Background Status
 * @package Intrinsic
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'intrinsic_header_menu_sticky', true) == 'no' ) {
    $sticky_menu = '';
} elseif( intrinsic_get_options('header_sticky') == false ) {
    $sticky_menu = '';
} else {
    $sticky_menu = 'sticky-header';
} 

/**
 * Theme Version Status
 * @package Intrinsic
 * @since 1.0
 */
$theme_color_version = intrinsic_get_options('theme_background_status');
if( $theme_color_version == 'dark' ) {
    $version_blog = 'dark';
} else {
    $version_blog = 'light';
} 

/**
 * Control Header Right Side
 * @package Intrinsic
 * @since 1.0
 */
$header_right_side = intrinsic_get_options('enable_header_right');
if( $header_right_side == true ) {
    $header_left_column = 'col-xl-7';
} else {
    $header_left_column = 'col-xl-12 no-right-block';
} ?>

<!-- Header
================================================== --> 
<header class="site-header <?php echo esc_attr($sticky_menu); ?>">
    <div class="container-fluid pd-0">
        <div class="row no-gutters">
            <div class="<?php echo esc_attr( $header_left_column ); ?>">
                <div class="header-left-block">
                    <!-- Site Branding -->  
                    <?php if(  get_post_meta( get_the_ID(), 'intrinsic_header_logo_main', true) !== false && get_post_meta( get_the_ID(), 'intrinsic_header_logo_main', true) !== '' ) { ?>
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
                            <img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'intrinsic_header_logo_main', true) ); ?>" alt="<?php echo esc_attr__('Site Logo', 'intrinsic'); ?>" />
                        </a>
                    </div><!--  /.site-branding -->
                    <?php } elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { ?>
                        <div class="site-branding">
                            <?php the_custom_logo(); ?>
                        </div><!--  /.site-branding -->
                    <?php } else { 
                        if ( function_exists( 'display_header_text' ) ) { 
                            if( display_header_text() == true ) { ?>
                            <div class="site-branding">
                                <div class="site-branding-text">
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                                    <?php $description = get_bloginfo( 'description', 'display' );
                                    if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html($description); ?></p>
                                    <?php endif; ?>
                                </div><!-- .site-branding-text -->
                            </div><!--  /.site-branding -->
                            <?php }
                        }
                    } ?>

                    <!-- Site Navigation -->
                    <div class="site-navigation">
                        <div class="hamburger-menus">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <nav class="navigation">
                            <div class="overlaybg"></div><!--  /.overlaybg -->
                            <!-- Main Menu -->
                            <div class="menu-wrapper">
                                <div class="menu-content">
                                    <?php
                                        if( get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true) !=='0') {
                                            wp_nav_menu ( array(
                                                'menu_class' => 'mainmenu',
                                                'container'=> 'ul',
                                                'menu' => get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true),
                                                'theme_location' => 'main-menu',  
                                            )); 
                                        } else {
                                            wp_nav_menu ( array(
                                                'menu_class' => 'mainmenu',
                                                'container'=> 'ul',
                                                'theme_location' => 'main-menu',  
                                            )); 
                                        }
                                    ?>
                                </div> <!-- /.hours-content-->
                            </div><!-- /.menu-wrapper --> 
                        </nav>
                    </div><!--  /.site-navigation -->
                </div><!--  /.header-left-block -->
            </div><!--  /.col-xl-7 -->
            
            <?php if( $header_right_side == true  ) { ?>
            <div class="col-xl-5">
                <div class="header-right-block bg-white <?php echo esc_attr($version_blog); ?>">
                    <?php if( intrinsic_get_options('header_mail_address') !== '' ) { ?>
                    <div class="mail-block">
                        <a href="mailto:<?php echo esc_attr( intrinsic_get_options(array('header_mail_address', 'example@domain.com')) ); ?>"><i class="<?php echo esc_attr( intrinsic_get_options( array('header_mail_icons','fas fa-envelope') ) ); ?>"></i><span><?php echo esc_html( intrinsic_get_options(array('header_mail_address', 'example@domain.com')) ); ?></span></a>
                    </div><!--  /.mail-block -->
                    <?php } ?>
                    <?php if( intrinsic_get_options('header_phone_numbers') !== '' ) { ?>
                    <div class="call-block">
                        <a href="tel:<?php echo esc_attr( intrinsic_get_options( array('header_phone_numbers','008969854756') ) ); ?>"><i class="<?php echo esc_attr( intrinsic_get_options( array('header_call_icons', 'fas fa-phone') ) ); ?>"></i><span><?php echo esc_html( intrinsic_get_options( array('header_phone_numbers','008969854756') ) ); ?></span></a>
                    </div><!--  /.call-block -->
                    <?php } ?>
                    <div class="social-block">
                        <?php 
                            $social_target = intrinsic_get_options('header_social_profile_target');
                            $url_target = ( $social_target == '_blank' ) ? 'target=_blank' : 'target=_self' ;
                        ?>
                        <ul>
                            <?php if( intrinsic_get_options('header_social_block_one_url') !== '' ) { ?>
                            <li><a <?php echo esc_attr( $url_target ); ?> href="<?php echo esc_url( intrinsic_get_options(array( 'header_social_block_one_url', '#') ) ); ?>"><i class="<?php echo esc_attr( intrinsic_get_options( array('header_social_block_one_icon', 'fab fa-facebook-f') ) ) ?>"></i></a></li>
                            <?php } ?>
                            <?php if( intrinsic_get_options('header_social_block_two_url') !== '' ) { ?>
                            <li><a <?php echo esc_attr( $url_target ); ?> href="<?php echo esc_url( intrinsic_get_options(array( 'header_social_block_two_url', '#') ) ); ?>"><i class="<?php echo esc_attr( intrinsic_get_options( array('header_social_block_two_icon', 'fab fa-twitter') ) ) ?>"></i></a></li>
                            <?php } ?>
                            <?php if( intrinsic_get_options('header_social_block_three_url') !== '' ) { ?>
                            <li><a <?php echo esc_attr( $url_target ); ?> href="<?php echo esc_url( intrinsic_get_options(array( 'header_social_block_three_url', '#') ) ); ?>"><i class="<?php echo esc_attr( intrinsic_get_options( array('header_social_block_three_icon', 'fab fa-instagram') ) ) ?>"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div><!--  /.social-block -->
                </div><!--  /.header-right-block -->
            </div><!--  /.col-lg-5 -->
            <?php } ?>
        </div><!--  /.row -->
    </div><!--  /.container-fluid -->
</header><!-- /.site-header -->