// ID of peer for which user wants to give review
let current_id = null;

function give_review(id, name) {
	$('#finish_bar').removeClass('d-flex').slideUp(10);
	$('#other_peers').removeClass('d-flex').slideUp(10);
	$("#form").fadeIn();
	current_id = id;
	$(".peer_name").html(name);
}

$(document).ready(function () {
	let q_array=['q_1','q_3','q_4','q_5','q_6','q_7','q_8'];
	q_array.forEach(function (item,index) {
		$("input[name="+ item +"]").click(function (e) {
			let ini = $(this).is(':checked');
			$("input[name="+ item +"]").prop('checked',false);
			if(!ini) $(this).prop('checked',false);
			else $(this).prop('checked',true);
		});
	});

	$.ajax({
		url: "./../assets/utils/peer-review/getStatus.php",
		success: function(res){
			if(res==='F'){
				window.location='index.html';
			}
			else{
				res=JSON.parse(res);
				console.log(res);
				$("#name").html(res.name);

				let last_done = parseInt(res.last_done);
				console.log(last_done);
				// If all compulsory peer reviews done, then allow giving other peer reviews
				if(last_done === 1){
					$('#question').removeClass('d-flex').hide();
					$('#finish_bar').addClass('d-flex');
					$('#other_peers').addClass('d-flex');

					$('#dataTable').DataTable({
						"processing": true,
						"responsive": true,
						"language": {
							"emptyTable": function(){
								return "No peers present";
							}
						},
						"pageLength": 50,
						"select": true,
						"dom": ' <"search"fl><"top">rt<"bottom"ip><"clear">',
						"ajax": {
							"url": './../assets/utils/peer-review/getPeerData.php',
							dataSrc: '',
						},
						"columns": [
							{ "data": "id", className: "dt-body-center" },
							{ "data": "name", className: "dt-body-center" },
							{
								data: {"id" : "id", "name" : "name"},
								render : function(data) {
									return (`<button onclick="give_review(${data.id},'${data.name}')" class="btn btn-sm btn-primary mx-1" title="Give review"><i class="fa fa-pencil"></i></button>`);
								},
								className: "dt-body-center"
							}
						],
						"columnDefs": [
							{ className: "text-center", "targets": [0] },
							{ className: "text-center", "targets": [1] },
							{ className: "text-center", "targets": [2] },
						],
					});
				}
				// Else show details of compulsory peer reviewcompulsory
				else{
					$(".peer_name").html(res.peer_name);
					$(".peer_dept").html(res.peer_dept);
					$(".peer_hostel").html(res.peer_hostel);
				}

				// Updating the progress bar 1
				let given = parseInt(res.given);
				let total = parseInt(res.total_peers);
				let percent = given / total * 100;

				let progress_bar = $('#completion1');
				progress_bar.css('width', percent+'%').attr('aria-valuenow', percent);

				let width = $('.progress').width();
				let progress_width = width * percent / 100;
				// Show count only if sufficient width of progress
				if(progress_width > 55)
					progress_bar.html(`${given} / ${total}`);
				else
					progress_bar.html('');	

				// Updating the progress bar 2
				given = parseInt(res.others_given);
				total = parseInt(res.total_other_peers);
				percent = given / total * 100;

				progress_bar = $('#completion2');
				progress_bar.css('width', percent+'%').attr('aria-valuenow', percent);

				width = $('.progress').width();
				progress_width = width * percent / 100;
				// Show count only if sufficient width of progress
				if(progress_width > 55)
					progress_bar.html(`${given} / ${total}`);
				else
					progress_bar.html('');	
			}
		}}
	);
	
	$("#yes").click(function () {
		$("#question").removeClass('d-flex').slideUp(10);
		$("#form").fadeIn();
	});

	$("#skip").click(function () {
		$.ajax({
			url: "./../assets/utils/peer-review/skip.php",
			success: function(res){
				if(res==='F'){
					window.location='index.html';
				}
				else{
					window.location.reload();
				}
			}}
		);

		
/*
		else{
			$.ajax({
				url: "./../assets/utils/peer-review/submit.php",
				type:'POST',
				data: {
					'data':[1]
				},
				success: function(res){
					console.log(res);
					if(res==='F'){
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem. Please try again.</div>',
							buttons:{
								OK: function () {
									window.location='index.html';
								}
							}
						});
					}
					else{
						$.alert({
							title: '<h3 class="text-success text-monospace mb-1 mt-2">Thank You</h3>',
							content: '<div class="fontOpenSansRegular">Form has been submitted successfully</div>',
							buttons:{
								OK: function () {
									window.location='index.html';
								}
							}
						});
					}
				}}
			);
		}*/
	});

	$("#submit").click(function () {
		let q1=$("input[name='q_1']:checked").val(),
			q2=$("#q_2").val().trim(),
			q3=$("input[name='q_3']:checked").val(),
			q4=$("input[name='q_4']:checked").val(),
			q5=$("input[name='q_5']:checked").val(),
			q6=$("input[name='q_6']:checked").val(),
			q7=$("input[name='q_7']:checked").val(),
			q8=$("input[name='q_8']:checked").val(),
			q9=$("#q_9").val().trim();
		if(q1 === undefined && q2 === '' && q3 === undefined && q4 === undefined && q5 === undefined && q6 === undefined && q7 === undefined && q8 === undefined && q9 === ''){
			$.alert({
				title: '<h3 class="text-danger text-monospace mb-1 mt-2">Alert</h3>',
				content: '<div class="fontOpenSansRegular">Please fill at least one of the questions.</div>'});
		}
		else{
			q1=((q1 === 'undefined' || q1 === undefined)?('NA'):(q1));
			q2=((q2 === '')?('NA'):(q2));
			q3=((q3 === 'undefined' || q3 === undefined)?('NA'):(q3));
			q4=((q4 === 'undefined' || q4 === undefined)?('NA'):(q4));
			q5=((q5 === 'undefined' || q5 === undefined)?('NA'):(q5));
			q6=((q6 === 'undefined' || q6 === undefined)?('NA'):(q6));
			q7=((q7 === 'undefined' || q7 === undefined)?('NA'):(q7));
			q8=((q8 === 'undefined' || q8 === undefined)?('NA'):(q8));
			q9=((q9 === '')?('NA'):(q9));

			let data=[];
			data.push(q1);
			data.push(q2);
			data.push(q3);
			data.push(q4);
			data.push(q5);
			data.push(q6);
			data.push(q7);
			data.push(q8);
			data.push(q9);

			$.ajax({
				url: "./../assets/utils/peer-review/update.php",
				type:'POST',
				data: {
					'id': current_id,
					'data' : data
				},
				success: function(res){
					if(res==='F'){
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem. Please try again.</div>',
							buttons:{
								OK: function () {
									window.location='index.html';
								}
							}
						});
					}
					else{
						window.location.reload();
					}
				}}
			);
		}
	});

	$('#finish').click(function() {
		$.ajax({
			url: "./../assets/utils/peer-review/finish.php",
			success: function(res){
				if(res === 'F'){
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem. Please try again.</div>',
						buttons:{
							OK: function () {
								window.location='index.html';
							}
						}
					});
				}
				
				else{
					window.location.reload();
				}
			}}
		);
	});
});