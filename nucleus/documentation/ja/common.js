/*
if (navigator.onLine) {
	document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" cache-control="max-age=15552000"><\/script>');
} else {
	var level = document.URL.replace(/\?.+$/,'').replace(/#.+$/,'').replace(/^.+documentation\//,'').match(/\//g).length + 1;
	document.write('<script src="' + '../'.repeat(level) + 'javascript/jquery/jquery.min.js" cache-control="max-age=15552000"><\/script>');
}
*/

document.addEventListener('DOMContentLoaded', function() {
	InitFontSizeChanger();
});

function InitFontSizeChanger() {
	var e = document.getElementById('fontSizeChanger');
	if (!e) {
		return;
	}
	if (typeof $ !== 'undefined') {
		$("#fontSizeChanger > a").click(function() {
			fontSizeChange($(this).attr('id'), this);
		});
	} else {
		var elements = document.querySelectorAll("#fontSizeChanger > a");
		for (var i = 0; i < elements.length; i++) {
			elements[i].addEventListener("click", function() {
				fontSizeChange(this.getAttribute('id'), this);
			});
		}
	}
}

function fontSizeChange(size, elem) {
	if (typeof $ !== 'undefined') {
		$("#body").css("font-size", size.substr(2));
		$("#fontSizeChanger > a").css("font-weight", "normal");
		$(elem).css("font-weight", "bold");
	} else {
		document.querySelector("#body").style.fontSize = size.substr(2);
		var elements = document.querySelectorAll("#fontSizeChanger > a");
		for (var i = 0; i < elements.length; i++) {
			elements[i].style.fontWeight = "normal";
		}
		elem.style.fontWeight = "bold";
	}
}
