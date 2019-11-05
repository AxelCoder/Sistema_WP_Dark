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
class Intrinsic_Counter_item_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-counter';
	}

	public function get_title() {
		return esc_html__( 'Counter Item', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
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
			'counter_sections',
			[
				'label' => esc_html__( 'Counter', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'counter_elem',
			[
				'label' => esc_html__( 'Counter Item', 'intrinsic-core' ),
				'type' => Controls_Manager::REPEATER,  
				'fields' => [ 
					[
						'name' => 'counter_box',
						'label' => esc_html__( 'Counter Value', 'intrinsic-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '43',
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'intrinsic-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Hourly Rate',
					],
				],
				'default' => [
					[
						'counter_box' => '117',
						'title'  => esc_html__( 'Happy Client', 'intrinsic-core' ),
					],		
					[
						'counter_box' => '20',
						'title'  => esc_html__( 'Years Experience', 'intrinsic-core' ),
					],
					[
						'counter_box' => '16',
						'title'  => esc_html__( 'Award Winer', 'intrinsic-core' ),
					],
					[
						'counter_box' => '156',
						'title'  => esc_html__( 'Project Complete', 'intrinsic-core' ),
					],
				],
				'title_field' => ' {{ title }}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'counter_styling',
			[
				'label' => esc_html__( 'Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'carousel_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fun-facts-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'carousel_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fun-facts-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layout_one_background',
			[
				'label' => esc_html__( 'Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#12141c',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .fun-facts-block' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'counter_title_colors',
			[
				'label' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .tg-promo-number .promo-title' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_numbers',
				'label' => esc_html__( 'Counter', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .tg-promo-number .odometer',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 7.323 ] ],
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'label' => esc_html__( 'Counter Title', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .tg-promo-number .promo-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 1.25 ] ],
				],
			]
		);	

		$this->add_control(
			'counter_colors',
			[
				'label' => esc_html__( 'Counter Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .tg-promo-number .odometer' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'counter_devider_colors',
			[
				'label' => esc_html__( 'Counter Devider Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255, 255, 255, .15)',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .hg-promo-numbers > .row > .col-lg-3 .tg-promo-number:after' => 'background-color: {{VALUE}};',
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
		?>  
		<div class="fun-facts-block">
			<div class="container hg-promo-numbers el-promonumber">			
				<div class="row">
					<?php foreach ($settings['counter_elem'] as $key => $value) { ?>
					<div class="col-sm-6 col-lg-3">
					    <div class="tg-promo-number text-center">
					        <div class="odometer el-odometer" data-odometer-final="<?php echo esc_attr( $value['counter_box'] ); ?>">0</div>
					        <h4 class="promo-title"><?php echo esc_html( $value['title'] ); ?></h4>
					    </div>
					    <!--end ts-promo-number-->
					</div>
					<?php } ?>
				</div>
			</div><!--  /.hg-promo-numbers -->
		</div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Counter_item_Widget() );