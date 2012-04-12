<?php

session_start();

// Zorgen dat deze pagina altijd wordt herladen zodat altijd de nieuwste gegevens worden opgevraagd.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require('../config.inc.php');
require('../main.php');

if ( check_login($_SESSION['hash'],$_SESSION['id'],$db) ) die("Log opnieuw in.");

if ( $_SERVER['REQUEST_METHOD'] == "GET" ) {
	if ( !empty($_GET['id']) ) {
		$q = $db->query("select * from webpages where `pageid` = '".$_GET['id']."'");
		echo $db->error;
		$prev = $q->fetch_assoc();
	}
	if ( $_GET['event'] == "add" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			Geef een naam op voor uw nieuwe pagina: <input id="input_add" name="option" onkeypress="onEnter(event,\''.$_GET['event'].'\',\''.$_GET['id'].'\');" /> 
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');"><img src="html/img/accept.png" alt="Toevoegen" /></a>
			<a onclick="location.reload(true);"><img src="html/img/cancel.png" alt="Annuleren" /></a>
			</form>';
	if ( $_GET['event'] == "del" ) {
		$db->query("delete from webpages where `pageid` = '".$_GET['id']."'");
		echo "DELETED";
	}
	if ( $_GET['event'] == "title" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			<input id="input_title" name="option" value="'.$prev['pagename'].'" onkeypress="onEnter(event,\''.$_GET['event'].'\',\''.$_GET['id'].'\');" /> 
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');"><img src="html/img/accept.png" alt="Update" /></a>
			<a onclick="location.reload(true);"><img src="html/img/cancel.png" alt="Annuleren" /></a>
			</form>';
	if ( $_GET['event'] == "content" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			<textarea id="input_innerContent" name="option">'.$prev['content'].'</textarea>
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');"><img src="html/img/accept.png" alt="Update" /></a>
			<a onclick="location.reload(true);"><img src="html/img/cancel.png" alt="Annuleren" /></a>
			</form>';
}
else {
	if ( $_POST['event'] == "add" ) {
		$short = urlencode(str_replace(" ","-",strtolower(substr($_POST['value'],0,30))));
		$db->query("insert into webpages values ('0', '".$short."', '".substr(strip_tags($_POST['value']),0,32)."', 'Nieuwe pagina.')");
		echo "?p=".stripslashes(substr($short,0,30));
		echo $db->error;
	}
	if ( $_POST['event'] == "title" ) {
		$db->query("update webpages set pagename = '".strip_tags($_POST['value'])."' where pageid = '".$_POST['id']."'");
		echo '<h1><a href="javascript:edit(\''.$_POST['event'].'\',\''.$_POST['id'].'\')">'.strip_tags($_POST['value']).'</a></h1>';
		echo $db->error;
	}
	if ( $_POST['event'] == "content" ) {
		$db->query("update webpages set content = '".$_POST['value']."' where pageid = '".$_POST['id']."'");
		echo nl2br($_POST['value']);
		echo $db->error;
	}
}

?>