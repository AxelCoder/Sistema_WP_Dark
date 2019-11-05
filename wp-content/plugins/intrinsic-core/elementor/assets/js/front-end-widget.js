(function ($) {
	"use strict";
	/* ---------------------------------------------
	 Progress Bar
	--------------------------------------------- */
	var WidgetIntrinsicProgressbarHandler = function( $scope, $ ) {
		var $progressBar = $('.skill-progress');
		var $skillBar = $('.skill-bar');
		if($progressBar.length) {

			var $section = $progressBar.parent();

			$skillBar.each(function() {
				$(this).isInViewport(function(status) {
					if (status === "entered") {
						$(this).find('.progress-content').animate({
							width: $(this).attr('data-percentage')
						}, 1500);
						$(this).find('.progress-mark').animate({
							left: $(this).attr('data-percentage')
						}, {
							duration: 1500,
							step: function(now, fx) {
								var data = Math.round(now);
								$(this).find('.percent').html(data + '%');
							}
						});
					}
				});
			});
		}
	};

	/* ---------------------------------------------
	 Testimonial Carousel
	--------------------------------------------- */
	var WidgetIntrinsicServicesCarouselHandler = function( $scope, $ ) {
		var $owlCarousel = $(".service-carousel");

		if( $owlCarousel.length ){
		    $owlCarousel.each(function() {

		        var items = parseInt( $(this).attr("data-owl-items"), 10);
		        if( !items ) items = 1;

		        var nav = parseInt( $(this).attr("data-owl-nav"), 2);
		        if( !nav ) nav = 0;

		        var dots = parseInt( $(this).attr("data-owl-dots"), 2);
		        if( !dots ) dots = 0;

		        var center = parseInt( $(this).attr("data-owl-center"), 2);
		        if( !center ) center = 0;

		        var loop = parseInt( $(this).attr("data-owl-loop"), 2);
		        if( !loop ) loop = 0;

		        var margin = parseInt( $(this).attr("data-owl-margin"), 10);
		        if( !margin ) margin = 0;

		        var autoWidth = parseInt( $(this).attr("data-owl-auto-width"), 2);
		        if( !autoWidth ) autoWidth = 0;

		        var navContainer = $(this).attr("data-owl-nav-container");
		        if( !navContainer ) navContainer = 0;

		        var autoplay = parseInt( $(this).attr("data-owl-autoplay"), 2);
		        if( !autoplay ) autoplay = 0;

		        var autoplayTimeOut = parseInt( $(this).attr("data-owl-autoplay-timeout"), 10);
		        if( !autoplayTimeOut ) autoplayTimeOut = 5000;

		        var autoHeight = parseInt( $(this).attr("data-owl-auto-height"), 2);
		        if( !autoHeight ) autoHeight = 0;

		        var animationIn = $(this).attr("data-owl-anim-in");
		        if( !animationIn ) animationIn = 0;
		        else animationIn = $(this).attr("data-owl-anim-in");	        

		        var animationOut = $(this).attr("data-owl-anim-out");
		        if( !animationOut ) animationOut = 0;
		        else animationOut = $(this).attr("data-owl-anim-out");


		        if( $("body").hasClass("rtl") ) var rtl = true;
		        else rtl = false;

		        if( items === 1 ){
		            $(this).owlCarousel({
		                navContainer: navContainer,
		                animateOut: animationOut,
		                animateIn: animationIn,
		                autoplayTimeout: autoplayTimeOut,
		                autoplay: 1,
		                autoHeight: autoHeight,
		                center: center,
		                loop: loop,
		                margin: margin,
		                autoWidth: autoWidth,
		                items: 1,
		                autoplayHoverPause: 1,
		                nav: nav,
		                dots: dots,
		                rtl: rtl,
		                navText: []
		            });
		        }
		        else {
		            $(this).owlCarousel({
		                navContainer: navContainer,
		                animateOut: animationOut,
		                animateIn: animationIn,
		                autoplayTimeout: autoplayTimeOut,
		                autoplay: autoplay,
		                autoHeight: autoHeight,
		                center: center,
		                loop: loop,
		                margin: margin,
		                autoWidth: autoWidth,
		                items: 1,
		                autoplayHoverPause: 1,
		                nav: nav,
		                dots: dots,
		                rtl: rtl,
		                navText: [],
		                responsive: {
		                    1199: {
		                        items: items
		                    },
		                    992: {
		                        items: 2
		                    },
		                    768: {
		                        items: 2
		                    },
		                    0: {
		                        items: 1
		                    }
		                }
		            });
		        }

		        if( $(this).find(".owl-item").length === 1 ){
		            $(this).find(".owl-nav").css( { "opacity": 0,"pointer-events": "none"} );
		        }

		    });
		}
	};

	/* ---------------------------------------------
	 Portfolio
	--------------------------------------------- */
	var WidgetIntrinsicTestimonialHandler = function( $scope, $ ) {
		var $owlCarousel = $(".testimonial-carousel");

		if( $owlCarousel.length ){
		    $owlCarousel.each(function() {

		        var items = parseInt( $(this).attr("data-owl-items"), 10);
		        if( !items ) items = 1;

		        var nav = parseInt( $(this).attr("data-owl-nav"), 2);
		        if( !nav ) nav = 0;

		        var dots = parseInt( $(this).attr("data-owl-dots"), 2);
		        if( !dots ) dots = 0;

		        var center = parseInt( $(this).attr("data-owl-center"), 2);
		        if( !center ) center = 0;

		        var loop = parseInt( $(this).attr("data-owl-loop"), 2);
		        if( !loop ) loop = 0;

		        var margin = parseInt( $(this).attr("data-owl-margin"), 10);
		        if( !margin ) margin = 0;

		        var autoWidth = parseInt( $(this).attr("data-owl-auto-width"), 2);
		        if( !autoWidth ) autoWidth = 0;

		        var navContainer = $(this).attr("data-owl-nav-container");
		        if( !navContainer ) navContainer = 0;

		        var autoplay = parseInt( $(this).attr("data-owl-autoplay"), 2);
		        if( !autoplay ) autoplay = 0;

		        var autoplayTimeOut = parseInt( $(this).attr("data-owl-autoplay-timeout"), 10);
		        if( !autoplayTimeOut ) autoplayTimeOut = 5000;

		        var autoHeight = parseInt( $(this).attr("data-owl-auto-height"), 2);
		        if( !autoHeight ) autoHeight = 0;

		        var animationIn = $(this).attr("data-owl-anim-in");
		        if( !animationIn ) animationIn = 0;
		        else animationIn = $(this).attr("data-owl-anim-in");	        

		        var animationOut = $(this).attr("data-owl-anim-out");
		        if( !animationOut ) animationOut = 0;
		        else animationOut = $(this).attr("data-owl-anim-out");


		        if( $("body").hasClass("rtl") ) var rtl = true;
		        else rtl = false;

		        if( items === 1 ){
		            $(this).owlCarousel({
		                navContainer: navContainer,
		                animateOut: animationOut,
		                animateIn: animationIn,
		                autoplayTimeout: autoplayTimeOut,
		                autoplay: 1,
		                autoHeight: autoHeight,
		                center: center,
		                loop: loop,
		                margin: margin,
		                autoWidth: autoWidth,
		                items: 1,
		                autoplayHoverPause: 1,
		                nav: nav,
		                dots: dots,
		                rtl: rtl,
		                navText: []
		            });
		        }
		        else {
		            $(this).owlCarousel({
		                navContainer: navContainer,
		                animateOut: animationOut,
		                animateIn: animationIn,
		                autoplayTimeout: autoplayTimeOut,
		                autoplay: autoplay,
		                autoHeight: autoHeight,
		                center: center,
		                loop: loop,
		                margin: margin,
		                autoWidth: autoWidth,
		                items: 1,
		                autoplayHoverPause: 1,
		                nav: nav,
		                dots: dots,
		                rtl: rtl,
		                navText: [],
		                responsive: {
		                    1199: {
		                        items: items
		                    },
		                    992: {
		                        items: 2
		                    },
		                    768: {
		                        items: 1
		                    },
		                    0: {
		                        items: 1
		                    }
		                }
		            });
		        }

		        if( $(this).find(".owl-item").length === 1 ){
		            $(this).find(".owl-nav").css( { "opacity": 0,"pointer-events": "none"} );
		        }

		    });
		}
	};

	/* ---------------------------------------------
	 Portfolio Carousel Gallery
	--------------------------------------------- */
	var WidgetcounterItem = function() {
		$(".hg-promo-numbers").each(function () {
		    $(this).isInViewport(function(status) {
		        if (status === "entered") {
		            for( var i=0; i < document.querySelectorAll(".odometer").length; i++ ){
		                var el = document.querySelectorAll('.odometer')[i];
		                el.innerHTML = el.getAttribute("data-odometer-final");
		            }
		        }
		    });
		});
	};

	/* ---------------------------------------------
	 Initialize Elementor Front Script
	--------------------------------------------- */
	$(window).on('elementor/frontend/init', function () {
		// Progress Bar
		elementorFrontend.hooks.addAction('frontend/element_ready/intrinsic-progressbar.default', WidgetIntrinsicProgressbarHandler);

		// Services Carousel
		elementorFrontend.hooks.addAction('frontend/element_ready/intrinsic-service.default', WidgetIntrinsicServicesCarouselHandler);

		// Portfolio Carousel
		elementorFrontend.hooks.addAction('frontend/element_ready/intrinsic-testimonials.default', WidgetIntrinsicTestimonialHandler);
		
		elementorFrontend.hooks.addAction('frontend/element_ready/intrinsic-counter.default', WidgetcounterItem);

		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
			if( $scope.hasClass('section-parallax') ) {
				$(".section-parallax").each(function() {
				    var speed = 3;
				    var $this = $(this);
				    var isVisible;
				    var backgroundPosition;

				    // Remove background image on parent element
				    var $backgroundImages = $this.css('background-image');
				    var $bgURL = $backgroundImages.replace('url(','').replace(')','').replace(/\"/gi, "");

				    $this.css('background-image', 'none');

				    $this.prepend('<div class="hg-background"></div>');

				    if( $bgURL !== 'none' ) {
				    	$this.find('.hg-background').append('<div class="hg-background-image hg-parallax-element" style="background-image: url('+ $bgURL+');"></div>');
				    }

				    $this.isInViewport(function(status) {
				        if (status === "entered") {
				            isVisible = 1;
				            var position;

				            $(window).scroll(function () {
				                if( isVisible === 1 ){
				                    position = $(window).scrollTop() - $this.offset().top;
				                    backgroundPosition = (100 - (Math.abs((-$(window).height()) - position) / ($(window).height()+$this.height()))*100);
				                    if( $this.find(".hg-parallax-element").hasClass("hg-background-image") ){
				                        $this.find(".hg-background-image.hg-parallax-element").css("background-position-y", (position/speed) + "px");
				                    }
				                    else {
				                        $this.find(".hg-parallax-element").css("transform", "translateY(" +(position/speed)+ "px)");
				                    }
				                }
				            });
				        }
				        if (status === "leaved"){
				            isVisible = 0;
				        }
				    });
				});
			}
		} );
	});
})(jQuery);