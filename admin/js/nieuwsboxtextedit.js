function addBBCode(tag)
{
	document.getElementsByName("tekst")[0].value += "[" + tag + "] [/" + tag + "]";
}
function addURL()
{
		document.getElementsByName("tekst")[0].value += "[url= /] [/url]";
}
function addEmail()
{
	var url = prompt("Enter E-mail Address:", "");
	if(url != null)
		document.getElementsByName("tekst")[0].value += "[email=" + url + "]" + email + "[/email]";
}
function addImg()
{
	var url = prompt("Enter Image URL:", "");
	if(url != null)
		document.getElementsByName("tekst")[0].value += "[img]" + url + "[/img]";
}
function nieuw_bericht()
{
	var txt='<table class="knoppen"><tr>'+
	'<td onclick="addBBCode(\'b\')" style="mouse=\'pointer\'"><b>B</b></td>'+
	'<td onclick="addBBCode(\'i\')" style="mouse=\'pointer\'"><i>I</i></td>'+
	'<td onclick="addBBCode(\'u\')" style="mouse=\'pointer\'"><u>U</u></td>'+
	'<td onclick="addBBCode(\'s\')" style="mouse=\'pointer\'"><s>S</s></td>'+
	'<td onclick="addURL()" style="mouse=\'pointer\'">URL</td>'+
	'</tr></table>';
	document.getElementById("input").innerHTML=txt;
}