<?php
add_shortcode( 'intrinsic_call_to_actions_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_call_to_actions_components', $atts ); 
	extract(shortcode_atts(array(
		'call_to_title' => '',  
		'call_to_btn_text' => '', 
		'call_to_btn_url' => '', 
		'call_to_btn_open' => '', 
		'bg_img' => '', 
		'call_to_padding_top' => '', 
		'call_to_padding_bottom' => '', 
		'call_to_parallax_speed' => '', 
		'title_color' => '', 
		'call_to_btn_bg' => '', 
		'call_to_btn_color' => '', 
		'call_to_bg_theme' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?>

	<div class="call-to-action" style="padding-top: <?php echo esc_attr( $call_to_padding_top ); ?>; padding-bottom: <?php echo esc_attr( $call_to_padding_bottom ); ?>;">
	    <div class="container">
	    	<?php if( $call_to_title ) { ?>
	        <h2 class="call-to-title" style="color: <?php echo esc_attr( $title_color ); ?>"><?php echo esc_html( $call_to_title ); ?></h2><!--  /.call-to-title -->
	    	<?php } ?>
	    	<?php if( $call_to_btn_text ) { ?>
			<?php 
			if( $call_to_btn_open == '_self' ) {
				$link_open = 'target=_self';
			} else {
				$link_open = 'target=_blank';
			} ?>
	        <a <?php echo esc_attr( $link_open ); ?> href="<?php echo esc_url( $call_to_btn_url ); ?>" class="btn btn-call-to mrt-30" style="background: <?php echo esc_attr( $call_to_btn_bg ); ?>; color: <?php echo esc_html( $call_to_btn_color ); ?>;"><?php echo esc_attr( $call_to_btn_text ); ?></a>
	    	<?php } ?>
	    </div><!--  /.container -->
		<?php 
		if( $call_to_bg_theme == 'dark' ) {
			$bg_theme = 'dark';
		} else {
			$bg_theme = 'light';
		} ?>
	    <div class="hg-background hg-overlay <?php echo esc_attr( $bg_theme ); ?>" data-bg-parallax="scroll" data-bg-parallax-speed="<?php echo esc_attr( $call_to_parallax_speed ); ?>">
	        <div class="hg-background-image hg-parallax-element" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url($bg_img) ); ?>);"></div>
	    </div><!--  /.hg-background -->
	</div><!--  /.our-work-step -->
	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_call_to_action_components' );
function intrinsic_vc_call_to_action_components() {
	vc_map(array(
		'base' => 'intrinsic_call_to_actions_components',
		'name' => esc_html__('Call To Action', 'intrinsic-core'),
		'description' => esc_html__('Call To Action Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-clone', 
		'params' => array(
			array(
				'param_name' => 'call_to_title',
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'intrinsic-core'), 
				'value' => esc_html__('Let\'s Work On Your Next Projects', 'intrinsic-core'),
				'admin_label' => true,
			),			
			array(
				'param_name' => 'call_to_btn_text',
				'type' => 'textfield',
				'heading' => esc_html__('Button Text', 'intrinsic-core'), 
				'value' => esc_html__('Hire Me Know', 'intrinsic-core'),
				'admin_label' => true,
			),			
			array(
				'param_name' => 'call_to_btn_url',
				'type' => 'textfield',
				'heading' => esc_html__('Button URL', 'intrinsic-core'), 
				'value' => '#',
			),
			array(
				'param_name' => 'call_to_btn_open',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Heading Alignments', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Alignments', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'Self Window', 'intrinsic-core' ) => '_self',
					esc_html__( 'New Window', 'intrinsic-core' ) => '_blank',
				),
			),
			array(
				'param_name' => 'bg_img',  
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'intrinsic-core' ),
			), 
			array(
				'param_name' => 'call_to_padding_top',
				'type' => 'textfield',
				'heading' => esc_html__('Spacing Top', 'intrinsic-core'), 
				'value' => '105px',
			),			
			array(
				'param_name' => 'call_to_padding_bottom',
				'type' => 'textfield',
				'heading' => esc_html__('Spacing Bottom', 'intrinsic-core'), 
				'value' => '120px',
			),
			array(
				'param_name' => 'call_to_parallax_speed',
				'type' => 'textfield',
				'heading' => esc_html__('Button Text', 'intrinsic-core'), 
				'value' => '3',
			),	
			array(
				'param_name' => 'title_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Title Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),			
			array(
				'param_name' => 'call_to_btn_bg',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Background', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Button Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e51681',
			),			
			array(
				'param_name' => 'call_to_btn_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Button Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),
			array(
				'param_name' => 'call_to_bg_theme',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Version', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Background Version', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'Light Overlay', 'intrinsic-core' ) => 'light',
					esc_html__( 'Dark Overlay', 'intrinsic-core' ) => 'dark',
				),
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}