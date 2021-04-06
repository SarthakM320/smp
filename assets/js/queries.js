(function ($)
{ "use strict"
	$(window).on('load', function () {
		jQuery.getScript('https://www.google.com/recaptcha/api.js');
	});
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

})(jQuery);
