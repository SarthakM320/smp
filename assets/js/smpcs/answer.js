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

	// $.ajax({
	// 	url: "../../assets/utils/smpcs/getCategoriesData.php",
	// 	async:false,
	// 	success: function(res){
	// 		if(res==='F'){
	// 			console.log(res)
	// 			$.alert({
	// 				title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
	// 				content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
	// 			});
	// 		}
	// 		else{
	// 			res=JSON.parse(res);
	// 			let temp = ''
	// 			for(let i = 0 ; i < res.length ; i++){
	// 				temp+='<option '+res[i]['category']+'>';
	// 				temp+=res[i]['category'];
	// 				temp+='</option>';
	// 			}
	// 			$("#category").append(temp);
	// 		}
	// 	}}
	// );

	function init(){
		$.ajax({
			url: "../../assets/utils/smpcs/getQuery.php",
			type:'POST',
			data:{
				id:getUrlParameter('id')
			},
			success: function(res){
				let result_decoded = JSON.parse(res);
				let status = result_decoded['status'];

				if(status === 'F'){
					console.log(result_decoded['error']);
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons: {
							OK:function (){
								window.location='index.php';
							}
						}
					});
				}
				else{
					let result = result_decoded['result'];
					let name = result['name'];
					let email = result['email'];
					let phone = result['phone'];
					let query = result['query'];
					let category = result['category'];
					$("#name").val(name);
					$("#email").val(email);
					$("#phone").val(phone);
					$("#category").val(category);
					$("#query").val(query);
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

	$("#submit").click(function () {
		let answer=$("#answer").val().trim();
		validate();

		if(answer !== ''){
			$.ajax({
				url: "../../assets/utils/smpcs/answer.php",
				type:'POST',
				data:{
					answer:answer,
					name:$("#name").val(),
					email:$("#email").val(),
					query:$("#query").val(),
					id:getUrlParameter('id'),
				},
				success: function(res){
					let result_decoded = JSON.parse(res);
					let status = result_decoded['status'];

					if(status === 'S'){
						window.location='index.php';
					}
					else{
						console.log(result_decoded['error']);
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