$(document).ready(function () {
	$("#submit").click(function () {
		let code=$("#code").val().trim();
		if(code === '' || code.length !== 6 || isNaN(code)	) {
			$.alert({
				title: '<h3 class="text-danger mb-1 mt-2">Error</h3>',
				content: '<div class="">Please enter a valid code!</div>',
			});
		}
		else{
			$.ajax({
				url: "./assets/utils/checkCode.php",
				type:'POST',
				data:{
					code:code
				},
				success: function(res){
					console.log(res);
					if(res==='S'){
						window.location='review.html';
					}
					else{
						$.alert({
							title: '<h3 class="text-danger mb-1 mt-2">Error</h3>',
							content: '<div class="">The code entered by you is not valid. Please enter a valid code!</div>',
						});
					}
				}}
			);
		}
	});
});