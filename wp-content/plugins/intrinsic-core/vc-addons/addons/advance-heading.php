<?php
add_shortcode( 'intrinsic_advance_headings_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_advance_headings_components', $atts ); 
	extract(shortcode_atts(array(
		'heading_count' => '', 
		'heading_title' => '', 
		'enable_border_bottom' => '', 
		'header_aligments' => '', 
		'counting_color' => '', 
		'heading_color' => '', 
		'border_bottom_sm_color' => '', 
		'border_bottom_lg_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?> 

	<?php 
		if( $header_aligments == 'left' ) {
			$aligments_class = 'text-left';
		} elseif ( $header_aligments == 'right' ) {
			$aligments_class = 'text-right';
		} else {
			$aligments_class = 'text-center';
		}
	?>

	<div class="section-title <?php echo esc_attr( $aligments_class ); ?>">
		<?php if( $heading_count ) { ?>
	    <h2 class="title-counter" style="color: <?php echo esc_attr( $counting_color ); ?>"><?php echo esc_html( $heading_count ); ?></h2><!--  /.title-counter -->
		<?php } ?>
		<?php if( $heading_title ) { ?>
	    <h2 class="title-main" style="color: <?php echo esc_attr( $heading_color ); ?>"><?php echo esc_html( $heading_title ); ?></h2><!-- /.title-main -->
		<?php } ?>

		<?php if( $enable_border_bottom == true ) { ?>
	    <div class="title-border">
	        <span class="small-border bg-black" style="background: <?php echo esc_attr( $border_bottom_sm_color ); ?>"></span>
	        <span class="large-border bg-deep-cerise" style="background: <?php echo esc_attr( $border_bottom_lg_color ); ?>"></span>
	        <span class="small-border bg-black" style="background: <?php echo esc_attr( $border_bottom_sm_color ); ?>"></span>
	    </div><!--  /.title-border -->
		<?php } ?>
	</div><!--  /.section-title -->


	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_advance_headings_components' );
function intrinsic_vc_advance_headings_components() {
	vc_map(array(
		'base' => 'intrinsic_advance_headings_components',
		'name' => esc_html__('Advance Heading', 'intrinsic-core'),
		'description' => esc_html__('Advance Headings', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-header', 
		'params' => array(
			array(
				'param_name' => 'heading_count',
				'type' => 'textfield',
				'heading' => esc_html__('Counting', 'intrinsic-core'), 
				'value' => '01',
			), 			
			array(
				'param_name' => 'heading_title',
				'type' => 'textfield',
				'heading' => esc_html__('Heading Text', 'intrinsic-core'), 
				'value' => esc_html__('My Heading', 'intrinsic-core'),
				'admin_label' => true,
			),
			array(
				'param_name' => 'enable_border_bottom',
				"type" => "checkbox",
				'heading' => esc_html__('Display Border Bottom', 'intrinsic-core'),  
				"value" => true,
				"description" => esc_html__( 'Enable or disable border bottom element.', 'intrinsic-core' ),
			),
			array(
				'param_name' => 'header_aligments',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Heading Alignments', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Alignments', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'Center', 'intrinsic-core' ) => 'center',
					esc_html__( 'Right', 'intrinsic-core' ) => 'right',
					esc_html__( 'Left', 'intrinsic-core' ) => 'left',
				),
			), 
			array(
				'param_name' => 'counting_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Counting Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Counting Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e1e1e1',
			),			
			array(
				'param_name' => 'heading_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#121212',
			), 			
			array(
				'param_name' => 'border_bottom_sm_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Small Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Border Small Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#000000',
			), 		
			array(
				'param_name' => 'border_bottom_lg_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Large Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Border Large Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e51681',
			),   										
			intrinsic_vc_css_param(),
		)
	));
}