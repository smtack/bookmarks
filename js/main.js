$(document).ready(function() {
	$(".sidebartoggle").click(function() {
		$(".sidebar").toggle();
		$(".sidebartoggle").toggleClass("moveLeft");
		$(".content").toggleClass("fill100");
	});
});
