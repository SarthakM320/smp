$(document).ready(function () {
	$.ajax({
		url: "../assets/utils/smpcs/getLogin.php",
		success: function(res){
			if(res==='logged_in'){
				window.location='home.php';
			}
		}}
	);
	function validate(){
		$('input').each(function () {
			$(this).removeClass('is-invalid');
			$(this).parent().find('.invalid-feedback').hide();
			if($(this).val().trim() === '') {
				$(this).addClass('is-invalid');
				$(this).parent().find('.invalid-feedback').show();
			}
		});
	}
	$('input').on('input',function () {
		$(this).removeClass('is-invalid');
		$(this).parent().find('.invalid-feedback').hide();
		$('.invalid-feedback.invalid').hide();
	})
	$("#submit").click(function () {
		let user=$("#user").val().trim(),
			pass=$("#pass").val().trim();
		validate();
		if(pass !== '' && user !== ''){
			$.ajax({
				url: "../assets/utils/smpcs/login.php",
				type:'POST',
				data:{
					user:user,
					pass:pass
				},
				success: function(res){
					if(res==='S'){
						window.location='home.php';
					}
					else{
						$('.invalid-feedback.invalid').show();
					}
				}}
			);
		}
	});
});