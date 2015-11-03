$(function(){
	$("#fontSizeChanger > a").click(function() {
		fontSizeChange($(this).attr('id'), this);
	});
});

function fontSizeChange(size, elem) {
	$("#body").css("font-size", size.substr(2));
	$("#fontSizeChanger > a").css("font-weight", "normal");
	$(elem).css("font-weight", "bold");
}
