	function show_public_date_time_picker(section = '')
	{
		var postfix = (section == '' ? '' : '_public_term_' + section);
		var y = parseInt(document.getElementById('inputyear' + postfix).value, 10);
		var m = parseInt(document.getElementById('inputmonth' + postfix).value, 10);
		var d = parseInt(document.getElementById('inputday' + postfix).value, 10);
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

		if (section == '') {
			$( "#hidden_date_time_picker").datepicker( "dialog", date, callback_createAt, datepicker_option );
		} else if (section == 'start') {
			$( "#hidden_public_date_time_picker_"+section).datepicker( "dialog", date, callback_public_term_start, datepicker_option );
		} else {
			$( "#hidden_public_date_time_picker_"+section).datepicker( "dialog", date, callback_public_term_end, datepicker_option);
		}
	}
	function callback_inputdateFromDatePickerEx(date, datepicker, section = '')
	{
		var postfix = (section == '' ? '' : '_public_term_' + section);
		if (date === undefined || date === 0)
			{	return ; }
		var parts = date.split('-');
		$("#inputyear"+postfix).val(parts[0]);
		$("#inputmonth"+postfix).val(parts[1]);
		$("#inputday"+postfix).val(parts[2]);
		if (section == '') {
			// act_future , act_changedate
			var id = $('#act_future').length ? '#act_future' : '#act_changedate';
			$(id).prop('checked',true);
		} else {
			// public_enable_term_start, inputyear_public_term_end
			$("#public_enable_term_"+section).prop('checked',true);
		}
	}
	function callback_createAt(date, datepicker)
	{
		callback_inputdateFromDatePickerEx(date, datepicker, '');
	}
	function callback_public_term_start(date, datepicker)
	{
		callback_inputdateFromDatePickerEx(date, datepicker, 'start');
	}
	function callback_public_term_end(date, datepicker)
	{
		callback_inputdateFromDatePickerEx(date, datepicker, 'end');
	}