(function ($)
{ "use strict"
	if($(window).width() <= 786) {
		$(window).on('scroll', function () {
			var scroll = $(window).scrollTop();
			if (scroll < 400) {
				// $(".header-sticky").removeClass("sticky-bar");
				$("#announcement-btn").fadeOut(400);
				$("#nav-btn").fadeOut(600);
			} else if (scroll > ($(document).height() - $('footer').height() - $(window).height())) {
				$("#announcement-btn").fadeOut(400);
				$("#nav-btn").fadeOut(600);
			} else {
				// $(".header-sticky").addClass("sticky-bar");
				$("#announcement-btn").fadeIn(600);
				$("#nav-btn").fadeIn(400);
			}
		});
	}

	//side navigation
	$(".side-menu-content>ul>li>a").on("click",function (e){
		e.preventDefault();
		let target = $(this).attr('href');
		if($(window).width()<=786){
			$(".slided").removeClass('slided');
			$(".hide").removeClass('hide');
			$("#close_btn").toggleClass('shw');
			$('html, body').animate({
				scrollTop: $(target).offset().top - 56 // Means Less header height
			},10);
		}
		else{
			$('html, body').animate({
				scrollTop: $(target).offset().top - 91 // Means Less header height
			},10);
		}
	})

	if($(window).width() > 575){
		if($(".news-content>ul").height() > (0.55 * ($(window).height() - 76 - 15 - 20 - 20 - 20 - $(".news-header").height() - 60)) && $(window).width() >1453){
			$("#news_section").height(0.55 * ($(window).height() - 76 - 15 - 20 - 20 - 20));
			let ticker = $(".news-content>ul");
			ticker.children().filter("ul").each(function () {
				let dt = $(this),
					container = $("<div>");
				dt.next().appendTo(container);
				dt.prependTo(container);
				container.appendTo(ticker);
			});
			ticker.css("overflow", "hidden");

			function animator(currentItem) {

				let distance = currentItem.height();
				let duration = (distance + parseInt(currentItem.css("marginTop")) + parseInt(currentItem.css("paddingBottom"))) / 0.025;
				currentItem.animate({ marginTop: - distance - parseInt(currentItem.css("paddingBottom")) }, duration, "linear", function () {
					currentItem.appendTo(currentItem.parent()).css("marginTop", 0);
					animator(currentItem.parent().children(":first"));
				});
			}
			animator(ticker.children(":first"));
			let j = 0

			ticker.mouseenter(function () {
				ticker.children().stop();
			});
			ticker.mouseleave(function () {
				if (j === 0)
					animator(ticker.children(":first"));
			});
		}
		else if($(".news-content>ul").height() > (0.55 * ($(window).height() - 48.5 - 15 - 20 - 20 - 20 - $(".news-header").height() - 60))){
			$("#news_section").height(0.55 * ($(window).height() - 48.5 - 15 - 20 - 20 - 20));
			let ticker = $(".news-content>ul");
			ticker.children().filter("ul").each(function () {
				let dt = $(this),
					container = $("<div>");
				dt.next().appendTo(container);
				dt.prependTo(container);
				container.appendTo(ticker);
			});
			ticker.css("overflow", "hidden");

			function animator(currentItem) {

				let distance = currentItem.height();
				let duration = (distance + parseInt(currentItem.css("marginTop")) + parseInt(currentItem.css("paddingBottom"))) / 0.025;
				currentItem.animate({ marginTop: - distance - parseInt(currentItem.css("paddingBottom")) }, duration, "linear", function () {
					currentItem.appendTo(currentItem.parent()).css("marginTop", 0);
					animator(currentItem.parent().children(":first"));
				});
			}
			animator(ticker.children(":first"));
			let j = 0

			ticker.mouseenter(function () {
				ticker.children().stop();
			});
			ticker.mouseleave(function () {
				if (j === 0)
					animator(ticker.children(":first"));
			});
		}
	}

	if($(window).width()<=786){
		$("#announcement-btn").click(function (e) {
			e.preventDefault();
			$("#news_section").toggleClass('slided');
			$(this).toggleClass('hide');
			$("#close_btn").toggleClass('shw');
		})
		$("#nav-btn").click(function (e) {
			e.preventDefault();
			$("#side_menu").toggleClass('slided');
			$(this).toggleClass('hide');
			$("#close_btn").toggleClass('shw');
		})
		$("#close_btn").click(function (e) {
			e.preventDefault();
			$(".slided").removeClass('slided');
			$(".hide").removeClass('hide');
			$("#close_btn").toggleClass('shw');
		})
	}

})(jQuery);
