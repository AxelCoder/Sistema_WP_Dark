<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor progressbar widget.
 *
 * Elementor widget that displays an escalating progressbar bar.
 *
 * @since 1.0.0
 */
class Intrinsic_Progressbar extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve progressbar widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'intrinsic-progressbar';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve progressbar widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Progress Bar', 'intrinsic-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve progressbar widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'intrinsic-category' ];
	}

	/**
	 * Register progressbar widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_progressbar',
			[
				'label' => esc_html__( 'Progress Bar', 'intrinsic-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'intrinsic-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'intrinsic-core' ),
				'default' => esc_html__( 'My Skill', 'intrinsic-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percentage', 'intrinsic-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#e51681',
				'selectors' => [
					'{{WRAPPER}} .progress-content' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'bar__outer_bg_color',
			[
				'label' => esc_html__( 'Outer Background Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .progress-outter' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_var_title',
			[
				'label' => esc_html__( 'Title Style', 'intrinsic-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'progress_var_title_color',
			[
				'label' => esc_html__( 'Text Color', 'intrinsic-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#121212',
				'selectors' => [
					'{{WRAPPER}} .progress-mark span, .progress-title-holder' => 'color: {{VALUE}};',
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
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .progress-mark span, .progress-title-holder',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'fields_options' => [
					'font_weight' => [
						'default' => '700',
					],
					'font_family' => [
						'default' => 'Dosis',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 18 ] ],
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render progressbar widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="skill-progress">
		    <div class="skill-bar" data-percentage="<?php echo esc_attr( $settings['percent']['size'] ); ?>%">
		        <h4 class="progress-title-holder">
		        	<?php if ( $settings['title'] ) { ?>
		            <span class="progress-title"><?php echo esc_html($settings['title']); ?></span>
		            <?php } ?>
		            <span class="progress-wrapper">
		                <span class="progress-mark">
		                    <span class="percent"><?php echo esc_attr( $settings['percent']['size'] ); ?>%</span>
		                </span>
		            </span>
		        </h4>
		        <div class="progress-outter">
		            <div class="progress-content"></div>
		        </div>
		    </div><!-- /.skill-bar -->
		</div>
	<?php
	}

	/**
	 * Render progressbar widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="skill-progress">
		    <div class="skill-bar" data-percentage="{{ settings.percent.size }}%">
		        <h4 class="progress-title-holder">
		        	<# if( settings.title ) { #>
		            <span class="progress-title">{{{ settings.title }}}</span>
		            <# } #>
		            <span class="progress-wrapper">
		                <span class="progress-mark">
		                    <span class="percent">{{{ settings.percent.size }}}%</span>
		                </span>
		            </span>
		        </h4>
		        <div class="progress-outter">
		            <div class="progress-content"></div>
		        </div>
		    </div><!-- /.skill-bar -->
		</div>
		<?php
	}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Intrinsic_Progressbar() );
