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

class Intrinsic_Contact_Form_7_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-contact_form_7';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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
			'contact_forms',
			[
				'label' => esc_html__( 'Select Form', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => $this->contact_form_list(),
			]
		); 

		$this->end_controls_section();

		$this->start_controls_section(
			'field_label',
			[
				'label' => esc_html__( 'Label Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_labelColor',
			[
				'label' => esc_html__( 'Label Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} form.wpcf7-form' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'form_labelDispaly',
			[
				'label' => esc_html__( 'Label Display', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'inline'  => esc_html__( 'inline', 'intrinsic-core' ),
					'block' => esc_html__( 'block', 'intrinsic-core' ), 
					'inline-block' => esc_html__( 'inline-block', 'intrinsic-core' ), 
				],
				'selectors' => [
					'{{WRAPPER}} form.wpcf7-form label' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_labels_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} form.wpcf7-form label',
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'form_inputs',
			[
				'label' => esc_html__( 'Field Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_inputs_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_inputs_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_inputs_size',
			[
				'label' => esc_html__( 'Fields Width', 'intrinsic-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), {{WRAPPER}} .wpcf7-form-control-wrap textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_inputs_txt_color',
			[
				'label' => esc_html__( 'Text Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea, {{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} :-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} :-moz-placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_inputs_bg',
			[
				'label' => esc_html__( 'Background Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_inputs_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_inputs_border',
				'label' => esc_html__( 'Box Border', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea',
			]
		);

        $this->add_control(
			'form_inputs_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap input:not(.wpcf7-submit), .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_btn',
			[
				'label' => esc_html__( 'Button Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_btn_size',
			[
				'label' => esc_html__( 'Button Size', 'intrinsic-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_btn_txt_color',
			[
				'label' => esc_html__( 'Text Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_btn_hover_txt_color',
			[
				'label' => esc_html__( 'Hover Text Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => '-webkit-transition:all 0.6s ease 0s;-moz-transition:all 0.6s ease 0s;-ms-transition:all 0.6s ease 0s;-o-transition:all 0.6s ease 0s;transition:all 0.6s ease 0s;',
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_btn_bg',
			[
				'label' => esc_html__( 'Background-color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_btn_hover_bg',
			[
				'label' => esc_html__( 'Hover Background color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => '-webkit-transition:all 0.6s ease 0s;-moz-transition:all 0.6s ease 0s;-ms-transition:all 0.6s ease 0s;-o-transition:all 0.6s ease 0s;transition:all 0.6s ease 0s;',
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_btn_box_shadow',
				'selector' => '{{WRAPPER}} .wpcf7-form-control.wpcf7-submit',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_btn_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wpcf7-form-control.wpcf7-submit',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_btn_border',
				'label' => esc_html__( 'Button Border', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .wpcf7-form-control.wpcf7-submit',
			]
		);        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_btn_border_hover',
				'label' => esc_html__( 'Button Border Hover', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .wpcf7-form-control.wpcf7-submit:hover',
			]
		);

        $this->add_control(
			'form_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function contact_form_list() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[ esc_html__( 'No contact forms found', 'intrinsic-core' ) ] = 0;
		}

		return $contact_forms;
	}

	/**
	 * Render Edu_Exp widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); 
			echo do_shortcode( '[contact-form-7 id="'. $settings['contact_forms'] .'"]' );
		?> 
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Contact_Form_7_Widget() );