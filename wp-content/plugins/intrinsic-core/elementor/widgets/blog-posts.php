<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Intrinsic Contact Form 7 Widget.
 *
 * Intrinsic widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */
class Intrinsic_Blog_Posts_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-blog';
	}

	public function get_title() {
		return esc_html__( 'Blog Posts', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'social_info_aligments',
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
				'default' => 3,
			]
		);	

		$this->add_control(
			'number_grids',
			[
				'label' => esc_html__( 'Number Of Grids', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'three',
				'options' => [
					'one'  => esc_html__( 'One Grid', 'intrinsic-core' ),
					'two' => esc_html__( 'Two Grid', 'intrinsic-core' ),
					'three' => esc_html__( 'Three Grid', 'intrinsic-core' ),
					'four' => esc_html__( 'Four Grid', 'intrinsic-core' ),
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
					'menu_order' => __( 'Menu Order', 'intrinsic-core' ),
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
			'content_color_style',
			[
				'label' => esc_html__( 'Content Color', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'post_date_bg',
			[
				'label' => esc_html__( 'Date Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .post-item .post .post-thumb .entry-date' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'post_date_color',
			[
				'label' => esc_html__( 'Date Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#121212',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .post-item .post .post-thumb .entry-date' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'post_title_color',
			[
				'label' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#121212',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .post-item .post .entry-title' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'post_category_color',
			[
				'label' => esc_html__( 'Category Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#828282',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .post-item .post .post-detail .entry-cat' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'content_color_typography',
			[
				'label' => esc_html__( 'Content Typography', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label' => esc_html__( 'Date', 'intrinsic-core' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .post-item .post .post-thumb .entry-date',
				'fields_options' => [
					'font_weight' => [
						'default' => '700',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 15 ] ],
				],
			]
		);			

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .post-item .post .entry-title',
				'fields_options' => [
					'font_weight' => [
						'default' => '700',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 20 ] ],
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label' => esc_html__( 'Category', 'intrinsic-core' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .post-item .post .post-detail .entry-cat',
				'fields_options' => [
					'font_weight' => [
						'default' => '500',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 16 ] ],
				],
			]
		);	

		$this->end_controls_section();
	}


	/**
	 * Render Edu_Exp widget output on the frontend.
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
		}
		$args = array(
		    'posts_per_page' => $settings['number'],  
		    'post_type' => 'post',
		    'orderby' => $settings['orderby'],
		    'order'   => $settings['order'], 
		);
		$the_query = new \WP_Query( $args ); ?>

		<!-- Content Row -->
		<div class="row">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		    <div class="<?php echo esc_attr( $grid_no ); ?>">
		        <div class="post-item" data-animate="hg-fadeInUp">                    
		            <article class="post">
		            	<?php if ( has_post_thumbnail() ) { ?>
		            	    <figure class="post-thumb">          
		                    	<div class="entry-date"><?php echo get_the_date('M j, Y'); ?></div><!--  /.entry-date -->
		            	        <a href="<?php the_permalink(); ?>">
		            	        	<?php 
		            	        		if( $settings['number_grids'] == 'one' ) {
		            	        			intrinsic_post_featured_image(350, 332, true, false);
		            	        		} elseif( $settings['number_grids'] == 'two' ) {
		            	        			intrinsic_post_featured_image(350, 332, true, false);
		            	        		} elseif( $settings['number_grids'] == 'three' ) {
		            	        			intrinsic_post_featured_image(350, 332, true, false);
		            	        		} else {
		            	        			intrinsic_post_featured_image(258, 244, true, false);
		            	        		}
		            	        	?>
		            	        </a> 
		            	    </figure><!-- /.post-thumb -->
		            	<?php } ?>
		                <div class="post-detail">
		                	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		                    <div class="entry-cat">
		                    	<?php the_category(', '); ?>
		                    </div><!--  /.entry-cat -->
		                </div><!--  /.post-detail -->
		            </article><!--  /.post -->
		        </div><!--  /.post-item -->
		    </div><!--  /.col-md-4 --> 
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!--  /.row -->
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Blog_Posts_Widget() );