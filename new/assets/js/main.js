function read_more(element) {
	let el = $(element);
	let parent = $(element).parent();
	$(el).html(($(el).html()==='Read More')?('Read Less'):('Read More'));
	$(el).remove();
	parent.parent().find('.read-more-content').slideToggle();
	parent.append(el);
	// let target_id = el.attr('data-id');
	// let active = el.attr('data-active');
	// if(active === 'true'){
	// 	el.attr('data-active','false');
	// 	el.html('Read More');
	// 	$(target_id).slideUp(500);
	// 	$(target_id).after(el);
	//
	// }
	// else{
	// 	el.attr('data-active','true');
	// 	el.html('Read Less');
	// 	$(target_id).slideDown();
	// 	$(target_id).after(el);
	// 	// setTimeout(function (){
	// 	// 	$(window).scrollTop($(window).scrollTop() + $(target_id).height());
	// 	// },100)
	// }
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

		if (scroll < 400) {
			// $(".header-sticky").removeClass("sticky-bar");
			$('#back-top').fadeOut(500);
		}
		else if(scroll > ($(document).height() - $('footer').height() - $(window).height())){
			$('#back-top').fadeOut(500);
		}
		else {
			$('#back-top').fadeIn(500);
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


// mobile_menu
	var menu = $('ul#navigation');
	if(menu.length){
		menu.slicknav({
			prependTo: ".mobile_menu",
			allowParentLinks: true,
			closedSymbol: '+',
			openedSymbol:'-',
			init:function(){
				console.log("clicked");
			}
		});
	}

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
