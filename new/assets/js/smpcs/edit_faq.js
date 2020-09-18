// function update(id,status){
// 	$.ajax({
// 		url: '../../assets/utils/smpcs/updateStatus.php',
// 		type: 'POST',
// 		// async:false,
// 		data: {
// 			id:id,
// 			active:status
// 		},
// 		success: function (res) {
// 			console.log(res);
// 			if (res === 'S'){
// 				$("#"+id).find('button')
// 					.html(((status === '0')?('Deactivate'):('Activate')))
// 					.removeClass((status === '0')?'btn-outline-success':'btn-outline-danger')
// 					.addClass((status === '1')?'btn-outline-success':'btn-outline-danger')
// 					.attr('onclick','update(\'' + id + '\',\'' + ((status === '0')?('1'):('0')) + '\')');
// 			}
// 			else{
// 				$.alert({
// 					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
// 					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
// 				});
// 			}
// 		}
// 	});
// }

$(document).ready(function () {

	var getUrlParameter = function getUrlParameter (sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};

	function init(){
		$.ajax({
			url: "../../assets/utils/smpcs/getFAQ.php",
			type:'POST',
			data:{
				id:getUrlParameter('id')
			},
			success: function(res){
				if(res==='F'){
					console.log(res)
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons: {
							OK:function (){
								window.location='index.html';
							}
						}
					});
				}
				else{
					res = JSON.parse(res);
					let question = res['question'];
					let answer = res['answer'];
					question = question.replaceAll('<br>','\n').replaceAll('&nbsp;',' ').replaceAll('\"','"');
					answer = answer.replaceAll('<br>','\n').replaceAll('&nbsp;',' ').replaceAll('\"','"');
					$("#answer").val(answer);
					$("#question").val(question);
				}
			}}
		);
	}
	init();

	function validate(){
		$('.faq-input').each(function () {
			$(this).removeClass('is-invalid');
			$(this).parent().parent().parent().find('.invalid-feedback').hide();
			if($(this).val().trim() === '') {
				$(this).addClass('is-invalid');
				$(this).parent().parent().parent().find('.invalid-feedback').show();
			}
		});
	}

	$('.faq-input').on('input',function () {
		$(this).removeClass('is-invalid');
		$(this).parent().parent().parent().find('.invalid-feedback').hide();
	})
	$('#input').on('input',function () {
		$("#output").html($("#input").val().replaceAll('\n','<br>').replaceAll(' ','&nbsp;'));
	})

	$(".editor-btn").click(function () {
		let type = $(this).attr('data-type');
		if(type === 'bold'){
			$("#input").val('<b></b>');
		}
		else if(type === 'italic'){
			$("#input").val('<i></i>');
		}
		else if(type === 'underline'){
			$("#input").val('<u></u>');
		}
		else if(type === 'link'){
			$("#input").val('<a href="https://"></a>');
		}
		else{
			$("#input").val('<h4></h4>');
		}
	})
	$("#submit").click(function () {
		let question=$("#question").val().trim(),
			answer=$("#answer").val().trim();
		validate();
		question = question.replaceAll('\n','<br>').replaceAll(' ','&nbsp;').replaceAll('"','\"');
		answer = answer.replaceAll('\n','<br>').replaceAll(' ','&nbsp;').replaceAll('"','\"');
		// console.log(question);
		// console.log(answer);
		if(answer !== '' && question !== ''){
			$.ajax({
				url: "../../assets/utils/smpcs/updateFAQ.php",
				type:'POST',
				data:{
					question:question,
					answer:answer,
					id:getUrlParameter('id')
				},
				success: function(res){
					if(res==='S'){
						window.location='index.html';
					}
					else{
						console.log(res)
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
						});
					}
				}}
			);
		}
	});



});