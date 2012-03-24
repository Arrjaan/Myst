<?php

require('../config.inc.php');
require('../main.php');

if ( $_SERVER['REQUEST_METHOD'] == "GET" ) {
	if ( $_GET['event'] == "title" ) 
		echo '<form method="post" id="admin" onsubmit="return false">
			<input id="option" name="option" onkeypress="onEnter(event);" /> 
			<a onclick="saveEdit(\''.$_GET['event'].'\',\''.$_GET['id'].'\');return false;">Update</a>
			</form>  ';
}
else {
	if ( $_POST['event'] == "title" ) {
		$db->query("update webpages set pagename = '".$_POST['value']."' where pageid = '".$_POST['id']."'");
		echo '<h1><a href="javascript:edit()">'.$_POST['value'].'</a></h1>';
		echo $db->error;
	}
}

?>