<?php
add_shortcode( 'intrinsic_portfolio_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_portfolio_components', $atts ); 
	extract(shortcode_atts(array(
		'total_posts' => '',  
		'portfolio_grid_layout' => '',  
		'portfolio_item_open_with' => '',  
		'portfolio_item_shortings' => '',  
		'portfolio_item_order_by' => '',  
		'portfolio_hover_bg' => '', 
		'portfolio_hover_text_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?>
	<?php 
		$terms = get_terms( array(
		    'taxonomy' => 'portfolio-category',
		    'hide_empty' => false,
		) );
		$port_cat = array();
		foreach ($terms as $term) { 
			$port_cat[] = $term->slug;
		} 
		$portfolio_query = new WP_Query(
		    array(
		        'post_type' => 'portfolio', 
		        'posts_per_page' => $total_posts,
		        'tax_query' => array(
		            array (
		                'taxonomy' => 'portfolio-category',
		                'field' => 'slug',
		                'terms' => $port_cat,
		            )
				),
				'orderby' => $portfolio_item_shortings,
				'order'   => $portfolio_item_order_by, 
		    )
		);
	?>
    <!-- Content Row -->
    <div class="row portfolio-grid">
    	<?php
    	if( $portfolio_grid_layout == 'one' ) {
    		$grid_no = 'col-lg-12';
    	} elseif( $portfolio_grid_layout == 'two' ) {
    		$grid_no = 'col-lg-6';
    	} elseif( $portfolio_grid_layout == 'three' ) {
    		$grid_no = 'col-lg-4';
    	} else {
    		$grid_no = 'col-lg-3';
    	}
    	if ($portfolio_query->have_posts()) :  
    		while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
	        <div class="col-md-6 <?php echo esc_attr( $grid_no ); ?> item">
	            <div class="portfolio-item" data-animate="hg-fadeInUp">
	                <figure class="portfolio-thumb">
	    	            <?php 
		            	$image_size = get_post_meta(get_the_ID(), 'intrinsic_featured_image_masonry_size', true);
		            	if( $portfolio_grid_layout == 'one' ) {
		            		intrinsic_post_featured_image(1120, 750, true, false); 
		            	} elseif( $portfolio_grid_layout == 'two' ) {
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
		            	} elseif( $portfolio_grid_layout == 'three' ) {
		            		if( $image_size == 'x_x' ) {
		            			intrinsic_post_featured_image(360, 252, true, false); 
		            		} elseif ( $image_size == 'x_dx' ) {
		            			intrinsic_post_featured_image(360, 385, true, false); 
		            		} elseif ( $image_size == 'dx_x' ) {
		            			intrinsic_post_featured_image(360, 490, true, false); 
		            		} elseif ( $image_size == 'dx_dx' ) {
		            			intrinsic_post_featured_image(360, 289, true, false); 
		            		} else {
		            			intrinsic_post_featured_image(360, 289, true, false); 
		            		}
		            	} else {            		
			            	if( $image_size == 'x_x' ) {
			            		intrinsic_post_featured_image(263, 184, true, false); 
			            	} elseif ( $image_size == 'x_dx' ) {
			            		intrinsic_post_featured_image(263, 281, true, false); 
			            	} elseif ( $image_size == 'dx_x' ) {
			            		intrinsic_post_featured_image(263, 358, true, false); 
			            	} elseif ( $image_size == 'dx_dx' ) {
			            		intrinsic_post_featured_image(263, 211, true, false); 
			            	} else {
			            		intrinsic_post_featured_image(263, 211, true, false); 
			            	}
		            	} ?>
	                	<?php 
	                	if( $portfolio_item_open_with == 'custom' ) {
	                		$portfolio_open_type = get_post_meta(get_the_ID(), 'intrinsic_custom_link', true);
	                		$title_link_class = 'custom-image';
	                	} elseif( $portfolio_item_open_with == 'single' ) {
	                		$portfolio_open_type = get_post_permalink(get_the_ID());
	                		$title_link_class = 'single-image';
	                	} else {
	                		$title_link_class = 'popup-image';
	                		$portfolio_open_type = get_the_post_thumbnail_url(get_the_ID(), 'full');
	                	} ?>
	                    <div class="overlay-wrapper">
	                        <div class="overlay" style="background-color: <?php echo esc_attr( $portfolio_hover_bg ); ?>"></div><!--  /.overlay -->
	                        <div class="popup" style="color: <?php echo esc_attr( $portfolio_hover_text_color ); ?>">
	                            <div class="popup-inner">
	                                <a href="<?php echo esc_url( $portfolio_open_type ); ?>" class="popup-image"><i class="fa fa-search"></i></a>
	                            </div><!--  /.popup-inner -->
	                        </div><!--  /.popup -->
	                    </div><!--  /.overlay-wrapper -->
	                </figure><!-- /.portfolio-thumb -->
	                <div class="content" style="color: <?php echo esc_attr( $portfolio_hover_text_color ); ?>">
	                    <h3><a href="<?php echo esc_url( $portfolio_open_type ); ?>" class="<?php echo esc_attr( $title_link_class ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
	                    <?php 
	                    	$portfilio_cats = get_the_terms( get_the_ID(), 'portfolio-category' ); 
	                    	$cats_name = "";
	                    	foreach($portfilio_cats as $cat_name) {    
	                    		$cats_name .= $cat_name->name.' '; 
	                    	}
	                    ?>
	                    <div class="cate"><?php echo esc_html($cats_name); ?></div>
	                </div>                      
	            </div><!--  /.portfolio-item -->
	        </div><!-- /.col-lg-4 --> 
            <?php endwhile; ?> <?php wp_reset_postdata(); ?> 
        <?php endif; ?>
    </div><!--  /.row -->
	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_portfolio_components' );
function intrinsic_vc_portfolio_components() {
	vc_map(array(
		'base' => 'intrinsic_portfolio_components',
		'name' => esc_html__('Portfolio', 'intrinsic-core'),
		'description' => esc_html__('Portfolio Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-th', 
		'params' => array(
            array(
            	'param_name' => 'total_posts',
            	'type' => 'textfield',
            	'heading' => esc_html__('Number Of Post Display', 'intrinsic-core'), 
            	'value' => '12',
            ),
            array(
            	'param_name' => 'portfolio_grid_layout',  
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
            	'param_name' => 'portfolio_item_open_with',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Portfolio Item Open With', 'intrinsic-core' ),
            	'description' => esc_html__('Change Portfolio Item Open With', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'Pop Up', 'intrinsic-core' ) => 'popup',
            		esc_html__( 'Single Portfolio', 'intrinsic-core' ) => 'single_portfolio',
            		esc_html__( 'Custom Links', 'intrinsic-core' ) => 'custom_links',
            	),
            ),            
            array(
            	'param_name' => 'portfolio_item_shortings',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Portfolio Item Shorting', 'intrinsic-core' ),
            	'description' => esc_html__('Short Your Portfolio Item', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'Date', 'intrinsic-core' ) => 'post_date',
            		esc_html__( 'Title', 'intrinsic-core' ) => 'post_title',
            		esc_html__( 'Menu Order', 'intrinsic-core' ) => 'menu_order',
            		esc_html__( 'Random', 'intrinsic-core' ) => 'rand',
            	),
            ),            
            array(
            	'param_name' => 'portfolio_item_order_by',  
            	'type' => 'dropdown',
            	'heading' => esc_html__( 'Portfolio Item Order By', 'intrinsic-core' ),
            	'description' => esc_html__('Portfolio Item Order By', 'intrinsic-core'), 
            	'value' => array(
            		esc_html__( 'ASC', 'intrinsic-core' ) => 'asc',
            		esc_html__( 'DESC', 'intrinsic-core' ) => 'desc',
            	),
            ),
			array(
				'param_name' => 'portfolio_hover_bg',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Portfolio Hover Background', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Portfolio Hover Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => 'rgba(229, 22, 129, 0.75)',
			),			
			array(
				'param_name' => 'portfolio_hover_text_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Hover Text Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Portfolio Text Color Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}