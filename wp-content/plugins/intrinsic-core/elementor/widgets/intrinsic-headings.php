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
class Intrinsic_Main_Headings_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-main-headings';
	}

	public function get_title() {
		return esc_html__( 'Intrinsic Headings', 'intrinsic-core' );
	}

	public function get_icon() {
		return ' eicon-editor-h1';
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
			'heading_content',
			[
				'label' => esc_html__( 'Headings', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_count',
			[
				'label'       => esc_html__( 'Heading Count', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter heading count', 'intrinsic-core' ),
				'default'     => esc_html__( '01', 'intrinsic-core' ),
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'       => esc_html__( 'Main Heading', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your heading here', 'intrinsic-core' ),
				'default'     => esc_html__( 'I am Heading', 'intrinsic-core' ),
			]
		);		

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'intrinsic-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'intrinsic-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'intrinsic-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'intrinsic-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'elementor-align%s-',
			]
		);

		$this->add_control(
			'show_border',
			[
				'label' => esc_html__( 'Show Bottom Border', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Hide', 'intrinsic-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_heading',
			[
				'label'     => esc_html__( 'Counting', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'     => esc_html__( 'Color', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#e1e1e1',
				'selectors' => [
					'{{WRAPPER}} .section-title .title-counter' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .section-title .title-counter',
				'fields_options' => [
					'font_weight' => [
						'default' => '700',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 7.323 ] ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main_heading',
			[
				'label'     => esc_html__( 'Main Heading', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'main_heading!' => '',
				],
			]
		);


		$this->add_control(
			'main_heading_color',
			[
				'label'     => esc_html__( 'Color', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#121212',
				'selectors' => [
					'{{WRAPPER}} .section-title .title-main' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'main_heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .section-title .title-main',
				'fields_options' => [
					'font_weight' => [
						'default' => '800',
					],
					'font_family' => [
						'default' => 'Dosis',
					],		
					'text_transform' => [
						'default' => 'uppercase',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 2.441 ] ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_heading_border',
			[
				'label'     => esc_html__( 'Border', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'large_border_color',
			[
				'label'     => esc_html__( 'Large Border', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#e51681',
				'selectors' => [
					'{{WRAPPER}} .title-border .large-border' => 'background: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'small_border_color',
			[
				'label'     => esc_html__( 'Small Border', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .title-border .small-border' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'heading_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_padding',
			[
				'label'      => esc_html__( 'Padding', 'intrinsic-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_control(
			'heading_margin',
			[
				'label'      => esc_html__( 'Margin', 'intrinsic-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings = $this->get_settings_for_display(); ?>
		<div class="section-title">
			<?php if( $settings['heading_count'] ) { ?>
            <h2 class="title-counter"><?php echo esc_html( $settings['heading_count'] ); ?></h2><!--  /.title-counter -->
        	<?php } ?>
        	<?php if( $settings['main_heading'] ) { ?>
            <h2 class="title-main"><?php echo esc_html( $settings['main_heading'] ); ?></h2><!-- /.title-main -->
        	<?php } ?>

        	<?php if( $settings['show_border'] == 'yes' ) { ?>
            <div class="title-border">
                <span class="small-border bg-black"></span>
                <span class="large-border bg-deep-cerise"></span>
                <span class="small-border bg-black"></span>
            </div><!--  /.title-border -->
        	<?php } ?>
        </div>
		<?php
	}

	/**
	 * Render Social Info widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="section-title">
			<# if( settings.heading_count ) { #>
            <h2 class="title-counter">{{{ settings.heading_count }}}</h2><!--  /.title-counter -->
        	<# } #>
        	<# if( settings.main_heading ) { #>
            <h2 class="title-main">{{{ settings.main_heading }}}</h2><!-- /.title-main -->
        	<# } #>

        	<# if( settings.show_border == 'yes' ) { #>
            <div class="title-border">
                <span class="small-border bg-black"></span>
                <span class="large-border bg-deep-cerise"></span>
                <span class="small-border bg-black"></span>
            </div><!--  /.title-border -->
        	<# } #>
        </div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Main_Headings_Widget() );