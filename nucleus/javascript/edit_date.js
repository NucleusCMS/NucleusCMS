
function edit_form_change_date_ByValue( list )
{
    var id_lists = new Array("inputyear", "inputmonth", "inputday",
                             "inputhour", "inputminutes");
    var i,e,v;
	for(i =0; i<=id_lists.length-1; i++)
    {
	   e = document.getElementById( id_lists[i] );
       if ((e != null) && (e != undefined))
	     {
            v = (i > list.length-1) ? "" : list[i];
            e.value = (v != null) ? v : "";
         }
    }
    // Update datetime-local inputs if present
    edit_form_update_datetime_local_inputs(list);
}

function edit_form_update_datetime_local_inputs(list)
{
    var datetime_inputs = ["input_datetime_currenttime", "input_datetime_itemtime"];
    for (var i = 0; i < datetime_inputs.length; i++) {
        var e = document.getElementById(datetime_inputs[i]);
        if (e != null && e != undefined && list.length >= 5) {
            var year = list[0];
            var month = String(list[1]).padStart(2, '0');
            var day = String(list[2]).padStart(2, '0');
            var hour = String(list[3]).padStart(2, '0');
            var minute = String(list[4]).padStart(2, '0');
            e.value = year + '-' + month + '-' + day + 'T' + hour + ':' + minute;
        }
    }
}

function edit_form_change_date_now()
{
    var e_now = new Date;
    edit_form_change_date_ByValue( new Array( e_now.getFullYear(),
         e_now.getMonth()+1, e_now.getDate(),
         e_now.getHours(), e_now.getMinutes() ) );
}