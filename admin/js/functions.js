// JavaScript Document
function closeDiv(eid){
	var element = document.getElementById(eid);
	
	element.style.display = 'none';
	element.style.visibility = 'hidden';
}

function showHide(eid){
	var element = document.getElementById(eid);
	
	if (element.style.display == 'none'){
		element.style.display = 'inherit';
		element.style.visibility = 'visible';
	}
	else{
		element.style.display = 'none';
		element.style.visibility = 'hidden';
	}
}

function popup(url)
{
	newwindow=window.open(url,"","width=340,height=350,left=100,top=100,dependent=yes,resizable=no,scrollbars=yes,menubar=no,status=no,directories=no,location=no,toolbar=no");
	if (window.focus) {newwindow.focus()}
	return false;
}
