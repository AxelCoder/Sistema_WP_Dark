/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */
(function( $ ) {
	'use strict';
	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {
		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();
		wp.customize.preview.bind( 'section-highlight', function( data ) {
			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'twentyseventeen-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	//Banner Text
	wp.customize( 'intrinsic_options[blog_heading_text]', function( value ) {
		value.bind( function( to ) {
			$( '.blog-page-home.banner-post .banner-text h2.page-title' ).text( to );
		});
	});
	//Banner Height
	wp.customize( 'intrinsic_options[blog_banner_height]', function( value ) {
		value.bind( function( to ) {
			$( '.blog-page-home.banner-post' ).css({'height': ''+to+''});
		});
	});

	wp.customize( 'intrinsic_options[logo_margin_top]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-top': ''+to+'px'});
		});
	});	

	wp.customize( 'intrinsic_options[logo_margin_bottom]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-bottom': ''+to+'px'});
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {
				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! to.length ) {
					$( '#easyart-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.banner-post .banner-text h2' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Page layouts.
	wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}
	
	// Footer Background
	wp.customize( 'intrinsic_options[footer_background]', function( value ) {
		value.bind( function( to ) {
			$( 'footer#ts-footer > div.intrinsic-footer' ).css({'background': ''+to+''});
		});
	});	
	//Footer Text Color
	wp.customize( 'intrinsic_options[footer_color]', function( value ) {
		value.bind( function( to ) {
			$( 'footer#ts-footer > div.intrinsic-footer' ).css({'color': ''+to+''});
		});
	});	

	//Footer Link Color
	wp.customize( 'intrinsic_options[footer_link_color]', function( value ) {
		value.bind( function( to ) {
			$( 'footer#ts-footer > div.intrinsic-footer a' ).css({'color': ''+to+''});
		});
	});

	//Page Content Padding
	wp.customize("intrinsic_options[page_content_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_top_padding">.page-content-main { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[page_content_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_bottom_padding">.page-content-main { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[page_content_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_tablet_top_padding">@media (max-width: 768px){ .page-content-main { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[page_content_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_tablet_bottom_padding">@media (max-width: 768px){ .page-content-main { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[page_content_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_mobile_top_padding">@media (max-width: 480px){ .page-content-main { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[page_content_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_page_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_page_mobile_bottom_padding">@media (max-width: 480px){ .page-content-main { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	//End Page Content Padding

	//Blog Content Padding
	wp.customize("intrinsic_options[top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_top_padding">.blog-content-main { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_bottom_padding">.blog-content-main { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_tablet_top_padding">@media (max-width: 768px){ .blog-content-main { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_tablet_bottom_padding">@media (max-width: 768px){ .blog-content-main { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_mobile_top_padding">@media (max-width: 480px){ .blog-content-main { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_blog_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_blog_mobile_bottom_padding">@media (max-width: 480px){ .blog-content-main { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	//End Blog Content Padding

	//Logo Padding
	wp.customize("intrinsic_options[logo_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_top_padding">.site-branding { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[logo_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_bottom_padding">.site-branding { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[logo_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_tablet_top_padding">@media (max-width: 768px){ .site-branding { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[logo_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_tablet_bottom_padding">@media (max-width: 768px){ .site-branding { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[logo_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_mobile_top_padding">@media (max-width: 480px){ .site-branding { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[logo_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_logo_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_logo_mobile_bottom_padding">@media (max-width: 480px){ .site-branding { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});
	//End Logo Padding


	//Single Blog Padding
	wp.customize("intrinsic_options[blog_single_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_top_padding">.blog-single-spacing { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[blog_single_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_bottom_padding">.blog-single-spacing { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[blog_single_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_tablet_top_padding">@media (max-width: 768px){ .blog-single-spacing { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[blog_single_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_tablet_bottom_padding">@media (max-width: 768px){ .blog-single-spacing { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[blog_single_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_mobile_top_padding">@media (max-width: 480px){ .blog-single-spacing { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[blog_single_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_single_blog_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_single_blog_mobile_bottom_padding">@media (max-width: 480px){ .blog-single-spacing { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});
	//Single Blog Padding

	//Footer Padding
	wp.customize("intrinsic_options[footer_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_top_padding">.site-footer { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[footer_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_bottom_padding">.site-footer { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[footer_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_tablet_top_padding">@media (max-width: 768px){ .site-footer { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[footer_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_tablet_bottom_padding">@media (max-width: 768px){ .site-footer { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[footer_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_mobile_top_padding">@media (max-width: 480px){ .site-footer { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("intrinsic_options[footer_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-intrinsic_footer_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-intrinsic_footer_mobile_bottom_padding">@media (max-width: 480px){ .site-footer { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});
	//Footer Padding

} )( jQuery );
