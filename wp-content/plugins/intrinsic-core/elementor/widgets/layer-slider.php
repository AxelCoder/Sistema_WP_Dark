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
class Intrinsic_Layer_Slider_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-layerslider';
	}

	public function get_title() {
		return esc_html__( 'Layer Slider', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
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
			'layer_slider',
			[
				'label' => esc_html__( 'Select Slider', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => $this->get_layer_slider_list(),
			]
		); 

		$this->end_controls_section();

		$this->start_controls_section(
			'layer_styling',
			[
				'label' => esc_html__( 'Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'layer_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .intrinsic-layer-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'layer_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .intrinsic-layer-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function get_layer_slider_list() {
		global $wpdb;
        $slides_array = array();
        $slides_array[0] = esc_html__( 'Select a slider', 'intrinsic-core' );
        if( function_exists( 'layerslider_loaded' ) ) {
	        $table_name = $wpdb->prefix . "layerslider";

	        $sliders = $wpdb->get_results ( $wpdb->prepare( "SELECT * FROM $table_name WHERE flag_hidden = '%d' AND flag_deleted = '%d' ORDER BY date_c ASC", 0, 0 ) );

	        if (! empty ( $sliders )) :
	        	foreach ( $sliders as $key => $item ) :
	        		$slides[$item->id] = '';
	        	endforeach;
	        endif;
    	}

        if( isset( $slides ) && $slides ) {
        	foreach ( $slides as $key => $val ) {
        		$slides_array[$key] = esc_html__( 'LayerSlider #', 'intrinsic-core' ) . ($key);
        	}
        }

        return $slides_array;
	}

	/**
	 * Render Edu_Exp widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); 
		?>  
		<div class="intrinsic-layer-slider">
			<?php  echo do_shortcode( '[layerslider id="'. $settings['layer_slider'] .'"]' ); ?>
		</div><!--  /.intrinsic-rev-slider -->
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Layer_Slider_Widget() );