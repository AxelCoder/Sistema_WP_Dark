<?php
add_shortcode( 'intrinsic_blog_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_blog_components', $atts ); 
	extract(shortcode_atts(array(
		'total_posts' => '',  
		'blog_grid_layout' => '', 
		'blog_item_shortings' => '', 
		'blog_item_order_by' => '', 
		'publish_date_bg' => '', 
		'publish_date_color' => '', 
		'post_title_color' => '', 
		'category_text_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?> 

	<?php 
		if( $blog_grid_layout == 'one' ) {
			$grid_no = 'col-lg-12';
		} elseif( $blog_grid_layout == 'two' ) {
			$grid_no = 'col-lg-6';
		} elseif( $blog_grid_layout == 'three' ) {
			$grid_no = 'col-lg-4';
		} else {
			$grid_no = 'col-lg-3';
		}
		$args = array(
		    'posts_per_page' => $total_posts,  
		    'post_type' => 'post',
		    'orderby' => $blog_item_shortings,
		    'order'   => $blog_item_order_by, 
		);
		$the_query = new \WP_Query( $args );
	?>

	<div class="row">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	    <div class="<?php echo esc_attr( $grid_no ); ?>">
	        <div class="post-item" data-animate="hg-fadeInUp">                    
	            <article class="post">
	            	<?php if ( has_post_thumbnail() ) { ?>
	            	    <figure class="post-thumb">          
	                    	<div class="entry-date" style="background: <?php echo esc_attr( $publish_date_bg ); ?>; color: <?php echo esc_attr( $publish_date_color ); ?>"><?php echo get_the_date('M j, Y'); ?></div><!--  /.entry-date -->
	            	        <a href="<?php the_permalink(); ?>">
	            	        	<?php 
	            	        		if( $blog_grid_layout == 'one' ) {
	            	        			intrinsic_post_featured_image(350, 332, true, false);
	            	        		} elseif( $blog_grid_layout == 'two' ) {
	            	        			intrinsic_post_featured_image(350, 332, true, false);
	            	        		} elseif( $blog_grid_layout == 'three' ) {
	            	        			intrinsic_post_featured_image(350, 332, true, false);
	            	        		} else {
	            	        			intrinsic_post_featured_image(258, 244, true, false);
	            	        		}
	            	        	?>
	            	        </a> 
	            	    </figure><!-- /.post-thumb -->
	            	<?php } ?>
	                <div class="post-detail">
	                	<h2 class="entry-title" style="color: <?php echo esc_attr( $post_title_color ); ?>"><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></h2><!--  /.entry-title -->
	                    <div class="entry-cat" style="color: <?php echo esc_attr( $category_text_color ); ?>">
	                    	<?php the_category(', '); ?>
	                    </div><!--  /.entry-cat -->
	                </div><!--  /.post-detail -->
	            </article><!--  /.post -->
	        </div><!--  /.post-item -->
	    </div><!--  /.col-md-4 --> 
		<?php endwhile; wp_reset_postdata(); ?>
	</div><!--  /.row -->

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_blog_components' );
function intrinsic_vc_blog_components() {
	vc_map(array(
		'base' => 'intrinsic_blog_components',
		'name' => esc_html__('Blog', 'intrinsic-core'),
		'description' => esc_html__('Blog Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-th-large', 
		'params' => array(
            array(
            	'param_name' => 'total_posts',
            	'type' => 'textfield',
            	'heading' => esc_html__('Number Of Post Display', 'intrinsic-core'), 
            	'value' => '3',
            ),
            array(
            	'param_name' => 'blog_grid_layout',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Number Of Grids', 'intrinsic-core' ),
            	'description' => esc_html__('Change Your Grid Columns', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'Four Grid', 'intrinsic-core' ) => 'four',
            		esc_html__( 'Three Grid', 'intrinsic-core' ) => 'three',
            		esc_html__( 'Two Grid', 'intrinsic-core' ) => 'two',
            		esc_html__( 'One Grid', 'intrinsic-core' ) => 'one',
            	),
            ),                      
            array(
            	'param_name' => 'blog_item_shortings',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Blog Item Shorting', 'intrinsic-core' ),
            	'description' => esc_html__('Short Your Blog Item', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'Date', 'intrinsic-core' ) => 'post_date',
            		esc_html__( 'Title', 'intrinsic-core' ) => 'post_title',
            		esc_html__( 'Menu Order', 'intrinsic-core' ) => 'menu_order',
            		esc_html__( 'Random', 'intrinsic-core' ) => 'rand',
            	),
            ),            
            array(
            	'param_name' => 'blog_item_order_by',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Blog Item Order By', 'intrinsic-core' ),
            	'description' => esc_html__('Blog Item Order By', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'ASC', 'intrinsic-core' ) => 'asc',
            		esc_html__( 'DESC', 'intrinsic-core' ) => 'desc',
            	),
            ), 
			array(
				'param_name' => 'publish_date_bg',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Publish Date Background', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Publish Date Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),			
			array(
				'param_name' => 'publish_date_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Publish Date Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Publish Date Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#3c3c3c',
			),			
			array(
				'param_name' => 'post_title_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Post Title Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Post Title Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#121212',
			), 	
			array(
				'param_name' => 'category_text_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Category Text Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Category Text Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#828282',
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}