$(document).ready(function () {
	$.ajax({
		url: "../../assets/utils/smpcs/getLogin.php",
		success: function(res){
			if(res==='logged_out'){
				window.location='../index.php';
			}
		}}
	);
});