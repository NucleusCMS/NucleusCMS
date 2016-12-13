	function show_public_date_time_picker(section)
	{
		var name = 'public_term_' + section;
		var y = parseInt(document.getElementById('inputyear_' + name).value, 10);
		var m = parseInt(document.getElementById('inputmonth_' + name).value, 10);
		var d = parseInt(document.getElementById('inputday_' + name).value, 10);
		var date;
		if (isNaN(y) || isNaN(m) || isNaN(d)) {
			/* fix invalid datetime:  20xx/11/31, 20xx/2/31 */
			date = new Date();
		} else {
			date = ("0000"+y).slice(-4) + '-' + ("0"+m).slice(-2) + '-' + ("0"+d).slice(-2);
		}
		if (y) {
			/* fix invalid datetime */
			var t = new Date(y, Math.max(0,m-1), d); /* month: 0 ～ 11 */
			y = t.getFullYear();
			m = t.getMonth() + 1; /* month: 0 ～ 11 */
			d = t.getDate();
			date = ("0000"+y).slice(-4) + '-' + ("0"+m).slice(-2) + '-' + ("0"+d).slice(-2);
		}
		var datepicker_option = {
				showOn: "focus",
				showButtonPanel: true,
				dateFormat: "yy-mm-dd",
				regional:'ja'
		};

		$( ".hidden_public_date_time_picker").datepicker( datepicker_option );
		if (section == 'start') {
			$( "#hidden_public_date_time_picker_"+section).datepicker( "dialog", date, callback_public_term_start, datepicker_option );
		} else {
			$( "#hidden_public_date_time_picker_"+section).datepicker( "dialog", date, callback_public_term_end, datepicker_option);
		}
	}
	function callback_public_term_start(date, datepicker)
	{
		if (date === undefined || date === 0)
			{	return ; }
		var parts = date.split('-');
		$("#inputyear_public_term_start").val(parts[0]);
		$("#inputmonth_public_term_start").val(parts[1]);
		$("#inputday_public_term_start").val(parts[2]);
		$("#public_enable_term_start").prop('checked',true);
	}
	function callback_public_term_end(date, datepicker)
	{
		if (date === undefined || date === 0)
			{	return ; }
		var parts = date.split('-');
		$("#inputyear_public_term_end").val(parts[0]);
		$("#inputmonth_public_term_end").val(parts[1]);
		$("#inputday_public_term_end").val(parts[2]);
		$("#public_enable_term_end").prop('checked',true);
	}