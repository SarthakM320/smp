$(document).ready(function () {
	$("#logout").click(function () {
		$.ajax({
			url: "../../assets/utils/smpcs/logout.php",
			success: function(){
				window.location='../index.php';
			}}
		);
	})
});