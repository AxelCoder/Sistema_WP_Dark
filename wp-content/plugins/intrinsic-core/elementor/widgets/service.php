<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Intrinsic Service Widget.
 *
 * Intrinsic widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Intrinsic_Service_Widget extends Widget_Base {

	public function get_name() {
		return 'intrinsic-service';
	}

	public function get_title() {
		return esc_html__( 'Service', 'intrinsic-core' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	/**
	 * Register Service widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'service_title', [
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Design' , 'intrinsic-core' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);		

		$repeater->add_control(
			'service_icons', [
				'label' => esc_html__( 'Icon Code', 'intrinsic-core' ),
				'description' => 'Find Icon Code From - <a href="https://fontawesome.com/icons?d=gallery" rel="nofollow" target="_blank">https://fontawesome.com/icons?d=gallery</a> ',
				'type' => Controls_Manager::TEXT,
				'default' => 'fas fa-marker',
			]
		);		

		$repeater->add_control(
			'service_images', [
				'label' => esc_html__( 'or Image Icon', 'intrinsic-core' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'service_description', [
				'label' => esc_html__( 'Description', 'intrinsic-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
			]
		);		

		$repeater->add_control(
			'service_hover_content', [
				'label' => esc_html__( 'Service Hover Content', 'intrinsic-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
			]
		);	

		$this->add_control(
			'service_item',
			[
				'label' => esc_html__( 'Service', 'intrinsic-core' ),
				'type' => Controls_Manager::REPEATER, 
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => ' {{ service_title }}',
				'default' => [
					[
						'service_title' => esc_html__('Design','intrinsic-core'),
						'service_icons' => 'fas fa-marker',
						'service_description' => '<ul><li>Info graphic Design</li><li>UI/UX Design</li><li>Branding Design</li></ul>',
					],					
					[
						'service_title' => esc_html__('Developing','intrinsic-core'),
						'service_icons' => 'fas fa-bullseye',
						'service_description' => '<ul><li>Info graphic Design</li><li>UI/UX Design</li><li>Branding Design</li></ul>',
					],					
					[
						'service_title' => esc_html__('Programming','intrinsic-core'),
						'service_icons' => 'far fa-paper-plane',
						'service_description' => '<ul><li>Info graphic Design</li><li>UI/UX Design</li><li>Branding Design</li></ul>',
					],
				],
			]
		);
				
		$this->end_controls_section();

		$this->start_controls_section(
			'content_settings',
			[
				'label' => esc_html__( 'Content Settings', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_grid_carousel',
			[
				'label' => esc_html__( 'Enable Carousel/Grid', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Grid', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Carousel', 'intrinsic-core' ),
				'return_value' => '1',
				'default' => '1',
			]
		);

		$this->add_control(
			'item_display',
			[
				'label' => esc_html__( 'Display Item', 'intrinsic-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
				'condition' => ['show_grid_carousel' => '']
			]
		);		

		$this->add_control(
			'item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'intrinsic-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => ['show_grid_carousel' => '']
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label' => esc_html__( 'Show Dot Nav', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Hide', 'intrinsic-core' ),
				'return_value' => 1,
				'default' => 1,
				'condition' => ['show_grid_carousel' => '']
			]
		);		

		$this->add_control(
			'show_loops',
			[
				'label' => esc_html__( 'Show Loop', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Enable', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Disable', 'intrinsic-core' ),
				'return_value' => 1,
				'default' => 1,
				'condition' => ['show_grid_carousel' => '']
			]
		);		

		$this->add_control(
			'item_center',
			[
				'label' => esc_html__( 'Center Item', 'intrinsic-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Enable', 'intrinsic-core' ),
				'label_off' => esc_html__( 'Disable', 'intrinsic-core' ),
				'return_value' => 1,
				'default' => 1,
				'condition' => ['show_grid_carousel' => '']
			]
		);

		$this->add_control(
			'grid_countings',
			[
				'label' => esc_html__( 'Border Style', 'intrinsic-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'three_column',
				'options' => [
					'one_column'  => esc_html__( 'One Column', 'intrinsic-core' ),
					'two_column' => esc_html__( 'Two Column', 'intrinsic-core' ),
					'three_column' => esc_html__( 'Three Column', 'intrinsic-core' ),
					'four_column' => esc_html__( 'Four Column', 'intrinsic-core' ),
				],
				'condition' => ['show_grid_carousel' => '1']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'service_icons_style',
			[
				'label' => esc_html__( 'Icon', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'service_icons_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .service-card .service-icon' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'service_title_style',
			[
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_control(
			'service_title_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .service-card .service-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);	

		$this->end_controls_section();	

		$this->start_controls_section(
			'service_descriotion_color',
			[
				'label' => esc_html__( 'Description', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->add_control(
			'service_description_text_color',
			[
				'label' => esc_html__( 'Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c3c3c3',
				'selectors' => [
					'{{WRAPPER}} .service-card .service-list' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);	

		$this->end_controls_section();	

		$this->start_controls_section(
			'service_box_color',
			[
				'label' => esc_html__( 'Item', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);			

		$this->add_control(
			'service_card_background',
			[
				'label' => esc_html__( 'Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#27282b',
				'selectors' => [
					'{{WRAPPER}} .service-card' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);	

		$this->add_control(
			'service_center_item_background',
			[
				'label' => esc_html__( 'Center Item Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#12141c',
				'selectors' => [
					'{{WRAPPER}} .service-carousel .owl-item.center .service-card' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);		

		$this->add_control(
			'service_dot_item_color',
			[
				'label' => esc_html__( 'Dot Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#cbcaca',
				'selectors' => [
					'{{WRAPPER}} .service-carousel .owl-dots .owl-dot' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);			

		$this->add_control(
			'service_dot_item_active_color',
			[
				'label' => esc_html__( 'Active Dot Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .service-carousel .owl-dots .owl-dot.active' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);	

		$this->add_responsive_control(
			'service_dot_item_padding',
			[
				'label' => esc_html__( 'Padding', 'intrinsic-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'service_item_hover_content',
			[
				'label' => esc_html__( 'Hover', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_control(
			'service_hover_item_bg',
			[
				'label' => esc_html__( 'Card Hover Background', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .service-hover-content' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);		

		$this->add_control(
			'service_hover_item_color',
			[
				'label' => esc_html__( 'Card Hover Text Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .service-hover-content' => 'color: {{VALUE}};',
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
	 * Render Service widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display();
		// Item Display
		$itemdisplay = $settings['item_display'];
		if( $itemdisplay ) {
			$itemdisplayAttr = 'data-owl-items='. $itemdisplay .'';
		} else {
			$itemdisplayAttr = '';
		}

		// Item Spacing
		$itemmargin = $settings['item_spacing'];
		if( $itemmargin ) {
			$itemmarginAttr = 'data-owl-margin='. $itemmargin .'';
		} else {
			$itemmarginAttr = '';
		}

		// Item Dots
		$showdots = $settings['show_dots'];
		if( $showdots ) {
			$showdotsAttr = 'data-owl-dots='. $showdots .'';
		} else {
			$showdotsAttr = '';
		}		

		$showloops = $settings['show_loops'];
		if( $showloops ) {
			$showloopsAttr = 'data-owl-loop='. $showloops .'';
		} else {
			$showloopsAttr = '';
		}		

		$itemcenter = $settings['item_center'];
		if( $itemcenter ) {
			$itemcenterAttr = 'data-owl-center='. $itemcenter .'';
		} else {
			$itemcenterAttr = '';
		} ?>
		
		<?php if( $settings['show_grid_carousel'] !== '1' ) { ?>

		<div class="service-carousel owl-carousel" <?php echo esc_attr( $itemdisplayAttr ); ?> <?php echo esc_attr( $itemmarginAttr ); ?> <?php echo esc_attr( $showdotsAttr ); ?> <?php echo esc_attr( $showloopsAttr ); ?> <?php echo esc_attr( $itemcenterAttr ); ?> data-animate="hg-fadeInUp">
			<?php foreach ($settings['service_item'] as $key => $value) { ?>
		    <div class="item">
		        <div class="service-card">
		            <div class="service-icon color-deep-cerise">
		            	<?php if( $value['service_icons'] ) { ?>
		                <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
		            	<?php } else { ?>
		            	<img src="<?php echo esc_url($value['service_images']['url']); ?>" alt="<?php esc_attr_e('Service Icons', 'intrinsic-core') ?>" />
		            	<?php } ?>
		            </div><!--  /.service-icon -->
		            <?php if( $value['service_title'] ) { ?>
		            <h2 class="service-title"><?php echo esc_html($value['service_title']); ?></h2><!--  /.service-title -->
		        	<?php } ?>
		            <div class="service-list">
		        		<?php if( $value['service_description'] ) { ?>
		            	<div class="service-content">
		                	<p><?php echo wp_kses_post( $value['service_description'] ); ?></p>
		            	</div><!--  /.service-content -->
		        		<?php } ?>

		        		<?php if( $value['service_hover_content'] ) { ?>
		            	<div class="service-hover-content">
		            		<?php echo wp_kses_post( $value['service_hover_content'] ); ?>
		            	</div><!--  /.service-hover-content -->
		            	<?php } ?>
		            </div><!--  /.service-list -->
		            <div class="shadow-icon">
	            		<?php if( $value['service_icons'] ) { ?>
	            	    <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
	            		<?php } else { ?>
	            		<img src="<?php echo esc_url($value['service_images']['url']); ?>" alt="<?php esc_attr_e('Service Icons', 'intrinsic-core') ?>" />
	            		<?php } ?>
		            </div><!--  /.shadow-icon -->
		        </div><!--  /.service-card -->
		    </div><!--  /.item -->                                       
			<?php } ?>
		</div><!--  /.owl-carousel -->
		<?php } else { ?>
			<div class="row">
				<?php 
					if( $settings['grid_countings'] == 'one_column' ) {
						$column_name = 'col-md-12 col-lg-12';
					} elseif ($settings['grid_countings'] == 'two_column') {
						$column_name = 'col-md-6 col-lg-6';
					} elseif ($settings['grid_countings'] == 'three_column') {
						$column_name = 'col-md-6 col-lg-4';
					} else {
						$column_name = 'col-md-6 col-lg-3';
					}
				?>			
				<?php foreach ($settings['service_item'] as $key => $value) { ?>
			    <div class="<?php echo esc_attr( $column_name ); ?> item" data-animate="hg-fadeInUp">
			        <div class="service-card mrb-30">
			            <div class="service-icon color-deep-cerise">
			            	<?php if( $value['service_icons'] ) { ?>
			                <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
			            	<?php } else { ?>
			            	<img src="<?php echo esc_url($value['service_images']['url']); ?>" alt="<?php esc_attr_e('Service Icons', 'intrinsic-core') ?>" />
			            	<?php } ?>
			            </div><!--  /.service-icon -->
			            <?php if( $value['service_title'] ) { ?>
			            <h2 class="service-title"><?php echo esc_html($value['service_title']); ?></h2><!--  /.service-title -->
			        	<?php } ?>
			            <div class="service-list">
			        		<?php if( $value['service_description'] ) { ?>
			            	<div class="service-content">
			                	<p><?php echo wp_kses_post( $value['service_description'] ); ?></p>
			            	</div><!--  /.service-content -->
			        		<?php } ?>

			        		<?php if( $value['service_hover_content'] ) { ?>
			            	<div class="service-hover-content">
			            		<?php echo wp_kses_post( $value['service_hover_content'] ); ?>
			            	</div><!--  /.service-hover-content -->
			            	<?php } ?>
			            </div><!--  /.service-list -->
			            <div class="shadow-icon">
		            		<?php if( $value['service_icons'] ) { ?>
		            	    <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
		            		<?php } else { ?>
		            		<img src="<?php echo esc_url($value['service_images']['url']); ?>" alt="<?php esc_attr_e('Service Icons', 'intrinsic-core') ?>" />
		            		<?php } ?>
			            </div><!--  /.shadow-icon -->
			        </div><!--  /.service-card -->
			    </div><!--  /.item -->                                     
				<?php } ?>
			</div><!--  /.row -->
		<?php } ?>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Service_Widget() );