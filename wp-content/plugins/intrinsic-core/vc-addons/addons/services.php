<?php
add_shortcode( 'intrinsic_services_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_services_components', $atts ); 
	extract(shortcode_atts(array(
		'services_items' => '', 
		'service_item_theme' => '', 
		'service_item_display' => '', 
		'service_grid_carousel' => '', 
		'service_grid_columns' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?>
	
	<?php if( $service_grid_carousel == 'carousel' ) { ?>
		<div class="service-carousel owl-carousel" data-owl-items="<?php echo esc_attr( $service_item_display ); ?>" data-owl-margin="30" data-owl-dots="1" data-owl-loop="1" data-owl-center="1" data-animate="hg-fadeInUp">
			<?php 
				$service_carousel_content = vc_param_group_parse_atts( $services_items );
				foreach ($service_carousel_content as $key => $value) { ?>
			      	<div class="item">
			      		<?php if( $service_item_theme == 'dark' ) {
			      			$service_theme = 'dark'; 
			      		} else {
							$service_theme = 'light';
			      		} ?>
			          	<div class="service-card <?php echo esc_attr( $service_theme ); ?>">
			          	    <div class="service-icon color-deep-cerise">
			          	        <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
			          	    </div><!--  /.service-icon -->
			          	    <h2 class="service-title"><?php echo esc_html( $value['service_title'] ); ?></h2><!--  /.service-title -->
			          	    <div class="service-list">
			          	    	<div class="service-content">
			          	    		<p><?php echo wp_kses_post( $value['service_sm_description'] ); ?></p>
			          	    	</div><!--  /.service-content -->
			          	    	<div class="service-hover-content">
				          	    	<ul>      	    		
					          	        <?php 
					          	        $service_list = vc_param_group_parse_atts( $value['service_description'] );
					          	        foreach ($service_list as $key2 => $value2) { ?>
					          	        <li><?php echo esc_html( $value2['service_lists'] ); ?></li>
					          	        <?php } ?>
				          	    	</ul>
			          	    	</div><!--  /.service-hover-content -->
			          	    </div><!--  /.service-list -->
			          	    <div class="shadow-icon">
			          	    	<i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
			          	    </div>
			          	</div><!--  /.service-card -->
			      	</div><!--  /.item -->  
				<?php }
			?>
	  	</div><!--  /.owl-carousel -->
	<?php } else { ?>
		<div class="row">
			<?php 
				$service_carousel_content = vc_param_group_parse_atts( $services_items );

				if( $service_grid_columns == 'one_column' ) {
					$column_name = 'col-md-12 col-lg-12';
				} elseif ($service_grid_columns == 'two_column') {
					$column_name = 'col-md-6 col-lg-6';
				} elseif ($service_grid_columns == 'three_column') {
					$column_name = 'col-md-6 col-lg-4';
				} else {
					$column_name = 'col-md-6 col-lg-3';
				}
				foreach ($service_carousel_content as $key => $value) { ?>
			      	<div class="<?php echo esc_attr( $column_name ); ?> item" data-animate="hg-fadeInUp">
			      		<?php if( $service_item_theme == 'dark' ) {
			      			$service_theme = 'dark'; 
			      		} else {
							$service_theme = 'light';
			      		} ?>
			          	<div class="service-card <?php echo esc_attr( $service_theme ); ?> mrb-30">
			          	    <div class="service-icon color-deep-cerise">
			          	        <i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
			          	    </div><!--  /.service-icon -->
			          	    <h2 class="service-title"><?php echo esc_html( $value['service_title'] ); ?></h2><!--  /.service-title -->
			          	    <div class="service-list">
			          	    	<div class="service-content">
			          	    		<p><?php echo wp_kses_post( $value['service_sm_description'] ); ?></p>
			          	    	</div><!--  /.service-content -->
			          	    	<div class="service-hover-content">
			          	    	<ul>      	    		
				          	        <?php 
				          	        $service_list = vc_param_group_parse_atts( $value['service_description'] );
				          	        foreach ($service_list as $key2 => $value2) { ?>
				          	        <li><?php echo esc_html( $value2['service_lists'] ); ?></li>
				          	        <?php } ?>
			          	    	</ul>
			          	    	</div><!--  /.service-hover-content -->
			          	    </div><!--  /.service-list -->
			          	    <div class="shadow-icon">
			          	    	<i class="<?php echo esc_attr( $value['service_icons'] ); ?>"></i>
			          	    </div>
			          	</div><!--  /.service-card -->
			      	</div><!--  /.item -->  
				<?php }
			?>
		</div><!--  /.row -->
	<?php } ?>

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_services_components' );
function intrinsic_vc_services_components() {
	vc_map(array(
		'base' => 'intrinsic_services_components',
		'name' => esc_html__('Service', 'intrinsic-core'),
		'description' => esc_html__('Author Service', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'vc-material vc-material-local_laundry_service', 
		'params' => array(
			array(
				'param_name' => 'service_grid_carousel',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Service Style', 'intrinsic-core' ),
				'description' => esc_html__('Change Service Style. Ex- Grid or carousel', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'Grid', 'intrinsic-core' ) => 'grid',
					esc_html__( 'Carousel', 'intrinsic-core' ) => 'carousel',
				),
			),			
			array(
				'param_name' => 'service_grid_columns',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Service Columns', 'intrinsic-core' ),
				'description' => esc_html__('Change Service Columns', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'One Columns', 'intrinsic-core' ) => 'one_column',
					esc_html__( 'Two Columns', 'intrinsic-core' ) => 'two_column',
					esc_html__( 'Three Columns', 'intrinsic-core' ) => 'three_column',
					esc_html__( 'Four Columns', 'intrinsic-core' ) => 'four_column',
				),
			),
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Service Items', 'intrinsic-core' ),
				'param_name' => 'services_items', 
				'params' => array( 
					array(
						'param_name' => 'service_title', 
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'intrinsic-core' ),
						'admin_label' => true,
						'value'	=> 'Design',
					),				
					array(
						'param_name' => 'service_icons', 
						'type' => 'textfield',
						'heading' => esc_html__( 'Service Icons Code', 'intrinsic-core' ),
						'description' => __('Find Icon Code From - <a href="https://fontawesome.com/icons?d=gallery" rel="nofollow" target="_blank">https://fontawesome.com/icons?d=gallery</a> ','intrinsic-core'),
						'value' => 'fas fa-bullseye', 
					),					
					array(
						'param_name' => 'service_sm_description', 
						'type' => 'textfield',
						'heading' => esc_html__( 'Service Description', 'intrinsic-core' ),
						'value' => 'UI and UX, two terms that are mistakenly used as synonyms. The difference between', 
					),
					array(
						'param_name' => 'service_description', 
						'type' => 'param_group',
						'heading' => esc_html__( 'Service Description', 'intrinsic-core' ),
						'params'  => array(
							array(
								'param_name' => 'service_lists', 
								'type' => 'textfield',
								'heading' => esc_html__( 'Lists', 'intrinsic-core' ),
								'value' => 'Info graphic Design',
								'admin_label' => true,
							),	
						),
						'callbacks' => array(
							'after_add' => 'vcChartParamAfterAddCallback',
						),
					),
				), 
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback',
				),
			),  			
			array(
				'param_name' => 'service_item_theme',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Service Theme', 'intrinsic-core' ),
				'description' => esc_html__('Change Service Theme. Ex- Light or Dark Version', 'intrinsic-core'), 
				'value' => array(
					esc_html__( 'Light', 'intrinsic-core' ) => 'light',
					esc_html__( 'Dark', 'intrinsic-core' ) => 'dark',
				),
			), 			
			array(
				'param_name' => 'service_item_display',  
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Item Display', 'intrinsic-core' ),
				'description' => esc_html__('Change Item that wow many Item you want to display?', 'intrinsic-core'), 
				'value' => array(
					esc_html__( '1', 'intrinsic-core' ) => '1',
					esc_html__( '2', 'intrinsic-core' ) => '2',
					esc_html__( '3', 'intrinsic-core' ) => '3',
					esc_html__( '4', 'intrinsic-core' ) => '4',
				),
			),  				
			intrinsic_vc_css_param(),
		)
	));
}