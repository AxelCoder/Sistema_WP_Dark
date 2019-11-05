<?php
add_shortcode( 'intrinsic_contact_info_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_contact_info_components', $atts ); 
	extract(shortcode_atts(array(
		'contact_item' => '',  
		'contact_icon_bg' => '', 
		'contact_title_color' => '', 
		'contact_description_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?> 
	<?php 
		$item = vc_param_group_parse_atts( $contact_item );
		foreach ($item as $key => $value) { ?>	
		<div class="contact-item">
	        <div class="icon">
	            <i class="<?php echo esc_attr( $value['icon_code'] ); ?>" style="background: <?php echo esc_attr( $contact_icon_bg ); ?>"></i>
	        </div><!--  /.icon -->
	        <div class="details">
	            <h3 class="info-title" style="color: <?php echo esc_attr( $contact_title_color ); ?>"><?php echo esc_html( $value['title'] ); ?></h3><!--  /.info-title -->
	            <p class="info-detail" style="color: <?php echo esc_attr( $contact_description_color ); ?>"><?php echo wp_kses_post( $value['description'] ); ?></p>
	        </div><!--  /.details -->
	    </div><!--  /.contact-item -->  
		<?php }
	?>
	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_contact_info_components' );
function intrinsic_vc_contact_info_components() {
	vc_map(array(
		'base' => 'intrinsic_contact_info_components',
		'name' => esc_html__('Contact Info', 'intrinsic-core'),
		'description' => esc_html__('Contact Info Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'vc-oi vc-oi-list', 
		'params' => array(
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Quote Item', 'intrinsic-core' ),
				'param_name' => 'contact_item', 
				'params' => array(  
					array(
						'param_name' => 'icon_code',
						'type' => 'textfield',
						'heading' => esc_html__('Icon Code', 'intrinsic-core'), 
						'description' => __('Find Icon Code From - <a href="https://fontawesome.com/icons?d=gallery" rel="nofollow" target="_blank">https://fontawesome.com/icons?d=gallery</a> ','intrinsic-core'),
						'value' => 'fas fa-envelope',
					),		
					array(
						'param_name' => 'title',
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'intrinsic-core'), 
						'value' => esc_html__('Mail', 'intrinsic-core'),
						'admin_label' => true,
					),
					array(
						'param_name' => 'description', 
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'intrinsic-core' ),
						'value' => 'example@domain.com',
					),
				), 
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback',
				),
			), 
			array(
				'param_name' => 'contact_icon_bg',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Background Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Quote Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#e51681',
			),			
			array(
				'param_name' => 'contact_title_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Title Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			), 	
			array(
				'param_name' => 'contact_description_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Contact Description Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Contact Description Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#dddddd',
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}