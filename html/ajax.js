var xmlhttp;

function createAJAX() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}
		
function edit() {
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET","php/update.php?title",true);
	xmlhttp.send(null);
}

function saveEdit()
{
	var option=encodeURIComponent(document.getElementById("option").value);
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("POST","php/update.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("option="+option);
}
		
function stateChanged() {
	if (xmlhttp.readyState==4 && xmlhttp.responseText != "") {
		document.getElementById("title").innerHTML=xmlhttp.responseText;
	}
}

function onEnter(evt){
	if(evt.keyCode==13) saveEdit();
}

$(document).ready(function() {
	$(".adminlogin").overlay({
		mask: {
			color: '#ebecff',
			loadSpeed: 200,
			opacity: 0.9
		},
		closeOnClick: false
	});
});