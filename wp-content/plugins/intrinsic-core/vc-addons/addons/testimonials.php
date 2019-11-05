<?php
add_shortcode( 'intrinsic_testimonials_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_testimonials_components', $atts ); 
	extract(shortcode_atts(array(
		'quote_item' => '',  
		'quote_details_bg' => '', 
		'client_name_color' => '', 
		'client_quote_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?>

    <div class="testimonial-carousel owl-carousel" data-owl-items="1" data-owl-dots="1" data-animate="hg-fadeInUp">
    	<?php $quote_lists = vc_param_group_parse_atts( $quote_item ); ?>
    	<?php foreach ($quote_lists as $key => $value) { ?>		
        <div class="item">
            <div class="client-testimonial">
                <div class="client-thumb">
                    <img src="<?php echo esc_url( intrinsic_get_image_crop_size( $value['author_img'] ) ); ?>" alt="<?php echo esc_attr( $value['client_name'] ); ?>" />
                </div><!--  /.client-thumb -->
                <div class="testimonial-details" style="background: <?php echo esc_attr( $quote_details_bg ); ?>">
                    <div class="client-area">
                        <div class="client-detail">
                            <h4 class="client-name" style="color: <?php echo esc_attr( $client_name_color ); ?>"><?php echo esc_html( $value['client_name'] ); ?></h4><!--  /.client-name -->
                        </div><!--  /.client-detail -->
                    </div><!--  /.client-area -->
                    <div class="details">
                        <p style="color: <?php echo esc_attr( $client_quote_color ); ?>"><?php echo esc_html( $value['client_quote'] ); ?></p>
                    </div><!--  /.details -->
                </div><!--  /.testimonial-details -->
            </div><!--  /.client-testimonial -->
        </div><!--  /.item -->
    	<?php } ?>
    </div><!--  /.owl-carousel -->

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_testimonials_components' );
function intrinsic_vc_testimonials_components() {
	vc_map(array(
		'base' => 'intrinsic_testimonials_components',
		'name' => esc_html__('Client Testimonials', 'intrinsic-core'),
		'description' => esc_html__('Client Testimonials Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-quote-left', 
		'params' => array(
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Quote Item', 'intrinsic-core' ),
				'param_name' => 'quote_item', 
				'params' => array( 
					array(
						'param_name' => 'author_img',  
						'type' => 'attach_image',
						'heading' => esc_html__( 'Client Image', 'intrinsic-core' ),
					),  
					array(
						'param_name' => 'client_name',
						'type' => 'textfield',
						'heading' => esc_html__('Client Name', 'intrinsic-core'), 
						'value' => esc_html__('Zohan Smith', 'intrinsic-core'),
						'admin_label' => true,
					),
					array(
						'param_name' => 'client_quote', 
						'type' => 'textarea',
						'heading' => esc_html__( 'Client Quote', 'intrinsic-core' ),
						'value' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when established fact that a reader will be looking at its layout.', 'intrinsic-core' ),
					),
				), 
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback',
				),
			), 
			array(
				'param_name' => 'quote_details_bg',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Background Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Quote Background Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#27282b',
			),			
			array(
				'param_name' => 'client_name_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Client Name Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Client Name Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			), 	
			array(
				'param_name' => 'client_quote_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Client Quote Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Client Quote Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#dddddd',
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}