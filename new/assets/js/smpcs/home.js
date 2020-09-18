$(document).ready(function () {
	$.ajax({
		url: "../assets/utils/smpcs/getLogin.php",
		success: function(res){
			if(res!=='logged_in'){
				window.location='index.html';
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