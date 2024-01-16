
function checked_act_draft(enable, sender)
{
	var e = (enable ? true : false);
	var senderName = (!sender ? '' : sender.name);
	if (document.getElementById("state_draft")) {
		if (!e && senderName!='act_state' && $("#state_draft").prop('checked')) {
			if (sender && 'act_delete'==sender.id) {
				$("#state_unpublic").prop('checked', true);
			} else {
				$("#state_public").prop('checked', true);
			}
		}
		$("#state_draft").prop('checked', e);
	}
	var arr_draft = ["act_draft","act_backtodrafts"];
	var arr_save  = ["act_now","act_edit"];
	for(var i = 0; i < arr_draft.length; i++) {
		var draft = arr_draft[i];
		if ( document.getElementById(draft) ) {
			if (!e && senderName!='actiontype' && $("#"+draft).prop('checked')) {
				for(var j = 0; j < arr_draft.length; j++) {
					if ( document.getElementById(arr_save[j]) ) {
						$("#"+arr_save[j]).prop('checked', true);
					}
				}
			}
			$("#"+draft).prop('checked', e);
		}
	}
}