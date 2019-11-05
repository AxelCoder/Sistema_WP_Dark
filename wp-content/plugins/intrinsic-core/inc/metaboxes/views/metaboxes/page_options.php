<ul class="intrinsic_metabox_tabs">
    <?php if( function_exists( 'register_block_type' ) ) { ?>
    <li class="active"><a href="#gutenberg"><?php echo esc_html__( "Gutenberg Options", 'intrinsic-core' ) ?></a></li>
	<li><a href="#header"><?php echo esc_html__( "Header", 'intrinsic-core' ) ?></a></li>
    <?php } else { ?>
    <li class="active"><a href="#header"><?php echo esc_html__( "Header", 'intrinsic-core' ) ?></a></li>
    <?php } ?>
    <li><a href="#contents"><?php echo esc_html__( "Content Area", 'intrinsic-core' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'intrinsic-core' ) ?></a></li>
</ul>
<div class="intrinsic_metabox">
    <?php if( function_exists( 'register_block_type' ) ) { ?>
    <div class="intrinsic_metabox_tab" id="intrinsic_tab_gutenberg">
        <?php 
        $this->select ( 'show_page_title', esc_html__( 'Show Page Title', 'intrinsic-core' ), array (
            'default' => esc_html__( 'Select to display title', 'intrinsic-core' ),
            'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
            'no' => esc_html__( 'No', 'intrinsic-core' )
        ), esc_html__( 'Choose to show or hide the page title.', 'intrinsic-core' ) );
        $this->select ( 'show_featured_image_in_content', esc_html__( 'Show featured image in the content', 'intrinsic-core' ), array (
            'default' => esc_html__( 'Select to display Featured Image', 'intrinsic-core' ),
            'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
            'no' => esc_html__( 'No', 'intrinsic-core' )
        ), esc_html__( 'Choose no to hide featured image in the content area.', 'intrinsic-core' ) );
        ?>
    </div>
    <?php } ?>
    <div class="intrinsic_metabox_tab" id="intrinsic_tab_header">
        <?php
        $menus = wp_get_nav_menus();
        $menuName = array();
        foreach ( $menus as $menu  ) : 
            $menuName[0] = esc_html__( 'Default', 'intrinsic-core' );
            $menuName[$menu->term_id] = $menu->name;
        endforeach;
        $this->select ( 'header_show_header', esc_html__( 'Show header', 'intrinsic-core' ), array (
            'default'   => esc_html__( 'Theme Setting', 'intrinsic-core' ),
            'yes'       => esc_html__( 'Yes', 'intrinsic-core' ),
            'no'        => esc_html__( 'No', 'intrinsic-core' ),
        ), esc_html__( 'Choose to show or hide the header.', 'intrinsic-core' ) );

        $this->select ( 'header_menu_sticky', esc_html__( 'Enable sticky/fixed header', 'intrinsic-core' ), array (
            'default'   => esc_html__( 'Default', 'intrinsic-core' ),
            'yes'       => esc_html__( 'Yes', 'intrinsic-core' ),
            'no'        => esc_html__( 'No', 'intrinsic-core' )
        ), esc_html__( 'Choose to enable or disable sticky menu.', 'intrinsic-core' ) );

        $this->select ( 'header_page_menu', esc_html__( 'Select Menu For Page', 'intrinsic-core' ), $menuName , esc_html__( 'Show Diffrent Menu at diffrent pages.', 'intrinsic-core' ) );

        $this->upload ( 'header_logo_main', esc_html__( 'Header Main Logo', 'intrinsic-core' ),esc_html__( 'Choose Page Header Main Logo.', 'intrinsic-core' ) );
        /* Start Header Background Status */
        ?>
    </div>

    <div class="intrinsic_metabox_tab" id="intrinsic_tab_contents">
        <?php
        $this->color('page_color', esc_html__('Page Custom Background Color', 'intrinsic-core'), 
            esc_html__('Add your Page Custom Background Color', 'intrinsic-core')
        ); 
        $this->text ( 'content_padding_top',  
            esc_html__( 'Spacing Top', 'intrinsic-core' ),  
            esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
        $this->text ( 'content_padding_bottom',  
            esc_html__( 'Spacing Bottom', 'intrinsic-core' ),  
            esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
        $this->text ( 'article_spacing_top',  
            esc_html__( 'Article Spacing Top', 'intrinsic-core' ),  
            esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
        $this->text ( 'article_spacing_bottom',  
            esc_html__( 'Article Spacing Bottom', 'intrinsic-core' ),  
            esc_html__( 'Leave it empty for default.', 'intrinsic-core' ) );
        ?>
    </div>

    <div class="intrinsic_metabox_tab" id="intrinsic_tab_footer">
        <?php
        $this->select ( 'footer_show_footer', esc_html__( 'Show footer', 'intrinsic-core' ), array (
            'default' => esc_html__( 'Theme Setting', 'intrinsic-core' ),
            'yes' => esc_html__( 'Yes', 'intrinsic-core' ),
            'no' => esc_html__( 'No', 'intrinsic-core' ),
        ), esc_html__( 'Choose to show or hide the footer.','intrinsic-core' ) );
        ?>
    </div>

</div>
<div class="clear"></div>