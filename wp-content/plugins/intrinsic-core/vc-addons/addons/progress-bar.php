<?php
add_shortcode( 'intrinsic_progress_bar_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_progress_bar_components', $atts ); 
	extract(shortcode_atts(array(
		'skill_bar_title' => '', 
		'counter_text' => '', 
		'title_color' => '', 
		'outer_background' => '', 
		'inner_background' => '',
		'css' => '',
	), $atts));  
	ob_start(); ?> 

	<div class="skill-progress">
        <div class="skill-bar" data-percentage="<?php echo esc_attr( $counter_text ); ?>%">
            <h4 class="progress-title-holder" style="color: <?php echo esc_attr( $title_color ); ?>">
                <span class="progress-title"><?php echo esc_html( $skill_bar_title ); ?></span>
                <span class="progress-wrapper">
                    <span class="progress-mark">
                        <span class="percent" style="color: <?php echo esc_attr( $title_color ); ?>"><?php echo esc_attr( $counter_text ); ?>%</span>
                    </span>
                </span>
            </h4>
            <div class="progress-outter" style="background: <?php echo esc_attr( $outer_background ); ?>">
                <div class="progress-content" style="background: <?php echo esc_attr( $inner_background ); ?>"></div>
            </div>
        </div><!-- /.skill-bar -->
    </div>

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_progress_bar_components' );
function intrinsic_vc_progress_bar_components() {
	vc_map(array(
		'base' => 'intrinsic_progress_bar_components',
		'name' => esc_html__('Progress Bar', 'intrinsic-core'),
		'description' => esc_html__('Progress Bar Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-tasks', 
		'params' => array(
			array(
				'param_name' => 'skill_bar_title',
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'intrinsic-core'), 
				'value' => esc_html__('My Skill', 'intrinsic-core'),
			), 			
			array(
				'param_name' => 'counter_text',
				'type' => 'textfield',
				'heading' => esc_html__('Counter Value', 'intrinsic-core'), 
				'value' => 80,
			),
			array(
				'param_name' => 'title_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Counting Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Counting Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#121212',
			),			
			array(
				'param_name' => 'outer_background',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Outer Background', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Outer Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#fafafa',
			), 			
			array(
				'param_name' => 'inner_background',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Small Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Border Small Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e51681',
			), 		   										
			intrinsic_vc_css_param(),
		)
	));
}