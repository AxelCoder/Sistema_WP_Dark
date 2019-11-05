/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function() {
	'use strict';
	wp.customize.bind( 'ready', function() {
		// Only show the color hue control when there's a custom color scheme.
		wp.customize( 'colorscheme', function( setting ) {
			wp.customize.control( 'colorscheme_hue', function( control ) {
				var visibility = function() {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			});
		});

		// Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
		wp.customize.section( 'theme_options', function( section ) {
			section.expanded.bind( function( isExpanding ) {
				// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
				wp.customize.previewer.send( 'section-highlight', { expanded: isExpanding });
			} );
		} );

		// Hide and show settings changes for header controls.

		// Responsive switchers
		$( '.customize-control .responsive-switchers button' ).on( 'click', function( event ) {

			// Set up variables
			var $this 		= $( this ),
				$devices 	= $( '.responsive-switchers' ),
				$device 	= $( event.currentTarget ).data( 'device' ),
				$control 	= $( '.customize-control.has-switchers' ),
				$body 		= $( '.wp-full-overlay' ),
				$footer_devices = $( '.wp-full-overlay-footer .devices' );

			// Button class
			$devices.find( 'button' ).removeClass( 'active' );
			$devices.find( 'button.preview-' + $device ).addClass( 'active' );

			// Control class
			$control.find( '.control-wrap' ).removeClass( 'active' );
			$control.find( '.control-wrap.' + $device ).addClass( 'active' );
			$control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );

			// Wrapper class
			$body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + $device );

			// Panel footer buttons
			$footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
			$footer_devices.find( 'button.preview-' + $device ).addClass( 'active' ).attr( 'aria-pressed', true );

			// Open switchers
			if ( $this.hasClass( 'preview-desktop' ) ) {
				$control.toggleClass( 'responsive-switchers-open' );
			}

		} );

		// If panel footer buttons clicked
		$( '.wp-full-overlay-footer .devices button' ).on( 'click', function( event ) {

			// Set up variables
			var $this 		= $( this ),
				$devices 	= $( '.customize-control.has-switchers .responsive-switchers' ),
				$device 	= $( event.currentTarget ).data( 'device' ),
				$control 	= $( '.customize-control.has-switchers' );

			// Button class
			$devices.find( 'button' ).removeClass( 'active' );
			$devices.find( 'button.preview-' + $device ).addClass( 'active' );

			// Control class
			$control.find( '.control-wrap' ).removeClass( 'active' );
			$control.find( '.control-wrap.' + $device ).addClass( 'active' );
			$control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );

			// Open switchers
			if ( ! $this.hasClass( 'preview-desktop' ) ) {
				$control.addClass( 'responsive-switchers-open' );
			} else {
				$control.removeClass( 'responsive-switchers-open' );
			}

		} );
	});
})( jQuery );
