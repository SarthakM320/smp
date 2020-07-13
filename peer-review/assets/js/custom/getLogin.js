$(document).ready(function () {
	$.ajax({
		url: "../assets/utils/custom/getLogin.php",
		success: function(res){
			if(res==='logged_out'){
				window.location='index.html';
			}
		}}
	);
});