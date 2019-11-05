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
class Intrinsic_Animated_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-animated_header';
	}

	public function get_title() {
		return esc_html__( 'Animated Header', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	public function get_script_depends() {
		return [ 'morphext', 'typed' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_heading',
			[
				'label' => esc_html__( 'Heading', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_layout',
			[
				'label'   => esc_html__( 'Layout', 'intrinsic-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'animated' => esc_html__( 'Animated', 'intrinsic-core' ),
					'typed'    => esc_html__( 'Typed', 'intrinsic-core' ),
				],
				'default' => 'animated',
			]
		);

		$this->add_control(
			'pre_heading',
			[
				'label'       => esc_html__( 'Prefix Heading', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your prefix title', 'intrinsic-core' ),
				'default'     => esc_html__( 'Hello I am', 'intrinsic-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'animated_heading',
			[
				'label'       => esc_html__( 'Heading', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'intrinsic-core' ),
				'description' => esc_html__( 'Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'intrinsic-core' ),
				'default'     => esc_html__( "Animated,Morphing,Awesome", 'intrinsic-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'post_heading',
			[
				'label'       => esc_html__( 'Post Heading', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your suffix title', 'intrinsic-core' ),
				'default'     => esc_html__( 'Heading', 'intrinsic-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'intrinsic-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
			]
		);

		$this->add_control(
			'header_size',
			[
				'label'   => esc_html__( 'HTML Tag', 'intrinsic-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => esc_html__( 'H1', 'intrinsic-core' ),
					'h2'   => esc_html__( 'H2', 'intrinsic-core' ),
					'h3'   => esc_html__( 'H3', 'intrinsic-core' ),
					'h4'   => esc_html__( 'H4', 'intrinsic-core' ),
					'h5'   => esc_html__( 'H5', 'intrinsic-core' ),
					'h6'   => esc_html__( 'H6', 'intrinsic-core' ),
					'div'  => esc_html__( 'div', 'intrinsic-core' ),
					'span' => esc_html__( 'span', 'intrinsic-core' ),
					'p'    => esc_html__( 'p', 'intrinsic-core' ),
				],
				'default' => 'h2',
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
				'default'      => 'center',
				'prefix_class' => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animation',
			[
				'label'     => esc_html__( 'Animation', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_animation!' => '',
				],
			]
		);

		$this->add_control(
			'heading_animation',
			[
				'label'       => esc_html__( 'Animation', 'intrinsic-core' ),
				'type'        => Controls_Manager::ANIMATION,
				'default'     => 'fadeIn',
				'label_block' => true,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_duration',
			[
				'label'   => esc_html__( 'Animation Duration', 'intrinsic-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''     => esc_html__( 'Normal', 'intrinsic-core' ),
					'slow' => esc_html__( 'Slow', 'intrinsic-core' ),
					'fast' => esc_html__( 'Fast', 'intrinsic-core' ),
				],
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_delay',
			[
				'label'     => esc_html__( 'Animation Delay', 'intrinsic-core' ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 2500,
				'min'       => 100,
				'max'       => 7000,
				'step'      => 100,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'     => esc_html__( 'Type Speed', 'intrinsic-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 100,
				'step'      => 5,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label'     => esc_html__( 'Start Delay', 'intrinsic-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label'     => esc_html__( 'Back Speed', 'intrinsic-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 30,
				'min'       => 0,
				'max'       => 100,
				'step'      => 2,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label'     => esc_html__( 'Back Delay', 'intrinsic-core' ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
				'min'       => 0,
				'max'       => 3000,
				'step'      => 50,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'     => esc_html__( 'Loop', 'intrinsic-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'loop_count',
			[
				'label'     => esc_html__( 'Loop Count', 'intrinsic-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'min'       => 0,
				'condition' => [
					'loop'           => 'yes',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			[
				'label' => esc_html__( 'Heading', 'intrinsic-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animated_heading_color',
			[
				'label'     => esc_html__( 'Color', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intrinsic-heading .intrinsic-heading-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'animated_heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-heading-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'animated_heading_shadow',
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-heading-tag',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			[
				'label'     => esc_html__( 'Pre Heading', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pre_heading!' => '',
				]
			]
		);

		$this->add_control(
			'pre_heading_color',
			[
				'label'     => esc_html__( 'Pre Heading Color', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intrinsic-heading .intrinsic-pre-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pre_heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-pre-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'pre_heading_shadow',
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-pre-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			[
				'label'     => esc_html__( 'Post Heading', 'intrinsic-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_heading!' => '',
				]
			]
		);

		$this->add_control(
			'post_heading_color',
			[
				'label'     => esc_html__( 'Post Heading Color', 'intrinsic-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intrinsic-heading .intrinsic-post-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-post-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'post_heading_shadow',
				'selector' => '{{WRAPPER}} .intrinsic-heading .intrinsic-post-heading',
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
		$settings      = $this->get_settings();
		$id            = $this->get_id();
		$final_heading = '';
		$heading_html  = array();

		if ( empty( $settings['pre_heading'] ) and empty( $settings['animated_heading'] ) and empty( $settings['post_heading'] ) ) {
			return;
		}

		$this->add_render_attribute( 'heading', 'class', 'intrinsic-heading-tag' );


		if ($settings['pre_heading']) :
			$final_heading .= '<div class="intrinsic-pre-heading">'. esc_attr($settings['pre_heading']).'</div> ';
		endif;

		if ($settings['animated_heading'] and 'animated' == $settings['heading_layout']) {
			$heading_animation_duration = ($settings['heading_animation_duration']) ? ' intrinsic-animated-'.$settings['heading_animation_duration'] : '';
	   		$final_heading .= '<div class="intrinsic-animated-heading'.$heading_animation_duration.'">'.rtrim(esc_attr($settings['animated_heading']), ',') . '</div> ';
		} elseif ($settings['animated_heading'] and 'typed' == $settings['heading_layout']) {
			$final_heading .= '<div class="intrinsic-animated-heading"></div> ';
		}

		if ($settings['post_heading']) :
			$final_heading .= '<div class="intrinsic-post-heading">'.esc_attr($settings['post_heading']).'</div>';
		endif;


		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$final_heading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $final_heading );
		}

		$heading_html[] = '<div id ="intrinsicah-'.$id.'" class="intrinsic-heading">';
		
		
		$heading_html[] = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $final_heading );
		
		$heading_html[] = '</div>';

		echo implode("", $heading_html);

		$type_heading = explode(",", esc_html($settings['animated_heading']) );
		?>	
		
		<?php if ($settings['animated_heading']) : ?>
		<script>
			jQuery(document).ready(function($) {
	    		"use strict";
	    		<?php if ( 'animated' == $settings['heading_layout'] ) : ?>
					$("#intrinsicah-<?php echo esc_attr($id); ?> .intrinsic-animated-heading").Morphext({
					    animation: "<?php echo esc_attr($settings['heading_animation']); ?>", // Overrides default "bounceIn"
					    speed: <?php echo esc_attr($settings['heading_animation_delay']); ?>, // Overrides default 2000
					});
				<?php elseif ( 'typed' == $settings['heading_layout'] ) : ?>
					var typed = new Typed('#intrinsicah-<?php echo esc_attr($id); ?> .intrinsic-animated-heading', {
					  strings: <?php echo json_encode($type_heading); ?>,
					  typeSpeed: <?php echo esc_attr( $settings['type_speed'] ); ?>,
					  startDelay: <?php echo esc_attr( $settings['start_delay'] ); ?>,
					  backSpeed: <?php echo esc_attr( $settings['back_speed'] ); ?>,
					  backDelay: <?php echo esc_attr( $settings['back_delay'] ); ?>,
					  loop: <?php echo ( 'yes' == $settings['loop'] ) ? 'true' : 'false'; ?>,
					  loopCount: <?php echo ($settings['loop_count']) ? esc_attr( $settings['loop_count'] ) : 0; ?>,
					});
				<?php endif; ?>
			});
		</script>
		<?php endif; ?>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Animated_Header_Widget() );