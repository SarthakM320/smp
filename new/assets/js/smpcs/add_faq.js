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
				url: "../../assets/utils/smpcs/addFAQ.php",
				type:'POST',
				data:{
					question:question,
					answer:answer
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