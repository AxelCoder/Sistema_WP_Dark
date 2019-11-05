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
class Intrinsic_Revolution_Slider_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-slider-revolution';
	}

	public function get_title() {
		return esc_html__( 'Slider Revolution', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-slider-3d';
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
			'contact_content_section',
			[
				'label' => esc_html__( 'Content', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'revoluation_slider',
			[
				'label' => esc_html__( 'Select Slider', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => $this->get_rev_slider_list(),
			]
		); 

		$this->end_controls_section();

		$this->start_controls_section(
			'rev_slider_styling',
			[
				'label' => esc_html__( 'Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'rev_slider_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .intrinsic-rev-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'rev_slider_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .intrinsic-rev-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Contact Form List.
	 *
	 * @since 1.0
	 */
	protected function get_rev_slider_list() {
		global $wpdb;
        $revsliders = array();
        $revsliders[0] = esc_html__( 'Select a slider', 'intrinsic-core' );

        $get_sliders = $wpdb->get_results ( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders where 1=%d', 1 ) );

        if ($get_sliders) {
            foreach ( $get_sliders as $slider ) {
                $revsliders[$slider->alias] = $slider->title;
            }
        }

        return $revsliders;
	}

	/**
	 * Render Edu_Exp widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); 
		?>  
		<div class="intrinsic-rev-slider">
			<?php  echo do_shortcode( '[rev_slider alias="'. $settings['revoluation_slider'] .'"]' ); ?>
		</div><!--  /.intrinsic-rev-slider -->
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Revolution_Slider_Widget() );