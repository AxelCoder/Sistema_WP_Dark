<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Intrinsic
 */


if ( ! function_exists( 'intrinsic_posts_pagination_nav' ) ) :
/**
 * This is for post pagination
 */
function intrinsic_posts_pagination_nav($wp_query = '', $custom_class = '', $page_url = false) {

    if(!$wp_query) {
        $wp_query = $GLOBALS['wp_query'];
    }

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    if($page_url == false) {
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    } else {
        $paged = ( isset($_GET['paged']) ? sanitize_text_field( wp_unslash( $_GET['paged'] ) ) : 1 );
    }
    
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    $div_class = ($custom_class != "") ? $custom_class : "";
    echo '<div class="pagination-block '. esc_attr( $div_class ) .' "><ul class="pagination">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="nav-previous">%s</li>' . "\n", wp_kses_post( get_previous_posts_link('<i class="fa fa-angle-left"></i>' ) ) );
    } 
    
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $link ) ), wp_kses_post( $link ) );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers curent" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $max ) ), wp_kses_post( $max ) );
    }


    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="nav-next">%s</li>' . "\n", wp_kses_post( get_next_posts_link( '<i class="fa fa-angle-right"></i>') ) );
    } 
    echo '</ul></div>' . "\n";
}
endif;

/**
 * To Load More Link
 */
if ( ! function_exists( 'intrinsic_load_more_post' ) ) :
function intrinsic_load_more_post() { ?>
    <div class="row">        
        <div class="col-12 text-center mrt-30">
            <span class="load-more-btn color-nero">
                <?php echo get_next_posts_link('<i class="fa fa-refresh"></i>'); ?>
            </span>
        </div>
    </div><!--  /.row -->
    <?php
} // end intrinsic_load_more_post
endif;


if ( ! function_exists( 'intrinsic_wp_link_pages' ) ) :
/**
 * To show wp_link_pages
 */
function intrinsic_wp_link_pages() {
    wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'intrinsic' ),
        'after'  => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}
endif;


if ( ! function_exists( 'intrinsic_archive_title' ) ) :
/**
 * Shim for `intrinsic_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function intrinsic_archive_title( $before = '', $after = '' ) {
    $allowed_html = array(
        'span' => array()
    );
    if ( is_category() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Category : </span>', 'intrinsic' ), $allowed_html ) . '%s', single_cat_title( '', false ) );
    } elseif ( is_tag() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Tag : </span>', 'intrinsic' ), $allowed_html ) . '%s', single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Author : </span>', 'intrinsic' ), $allowed_html ) . '%s', get_the_author() );
    } elseif ( is_year() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Year : </span>', 'intrinsic' ), $allowed_html ) . '%s', get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'intrinsic' ) ) );
    } elseif ( is_month() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Month : </span>', 'intrinsic' ), $allowed_html ) . '%s', get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'intrinsic' ) ) );
    } elseif ( is_day() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Day : </span>', 'intrinsic' ), $allowed_html ) . '%s', get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'intrinsic' ) ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Aside', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Gallery', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Image', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Video', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Quote', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Link', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Status', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Audio', 'post format archive title', 'intrinsic' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format : </span>', 'intrinsic' ), $allowed_html ).esc_html_x( 'Chat', 'post format archive title', 'intrinsic' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = sprintf( __( '<span>Browsing Archives :</span>', 'intrinsic' ) . '%s', post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf( esc_html__( '%1$s: %2$s', 'intrinsic' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
        $title = esc_html__( 'Browsing Archives :', 'intrinsic' );
    }

    /**
     * Filter the archive title.
     *
     * @param string $title Archive title to be displayed.
     */
    $title = apply_filters( 'get_the_archive_title', $title );

    if ( ! empty( $title ) ) {
        echo wp_kses( $before, Intrinsic_Static::html_allow() ) . wp_kses( $title, Intrinsic_Static::html_allow() ) . wp_kses( $after, Intrinsic_Static::html_allow() ); // WPCS: XSS OK
    }
}
endif;

if ( ! function_exists( 'intrinsic_the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function intrinsic_the_archive_description( $before = '', $after = '' ) {
    $description = apply_filters( 'get_the_archive_description', term_description() );

    if ( ! empty( $description ) ) {
        /**
         * Filter the archive description.
         *
         * @see term_description()
         *
         * @param string $description Archive description to be displayed.
         */

        echo wp_kses( $before, Intrinsic_Static::html_allow() ) . wp_kses( $description, Intrinsic_Static::html_allow() ) . wp_kses( $after, Intrinsic_Static::html_allow() ); // WPCS: XSS OK
    }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function intrinsic_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'intrinsic_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'intrinsic_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so intrinsic_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so intrinsic_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in intrinsic_categorized_blog.
 */
function intrinsic_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'intrinsic_categories' );
}
add_action( 'edit_category', 'intrinsic_category_transient_flusher' );
add_action( 'save_post',     'intrinsic_category_transient_flusher' );

/**
 * Intrinsic Post Type Search
 * @package Intrinsic
 * @since  1.0
 */
function intrinsic_post_type_search_query( $query ) {
    if ( is_search() && $query->is_main_query() && $query->get( 's' ) ) {
        $query->set( 'post_type', array('post', 'page', 'portfolio', 'product') );
        return $query;
    }
}
add_action( 'pre_get_posts', 'intrinsic_post_type_search_query' );
