;( function( $ ) {
$(document).ready( function () {
	var minHeight = $('ul.intrinsic_metabox_tabs').height();
	
	function set_tab_height() {
		var height = $('div.intrinsic_metabox').height();
		$('ul.intrinsic_metabox_tabs').height(
			height > minHeight ? ( height + 40 ): minHeight	
		);
	}

	$(".intrinsic_metabox_tabs a").click ( function ( e ) {
		e.preventDefault();

		$(".intrinsic_metabox_tabs li").removeClass('active');
		$(this).closest( 'li' ).addClass('active');

		$('.intrinsic_metabox_tab').hide();

		var tabid = $(this).attr( 'href' );
		tabid = tabid.replace( '#', '' );

		$('#intrinsic_tab_' + tabid + '.intrinsic_metabox_tab').fadeIn( 300,
				function ( ) {
					set_tab_height();
				}
		);
	});

	$(".intrinsic_metabox_tabs li.active a").trigger('click');

	$('.intrinsic_metabox input.intrinsic_upload_button').click( function(e) {
		e.preventDefault();
		var self = $(this);

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Select Image',
			},
			frame: 'post',

			multiple: false  // Set to true to allow multiple files to be selected
		});

		file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();
		$('.media-menu a:contains(Create Gallery)').remove();

		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');
				selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				self.parent().parent().find('.upload_field').val( attachment.url );
			});

			$('.media-modal-close').trigger('click');
		});

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get('selection');
			var size = $('.attachment-display-settings .size').val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				self.parent().parent().find('.upload_field').val( attachment.url );
			});

			self.text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});
	});
	
	var custom_uploader;
	$('.intrinsic_multiple_images').each( function() {
		var multiple_image_wrapper = $(this);
		var id = multiple_image_wrapper.data('formid');
		$(this).find('.intrinsic_multiple_upload_button').click( function(e) {
			e.preventDefault();
			
			if (custom_uploader) {
		        custom_uploader.open();
		        return;
		    }
			
			custom_uploader = wp.media.frames.file_frame = wp.media({
		        title: 'Choose Image',
		        button: {
		            text: 'Choose Image'
		        },
		        multiple: true
		    });
		    custom_uploader.on('select', function() {
		    	var selection = custom_uploader.state().get('selection');
		    	var upload_container = multiple_image_wrapper.find('.intrinsic_uploaded_images');
		        selection.map( function( attachment ) {
			        attachment = attachment.toJSON();
			        var img_html = '';
			        img_html += '<div class="image">';
			        img_html += ( '<img src="' + attachment.sizes['thumbnail'].url + '">' );
			        img_html += ( '<input type="hidden" id="intrinsic_' + id + '" name="intrinsic_' + id + '[]" value="' + attachment.id + '">' );
			        img_html += '<i class="remove fa fa-close"></i>';
			        img_html += '</div>';
			        upload_container.append( img_html );
		        });
		        set_tab_height();
		    });
		    custom_uploader.open();
		} );
	} );
	$(document).on( 'click', '.intrinsic_uploaded_images .remove', function(){
		var img_container = $(this).closest('.image');
		img_container.remove();
	} );

	$('.intrinsic-metabox-color-picker').wpColorPicker();

	/* Metabox option group toggle open/close */
	$('.intrinsic-metabox-subsection .subsection-title').on( 'click', function() {
		var $section = $(this).closest( '.intrinsic-metabox-subsection' );
		if( $section.hasClass( 'opened' ) ) {
			$section.removeClass( 'opened' );
			$section.find( '.subsection-content' ).slideUp( 400 );
		} else {
			$section.addClass( 'opened' );
			$section.find( '.subsection-content' ).slideDown( 400 );
		}
	} );
	
	/* Metabox dependency check */
	var option_prefix = 'intrinsic_';
	function metabox_check_dependency() {
		$( '.intrinsic_metabox' ).find( 'div[data-dep-option]' ).each( function() {
			var $this = $(this);
			var dep_option = $this.data( 'dep-option' );
			var dep_value = $this.data( 'dep-value' );
			var dep_default = $this.data( 'dep-default' );
			var dep_value_in = $(this).data( 'dep-value-in' );
			var dep_value_not_in = $(this).data( 'dep-value-not-in' );
			var dep_option_value = $( '#' + option_prefix + dep_option ).val();
			var show = true;
			console.log( dep_value + ' ' + dep_option_value );
			if( dep_option_value == 'default' ) {
				if( dep_value == dep_default ) {
					show = true;
				} else {
					show = false;
				}
			} else if( dep_value ) {
				if( dep_option_value == dep_value ) {
					show = true;
				} else {
					show = false;
				}
			} else if( dep_value_in ) {
				var values = dep_value_in.split( ',' );
				var value_is_in = false;
				for( var i = 0; i < values.length; i++ ) {
					if( values[i] == dep_option_value ) {
						value_is_in = true;
						break;
					}
				}
				if( !value_is_in ) {
					show = false;
				}
			} else if( dep_value_not_in ) {
				var values = dep_value_not_in.split( ',' );
				for( var i = 0; i < values.length; i++ ) {
					if( values[i] == dep_option_value ) {
						show = false;
						break;
					}
				}
			}
			if( show ) {
				$this.css( 'display', 'block' );
			} else { 
				$this.css( 'display', 'none' );
			}
		} );
	}
	metabox_check_dependency();

	$( '.intrinsic-meta-value' ).on( 'change', function() {
		metabox_check_dependency();
	} );
});
})( jQuery );