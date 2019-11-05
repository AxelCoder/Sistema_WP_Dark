<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Intrinsic Testimonials Widget.
 *
 * Intrinsic widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Intrinsic_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	/**
	 * Register Testimonials widget controls.
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
	 		'testimonials',
	 		[
	 			'label' => esc_html__( 'Testimonials', 'intrinsic-core' ),
	 			'type' => Controls_Manager::REPEATER,
	 			'default' => [
	 				[
	 					'name' => esc_html__( 'Zohan Smith', 'intrinsic-core' ),
	 					'position' => esc_html__( 'Chif Dighal Officer', 'intrinsic-core' ),
	 					'testimonial' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.",
	 				], 
	 			],
	 			'fields' => [ 
	 				[
	 					'name' => 'name',
	 					'label' => esc_html__( 'Name', 'intrinsic-core' ),
	 					'type' => Controls_Manager::TEXT,
	 					'label_block' => true, 
	 					'default' => 'Zohan Smith',
	 				], 
	 				[
	 					'name' => 'img',
	 					'label' => esc_html__( 'Image', 'intrinsic-core' ),
	 					'type' => Controls_Manager::MEDIA,
	 					'dynamic' => [
	 						'active' => true,
	 					],
	 					'default' => [
	 						'url' => Utils::get_placeholder_image_src(),
	 					],
	 				],
	 				[
	 					'name' => 'position',
	 					'label' => esc_html__( 'Position', 'intrinsic-core' ),
	 					'type' => Controls_Manager::TEXT,
	 					'label_block' => true, 
	 					'default' => esc_html__( 'Chif Dighal Officer', 'intrinsic-core' ),
	 				],
	 				[
	 					'name' => 'testimonial',
	 					'label' => esc_html__( 'Testimonial', 'intrinsic-core' ),
	 					'type' => Controls_Manager::WYSIWYG,
	 					'dynamic' => [
	 						'active' => true,
	 					],
	 					'default' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.",
	 				],
	 			],
	 			'title_field' => ' {{{ name }}} -- {{ position }}',
	 		]
	 	);

	 	$this->end_controls_section();

	 	$this->start_controls_section(
	 		'content_style',
	 		[
	 			'label' => esc_html__( 'Color Control', 'intrinsic-core' ),
	 			'tab' => Controls_Manager::TAB_STYLE,
	 		]
	 	);

	 	$this->add_control(
	 		'quote_box_background',
	 		[
	 			'label' => esc_html__( 'Background', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#27282b',
	 			'selectors' => [
	 				'{{WRAPPER}} .client-testimonial .testimonial-details' => 'background: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);
		
	 	$this->add_control(
	 		'quote_client_name_color',
	 		[
	 			'label' => esc_html__( 'Client Name Color', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#dfdfdf',
	 			'selectors' => [
	 				'{{WRAPPER}} .client-testimonial .testimonial-details .client-name' => 'color: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);

	 	$this->add_control(
	 		'quote_icon_color',
	 		[
	 			'label' => esc_html__( 'Quote Color', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#dddddd',
	 			'selectors' => [
	 				'{{WRAPPER}} .client-testimonial .testimonial-details .details' => 'color: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);
		 
	 	$this->add_control(
	 		'quote_client_border_color',
	 		[
	 			'label' => esc_html__( 'Thumbnail Border Color', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#ffffff',
	 			'selectors' => [
	 				'{{WRAPPER}} .client-testimonial .client-thumb' => 'border-color: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);	 	

		$this->add_control(
	 		'quote_carousel_dot_color',
	 		[
	 			'label' => esc_html__( 'Carousel Dot Color', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#cbcaca',
	 			'selectors' => [
	 				'{{WRAPPER}} .testimonial-carousel .owl-dots .owl-dot' => 'background: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);		

		$this->add_control(
	 		'quote_carousel_dot_active_color',
	 		[
	 			'label' => esc_html__( 'Carousel Dot Active Color', 'intrinsic-core' ),
	 			'type' => Controls_Manager::COLOR,
	 			'default' => '#e51681',
	 			'selectors' => [
	 				'{{WRAPPER}} .testimonial-carousel .owl-dots .owl-dot.active' => 'background: {{VALUE}};',
	 			],
	 			'scheme' => [
	 				'type' => Scheme_Color::get_type(),
	 				'value' => Scheme_Color::COLOR_1,
	 			],
	 		]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style_typography',
			[
				'label' => esc_html__( 'Typography Control', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'client_name_typography',
				'label' => esc_html__( 'Client Name:', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .client-testimonial .testimonial-details .client-name',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 25 ] ],
				],
			]
		);			

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'client_quote_typography',
				'label' => esc_html__( 'Client Name:', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .client-testimonial .testimonial-details .details',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'font_weight' => [
						'default' => '400',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 20 ] ],
				],
			]
		);	
		 
		$this->end_controls_section();


		$this->start_controls_section(
			'content_style_spacing',
			[
				'label' => esc_html__( 'Spacing Control', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'padding_controls',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .client-testimonial .testimonial-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Testimonials widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); ?> 
		<!-- Content Row -->
		<div class="row justify-content-md-center">
		    <div class="col-md-10">            
		        <div class="testimonial-carousel owl-carousel" data-owl-items="1" data-owl-dots="1" data-animate="hg-fadeInUp">
		        	<?php foreach ( $settings['testimonials'] as $index => $item ) : ?>
		            <div class="item">
		                <div class="client-testimonial">
		                	<?php if(isset($item['img'])) { ?>
		                    <div class="client-thumb">
		                        <img src="<?php echo esc_url( intrinsic_get_image_crop_size_by_url( $item['img']['url'], 100, 100, true ) ); ?>" alt="<?php if(isset($item['name'])) echo esc_attr($item['name']); ?>" />
		                    </div><!--  /.client-thumb -->
		                	<?php } ?>
		                    <div class="testimonial-details">
		                        <div class="client-area">
		                        	<?php if(isset($item['name'])) { ?>
		                            <div class="client-detail">
		                                <h4 class="client-name"><?php echo esc_html($item['name']); ?></h4><!--  /.client-name -->
		                            </div><!--  /.client-detail -->
		                        	<?php } ?>
		                        </div><!--  /.client-area -->
		                        <?php if(isset($item['testimonial'])) { ?>
		                        <div class="details">
		                            <?php echo wp_kses_post($item['testimonial']); ?>
		                        </div><!--  /.details -->
		                    	<?php } ?>
		                    </div><!--  /.testimonial-details -->
		                </div><!--  /.client-testimonial -->
		            </div><!--  /.item -->
		            <?php endforeach; ?> 
		        </div><!--  /.owl-carousel -->
		    </div><!--  /.col-md-10 -->
		</div><!--  /.row -->
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Testimonials_Widget() );