function help(url) {
	popup = window.open(url,'helpwindow','status=no,toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500,top=0,left=0');
	if (popup.focus) popup.focus();
	if (popup.GetAttention) popup.GetAttention();
	return false;
}				

var oldCellColor = "#000";
function focusRow(row) {
	var cells = row.cells;
	if (!cells) return;
	oldCellColor = cells[0].style.backgroundColor;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor='whitesmoke';
	}
}
function blurRow(row) {
	var cells = row.cells;
	if (!cells) return;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor=oldCellColor;
	}
}
function batchSelectAll(what) {
	var i = 0;
	var el;
	while (el = document.getElementById('batch' + i)) {
		el.checked = what?'checked':'';
		i++;
	}
	return false;					
}

