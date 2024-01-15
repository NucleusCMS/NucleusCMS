jQuery(function($) {
	$.datepicker.regional['ja'] = {
		closeText: '閉じる',
		prevText: '先月',
		nextText: '翌月',
		currentText: '今日',
		monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
		dayNamesShort: ['日','月','火','水','木','金','土'],
		dayNamesMin: ['日','月','火','水','木','金','土'],
		weekHeader: '週',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['ja']);
	$.datepicker.setDefaults({
	  beforeShowDay: function(day) { return beforeShowDay_ja_holiday(day); }
	  });
	  // https://api.jqueryui.com/datepicker/
});

function beforeShowDay_ja_holiday(date) {
	var weekday = date.getDay();
	var res = check_ja_holiday(date);
//	alert(date.toUTCString() + ' ' + date.getDate());
	var newClassName = "datepicker-"+$.datepicker.regional[""].dayNames[weekday].toLowerCase();
	if (res == false) {
		return [true, newClassName, ""];
	}
	if (-1 != res.indexOf('？')) {
		return [true, newClassName + " datepicker-holiday_undefined", res];
	}
	return [true, newClassName + " datepicker-holiday", res];
}

function check_ja_holiday(date) {
	return false;
}