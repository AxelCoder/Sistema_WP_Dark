<ul class="intrinsic_metabox_tabs">
	<li class="active"><a href="#post"><?php echo esc_html__( "Portfolio", 'intrinsic-core' ) ?></a></li>
</ul>
<div class='intrinsic_metabox'>
	<div class="intrinsic_metabox_tab active" id="intrinsic_tab_post">
		<?php
		$this->select ( 'featured_image_masonry_size', esc_html__( 'Masonry Image Size', 'intrinsic-core' ), array (
            'x_x' => esc_html__( 'X * X', 'intrinsic-core' ),
            'x_dx' => esc_html__( 'X * 2X', 'intrinsic-core' ),
			'dx_x' => esc_html__( '2X * X', 'intrinsic-core' ),
			'dx_dx' => esc_html__( '2X * 2X', 'intrinsic-core' )
		), esc_html__( 'Select featured image size in masonry layout.', 'intrinsic-core' ) );
		$this->text ( 'custom_link',  
			esc_html__( 'Custom Links', 'intrinsic-core' ),  
			esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
			
		$this->select ( 'show_page_title', esc_html__( 'Show Portfolio Title', 'intrinsic-core' ), array (
				'default' => esc_html__( 'Select to display Title', 'intrinsic-core' ),
				'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
				'no' => esc_html__( 'No', 'intrinsic-core' )
			), esc_html__( 'Choose no to hide Title in the content area.', 'intrinsic-core' ) );
		$this->select ( 'show_featured_image_in_content', esc_html__( 'Show featured image in the content', 'intrinsic-core' ), array (
				'default' => esc_html__( 'Select to display Featured Image', 'intrinsic-core' ),
				'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
				'no' => esc_html__( 'No', 'intrinsic-core' )
			), esc_html__( 'Choose no to hide featured image in the content area.', 'intrinsic-core' ) );
		?>
	</div>
</div>
<div class="clear"></div>