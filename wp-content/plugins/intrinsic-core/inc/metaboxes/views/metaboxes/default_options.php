<ul class="intrinsic_metabox_tabs">
	<li class="active"><a href="#header"><?php echo esc_html__( "Header", 'intrinsic-core' ) ?></a></li>
	<li><a href="#contents"><?php echo esc_html__( "Content Area", 'intrinsic-core' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'intrinsic-core' ) ?></a></li>
</ul>
<div class='intrinsic_metabox'>
	<div class="intrinsic_metabox_tab" id="intrinsic_tab_header">
		<?php
		$this->select ( 'header_show_header', esc_html__( 'Show header', 'intrinsic-core' ), array (
			'default' 	=> esc_html__( 'Theme Setting', 'intrinsic-core' ),
			'yes' 		=> esc_html__( 'Yes', 'intrinsic-core' ),
			'no' 		=> esc_html__( 'No', 'intrinsic-core' )
		), esc_html__( 'Choose to show or hide the header.', 'intrinsic-core' ) );
		$this->select ( 'header_menu_sticky', esc_html__( 'Enable sticky menu', 'intrinsic-core' ), array (
			'default' 	=> esc_html__( 'Theme Setting', 'intrinsic-core' ),
			'yes' 		=> esc_html__( 'Yes', 'intrinsic-core' ),
			'no' 		=> esc_html__( 'No', 'intrinsic-core' )
		), esc_html__( 'Choose to enable or disable sticky menu.', 'intrinsic-core' ) );
        ?>
	</div>
	<div class="intrinsic_metabox_tab" id="intrinsic_tab_sidebars">
		<?php
		$this->select ( 'sidebar_position', esc_html__( 'Sidebar Position', 'intrinsic-core' ),
			array (
				'default' => esc_html__( 'Theme Setting', 'intrinsic-core' ),
				'right' => esc_html__( 'Right', 'intrinsic-core' ),
				'left' => esc_html__( 'Left', 'intrinsic-core' ),
		), esc_html__( 'Select the sidebar position.', 'intrinsic-core' ) );
		?>
	</div>
	<div class="intrinsic_metabox_tab" id="intrinsic_tab_contents">
	    <?php 
	    $this->text ( 'content_padding_top',  
	        esc_html__( 'Padding Top', 'intrinsic-core' ),  
	        esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );

	    $this->text ( 'content_padding_bottom',  
	        esc_html__( 'Padding Bottom', 'intrinsic-core' ),  
	        esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
	    ?>
	</div>
	<div class="intrinsic_metabox_tab" id="intrinsic_tab_footer">
		<?php
		$this->select ( 'footer_show_footer', esc_html__( 'Show footer', 'intrinsic-core' ), array (
			'default' => esc_html__( 'Default', 'intrinsic-core' ),
			'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
			'no' => esc_html__( 'No', 'intrinsic-core' ),
		), esc_html__( 'Choose to show or hide the footer.','intrinsic-core' ) );
		?>
	</div>
</div>
<div class="clear"></div>