<?php
/**
 * Server-side rendering for the Portfolio block
 *
 * @since 	1.0
 * @package Intrinsic Core
 */
/**
 * Renders the post grid block on server.
 */
function intrinsic_blog_block_render_fallback( $attributes, $content ) {
	$recent_portfolio = wp_get_recent_posts( array(
		'order' => $attributes['order'],
		'orderby'=> $attributes['orderBy'],
        'numberposts' => $attributes['postsToShow'],
        'post_status' => 'publish',
    ) );

	$markup = '';

	$counter = 0; 

	foreach ($recent_portfolio as $post ) {
		$post_id = $post['ID'];
		$title = get_the_title( $post_id );
		if ( ! $title ) {
			$title = esc_html__( 'No Title', 'intrinsic-core' );
		}

		$post_thumb_id = get_post_thumbnail_id( $post_id );
		
		$category_array = wp_get_post_categories( $post_id );

		$category_list = array();

		foreach ( $category_array as $categories ) {
            $category_list[] = get_cat_name( $categories );
        }
        $lister = implode(' ,', $category_list);

		$markup .= sprintf('<div class="col-md-4">');
			$markup .= sprintf('<div class="post-item" data-animate="hg-fadeInUp" data-delay="0.%1$ss">', $counter);
				$markup .= sprintf( '<article class="post">' );
					if( $post_thumb_id ) {					
						$markup .= sprintf('<figure class="post-thumb">');
							$markup .= sprintf('<div class="entry-date" style="background: %2$s; color: %3$s;">%1$s</div>', get_the_date( 'M j, Y', $post_id ), $attributes['dateBg'], $attributes['dateColor']);
							$markup .= sprintf('<img src="%1$s" alt="%2$s" />', intrinsic_get_image_crop_size($post_thumb_id, 367, 348, true, false), $title );
						$markup .= sprintf('</figure>');
					}
					$markup .= sprintf('<div class="post-detail">');
						$markup .= sprintf('<h2 class="entry-title" style="color: %3$s;"><a href="%1$s">%2$s</a></h2>', get_permalink( $post_id ), $title, $attributes['titleColor'] );
						$markup .= sprintf('<div class="entry-cat" style="color: %2$s;">%1$s</div>', $lister, $attributes['cateColor']);
					$markup .= sprintf('</div>');
				$markup .= sprintf( '</article>' );
			$markup .= sprintf('</div>');
		$markup .= sprintf('</div>');

		$counter++; 

	}

	$class = "intrinsic-blog align{$attributes['alignmentControl']}";

	$block_content = sprintf(
		'<div class="%1$s"><div class="row">%2$s</div></div>',
		esc_attr( $class ),
		$markup
	);

    return $block_content;
}

/**
 * Registers the `intrinsic-core/portfolio` block on server.
 */
function intrinsic_blog_register_block() {
	// Check if the register function exists
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	register_block_type( 'intrinsic-core/blog', array(
		'attributes' => array(
			'postsToShow' => array(
				'type' => 'number',
				'default' => 3,
			),			
			'alignmentControl' => array(
				'type' => 'string',
				'default' => 'wide',
			),
			'columns' => array(
				'type' => 'number',
				'default' => 'three',
			),			
			'portfolioOpen' => array(
				'type' => 'string',
				'default' => 'popup',
			),
			'order' => array(
				'type' => 'string',
				'default' => 'desc',
			),
			'orderBy'  => array(
				'type' => 'string',
				'default' => 'date',
			),	
			'dateBg'  => array(
				'type' => 'string',
				'default' => '#ffffff',
			),		
			'dateColor'  => array(
				'type' => 'string',
				'default' => '#3c3c3c',
			),
			'titleColor'  => array(
				'type' => 'string',
				'default' => '#121212',
			),
			'cateColor'  => array(
				'type' => 'string',
				'default' => '#828282',
			)
		),
		'render_callback' => 'intrinsic_blog_block_render_fallback',
		'editor_script' => 'intrinsic_editor_script',
		'editor_style' => 'intrinsic_editor_style',
	));
}
add_action( 'init', 'intrinsic_blog_register_block' );

/**
 * Create API fields for additional info
 */
function intrinsic_blocks_blog_register_rest_fields() {
	// Add landscape featured image source
	register_rest_field(
		'post',
		'featured_image',
		array(
			'get_callback' => 'intrinsic_blog_blocks_get_image_src_landscape',
			'update_callback' => null,
			'schema' => null,
		)
	);

	// Add post date
	register_rest_field(
		'post',
		'post_date',
		array(
			'get_callback' => 'intrinsic_blog_blocks_date_format',
			'update_callback' => null,
			'schema' => null,
		)
	);

	// Add category
	register_rest_field(
		'post',
		'post_category',
		array(
			'get_callback' => 'intrinsic_blog_blocks_category',
			'update_callback' => null,
			'schema' => null,
		)
	);
}
add_action( 'rest_api_init', 'intrinsic_blocks_blog_register_rest_fields' );

/**
 * Get landscape featured image source for the rest field
 */
function intrinsic_blog_blocks_get_image_src_landscape( $object, $field_name, $request ) {
	$feat_img_array = wp_get_attachment_image_src(
		$object['featured_media'],
		'intrinsic-portfolio-x-x',
		false
	);
	return $feat_img_array[0];
}

function intrinsic_blog_blocks_date_format( $object, $field_name, $request ) {
	$post_date = get_the_date( 'M j, Y', $object['id'] );
	return $post_date;
}

function intrinsic_blog_blocks_category( $object, $field_name, $request ) {
	$post_category = get_the_category( $object['id'] );
	return $post_category;
}
