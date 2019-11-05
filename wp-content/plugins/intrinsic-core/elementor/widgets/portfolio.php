<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Intrinsic Portfolio Widget.
 *
 * Intrinsic widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Intrinsic_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	/**
	 * Register Portfolio widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Total Post', 'intrinsic-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 12,
			]
		);		

		$this->add_control(
			'number_grids',
			[
				'label' => esc_html__( 'Number Of Grids', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'four',
				'options' => [
					'one'  => esc_html__( 'One Grid', 'intrinsic-core' ),
					'two' => esc_html__( 'Two Grid', 'intrinsic-core' ),
					'three' => esc_html__( 'Three Grid', 'intrinsic-core' ),
					'four' => esc_html__( 'Four Grid', 'intrinsic-core' ),
				],
			]
		);

		$this->add_control(
			'portfolio_open_with',
			[
				'label' => esc_html__( 'Portfolio Open With', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => [
					'popup'  => esc_html__( 'Popup', 'intrinsic-core' ),
					'single' => esc_html__( 'Single Portfolio', 'intrinsic-core' ),
					'custom' => esc_html__( 'Custom Links', 'intrinsic-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_shortings',
			[
				'label' => esc_html__( 'Shortings', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => esc_html__( 'Date', 'intrinsic-core' ),
					'post_title' => esc_html__( 'Title', 'intrinsic-core' ),
					'menu_order' => esc_html__( 'Menu Order', 'intrinsic-core' ),
					'rand' => esc_html__( 'Random', 'intrinsic-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'intrinsic-core' ),
					'desc' => esc_html__( 'DESC', 'intrinsic-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'portfolio_icons_color',
			[
				'label' => esc_html__( 'Icon Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .portfolio-thumb .popup .popup-inner a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'portfolio_title_color',
			[
				'label' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .content h3' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);			

		$this->add_control(
			'portfolio_cat_color',
			[
				'label' => esc_html__( 'Category Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .content .cate' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);			

		$this->add_control(
			'portfolio_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(229, 22, 129, 0.75)',
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .portfolio-thumb .overlay' => 'background-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);		

		$this->add_control(
			'portfolio_overlay_border_color',
			[
				'label' => esc_html__( 'Overlay Border Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255, 255, 255, 0.45)',
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .portfolio-thumb .overlay:before' => 'border-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Portfolio widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display();
		if( $settings['number_grids'] == 'one' ) {
			$grid_no = 'col-lg-12';
		} elseif( $settings['number_grids'] == 'two' ) {
			$grid_no = 'col-lg-6';
		} elseif( $settings['number_grids'] == 'three' ) {
			$grid_no = 'col-lg-4';
		} else {
			$grid_no = 'col-lg-3';
		} ?>
		<div class="row portfolio-grid">
			<?php 
				$terms = get_terms( array(
				    'taxonomy' => 'portfolio-category',
				    'hide_empty' => false,
				) );
				$port_cat = array();
				foreach ($terms as $term) { 
					$port_cat[] = $term->slug;
				} 
				$portfolio_query = new \WP_Query(
				    array(
				        'post_type' => 'portfolio', 
				        'posts_per_page' => $settings['number'],
				        'tax_query' => array(
				            array (
				                'taxonomy' => 'portfolio-category',
				                'field' => 'slug',
				                'terms' => $port_cat,
				            )
						),
						'orderby' => $settings['orderby'],
						'order'   => $settings['order'], 
				    )
				);
			while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?> 
			<?php if ( has_post_thumbnail() ) { 
				$get_portfolio_url_stauts = $settings['portfolio_open_with'];
				if( $get_portfolio_url_stauts == 'custom' ) {
					$portfolio_open_type = get_post_meta(get_the_ID(), 'intrinsic_custom_link', true);
					$title_link_class = 'custom-image';
            	} elseif( $get_portfolio_url_stauts == 'single' ) {
            		$portfolio_open_type = get_post_permalink(get_the_ID());
            		$title_link_class = 'single-image';
            	} else {
            		$title_link_class = 'popup-image';
            		$portfolio_open_type = get_the_post_thumbnail_url(get_the_ID(), 'full');
            	}
			?>
			<div class="col-md-6 <?php echo esc_attr($grid_no); ?> item">
		    	<div class="portfolio-item" data-animate="hg-fadeInUp">
		    	    <figure class="portfolio-thumb">
	    	            <?php 
		            	$image_size = get_post_meta(get_the_ID(), 'intrinsic_featured_image_masonry_size', true);
		            	if( $settings['number_grids'] == 'one' ) {
		            		intrinsic_post_featured_image(1120, 750, true, false); 
		            	} elseif( $settings['number_grids'] == 'two' ) {
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
		            	} elseif( $settings['number_grids'] == 'three' ) {
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
		    	        <div class="overlay-wrapper">
		    	            <div class="overlay"></div><!--  /.overlay -->
		    	            <div class="popup">
		    	                <div class="popup-inner">
		    	                    <a href="<?php echo esc_url( $portfolio_open_type ); ?>" class="<?php echo esc_attr( $title_link_class ); ?>"><i class="fa fa-search"></i></a>
		    	                </div><!--  /.popup-inner -->
		    	            </div><!--  /.popup -->
		    	        </div><!--  /.overlay-wrapper -->
		    	    </figure><!-- /.portfolio-thumb -->
		    	    <div class="content">
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
	    	<?php } ?>
	        <?php endwhile; ?> <?php wp_reset_postdata(); ?>
		</div>
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Portfolio_Widget() );