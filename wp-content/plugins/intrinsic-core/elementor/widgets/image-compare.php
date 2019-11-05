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
class Intrinsic_Image_Compare_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-image-before-after';
	}

	public function get_title() {
		return esc_html__( 'Image Before After', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	public function get_style_depends() {
		return [ 'twentytwenty' ];
	}

	public function get_script_depends() {
		return [ 'eventmove', 'twentytwenty' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'social_info_section',
			[
				'label' => esc_html__( 'Layout', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
				'label' => esc_html__( 'Before Image (Same Size of Both Image)', 'intrinsic-core' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => INTRINSIC_PLUGIN_URL . '/elementor/assets/images/before.svg',
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'after_image',
			[
				'label' => esc_html__( 'After Image (Same Size of Both Image)', 'intrinsic-core' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => INTRINSIC_PLUGIN_URL.'/elementor/assets/images/after.svg',
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'before_label',
			[
				'label'       => esc_html__( 'Before Label', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Before Label', 'intrinsic-core' ),
				'default'     => esc_html__( 'Before', 'intrinsic-core' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'after_label',
			[
				'label'       => esc_html__( 'After Label', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'After Label', 'intrinsic-core' ),
				'default'     => esc_html__( 'After', 'intrinsic-core' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'orientation',
			[
				'label'   => esc_html__( 'Orientation', 'intrinsic-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'intrinsic-core' ),
					'vertical'   => esc_html__( 'Vertical', 'intrinsic-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_styling',
			[
				'label' => esc_html__( 'Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'before_background',
			[
				'label' => esc_html__( 'Before Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-before-label:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'before_color',
			[
				'label' => esc_html__( 'Before Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-before-label:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'after_background',
			[
				'label' => esc_html__( 'After Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-after-label:before' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'after_color',
			[
				'label' => esc_html__( 'After Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-after-label:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-handle' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-handle:before' => 'background-color: {{VALUE}}; -webkit-box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5); box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-handle:after' => 'background-color: {{VALUE}}; -webkit-box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5); box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-handle span.twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .intrinsic-image-compare .twentytwenty-handle span.twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
				],
				'separator' => 'before',
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
		$settings = $this->get_settings();
		?>
		<div class="intrinsic-image-compare intrinsic-position-relative">
			<div class="twentytwenty-container">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'before_image' ); ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'after_image' ); ?>
			</div>
		</div>

		<script>
			jQuery(document).ready(function($) {
				"use strict";
				$(".elementor-element-<?php echo esc_attr($this->get_id()); ?> .twentytwenty-container").twentytwenty({
					default_offset_pct: 0.7, 
					orientation: '<?php echo esc_attr($settings['orientation']); ?>',
					before_label: '<?php echo esc_html($settings['before_label']); ?>',
					after_label: '<?php echo esc_html($settings['after_label']); ?>',
				});
			});
		</script>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Image_Compare_Widget() );