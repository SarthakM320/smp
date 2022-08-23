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
// 					.php(((status === '0')?('Deactivate'):('Activate')))
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
		$("#output").php($("#input").val()
			.replaceAll('\n','<br>')
			.replaceAll('<ul><br>','<ul>')
			.replaceAll('<br></ul>','</ul>')
			.replaceAll('<ol><br>','<ol>')
			.replaceAll('<br></ol>','</ol>')
			.replaceAll('<br><li>','<li>')
			.replaceAll('</li><br>','</li>')
			.replaceAll(' ','&nbsp;')
			.replaceAll('<a&nbsp;','<a ')
			.replaceAll('&nbsp;>',' >')
			.replaceAll('<&nbsp;/','</')
			.replaceAll('</&nbsp;','</'));
	})

	$.ajax({
		url: "../../assets/utils/smpcs/getCategoriesData.php",
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

	$(".editor-btn").click(function () {
		let type = $(this).attr('data-type');
		if(type === 'bold'){
			$("#input").val('<b>bold text</b>');
		}
		else if(type === 'italic'){
			$("#input").val('<i>italic text</i>');
		}
		else if(type === 'underline'){
			$("#input").val('<u>underlined text</u>');
		}
		else if(type === 'link'){
			$("#input").val('<a href="https://www.google.com">link to google</a>');
		}
		else if(type === 'header'){
			$("#input").val('<h4>heading</h4>');
		}
		else if(type === 'ul'){
			$("#input").val('<ul><li>item 1</li><li>item 2</li></ul>');
		}
		else{
			$("#input").val('<ol><li>item 1</li><li>item 2</li></ol>');
		}
		$("#output").php($("#input").val().replaceAll('\n','<br>').replaceAll(' ','&nbsp;').replaceAll('<a&nbsp;','<a ').replaceAll('&nbsp;>',' >').replaceAll('<&nbsp;/','</').replaceAll('</&nbsp;','</'));
	})
	$("#submit").click(function () {
		let question=$("#question").val().trim(),
			category=$("#category").val().trim(),
			answer=$("#answer").val().trim();
		validate();
		question = question
			.replaceAll('\n','<br>')
			.replaceAll('"','\"')
			.replaceAll('\n','<br>')
			.replaceAll('<ul><br>','<ul>')
			.replaceAll('<br></ul>','</ul>')
			.replaceAll('<ol><br>','<ol>')
			.replaceAll('<br></ol>','</ol>')
			.replaceAll('<br><li>','<li>')
			.replaceAll('</li><br>','</li>')
			.replaceAll(' ','&nbsp;')
			.replaceAll('<a&nbsp;','<a ')
			.replaceAll('&nbsp;>',' >')
			.replaceAll('<&nbsp;/','</')
			.replaceAll('</&nbsp;','</');

		answer = answer
			.replaceAll('\n','<br>')
			.replaceAll('"','\"')
			.replaceAll('\n','<br>')
			.replaceAll('<ul><br>','<ul>')
			.replaceAll('<br></ul>','</ul>')
			.replaceAll('<ol><br>','<ol>')
			.replaceAll('<br></ol>','</ol>')
			.replaceAll('<br><li>','<li>')
			.replaceAll('</li><br>','</li>')
			.replaceAll(' ','&nbsp;')
			.replaceAll('<a&nbsp;','<a ')
			.replaceAll('&nbsp;>',' >')
			.replaceAll('<&nbsp;/','</')
			.replaceAll('</&nbsp;','</');
		// console.log(question);
		// console.log(answer);
		if(answer !== '' && question !== '' && category !== ''){
			$.ajax({
				url: "../../assets/utils/smpcs/addFAQ.php",
				type:'POST',
				data:{
					question:question,
					answer:answer,
					category:category
				},
				success: function(res){
					if(res==='S'){
						window.location='index.php';
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