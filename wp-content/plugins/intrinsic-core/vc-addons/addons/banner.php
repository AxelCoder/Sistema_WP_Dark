<?php
add_shortcode( 'intrinsic_hero_banner', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_hero_banner', $atts ); 
	extract(shortcode_atts(array(
		'horizontal_border'	=> '',
		'hero_subheading'	=> '', 
		'hero_heading'	=> '',
		'designation'		=> '', 
		'btn_text'	=> '',
		'btn_url'	=> '',
		'bg_img' => '', 
		'horizontal_border_color' => '', 
		'subheading_font_size' => '', 
		'subheading_color' => '', 
		'heading_font_size' => '', 
		'heading_color' => '', 
		'desegnation_font_size' => '', 
		'desegnation_color' => '', 
		'btn_colors' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?> 

	<div class="hero-block">
	    <div class="container-xl">
	        <div class="row">
	            <div class="col-md-9">
	            	<?php if( $horizontal_border == true ) { ?>
	                <div class="horizontal-border" style="background: <?php echo esc_attr( $horizontal_border_color ); ?>"></div><!--  /.horizontal-border -->
	            	<?php } ?>
	            	<?php if( $hero_subheading == true ) { ?>
	                <h2 class="hero-subheading" style="color: <?php echo esc_attr( $subheading_color ); ?>; font-size: <?php echo esc_attr( $subheading_font_size ); ?>"><?php echo esc_html( $hero_subheading ); ?></h2>
	            	<?php } ?>

	            	<?php if( $hero_heading ) { ?>
	                <h2 class="hero-title" style="color: <?php echo esc_attr( $heading_color ); ?>; font-size: <?php echo esc_attr( $heading_font_size ); ?>"><?php echo esc_html( $hero_heading ); ?></h2><!--  /.hero-title -->
	            	<?php } ?>

	            	<?php $desegnation_lists_item = vc_param_group_parse_atts( $designation ); ?>

					<?php if( !empty( $desegnation_lists_item ) ) { ?>
	                <ul class="hero-designation" style="font-size: <?php echo esc_attr( $desegnation_font_size ); ?>">
	                	<?php foreach ($desegnation_lists_item as $key => $value) { ?>
	                		<li style="color: <?php echo esc_attr( $desegnation_color ); ?>;"><?php echo esc_html( $value['designation_list'] ); ?></li>
	                	<?php } ?>
	                </ul><!--  /.hero-designation -->
	            	<?php } ?>
					
					<?php if( $btn_url ) { ?>
	                <a href="<?php echo esc_url( $btn_url ); ?>" class="hero-video-btn video-popup" style="color: <?php echo esc_attr( $btn_colors ); ?>;">
	                    <i class="fas fa-play"></i>
	                    <?php if( $btn_text ) { ?>
	                    <span class="video-title"><?php echo esc_html( $btn_text ); ?></span>
	                	<?php } ?>
	                </a>
	            	<?php } ?>
	            </div><!--  /.col-lg-8 -->
	        </div><!--  /.row -->
	    </div><!--  /.container-fluid -->
	    <div class="hg-background">
	        <div class="hg-background-image" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url($bg_img) ); ?>);"></div><!--  /.hg-background-image -->
	    </div><!--  /.hg-background -->
	</div><!--  /.hero-block -->

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_hero_banner' );
function intrinsic_vc_hero_banner() {
	vc_map(array(
		'base' => 'intrinsic_hero_banner',
		'name' => esc_html__('Author Banner', 'intrinsic-core'),
		'description' => esc_html__('Author hero banner', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'vc-material vc-material-airplay', 
		'params' => array(
			array(
				'param_name' => 'horizontal_border',
				"type" => "checkbox",
				'heading' => esc_html__('Display Horizontal Border', 'intrinsic-core'),  
				"value" => true,
				"description" => esc_html__( 'Enable or disable horizontal border element.', 'intrinsic-core' ),
			),
			array(
				'param_name' => 'hero_subheading',
				'type' => 'textfield',
				'heading' => esc_html__('Sub Heading', 'intrinsic-core'), 
				'value' => 'Creative Freelancer',
			),			
			array(
				'param_name' => 'hero_heading',
				'type' => 'textfield',
				'heading' => esc_html__('Heading', 'intrinsic-core'), 
				'value' => 'Zohan Williams',
				'admin_label' => true,
			),
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Designation', 'intrinsic-core' ),
				'param_name' => 'designation', 
				'params' => array( 
					array(
						'param_name' => 'designation_list', 
						'type' => 'textfield',
						'heading' => esc_html__( 'Designations', 'intrinsic-core' ),
						'admin_label' => true,
					),
				), 
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback',
				),
			),  
			array(
				'param_name' => 'btn_text',
				'type' => 'textfield',
				'heading' => esc_html__('Button Text', 'intrinsic-core'), 
				'value' => 'About Me',
			),
			array(
				'param_name' => 'btn_url',
				'type' => 'textfield',
				'heading' => esc_html__('Button URL', 'intrinsic-core'), 
				'description' => esc_html__('Added Video URL', 'intrinsic-core'), 
				'value' => 'https://player.vimeo.com/video/4760972',
			),  
			array(
				'param_name' => 'bg_img',  
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'intrinsic-core' ),
			),  			
			array(
				'param_name' => 'horizontal_border_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Horizontal Border Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Horizontal Border Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#aeaeae',
			),  
			array(
				'param_name' => 'subheading_font_size',
				'type' => 'textfield',
				'heading' => esc_html__('Sub Heading Font Size', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '1.953em',
			),
			array(
				'param_name' => 'subheading_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Sub Heading Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Sub Heading Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#dddddd',
			),
			array(
				'param_name' => 'heading_font_size',
				'type' => 'textfield',
				'heading' => esc_html__('Name Font Size', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '7.323em',
			),
			array(
				'param_name' => 'heading_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Name Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Name Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),			
			array(
				'param_name' => 'desegnation_font_size',
				'type' => 'textfield',
				'heading' => esc_html__('Designation Font Size', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '1.953em',
			),
			array(
				'param_name' => 'desegnation_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Designation Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Designation Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e51681',
			),			
			array(
				'param_name' => 'btn_colors',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Video Button Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Video Button Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),
			intrinsic_vc_css_param(),
		)
	));
}