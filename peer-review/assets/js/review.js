let given=0;
let last=0;
$(document).ready(function () {
	let name='';
	$.ajax({
		url: "./assets/utils/getStatus.php",
		async:false,
		success: function(res){
			if(res==='F'){
				window.location='index.html';
			}
			else{
				res=JSON.parse(res);
				console.log(res);
				last=res.last;
				$("#name").html(res.name);
				$(".name2").html(res.peer_name);
			}
		}}
	);
	$("#yes").click(function () {
		$("#question").removeClass('d-flex').slideUp(10);
		$("#form").fadeIn();
		given=1;
	});
	$("#skip").click(function () {
		if(last === 0){
			$.ajax({
				url: "./assets/utils/skip.php",
				success: function(res){
					if(res==='F'){
						window.location='index.html';
					}
					else{
						window.location.reload();
					}
				}}
			);
		}
		else{
			$.ajax({
				url: "./assets/utils/submit.php",
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
		}
	});
	$("#submit").click(function () {
		let q1=$("input[name='q_1']:checked").val(),
			q2=$("#q_2").val().trim(),
			q3=$("input[name='q_3']:checked").val(),
			q4=$("input[name='q_4']:checked").val(),
			q5=$("input[name='q_5']:checked").val(),
			q6=$("input[name='q_6']:checked").val(),
			q7=$("input[name='q_7']:checked").val(),
			q8=$("#q_8").val().trim();
		if(q1 === undefined || q2 === '' || q3 === undefined || q4 === undefined || q5 === undefined || q6 === undefined || q7 === undefined || q8 === ''){
			$.alert({
				title: '<h3 class="text-danger text-monospace mb-1 mt-2">Alert</h3>',
				content: '<div class="fontOpenSansRegular">Please fill all the details.</div>'});
		}
		else{
			let url='';
			if(last === 0) {
				url="./assets/utils/update.php";
			}
			else{
				url="./assets/utils/submit.php";
			}
			let data=[];
			data.push(q1);
			data.push(q2);
			data.push(q3);
			data.push(q4);
			data.push(q5);
			data.push(q6);
			data.push(q7);
			data.push(q8);
			$.ajax({
				url: url,
				type:'POST',
				data: {
					'data':data
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
						$.alert({
							title: '<h3 class="text-success text-monospace mb-1 mt-2">Thank You</h3>',
							content: '<div class="fontOpenSansRegular">Form has been submitted successfully</div>',
							buttons:{
								OK: function () {
									window.location.reload();
								}
							}
						});
					}
				}}
			);
		}
	});
});