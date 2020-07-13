$(document).ready(function () {
	$("#logout").click(function () {
		$.ajax({
			url: "../assets/utils/custom/logout.php",
			success: function(){
				window.location='index.html';
			}}
		);
	})
});