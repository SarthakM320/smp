function read_more(element) {
	let el = $(element);
	$(element).remove();
	let target_id = el.attr('data-id');
	let active = el.attr('data-active');
	if(active === 'true'){
		el.attr('data-active','false');
		el.php('Read More');
		$(target_id).slideUp(500);
		$(target_id).after(el);

	}
	else{
		el.attr('data-active','true');
		el.php('Read Less');
		$(target_id).slideDown();
		$(target_id).after(el);
		// setTimeout(function (){
		// 	$(window).scrollTop($(window).scrollTop() + $(target_id).height());
		// },100)
	}
}

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
		// console.log(scroll);
		// console.log(($(document).height() - $('footer').height()));

		if (scroll < 400) {
			// $(".header-sticky").removeClass("sticky-bar");
			$('#back-top').fadeOut(500);
			if($(window).width() <= 786){
				$("#announcement-btn").fadeOut(400);
				$("#nav-btn").fadeOut(600);
			}
		}
		else if(scroll > ($(document).height() - $('footer').height() - $(window).height())){
			$('#back-top').fadeOut(500);
			if($(window).width() <= 786){
				$("#announcement-btn").fadeOut(400);
				$("#nav-btn").fadeOut(600);
			}
		}
		else {
			// $(".header-sticky").addClass("sticky-bar");
			$('#back-top').fadeIn(500);
			if($(window).width() <= 786){
				$("#announcement-btn").fadeIn(600);
				$("#nav-btn").fadeIn(400);
			}
		}
	});
	// Scroll Up
	$('#back-top a').on("click", function (e) {
		e.preventDefault();
		$('body,html').animate({
			scrollTop: 0
		}, 10);
		// return false;
	});


	//side navigation
	$(".side-menu-content>ul>li>a").on("click",function (e){
		e.preventDefault();
		let target = $(this).attr('href');
		if($(window).width()<=786){
			$(".slided").removeClass('slided');
			$(".hide").removeClass('hide');
			$("#close_btn").toggleClass('shw');
			$('html, body').animate({
				scrollTop: $(target).offset().top - 56 // Means Less header height
			},10);
		}
		else{
			$('html, body').animate({
				scrollTop: $(target).offset().top - 91 // Means Less header height
			},10);
		}
	})
	// scroll-to-bottom
	$(".arrow>a").on("click",function (e){
		e.preventDefault();
		let target = '#main_body';
		if($(window).width()<=786){
			$('html, body').animate({
				scrollTop: $(target).offset().top - 56 // Means Less header height
			},10);
		}
		else{
			$('html, body').animate({
				scrollTop: $(target).offset().top - 91 // Means Less header height
			},10);
		}
	})


	// announcement auto scroll
	if($(window).width() > 575 && $(".news-content>ul").height() > (0.6 * ($(window).height() - 76 - 15 - 20 - 20 - 20 - $(".news-header").height() - 60))){
		let ticker = $(".news-content>ul");
		ticker.children().filter("ul").each(function () {
			let dt = $(this),
				container = $("<div>");
			dt.next().appendTo(container);
			dt.prependTo(container);
			container.appendTo(ticker);
		});
		ticker.css("overflow", "hidden");

		function animator(currentItem) {

			let distance = currentItem.height();
			let duration = (distance + parseInt(currentItem.css("marginTop")) + parseInt(currentItem.css("paddingBottom"))) / 0.025;
			currentItem.animate({ marginTop: - distance - parseInt(currentItem.css("paddingBottom")) }, duration, "linear", function () {
				currentItem.appendTo(currentItem.parent()).css("marginTop", 0);
				animator(currentItem.parent().children(":first"));
			});
		}
		animator(ticker.children(":first"));
		let j = 0

		ticker.mouseenter(function () {
			ticker.children().stop();
		});
		ticker.mouseleave(function () {
			if (j === 0)
				animator(ticker.children(":first"));
		});
	}

	if($(window).width()<=786){
		$("#announcement-btn").click(function (e) {
			e.preventDefault();
			$("#news_section").toggleClass('slided');
			$(this).toggleClass('hide');
			$("#close_btn").toggleClass('shw');
		})
		$("#nav-btn").click(function (e) {
			e.preventDefault();
			$("#side_menu").toggleClass('slided');
			$(this).toggleClass('hide');
			$("#close_btn").toggleClass('shw');
		})
		$("#close_btn").click(function (e) {
			e.preventDefault();
			$(".slided").removeClass('slided');
			$(".hide").removeClass('hide');
			$("#close_btn").toggleClass('shw');
		})
	}


	/* slick Nav */
// mobile_menu
	var menu = $('ul#navigation');
	if(menu.length){
		menu.slicknav({
			prependTo: ".mobile_menu",
			closedSymbol: '+',
			openedSymbol:'-',
			init:function(){
				console.log("clicked");
			}
		});
	}
	// setTimeout(function (){
	// 	if($(window).width<578){
	// 		$(".slicknav_row").click(function (e) {
	// 			console.log('clicked');
	// 			e.preventDefault();
	// 			$(".slicknav_parent").removeClass('slicknav_open').addClass('slicknav_collapsed');
	// 			$(this).removeClass('slicknav_collapsed').addClass('slicknav_open');
	//
	// 			$(".slicknav_parent>ul").attr("aria-hidden","false").addClass('slicknav_hidden').slideUp();
	// 			$(this).find('.submenu').attr("aria-hidden","true").removeClass('slicknav_hidden').slideDown();
	// 		})
	// 	}
	// },5000);



	/* MainSlider-1 */

	// $(".slider-area").vegas({
	// 	slides: [
	//
	// 		{ src: "assets/img/about/FP1.png" },
	//
	// 		{ src: "assets/img/about/FP2.png" },
	//
	// 		{ src: "assets/img/about/FP3.png" },
	//
	// 	],
	// 	// slide:2,
	// 	transition: ['fade'],
	// 	transitionDuration: 5000,
	// 	firstTransition: ['fade'],
	// 	firstTransitionDuration:3000,
	// 	timer: false,
	// });

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

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "500",
		"timeOut": "2000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}



	if($(window).width() <= 768){
		$(".dropdown-toggle").attr("data-toggle", "dropdown");
	}
	$(".copy-link").click(function() {
		// console.log('clicked');
		let text = $(this).parent().find('a').attr('href');
		let body = $('body');
		body.append('<span id="copyTextElement">'+ text +'</span>');
		let node = $("#copyTextElement")[0];

		if (document.body.createTextRange) {
			const range = document.body.createTextRange();
			range.moveToElementText(node);
			range.select();
		} else if (window.getSelection) {
			const selection = window.getSelection();
			const range = document.createRange();
			range.selectNodeContents(node);
			selection.removeAllRanges();
			selection.addRange(range);
		} else {
			console.warn("Could not select text in node: Unsupported browser.");
		}

		// let range = document.createRange();
		// let selection = window.getSelection();
		// range = document.createRange();
		// range.selectNodeContents(node);
		// selection.removeAllRanges();
		// selection.addRange(range);
		try {
			document.execCommand('copy');
		} catch(err) {
			alert("Automatic copying isn't currently supported by your browser. You can still highlight the desired values and copy them manually.")
		}
		window.getSelection().removeAllRanges();
		node.remove();

		toastr["success"]("", "Copied")

	});
})(jQuery);
