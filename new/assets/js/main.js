(function ($)
{ "use strict"

	/* Preloader */
	$(window).on('load', function () {
		$('#preloader-active').delay(1450).fadeOut('slow');
		$('.preloader').delay(450).addClass('fadePreloaderOut');
		$('body').delay(450).css({
			'overflow': 'visible'
		});
	});

	/* sticky And Scroll UP */
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 400) {
			$(".header-sticky").removeClass("sticky-bar");
			$('#back-top').fadeOut(500);
		} else {
			$(".header-sticky").addClass("sticky-bar");
			$('#back-top').fadeIn(500);
		}
	});
	// Scroll Up
	$('#back-top a').on("click", function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});


	/* slick Nav */
// mobile_menu
	var menu = $('ul#navigation');
	if(menu.length){
		menu.slicknav({
			prependTo: ".mobile_menu",
			closedSymbol: '+',
			openedSymbol:'-'
		});
	}




	/* MainSlider-1 */

	$(".slider-area").vegas({
		slides: [

			{ src: "assets/img/about/FP1.png" },

			{ src: "assets/img/about/FP2.png" },

			{ src: "assets/img/about/FP3.png" },

		],
		// slide:2,
		transition: ['zoomOut'],
		transitionDuration: 5000,
		firstTransition: ['zoomOut'],
		firstTransitionDuration:3000,
	});

	// function mainSlider() {
	//     var BasicSlider = $('.slider-active');
	//     BasicSlider.on('init', function (e, slick) {
	//       var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
	//       doAnimations($firstAnimatingElements);
	//     });
	//     BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
	//       var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
	//       doAnimations($animatingElements);
	//     });
	//     BasicSlider.slick({
	//       autoplay: false,
	//       autoplaySpeed: 10000,
	//       dots: false,
	//       fade: true,
	//       arrows: true,
	//       prevArrow: '<button type="button" class="slick-prev"><i class="ti-arrow-left"></i></button>',
	//       nextArrow: '<button type="button" class="slick-next"><i class="ti-arrow-right"></i></button>',
	//       responsive: [{
	//           breakpoint: 1024,
	//           settings: {
	//             slidesToShow: 1,
	//             slidesToScroll: 1,
	//             infinite: true,
	//           }
	//         },
	//         {
	//           breakpoint: 992,
	//           settings: {
	//             slidesToShow: 1,
	//             slidesToScroll: 1,
	//             arrows: false
	//           }
	//         },
	//         {
	//           breakpoint: 767,
	//           settings: {
	//             slidesToShow: 1,
	//             slidesToScroll: 1,
	//             arrows: false
	//           }
	//         }
	//       ]
	//     });
	//
	//     function doAnimations(elements) {
	//       var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
	//       elements.each(function () {
	//         var $this = $(this);
	//         var $animationDelay = $this.data('delay');
	//         var $animationType = 'animated ' + $this.data('animation');
	//         $this.css({
	//           'animation-delay': $animationDelay,
	//           '-webkit-animation-delay': $animationDelay
	//         });
	//         $this.addClass($animationType).one(animationEndEvents, function () {
	//           $this.removeClass($animationType);
	//         });
	//       });
	//     }
	//   }
	//   mainSlider();


	// Brand Active
	//    $('.brand-active').slick({
	//      dots: false,
	//      infinite: true,
	//      autoplay: true,
	//      speed: 400,
	//      arrows: false,
	//      slidesToShow: 5,
	//      slidesToScroll: 1,
	//      responsive: [
	//        {
	//          breakpoint: 1200,
	//          settings: {
	//            slidesToShow: 4,
	//            slidesToScroll: 3,
	//            infinite: true,
	//            dots: false,
	//          }
	//        },
	//        {
	//          breakpoint: 1024,
	//          settings: {
	//            slidesToShow: 3,
	//            slidesToScroll: 3,
	//            infinite: true,
	//            dots: false,
	//          }
	//        },
	//        {
	//          breakpoint: 991,
	//          settings: {
	//            slidesToShow: 3,
	//            slidesToScroll: 1,
	//            infinite: true,
	//            dots: false,
	//          }
	//        },
	//        {
	//          breakpoint: 768,
	//          settings: {
	//            slidesToShow: 2,
	//            slidesToScroll: 1
	//          }
	//        },
	//        {
	//          breakpoint: 480,
	//          settings: {
	//            slidesToShow: 1,
	//            slidesToScroll: 1
	//          }
	//        },
	//
	//        // You can unslick at a given breakpoint now by adding:
	//        // settings: "unslick"
	//        // instead of a settings object
	//      ]
	//    });


	/* Testimonial Active*/
	// var testimonial = $('.h1-testimonial-active');
	//     if(testimonial.length){
	//     testimonial.slick({
	//         dots: false,
	//         infinite: true,
	//         speed: 1000,
	//         autoplay:false,
	//         loop:true,
	//         arrows: true,
	//         prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',
	//         nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',
	//         slidesToShow: 1,
	//         slidesToScroll: 1,
	//         responsive: [
	//           {
	//             breakpoint: 1024,
	//             settings: {
	//               slidesToShow: 1,
	//               slidesToScroll: 1,
	//               infinite: true,
	//               dots: false,
	//               arrow:false
	//             }
	//           },
	//           {
	//             breakpoint: 600,
	//             settings: {
	//               slidesToShow: 1,
	//               slidesToScroll: 1,
	//               arrows:false
	//             }
	//           },
	//           {
	//             breakpoint: 480,
	//             settings: {
	//               slidesToShow: 1,
	//               slidesToScroll: 1,
	//               arrows:false,
	//             }
	//           }
	//         ]
	//       });
	//     }


	/* Nice Selector  */
	var nice_Select = $('select');
	if(nice_Select.length){
		nice_Select.niceSelect();
	}

	/* data-background */
	$("[data-background]").each(function () {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
	});


	/* WOW active */
	new WOW().init();



// ---- Mailchimp js --------//
	function mailChimp() {
		$('#mc_embed_signup').find('form').ajaxChimp();
	}
	mailChimp();



// Pop Up Img
	var popUp = $('.single_gallery_part, .img-pop-up');
	if(popUp.length){
		popUp.magnificPopup({
			type: 'image',
			gallery:{
				enabled:true
			}
		});
	}

	/* magnificPopup video view */
	$('.popup-video').magnificPopup({
		type: 'iframe'
	});



	/* counterUp*/
	$('.counter').counterUp({
		delay: 10,
		time: 3000
	});


	/* side navigation */
	setTimeout(function(){
		let slider=$('.slider-area'),
			header=$('.header-bottom'),
			footer=$('footer'),
			sidenav=$('.nav'),
			news=$('#news_section'),
			sidenavmenu=$('#side_nav'),
			newssection=$('#news_section>div');

		let nav_ht=header.height();
		let distanceFromTop = $(window).scrollTop();
		let height = $(document).height();
		let w_height = $(window).height();
		let news_content = $("#news_section ul");

		$(window).on('load', function () {
			sidenav.css('height', w_height - nav_ht);
			news.css('height', w_height - nav_ht);
			sidenavmenu.css('height', sidenav.height() - 40);
			newssection.css('height', news.height() - 40);
			news_content.css('height','calc('+newssection.height()+'px'+' - '+$("#news_section h4").css('height')+' - 20px)');
			if (distanceFromTop <= (slider.height()-header.height())) {
				sidenav.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":0,
					"bottom":"unset",
					"width":"100%",
				});
				news.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":0,
					"bottom":"unset",
					"width":"100%",
				});
			}
			else if (distanceFromTop <= height - (footer.height()) - w_height) {
				sidenav.css({
					"margin-top": nav_ht,
					"position": "fixed",
					"top":0,
					"bottom":"unset",
					"width":"25%",
				});
				news.css({
					"margin-top": nav_ht,
					"position": "fixed",
					"top":0,
					"bottom":"unset",
					"width":"25%",
				});
			} else {
				sidenav.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":"unset",
					"bottom":"0px",
					"width":"100%",
				});
				news.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":"unset",
					"bottom":"0px",
					"width":"100%",
				});
			}
		});

		$(window).on('scroll', function () {
			nav_ht=header.height();
			distanceFromTop = $(window).scrollTop();
			height = $(document).height();
			w_height = $(window).height();
			if (distanceFromTop <= (slider.height()-header.height())) {
				sidenav.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":0,
					"bottom":"unset",
					"width":"100%",
				});
				news.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":0,
					"bottom":"unset",
					"width":"100%",
				});
			}
			else if (distanceFromTop <= height - (footer.height()) - w_height) {
				sidenav.css({
					"margin-top": nav_ht,
					"position": "fixed",
					"top":0,
					"bottom":"unset",
					"width":"25%",
				});
				news.css({
					"margin-top": nav_ht,
					"position": "fixed",
					"top":0,
					"bottom":"unset",
					"width":"25%",
				});
			} else {
				sidenav.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":"unset",
					"bottom":"0px",
					"width":"100%",
				});
				news.css({
					"margin-top": "0px",
					"position": "absolute",
					"top":"unset",
					"bottom":"0px",
					"width":"100%",
				});
			}
		});
	},2000);

	// if ($(window).width()>=600) {
	//   $(window).on('scroll', function () {
	//
	//     var distanceFromTop = $(this).scrollTop();
	//
	//     if (distanceFromTop > ($('.slider-area').height() - $('header').height() - 20)) {
	//       // $("#side_menu").css({
	//       //     'position': 'fixed',
	//       //     'top': $('#mainNav').height()+20
	//       // });
	//       $("#side_nav").css('padding-top', 'calc(' + ini + ' + ' + (he + 20) + 'px)');
	//       $("#news_section").css('padding-top', 'calc(' + ini2 + ' + ' + (he + 20) + 'px)');
	//       console.log("yes");
	//     } else {
	//       $("#side_nav").css('padding-top', ini);
	//       $("#news_section").css('padding-top', ini2);
	//       console.log("no");
	//       // $("#side_menu").css({
	//       //     'position': 'absolute',
	//       //     'top': 'unset'
	//       // });
	//       // $('#sticky').removeClass('fixed');
	//     }
	//   });
	// }
	// else{
	//   $(window).on('scroll', function () {
	//     if ($(window).scrollTop() > 300) {
	//       nav.addClass('shw');
	//     } else {
	//       nav.removeClass('shw');
	//     }
	//   });
	//   $("#side_menu a").click(function(){
	//     $("#side_nav").toggleClass('slided');
	//     close_btn.toggleClass('shw');
	//   });
	//   $("#side_menu a").click(function(){
	//     $("#side_nav").toggleClass('slided');
	//     close_btn.toggleClass('shw');
	//   });
	// }
	// $(window).on('scroll', function () {
	//   if ($(window).scrollTop() > 300) {
	//     btn.addClass('shw');
	//   } else {
	//     btn.removeClass('shw');
	//   }
	// });

	// btn.on('click', function(e) {
	//   e.preventDefault();
	//   $('html, body').animate({scrollTop:0}, '300');
	// });
	// nav.on('click', function(e) {
	//   e.preventDefault();
	//   $("#side_nav").toggleClass('slided');
	//   setTimeout(function(){
	//     close_btn.toggleClass('shw');
	//   },500);
	// });
	// close_btn.on('click', function(e) {
	//   e.preventDefault();
	//   $("#side_nav").toggleClass('slided');
	//   close_btn.toggleClass('shw');
	// });
	function readMore(section) {
		// let dots = document.querySelector(`.card[data-city="${city}"] .dots`);
		let moreText = document.querySelector(`section[id="${section}"] .more`);
		let btnText = document.querySelector(`section[id="${section}"] .read_more`);
		console.log(moreText.style);
		if (moreText.style.display === "none") {
			// dots.style.display = "inline";
			btnText.textContent = "Read Less";
			moreText.style.display = "inline";
		} else {
			// dots.style.display = "none";
			btnText.textContent = "Read More";
			moreText.style.display = "none";
		}
	}
	if($(window).width() <= 768){
		$(".dropdown-toggle").attr("data-toggle", "dropdown");
	}

})(jQuery);
