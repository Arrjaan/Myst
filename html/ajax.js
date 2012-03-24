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
		
function edit(event,id) {
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET","php/update.php?event="+event+"&id="+id,true);
	xmlhttp.send(null);
}

function saveEdit(event,id)
{
	var option=encodeURIComponent(document.getElementById("option").value);
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("POST","php/update.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("event="+event+"&id="+id+"&value="+option);
}

function doLogin()
{
	var username=encodeURIComponent(document.getElementById("username").value);
	var password=encodeURIComponent(document.getElementById("password").value);
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=loggedin;
	xmlhttp.open("POST","admin/index.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("send=receive&log_on=Doorgaan&user="+username+"&pass="+password);
}
		
function stateChanged() {
	if (xmlhttp.readyState==4 && xmlhttp.responseText != "") {
		document.getElementById("title").innerHTML=xmlhttp.responseText;
	}
}

function loggedin() {
	if (xmlhttp.readyState==4 && xmlhttp.responseText != "") {
		document.getElementById("loginmsg").innerHTML=xmlhttp.responseText;
	}
}

function onEnter(evt,event,id){
	if(evt.keyCode==13) saveEdit(event,id);
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
	$("#prompt form").submit(function(e) {
		doLogin();
		return e.preventDefault();
	});
});