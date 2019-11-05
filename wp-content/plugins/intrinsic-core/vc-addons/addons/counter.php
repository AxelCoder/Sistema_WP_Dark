<?php
add_shortcode( 'intrinsic_counter_components', function($atts, $content = null) {
	$atts = vc_map_get_attributes( 'intrinsic_counter_components', $atts ); 
	extract(shortcode_atts(array(
		'counter_item' => '',  
		'title_color' => '', 
		'counter_color' => '', 
		'css' => '',
	), $atts));  
	ob_start(); ?>
	<div class="fun-facts-block">
        <div class="hg-promo-numbers">
            <div class="row">
			<?php 
				$counter_items = vc_param_group_parse_atts( $counter_item );
				foreach ($counter_items as $key => $value) { ?>				
	            <div class="col-sm-6 col-lg-3">
	                <div class="tg-promo-number text-center">
	                    <div class="odometer" data-odometer-final="<?php echo esc_attr( $value['number'] ); ?>" >0</div><!--  /.odometer -->
	                    <h4 class="promo-title" style="color: <?php echo esc_attr( $title_color ); ?>"><?php echo esc_html( $value['title'] ); ?></h4><!--  /.promo-title -->
	                </div><!--  /.tg-promo-number -->
	            </div><!--  /.col-sm-6 -->
				<?php }
			?>
            </div><!--  /.row -->
        </div><!--  /.container -->
    </div><!--  /.fun-facts-block -->

	<?php return ob_get_clean();
});

// Visual Composer Custom Shortcode
add_action( 'vc_before_init', 'intrinsic_vc_counter_components' );
function intrinsic_vc_counter_components() {
	vc_map(array(
		'base' => 'intrinsic_counter_components',
		'name' => esc_html__('Fun Fact Counter', 'intrinsic-core'),
		'description' => esc_html__('Fun Fact Counter Components', 'intrinsic-core'),
		'category' => esc_html__('Intrinsic Component', 'intrinsic-core'),
		'icon' => 'fa fa-sort-numeric-desc', 
		'params' => array(
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Counter Item', 'intrinsic-core' ),
				'param_name' => 'counter_item', 
				'params' => array( 
					array(
						'param_name' => 'number', 
						'type' => 'textfield',
						'heading' => esc_html__( 'Count Number', 'intrinsic-core' ),
						'value' => '117',
					),
					array(
						'param_name' => 'title',
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'intrinsic-core'), 
						'value' => esc_html__('Happy Client', 'intrinsic-core'),
						'admin_label' => true,
					),
				), 
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback',
				),
			), 
			array(
				'param_name' => 'title_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Counting Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Counting Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			),			
			array(
				'param_name' => 'counter_color',  
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Counting Color', 'intrinsic-core' ),
				'description' => esc_html__('Change Your Heading Colors', 'intrinsic-core'), 
				'group' => esc_html__( 'Content Styling', 'intrinsic-core' ),
				'value' => '#ffffff',
			), 			 		   										
			intrinsic_vc_css_param(),
		)
	));
}