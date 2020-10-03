$(document).ready(function () {
	$.ajax({
		url: "../assets/utils/smpcs/getLogin.php",
		success: function(res){
			if(res!=='logged_in'){
				window.location='index.html';
			}
			else{
				$.ajax({
					url: "../assets/utils/smpcs/getRoles.php",
					success: function(res){
						if(res==='F'){
							window.location='index.html';
						}
						else{
							console.log(res);
							res = JSON.parse(res);
							for (let i = 0 ; i < res.length ; i++){
								let role = res[i];
								$("#roles").append('<button class="btn btn-primary mx-1" onclick="window.location.href=\'' + role['link'] + '\'">' + role['title'] + '</button>');
							}
						}
					}}
				);
			}
		}}
	);
	$("#logout").click(function () {
		$.ajax({
			url: "../assets/utils/smpcs/logout.php",
			success: function(){
				window.location='index.html';
			}}
		);
	})
});