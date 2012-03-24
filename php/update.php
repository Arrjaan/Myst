<?php

require('../config.inc.php');
require('../main.php');

if ( $_SERVER['REQUEST_METHOD'] == "GET" ) {
	$q = $db->query("select * from webpages where `pageid` = '".$_GET['id']."'");
	echo $db->error;
	$prev = $q->fetch_assoc();
	if ( $_GET['event'] == "title" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			<input id="option" name="option" value="'.$prev['pagename'].'" onkeypress="onEnter(event,\''.$_GET['event'].'\',\''.$_GET['id'].'\');" /> 
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');return false;">Update</a>
			</form>';
	if ( $_GET['event'] == "content" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			<textarea id="option" name="option">'.$prev['content'].'</textarea>
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');return false;">Update</a>
			</form>';
}
else {
	if ( $_POST['event'] == "title" ) {
		$db->query("update webpages set pagename = '".$_POST['value']."' where pageid = '".$_POST['id']."'");
		echo '<h1><a href="javascript:edit(\''.$_POST['event'].'\',\''.$_POST['id'].'\')">'.$_POST['value'].'</a></h1>';
		echo $db->error;
	}
	if ( $_POST['event'] == "content" ) {
		$db->query("update webpages set content = '".$_POST['value']."' where pageid = '".$_POST['id']."'");
		echo nl2br($_POST['value']);
		echo $db->error;
	}
}

?>