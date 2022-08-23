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

	$.ajax({
		url: "./assets/utils/smpcs/getFAQsData.php",
		success: function(res){
			if(res==='F'){
				$("#faqs_content").php('No FAQs to show...')
			}
			else{
				res = JSON.parse(res);
				let data={};
				for(let i = 0 ; i < res.length ; i++){
					let temp = '';
					temp += '<div class="faq">';
					let question = res[i]['question'];
					let answer = res[i]['answer'];
					question = question
						// .replaceAll('<br>','\n')
						.replaceAll('&nbsp;',' ')
						// .replaceAll('\"','"');
					answer = answer
						// .replaceAll('<br>','\n')
						.replaceAll('&nbsp;',' ')
						// .replaceAll('\"','"');
					temp += '<div class="faq-question">';
					temp += question;
					temp += ' <i class="fa fa-caret-right"></i>';
					temp += '</div>';
					temp += '<div class="faq-answer" style="display: none">';
					temp += answer;
					temp += '</div>';
					temp += '</div>';
					if(data[res[i]['category']] === undefined){
						data[res[i]['category']] = temp;
					}
					else{
						data[res[i]['category']] += temp;
					}
				}
				console.log(data);
				for (let key in data) {
					if (data.hasOwnProperty(key)) {
						let temp = '<div class="category">' +
							'<div class="category-header">' +
							key +' <i class="fa fa-caret-right"></i>' +
							'</div>' +
							'<div class="category-content" style="display:none">';
						temp += data[key];
						temp += '</div>';
						temp += '</div>';
						$("#faqs_content").append(temp);
					}
				}
				$(".faq-question").click(function (){
					$(this).toggleClass('active');
					$(this).parent().find('.faq-answer').slideToggle();
				});
				$(".category-header").click(function (){
					$(this).toggleClass('active');
					$(this).parent().find('.category-content').slideToggle();
					// $(this).find('.faq-answer').slideToggle();
				});
				// $("#question").val(question);
			}
		}}
	);

	/* sticky And Scroll UP */
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		// console.log(scroll);
		// console.log(($(document).height() - $('footer').height()));

		if (scroll < 400) {
			// $(".header-sticky").removeClass("sticky-bar");
			$('#back-top').fadeOut(500);
			// if($(window).width() <= 786){
			// 	$("#announcement-btn").fadeOut(400);
			// 	$("#nav-btn").fadeOut(600);
			// }
		}
		else if(scroll > ($(document).height() - $('footer').height() - $(window).height())){
			$('#back-top').fadeOut(500);
			// if($(window).width() <= 786){
			// 	$("#announcement-btn").fadeOut(400);
			// 	$("#nav-btn").fadeOut(600);
			// }
		}
		else {
			// $(".header-sticky").addClass("sticky-bar");
			$('#back-top').fadeIn(500);
			// if($(window).width() <= 786){
			// 	$("#announcement-btn").fadeIn(600);
			// 	$("#nav-btn").fadeIn(400);
			// }
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
