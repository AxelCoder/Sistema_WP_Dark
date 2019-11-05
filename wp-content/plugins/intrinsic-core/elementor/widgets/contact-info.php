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
class Intrinsic_Contact_info_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-contact-info';
	}

	public function get_title() {
		return esc_html__( 'Contact Info', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
			'contact_info_section',
			[
				'label' => esc_html__( 'Contact Info', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_info_elem',
			[
				'label' => esc_html__( 'Info Item', 'intrinsic-core' ),
				'type' => Controls_Manager::REPEATER,  
				'fields' => [ 
					[
						'name' => 'icon',
						'label' => esc_html__( 'Icon', 'intrinsic-core' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
					],
					[
						'name' => 'custom_icon',
						'label' => esc_html__( 'Or Custom Icon', 'intrinsic-core' ),
						'label_block' => true,
						'default' => 'fas fa-envelope',
						'type' => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'intrinsic-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Mail',
					],					
					[
						'name' => 'description',
						'label' => esc_html__( 'Description', 'intrinsic-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => 'example@example.com',
					],
				],
				'title_field' => ' {{ title }}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_styling_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'info_icon_box_bg',
			[
				'label' => esc_html__( 'Icon Box Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-item .icon i' => 'background: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'info_icon_box_color',
			[
				'label' => esc_html__( 'Icon Box Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-item .icon i' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'info_title_color',
			[
				'label' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-item .info-title' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'info_description_color',
			[
				'label' => esc_html__( 'Description Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#dddddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-item .info-detail' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_styling_typography',
			[
				'label' => esc_html__( 'Typography', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'label' => esc_html__( 'Heading', 'intrinsic-core' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .contact-item .info-title',
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
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
				'name'     => 'description_typography',
				'label' => esc_html__( 'Description', 'intrinsic-core' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .contact-item .info-title',
				'fields_options' => [
					'font_weight' => [
						'default' => '600',
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
			'info_styling_spacing',
			[
				'label' => esc_html__( 'Spacing', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'info_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		<?php foreach ($settings['contact_info_elem'] as $key => $value) { ?>
		<div class="contact-item">
            <div class="icon">
                <?php 
                	if ( $value['custom_icon'] !=="" ) { ?>
                		<i class="<?php echo esc_attr( $value['custom_icon'] ); ?>"></i>
                	<?php } else { ?>
                		<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
                	<?php }
                ?>
            </div><!--  /.icon -->
            <div class="details">
                <h3 class="info-title"><?php echo esc_html( $value['title'] ); ?></h3><!--  /.info-title -->
                <p class="info-detail"><?php echo wp_kses_post( $value['description'] ); ?></p>
            </div><!--  /.details -->
        </div><!--  /.contact-item -->
    	<?php } ?>
		<?php 
	}

	/**
	 * Render Contact Info widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
			<# _.each( settings.contact_info_elem, function( value ) { #>
			<div class="contact-item">
	            <div class="icon">
                 	<#
                		if( value.custom_icon !=='' ) { #>
                			<i class="{{ value.custom_icon }}"></i>
                		<# } else { #>
                			<i class="{{ value.icon }}"></i>
                		<# }
                 	#>
	            </div><!--  /.icon -->
	            <div class="details">
	                <h3 class="info-title">{{{ value.title }}}</h3><!--  /.info-title -->
	                <p class="info-detail">{{{ value.description }}}</p>
	            </div><!--  /.details -->
	        </div><!--  /.contact-item -->
	        <# }); #>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Contact_info_Widget() );