$(document).ready(function(){
	$(".open").click(function(){
		$(".menu").css("bottom","0");
		$(".col").css("bottom","0");
		$(".menu_list li").fadeIn();
	});
	$(".Close").click(function(){
		$(".menu").css("bottom","80vh");
		$(".menu_list li").fadeOut();
	});
	$(".feedback_close").click(function(){
		$(".feedback").css("display","none");
	});
	$(".read_more").click(function(){
		$(".read_more_modal").css("left","50%");
	});
	$(".read_more_modal_close").click(function(){
		$(".read_more_modal").css("left","-100vw");
	});
});