
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
}

function edit_form_change_date_now()
{
    var e_now = new Date;
    edit_form_change_date_ByValue( new Array( e_now.getFullYear(),
         e_now.getMonth()+1, e_now.getDate(),
         e_now.getHours(), e_now.getMinutes() ) );
}