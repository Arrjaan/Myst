<?php
// database connectie \\
function db($db) {

	$db = new mysqli($db['server'], $db['user'], $db['passw'], $db['db']);

	if ($db->connect_errno) {
		die('Connect Error: ' . $db->connect_errno);
		return false;
	}
	else return $db;

}

$db = db($db);

function save_log($sort,$a_page) {
	print("empty");
}

function error($errormsg, $errno = 0) {
	echo $errormsg;
}

// direct doorsturen \\
function redirect($url) {
	if ( !headers_sent() ) {
		header("HTTP/1.1 302 found");
		header("Location: ".$url);
	}
	else error('<span style="font-family: 
		Tahoma; font-size: 11px;">Redirect : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden.</span>');
	die();
}
	
?>