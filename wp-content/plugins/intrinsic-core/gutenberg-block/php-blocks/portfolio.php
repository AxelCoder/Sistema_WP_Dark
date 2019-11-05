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
function intrinsic_portfolio_block_render_fallback( $attributes, $content ) {
	$recent_portfolio = wp_get_recent_posts( array(
		'post_type' => 'portfolio',
		'order' => $attributes['order'],
		'orderby'=> $attributes['orderBy'],
        'numberposts' => $attributes['postsToShow'],
        'post_status' => 'publish',
    ) );

	$markup = '';

	foreach ($recent_portfolio as $post ) {
		$post_id = $post['ID'];
		$title = get_the_title( $post_id );
		if ( ! $title ) {
			$title = esc_html__( 'No Title', 'intrinsic-core' );
		}

		$post_thumb_id = get_post_thumbnail_id( $post_id );

    	$image_size = get_post_meta($post_id, 'intrinsic_featured_image_masonry_size', true);

    	if( $attributes['columns'] == 'one' ) {
    		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 1120, 750, true, false);
    		$col_class = 'col-md-12 col-lg-12'; 
    	} elseif( $attributes['columns'] == 'two' ) {
    		if( $image_size == 'x_x' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 550, 385, true, false); 
    		} elseif ( $image_size == 'x_dx' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 550, 588, true, false); 
    		} elseif ( $image_size == 'dx_x' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 550, 749, true, false); 
    		} elseif ( $image_size == 'dx_dx' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 550, 441, true, false); 
    		} else {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 540, 411, true, false); 
    		}
    		$col_class = 'col-md-6 col-lg-6'; 
    	} elseif( $attributes['columns'] == 'three' ) {
    		if( $image_size == 'x_x' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 360, 252, true, false); 
    		} elseif ( $image_size == 'x_dx' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 360, 385, true, false); 
    		} elseif ( $image_size == 'dx_x' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 360, 490, true, false); 
    		} elseif ( $image_size == 'dx_dx' ) {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 360, 289, true, false); 
    		} else {
    			$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 360, 289, true, false); 
    		}
    		$col_class = 'col-md-6 col-lg-4'; 
    	} else {            		
        	if( $image_size == 'x_x' ) {
        		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 263, 184, true, false); 
        	} elseif ( $image_size == 'x_dx' ) {
        		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 263, 281, true, false); 
        	} elseif ( $image_size == 'dx_x' ) {
        		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 263, 358, true, false); 
        	} elseif ( $image_size == 'dx_dx' ) {
        		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 263, 211, true, false); 
        	} else {
        		$portfolio_image = intrinsic_get_image_crop_size($post_thumb_id, 263, 211, true, false); 
        	}
        	$col_class = 'col-md-6 col-lg-3'; 
    	}

    	if( $attributes['portfolioOpen'] == 'custom' ) {
    		$portfolioLink = get_post_meta(get_the_ID(), 'intrinsic_custom_link', true);
    		$openClass = 'custom-link';
    	} elseif ( $attributes['portfolioOpen'] == 'popup' ) {
    		$portfolioLink = intrinsic_get_image_crop_size($post_thumb_id, 1120, 750, true, false);
    		$openClass = 'popup-image';
    	} else {
    		$portfolioLink = get_permalink( $post_id );
    		$openClass = 'single-link';
    	}

    	$portfilio_cats = get_the_terms( $post_id, 'portfolio-category' );
    	$cats_name = '';

    	if (is_array($portfilio_cats) || is_object($portfilio_cats)) {		
	    	foreach($portfilio_cats as $cat_name) {    
	    		$cats_name .= $cat_name->name.' ';
	    	}
    	}

    	// Main Markup
		$markup .= sprintf('<div class="%1$s %2$s item">', $col_class, $image_size);
			$markup .= sprintf('<div class="portfolio-item" data-animate="hg-fadeInUp">');
				$markup .= sprintf('<figure class="portfolio-thumb">');
	            	$markup .= sprintf( '<img src="%1$s" alt="%1$s" />', $portfolio_image, get_the_title( $post_id )  );
	            	$markup .= sprintf('<div class="overlay-wrapper">');
	            		$markup .= sprintf('<div class="overlay" style="background-color: %1$s"></div>', $attributes['overlayColor']);
	            		$markup .= sprintf('<div class="popup">');
	            			$markup .= sprintf('<div class="popup-inner">');
	            				$markup .= sprintf('<a href="%1$s" class="%2$s"><i class="fa fa-search" style="color: %3$s;"></i></a>', $portfolioLink, $openClass, $attributes['iconColor'] );
	            			$markup .= sprintf('</div>');
	            		$markup .= sprintf('</div>');
	            	$markup .= sprintf('</div>');
				$markup .= sprintf('</figure>');
				$markup .= sprintf('<div class="content">');
					$markup .= sprintf('<h3 style="color: %4$s;"><a class="%3$s" href="%1$s">%2$s</a></h3>',$portfolioLink, $title, $openClass, $attributes['titleColor'] );
					$markup .= sprintf('<div class="cate" style="color: %2$s">%1$s</div>', $cats_name, $attributes['cateColor'] );
				$markup .= sprintf('</div>');
			$markup .= sprintf('</div>');
		$markup .= sprintf('</div>');
	}

	$class = "intrinsic-portfolio align{$attributes['alignmentControl']}";

	$block_content = sprintf(
		'<div class="%1$s"><div class="row portfolio-grid">%2$s</div></div>',
		esc_attr( $class ),
		$markup
	);

    return $block_content;
}

/**
 * Registers the `intrinsic-core/portfolio` block on server.
 */
function intrinsic_portfolio_register_block() {
	// Check if the register function exists
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	register_block_type( 'intrinsic-core/portfolio', array(
		'attributes' => array(
			'postsToShow' => array(
				'type' => 'number',
				'default' => 12,
			),			
			'alignmentControl' => array(
				'type' => 'string',
				'default' => 'wide',
			),
			'columns' => array(
				'type' => 'string',
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
			'iconColor'  => array(
				'type' => 'string',
				'default' => '#ffffff',
			),
			'titleColor'  => array(
				'type' => 'string',
				'default' => '#ffffff',
			),
			'cateColor'  => array(
				'type' => 'string',
				'default' => '#ffffff',
			),
			'overlayColor'  => array(
				'type' => 'string',
				'default' => 'rgba(229, 22, 129, 0.75)',
			),
		),
		'render_callback' => 'intrinsic_portfolio_block_render_fallback',
		'editor_script' => 'intrinsic_editor_script',
		'editor_style' => 'intrinsic_editor_style',
	));
}
add_action( 'init', 'intrinsic_portfolio_register_block' );

/**
 * Create API fields for additional info
 */
function intrinsic_blocks_portfolio_register_rest_fields() {
	// Add landscape featured image source
	register_rest_field(
		'portfolio',
		'featured_image',
		array(
			'get_callback' => 'intrinsic_portfolio_blocks_get_image_src_landscape',
			'update_callback' => null,
			'schema' => null,
		)
	);

	// Add landscape featured image source
	register_rest_field(
		'portfolio',
		'portfolio_categories',
		array(
			'get_callback' => 'intrinsic_portfolio_blocks_categories',
			'update_callback' => null,
			'schema' => null,
		)
	);

	//Return Custom Link
	register_rest_field(
		'portfolio',
		'portfolio_custom',
		array(
			'get_callback' => 'intrinsic_portfolio_custom_link',
			'update_callback' => null,
			'schema' => null,
		)
	);
}
add_action( 'rest_api_init', 'intrinsic_blocks_portfolio_register_rest_fields' );

/**
 * Get landscape featured image source for the rest field
 */
function intrinsic_portfolio_blocks_get_image_src_landscape( $object, $field_name, $request ) {
	$feat_img_array = wp_get_attachment_image_src(
		$object['featured_media'],
		'intrinsic-portfolio-x-x',
		false
	);
	return $feat_img_array[0];
}

/**
 * Get landscape featured image source for the rest field
 */
function intrinsic_portfolio_blocks_categories( $object, $field_name, $request ) {
	$portfilio_cats = get_the_terms( $object['id'], 'portfolio-category' );
	return $portfilio_cats;
}

function intrinsic_portfolio_custom_link( $object, $field_name, $request ) {
	$portfolio_open_type = get_post_meta(get_the_ID(), 'intrinsic_custom_link', true);
	return $portfolio_open_type;
}