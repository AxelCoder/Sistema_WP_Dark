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
class Intrinsic_Call_to_actions extends Widget_Base {

	public function get_name() {
		return 'intrinsic-call-to-actions';
	}

	public function get_title() {
		return esc_html__( 'Call To Actions', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
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
			'call_to_sections',
			[
				'label' => esc_html__( 'Call To Actions', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'call_to_actions_title',
			[
				'label' => esc_html__( 'Call To Title', 'intrinsic-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Add Title', 'intrinsic-core' ),
				'default'	=> esc_html__('Let\'s Work On Your Next Projects', 'intrinsic-core'),
			]
		);

		$this->add_control(
			'call_to_background',
			[
				'label' => esc_html__( 'Background Image', 'intrinsic-core' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'call_to_btn',
			[
				'label' => esc_html__( 'Button', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'call_to_actions_btn_title',
			[
				'label' => esc_html__( 'Button Title', 'intrinsic-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add Title', 'intrinsic-core' ),
				'default' => 'Hire Me Now!',
			]
		);	

		$this->add_control(
			'call_to_button_url',
			[
				'label' => esc_html__( 'Button URL', 'intrinsic-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'intrinsic-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
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

		$this->add_responsive_control(
			'video_popup_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'video_popup_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'call_to_title_color',
			[
				'label' => esc_html__( 'Title Colors', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .call-to-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'label' => esc_html__( 'Title Typo', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .call-to-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 2.9292 ] ],
				],
			]
		);			

		$this->add_control(
			'call_to_overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(18,20,28,0.75)',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .call-to-action .hg-overlay:before' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'call_to_btn_bg',
			[
				'label' => esc_html__( 'Button Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .call-to-action .btn-call-to' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'call_to_btn_hover_bg',
			[
				'label' => esc_html__( 'Button Hover Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .call-to-action .btn-call-to:hover' => 'background-color: {{VALUE}};',
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
		<div class="call-to-action">
	        <div class="container">
	        	<?php if(  $settings['call_to_actions_title'] ) { ?>
	            <h2 class="call-to-title"><?php echo esc_html( $settings['call_to_actions_title'] ); ?></h2><!--  /.call-to-title -->
	            <?php } ?>
	            <?php if( $settings['call_to_actions_btn_title'] !== '' ) : ?>
	            <?php 
	            	$target = $settings['call_to_button_url']['is_external'] ? ' target="_blank"' : '';
	            	$nofollow = $settings['call_to_button_url']['nofollow'] ? ' rel="nofollow"' : '';
	            ?>
	            <a href="<?php echo esc_url( $settings['call_to_button_url']['url'] ); ?>" class="btn btn-call-to mrt-30" <?php echo ( $target .' '. $nofollow ) ?>><?php echo esc_html( $settings['call_to_actions_btn_title'] ); ?></a>
	            <?php endif; ?>
	        </div><!--  /.container -->

	        <div class="hg-background hg-overlay" data-bg-parallax="scroll" data-bg-parallax-speed="3">
	            <div class="hg-background-image hg-parallax-element" data-bg-image="<?php echo esc_url( $settings['call_to_background']['url'] ); ?>"></div><!--  /.hg-background-image -->
	        </div><!--  /.hg-background -->
	    </div><!--  /.our-work-step -->
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Call_to_actions() );