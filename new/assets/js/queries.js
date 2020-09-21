function read_more(element) {
	let el = $(element);
	$(element).remove();
	let target_id = el.attr('data-id');
	let active = el.attr('data-active');
	if(active === 'true'){
		el.attr('data-active','false');
		el.html('Read More');
		$(target_id).slideUp(500);
		$(target_id).after(el);

	}
	else{
		el.attr('data-active','true');
		el.html('Read Less');
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
		// setTimeout(function () {
		$('#preloader-active').delay(1450).fadeOut('slow');
		$('.preloader').delay(450).addClass('fadePreloaderOut');
		$('body').delay(450).css({
			'overflow': 'visible'
		});
		jQuery.getScript('https://www.google.com/recaptcha/api.js');
	});
	// },2000);


	$('.form-input').on('input',function () {
		$(this).removeClass('is-invalid');
		$(this).parent().find('.invalid-feedback').hide();
		$('.invalid-feedback.invalid').hide();
		$("#error-message").hide();
	})

	$.ajax({
		url: "./assets/utils/smpcs/getCategoriesData.php",
		async:false,
		success: function(res){
			if(res==='F'){
				console.log(res)
				$.alert({
					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
				});
			}
			else{
				res=JSON.parse(res);
				let temp = ''
				for(let i = 0 ; i < res.length ; i++){
					temp+='<option '+res[i]['category']+'>';
					temp+=res[i]['category'];
					temp+='</option>';
				}
				$("#category").append(temp);
			}
		}}
	);

	$("#submit").click(function (e) {
		e.preventDefault();
		let name=$("#name"),
			email=$("#email"),
			phone=$("#phone"),
			category=$("#category"),
			query=$("#query");

		if(name.val().trim().length <= 2){
			name.addClass('is-invalid');
			name.parent().find('.invalid-feedback').show();
			return;
		}

		let emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
		if(!emailExp.test(email.val().trim().toLowerCase())){
			email.addClass('is-invalid');
			email.parent().find('.invalid-feedback').show();
			return;
		}

		if(isNaN(parseInt(phone.val().trim())) || phone.val().trim().length !== 10){
			phone.addClass('is-invalid');
			phone.parent().find('.invalid-feedback').show();
			return;
		}

		if(category.val() === ''){
			category.addClass('is-invalid');
			category.parent().find('.invalid-feedback').show();
			return;
		}

		if(query.val().trim() <= 5){
			query.addClass('is-invalid');
			query.parent().find('.invalid-feedback').show();
			return;
		}

		$(this).html('Processing...<i style="font-size: 1.25em" class="fa fa-spinner fa-spin"></i>').addClass('disabled');

		$(".form-input").addClass('disabled').attr('disabled',true);

		let grecaptcha_response = grecaptcha.getResponse().trim();

		if(grecaptcha_response.length<=0){
			$(this).html('Submit').removeClass('disabled');
			$("#error-message").html('Please complete the reCAPTCHA to proceed.').show();
			$(".form-input").removeClass('disabled').attr('disabled',false);
			return;
		}

		$.ajax({
			url: "./assets/utils/submitQuery.php",
			type: 'POST',
			data:{
				name:name.val().trim(),
				email:email.val().trim(),
				phone:phone.val().trim(),
				query:query.val().trim(),
				category:category.val(),
				grecaptcha_response:grecaptcha_response
			},
			success: function(res){
				console.log(res);
				$("#error-message").hide(10);
				if(res==='bot_detected'){
					$("#error-message").html('Unusual activity detected! Please reload the page and try again.').show();
					$("#submit").html('Try Again').removeClass('disabled').click(function (e) {
						e.preventDefault();
						window.location.reload();
					});
				}
				else if (res === 'S'){
					$("#submit").html('Query Submitted').addClass('form-success');
					$("#error-message").html('Your query has been submitted successfully!').removeClass('text-danger').addClass('text-success').show();
				}
				else{
					$("#error-message").html('Sorry... There has been a technical problem.').show();
					$(".form-input").removeClass('disabled').attr('disabled',false);
					$("#submit").html('Submit again').removeClass('disabled');
				}
			}
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
