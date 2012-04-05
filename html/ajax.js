var xmlhttp;
var updateEvent

function createAJAX() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}

function add() {
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET","php/update.php?event=add",true);
	xmlhttp.send(null);
	updateEvent = "add";
}
		
function edit(event,id) {
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET","php/update.php?event="+event+"&id="+id,true);
	xmlhttp.send(null);
	updateEvent = event;
}

function del(id) {
	xmlhttp=createAJAX();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET","php/update.php?event=del&id="+id,true);
	xmlhttp.send(null);
	updateEvent = "del";
}

function saveEdit(event,id)
{
	var realEvent = "input_"+event;
	if (realEvent == "input_content") {
		realEvent = "input_innerContent";
	}
	var option=encodeURIComponent(document.getElementById(realEvent).value);
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
		var regex = /\?p\=/;
		if (updateEvent == "content") {
			updateEvent = "innerContent";
		}
		if (updateEvent == "del") {
			window.location = "?p=index";
		}
		if (updateEvent == "add" && regex.test(xmlhttp.responseText)) {
			window.location = xmlhttp.responseText;
			return true;
		}
		document.getElementById(updateEvent).innerHTML=xmlhttp.responseText;
	}
}

function loggedin() {
	if (xmlhttp.readyState==4 && xmlhttp.responseText != "") {
		var regex = /bent nu ingelogd/;
		if ( regex.test(xmlhttp.responseText) ) {
			document.getElementById("loggedin").style.display = 'inline';
			document.getElementById("loginform").style.display = 'none';
		}
		else {
			document.getElementById("loginmsg").innerHTML=xmlhttp.responseText;
		}
	}
}

function autoLogin() {
	document.getElementById("loggedin").style.display = 'inline';
	document.getElementById("loginform").style.display = 'none';
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