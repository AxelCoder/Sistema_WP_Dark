<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Intrinsic Hero Banner Widgets
 *
 * Intrinsic widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */
class Intrinsic_Banner_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-banner';
	}

	public function get_title() {
		return esc_html__( 'Hero Block', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
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
			'sub_title_top',
			[
				'label' => esc_html__( 'Sub Title', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_horizontal_border',
			[
				'label' => esc_html__( 'Show Horizontal Border', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Hide', 'intrinsic-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'sub_title_top_content',
			[
				'label'       => esc_html__( 'Sub Title', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your sub title', 'intrinsic-core' ),
				'default'     => esc_html__( 'Creative Freelancer', 'intrinsic-core' ),
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'author_title',
			[
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_control(
			'title_content',
			[
				'label'       => esc_html__( 'Title', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your title', 'intrinsic-core' ),
				'default'     => esc_html__( 'Zohan Williams', 'intrinsic-core' ),
			]
		);	

		$this->end_controls_section();	

		$this->start_controls_section(
			'add_section',
			[
				'label' => esc_html__( 'Designation', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_control(
			'designation_content',
			[
				'label' => esc_html__( 'Designation Item', 'intrinsic-core' ),
				'type' => Controls_Manager::REPEATER,  
				'prevent_empty' => false,
				'fields' => [ 
					[
						'name' => 'desegnation_name',
						'label_block' => true,
						'label' => esc_html__( 'Designation Name', 'intrinsic-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Photographer',
					],
				],
				'default' => [
					[
						'desegnation_name' => esc_html__( 'Web Designer', 'intrinsic-core' ),
					],
					[
						'desegnation_name' => esc_html__( 'Web Developer', 'intrinsic-core' ),
					],	
					[
						'desegnation_name' => esc_html__( 'Programmer', 'intrinsic-core' ),
					],
				],
				'title_field' => ' {{ desegnation_name }}',
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'video_btn_elements',
			[
				'label' => esc_html__( 'Video Button', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_control(
			'video_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your Button Text', 'intrinsic-core' ),
				'default'     => esc_html__( 'About Me', 'intrinsic-core' ),
			]
		);			

		$this->add_control(
			'video_btn_url',
			[
				'label'       => esc_html__( 'Video url', 'intrinsic-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your youtube, vimeo video url', 'intrinsic-core' ),
				'default'     => 'https://player.vimeo.com/video/4760972',
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'banner_image_section',
			[
				'label' => esc_html__( 'Hero Background', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_control(
			'hero_background_content',
			[
				'label'       => esc_html__( 'Select Hero Background', 'intrinsic-core' ),
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
			'hero_layout_style',
			[
				'label' => esc_html__( 'Banner Styling', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'hero_layout_margin',
			[
				'label' => esc_html__( 'Margin', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'hero_layout_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'hero_layout_height',
			[
				'label' => esc_html__( 'Set Height', 'intrinsic-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'em', 'vh' ],
				'range' => [				
					'em' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],					
					'vh' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .hero-block' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_styling',
			[
				'label' => esc_html__( 'Sub Title', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'horizontal_border_color',
			[
				'label' => esc_html__( 'Horizontal Border Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#aeaeae',
				'selectors' => [
					'{{WRAPPER}} .hero-block .horizontal-border' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);		

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-subheading' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_text_typography',
				'label' => esc_html__( 'Typography:', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .hero-block .hero-subheading',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'font_weight' => [
						'default' => '500',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'em', 'size' => 1.953 ] ],
				],
			]
		);			

		$this->end_controls_section();

		$this->start_controls_section(
			'titles_styling',
			[
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titles_text_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);			

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'titles_text_typography',
				'label' => esc_html__( 'Typography:', 'intrinsic-core' ),
				'selector' => '{{WRAPPER}} .hero-block .hero-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'font_weight' => [
						'default' => '800',
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
			'desegnation_item_styling',
			[
				'label' => esc_html__( 'Designation Item', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desegnation_item_colors',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-designation > li' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);		

		$this->add_control(
			'desegnation_item_seperator_colors',
			[
				'label' => esc_html__( 'Separator Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-designation > li:after' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_btn_styling',
			[
				'label' => esc_html__( 'Video Button', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_control(
			'video_btn_color',
			[
				'label' => esc_html__( 'Button Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-video-btn .video-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hero-block .hero-video-btn i' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);			

		$this->add_control(
			'video_btn_hover_color',
			[
				'label' => esc_html__( 'Button Hover', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .hero-block .hero-video-btn:hover .video-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hero-block .hero-video-btn:hover i' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
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
		<div class="hero-block">
			<div class="container-xl">			
		        <div class="row">
		            <div class="col-md-9">
		            	<?php if( $settings['show_horizontal_border'] == 'yes' ) { ?>
		                <div class="horizontal-border"></div><!--  /.horizontal-border -->
		            	<?php } ?>
		            	<?php if( $settings['sub_title_top_content'] ) { ?>
		                <h2 class="hero-subheading"><?php echo esc_html( $settings['sub_title_top_content'] ); ?></h2>
		            	<?php } ?>
		            	<?php if( $settings['title_content'] ) { ?>
		                <h2 class="hero-title"><?php echo esc_html($settings['title_content']); ?></h2><!--  /.hero-title -->
		            	<?php } ?>
		            	<?php if( !empty( $settings['designation_content'] ) ) { ?>
		                <ul class="hero-designation">
		                	<?php foreach ($settings['designation_content'] as $key => $value) { ?>
		                		<li><?php echo esc_html( $value['desegnation_name'] ); ?></li>
		                	<?php } ?>
		                </ul><!--  /.hero-designation -->
		            	<?php } ?>

		            	<?php if( $settings['video_btn_url'] ) { ?>
		                <a href="<?php echo esc_url( $settings['video_btn_url'] ); ?>" class="hero-video-btn video-popup">
		                    <i class="fas fa-play"></i>
		                    <span class="video-title"><?php echo esc_html( $settings['video_btn_text'] ); ?></span>
		                </a>
		            	<?php } ?>
		            </div><!--  /.col-lg-8 -->
		        </div><!--  /.row -->
			</div><!--  /.container-xl -->

		    <div class="hg-background">
		    	<?php if( $settings['hero_background_content'] ) { ?>
		        <div class="hg-background-image" data-bg-image="<?php echo esc_attr( $settings['hero_background_content']['url'] ); ?>"></div><!--  /.hg-background-image -->
		    	<?php } ?>
		    </div><!--  /.hg-background -->
		</div><!--  /.hero-block -->
		<?php 
	}

	/**
	 * Render Social Status widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() { ?>
		<div class="hero-block">
			<div class="container-xl">			
		        <div class="row">
		            <div class="col-md-9">
		            	<# if( settings.show_horizontal_border == 'yes' ) { #>
		                <div class="horizontal-border"></div><!--  /.horizontal-border -->
		            	<# } #>
		            	<# if( settings.sub_title_top_content ) { #>
		                <h2 class="hero-subheading">{{{ settings.sub_title_top_content }}}</h2>
		            	<# } #>
		            	<# if( settings.title_content ) { #>
		                <h2 class="hero-title">{{{ settings.title_content }}}</h2><!--  /.hero-title -->
		            	<# } #>

		            	<# if( settings.designation_content.length ) { #>
		                <ul class="hero-designation">
		                	<# _.each( settings.designation_content, function( item ) { #>
		                		<li>{{{ item.desegnation_name }}}</li>
		                	<# }); #>
		                </ul><!--  /.hero-designation -->
		            	<# } #>

		            	<# if( settings.video_btn_url ) { #>
		                <a href="{{ settings.video_btn_url }}" class="hero-video-btn video-popup">
		                    <i class="fas fa-play"></i>
		                    <span class="video-title">{{{ settings.video_btn_text }}}</span>
		                </a>
		            	<# } #>
		            </div><!--  /.col-lg-8 -->
		        </div><!--  /.row -->
			</div><!--  /.container-xl -->

		    <div class="hg-background">
		    	<# if( settings.hero_background_content ) { #>
		        <div class="hg-background-image" data-bg-image="{{ settings.hero_background_content.url }}" style="background-image: url( {{ settings.hero_background_content.url }} );"></div><!--  /.hg-background-image -->
		    	<# } #>
		    </div><!--  /.hg-background -->
		</div><!--  /.hero-block -->
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Banner_Widget() );