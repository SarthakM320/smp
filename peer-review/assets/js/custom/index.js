$(document).ready(function () {
	$.ajax({
		url: "../assets/utils/custom/getLogin.php",
		success: function(res){
			if(res==='logged_in'){
				window.location='index.html';
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
				url: "../assets/utils/custom/login.php",
				type:'POST',
				data:{
					user:user,
					pass:pass
				},
				success: function(res){
					if(res==='S'){
						window.location='admin.html';
					}
					else{
						$('.invalid-feedback.invalid').show();
					}
				}}
			);
		}
	});
});